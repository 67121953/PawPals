<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    private function isAdmin(): bool
    {
        return Auth::user()?->role === 'admin';
    }

    private function conversationForUser(): Conversation
    {
        return Conversation::firstOrCreate([
            'user_id' => Auth::id(),
        ]);
    }

    public function index()
    {
        if ($this->isAdmin()) {
            $conversations = Conversation::with('user', 'latestMessage')
                ->withCount([
                    'messages as unread_count' => function ($query) {
                        $query->where('read_at', null)
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

        $conversation = $this->conversationForUser();

        $messages = $conversation->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();

        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'admin' => false,
            'conversation' => $conversation->load('user'),
            'messages' => $messages,
        ]);
    }

    public function conversation(Conversation $conversation)
    {
        abort_unless($this->isAdmin() || $conversation->user_id === Auth::id(), 403);

        $messages = $conversation->messages()
            ->with('sender:id,name,email,role')
            ->orderBy('id')
            ->get();

        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return response()->json([
            'conversation' => $conversation->load('user'),
            'messages' => $messages,
        ]);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:5000'],
            'conversation_id' => ['nullable', 'integer', 'exists:conversations,id'],
        ]);

        if ($this->isAdmin()) {
            abort_unless(!empty($validated['conversation_id']), 422, 'กรุณาเลือกผู้ติดต่อ');

            $conversation = Conversation::findOrFail($validated['conversation_id']);
        } else {
            $conversation = $this->conversationForUser();
        }

        $message = $conversation->messages()->create([
            'sender_id' => Auth::id(),
            'message' => trim($validated['message']),
        ]);

        $conversation->touch();

        return response()->json([
            'success' => true,
            'message' => $message->load('sender:id,name,email,role'),
        ]);
    }

    public function unread()
    {
        if ($this->isAdmin()) {
            $count = Message::whereNull('read_at')
                ->where('sender_id', '!=', Auth::id())
                ->whereHas('conversation')
                ->count();
        } else {
            $conversation = Conversation::where('user_id', Auth::id())->first();

            $count = $conversation
                ? $conversation->messages()
                    ->whereNull('read_at')
                    ->where('sender_id', '!=', Auth::id())
                    ->count()
                : 0;
        }

        return response()->json(['count' => $count]);
    }
}
