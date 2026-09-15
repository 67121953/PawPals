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
    | ตรวจสอบว่าเป็น Admin หรือไม่
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
        | Admin
        |--------------------------------------------------------------------------
        */

        if ($this->isAdmin()) {

            $conversations = Conversation::with([
                    'user',
                    'latestMessage',
                ])
                ->withCount([
                    'messages as unread_count' => function ($query) {
                        $query->whereNull('read_at')
                            ->where('sender_id', '!=', Auth::id());
                    },
                ])
                ->latest('updated_at')
                ->get();

            return response()->json([
                'admin' => true,
                'conversations' => $conversations,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | User ทั่วไป
        |--------------------------------------------------------------------------
        */

        $conversation = $this->conversationForUser();

        $messages = $conversation->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();

        /*
        | เมื่อ User เปิด Chat
        | ให้ข้อความจาก Admin ถูกทำเครื่องหมายว่าอ่านแล้ว
        */

        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'admin' => false,
            'conversation' => $conversation->load('user'),
            'messages' => $messages,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ดึงข้อความของ Conversation
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

        $conversation = Conversation::findOrFail($conversationId);

        /*
        | Admin สามารถดูทุก Conversation
        | User ดูได้เฉพาะ Conversation ของตัวเอง
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

        $messages = $conversation->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();

        /*
        | เมื่อเปิดข้อความ ให้ถือว่าอ่านแล้ว
        */

        $conversation->messages()
            ->where('sender_id', '!=', $user->id)
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'conversation' => $conversation->load('user'),
            'messages' => $messages,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ดึง Conversation รายตัว
    |--------------------------------------------------------------------------
    */

    public function conversation(Conversation $conversation)
    {
        /*
        | Admin ดูได้ทุก Conversation
        | User ดูเฉพาะของตัวเอง
        */

        abort_unless(
            $this->isAdmin() ||
            $conversation->user_id === Auth::id(),
            403
        );

        $messages = $conversation->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();

        /*
        | ทำเครื่องหมายข้อความที่ส่งมาจากอีกฝ่ายว่าอ่านแล้ว
        */

        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
            'conversation' => $conversation->load('user'),
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
        | Admin
        |--------------------------------------------------------------------------
        */

        if ($this->isAdmin()) {

            if (empty($validated['conversation_id'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'กรุณาเลือกผู้ติดต่อ',
                ], 422);
            }

            $conversation = Conversation::findOrFail(
                $validated['conversation_id']
            );
        }


        /*
        |--------------------------------------------------------------------------
        | User ทั่วไป
        |--------------------------------------------------------------------------
        */

        else {

            $conversation = $this->conversationForUser();
        }


        /*
        |--------------------------------------------------------------------------
        | สร้างข้อความ
        |--------------------------------------------------------------------------
        */

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'message' => trim($validated['message']),
        ]);

        /*
        | อัปเดตเวลาของ Conversation
        */

        $conversation->touch();

        /*
        | โหลดข้อมูลผู้ส่งกลับไปด้วย
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

        $conversation = $this->conversationForUser();

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'message' => trim($validated['message']),
        ]);

        $conversation->touch();

        return redirect()
            ->route('contact')
            ->with(
                'success',
                'ส่งข้อความเรียบร้อยแล้ว คุณสามารถพูดคุยกับ Admin ต่อได้ผ่านกล่อง Chat'
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
        | Admin
        |--------------------------------------------------------------------------
        */

        if ($this->isAdmin()) {

            $count = Message::whereNull('read_at')
                ->where('sender_id', '!=', Auth::id())
                ->whereHas('conversation')
                ->count();
        }


        /*
        |--------------------------------------------------------------------------
        | User ทั่วไป
        |--------------------------------------------------------------------------
        */

        else {

            $conversation = Conversation::where(
                'user_id',
                Auth::id()
            )->first();

            $count = $conversation
                ? $conversation->messages()
                    ->whereNull('read_at')
                    ->where('sender_id', '!=', Auth::id())
                    ->count()
                : 0;
        }

        return response()->json([
            'count' => $count,
        ]);
    }


    /*
    |--------------------------------------------------------------------------
    | ทำเครื่องหมายว่าอ่านแล้ว
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
        | ตรวจสอบสิทธิ์
        */

        abort_unless(
            $this->isAdmin() ||
            $conversation->user_id === Auth::id(),
            403
        );

        /*
        | เปลี่ยนข้อความของอีกฝ่ายเป็นอ่านแล้ว
        */

        $conversation->messages()
            ->whereNull('read_at')
            ->where('sender_id', '!=', Auth::id())
            ->update([
                'read_at' => now(),
            ]);

        return response()->json([
            'success' => true,
        ]);
    }
}