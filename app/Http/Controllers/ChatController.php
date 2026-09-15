<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ตรวจสอบ Admin
    |--------------------------------------------------------------------------
    */

    private function isAdmin(): bool
    {
        return Auth::user()?->role === 'admin';
    }


    /*
    |--------------------------------------------------------------------------
    | Conversation ของ User ปัจจุบัน
    |--------------------------------------------------------------------------
    |
    | User 1 คน = 1 Conversation
    |
    | Conversation ไม่ผูกกับ Admin
    |
    | ดังนั้น Admin ทุกคนสามารถเข้ามาดูและตอบได้
    |
    */

    private function conversationForUser(): Conversation
    {
        return Conversation::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | เปิด Chat
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        |
        | Admin ทุกคนเห็น User ทุกคน
        |
        */

        if ($this->isAdmin()) {

            $conversations = Conversation::with([
                    'user:id,name,email',
                    'latestMessage',
                ])
                ->withCount([
                    'messages as unread_count' => function ($query) {

                        $query
                            ->whereNull('read_at')
                            ->where('sender_id', '!=', Auth::id());

                    },
                ])
                ->orderByDesc('updated_at')
                ->get();


            return response()->json([
                'success' => true,
                'admin' => true,
                'conversations' => $conversations,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        $conversation = $this->conversationForUser();


        $messages = $conversation
            ->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | User เปิด Chat
        | ทำข้อความจาก Admin เป็นอ่านแล้ว
        |--------------------------------------------------------------------------
        */

        $conversation
            ->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        return response()->json([
            'success' => true,
            'admin' => false,
            'conversation' => $conversation->load('user:id,name,email'),
            'messages' => $messages,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ดึงข้อความ Conversation
    |--------------------------------------------------------------------------
    */

    public function messages(Request $request)
    {
        $user = Auth::user();

        $conversationId = $request->get('conversation_id');


        if (!$conversationId) {

            return response()->json([
                'success' => false,
                'message' => 'ไม่พบ Conversation',
            ], 400);
        }


        $conversation = Conversation::findOrFail(
            $conversationId
        );


        /*
        |--------------------------------------------------------------------------
        | ตรวจสอบสิทธิ์
        |--------------------------------------------------------------------------
        */

        if (
            !$this->isAdmin() &&
            $conversation->user_id !== $user->id
        ) {

            return response()->json([
                'success' => false,
                'message' => 'ไม่มีสิทธิ์เข้าถึงบทสนทนานี้',
            ], 403);
        }


        /*
        |--------------------------------------------------------------------------
        | โหลดข้อความ
        |--------------------------------------------------------------------------
        */

        $messages = $conversation
            ->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Mark Read
        |--------------------------------------------------------------------------
        */

        $conversation
            ->messages()
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        return response()->json([
            'success' => true,
            'conversation' => $conversation->load('user:id,name,email'),
            'messages' => $messages,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ดึง Conversation รายตัว
    |--------------------------------------------------------------------------
    |
    | ใช้เมื่อ Admin คลิกเลือกผู้ติดต่อ
    |
    */

    public function conversation(Conversation $conversation)
    {
        /*
        |--------------------------------------------------------------------------
        | Admin ทุกคนดูได้
        |--------------------------------------------------------------------------
        |
        | User ดูได้เฉพาะของตัวเอง
        |
        */

        abort_unless(
            $this->isAdmin() ||
            $conversation->user_id === Auth::id(),
            403
        );


        /*
        |--------------------------------------------------------------------------
        | โหลดข้อความ
        |--------------------------------------------------------------------------
        */

        $messages = $conversation
            ->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Mark Read
        |--------------------------------------------------------------------------
        */

        $conversation
            ->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);


        return response()->json([
            'success' => true,

            'conversation' => $conversation->load(
                'user:id,name,email'
            ),

            'messages' => $messages,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ส่งข้อความ
    |--------------------------------------------------------------------------
    */

    public function send(Request $request)
    {
        $validated = $request->validate([

            'message' => [
                'required',
                'string',
                'max:5000',
            ],

            'conversation_id' => [
                'nullable',
                'integer',
                'exists:conversations,id',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($this->isAdmin()) {

            if (empty($validated['conversation_id'])) {

                return response()->json([
                    'success' => false,
                    'message' => 'กรุณาเลือกผู้ติดต่อก่อนส่งข้อความ',
                ], 422);
            }


            $conversation = Conversation::findOrFail(
                $validated['conversation_id']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        else {

            $conversation = $this->conversationForUser();
        }


        /*
        |--------------------------------------------------------------------------
        | สร้าง Message
        |--------------------------------------------------------------------------
        */

        $message = $conversation
            ->messages()
            ->create([

                'sender_id' => Auth::id(),

                'message' => trim(
                    $validated['message']
                ),

            ]);


        /*
        |--------------------------------------------------------------------------
        | Update Conversation
        |--------------------------------------------------------------------------
        */

        $conversation->touch();


        /*
        |--------------------------------------------------------------------------
        | โหลดข้อมูลผู้ส่ง
        |--------------------------------------------------------------------------
        */

        $message->load(
            'sender:id,name,email,role'
        );


        return response()->json([
            'success' => true,
            'message' => $message,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ส่งข้อความจาก Contact
    |--------------------------------------------------------------------------
    */

    public function sendContact(Request $request)
    {
        $validated = $request->validate([

            'message' => [
                'required',
                'string',
                'max:5000',
            ],

        ]);


        /*
        |--------------------------------------------------------------------------
        | หา Conversation ของ User
        |--------------------------------------------------------------------------
        */

        $conversation = $this->conversationForUser();


        /*
        |--------------------------------------------------------------------------
        | สร้างข้อความ
        |--------------------------------------------------------------------------
        */

        $conversation
            ->messages()
            ->create([

                'sender_id' => Auth::id(),

                'message' => trim(
                    $validated['message']
                ),

            ]);


        /*
        |--------------------------------------------------------------------------
        | Update เวลา
        |--------------------------------------------------------------------------
        */

        $conversation->touch();


        return redirect()
            ->route('contact')
            ->with(
                'success',
                'ส่งข้อความเรียบร้อยแล้ว ข้อความถูกส่งถึงทีม Admin ทุกคนแล้ว'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | จำนวนข้อความที่ยังไม่ได้อ่าน
    |--------------------------------------------------------------------------
    */

    public function unread()
    {
        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        if ($this->isAdmin()) {

            $count = Message::whereNull('read_at')
                ->where(
                    'sender_id',
                    '!=',
                    Auth::id()
                )
                ->whereHas('conversation')
                ->count();
        }


        /*
        |--------------------------------------------------------------------------
        | USER
        |--------------------------------------------------------------------------
        */

        else {

            $conversation = Conversation::where(
                'user_id',
                Auth::id()
            )->first();


            $count = $conversation

                ? $conversation
                    ->messages()
                    ->whereNull('read_at')
                    ->where(
                        'sender_id',
                        '!=',
                        Auth::id()
                    )
                    ->count()

                : 0;
        }


        return response()->json([
            'count' => $count,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | Mark As Read
    |--------------------------------------------------------------------------
    */

    public function markAsRead(Request $request)
    {
        $validated = $request->validate([

            'conversation_id' => [
                'required',
                'integer',
                'exists:conversations,id',
            ],

        ]);


        $conversation = Conversation::findOrFail(
            $validated['conversation_id']
        );


        /*
        |--------------------------------------------------------------------------
        | ตรวจสอบสิทธิ์
        |--------------------------------------------------------------------------
        */

        abort_unless(

            $this->isAdmin() ||
            $conversation->user_id === Auth::id(),

            403

        );


        /*
        |--------------------------------------------------------------------------
        | Mark Read
        |--------------------------------------------------------------------------
        */

        $conversation
            ->messages()
            ->whereNull('read_at')
            ->where(
                'sender_id',
                '!=',
                Auth::id()
            )
            ->update([
                'read_at' => now(),
            ]);


        return response()->json([
            'success' => true,
        ]);
    }
}