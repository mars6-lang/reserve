<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Chat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users\products;

class ChatController extends Controller
{
    public function index()
    {
        $authId = auth()->id();

        $contacts = Chat::where('sender_id', $authId)
            ->orWhere('receiver_id', $authId)
            ->with(['sender', 'receiver', 'product'])
            ->get()
            ->map(function ($chat) use ($authId) {
                return $chat->sender_id == $authId ? $chat->receiver : $chat->sender;
            })
            ->unique('id')
            ->values();

        $contactProducts = [];

        foreach ($contacts as $contact) {
            // Get the latest product sent BY the contact (e.g., buyer)
            $latestProductMessage = Chat::where('sender_id', $contact->id)
                ->where('receiver_id', $authId)
                ->whereNotNull('product_id')
                ->with('product')
                ->latest()
                ->first();

            $contactProducts[$contact->id] = $latestProductMessage?->product;
        }

        return view('chatroom.index', compact('contacts', 'contactProducts'));
    }

    public function show(User $user, Request $request)
    {
        $authId = auth()->id();

        // Get all messages between the two users
        $messages = Chat::where(function ($q) use ($authId, $user) {
            $q->where('sender_id', $authId)
                ->where('receiver_id', $user->id);
        })->orWhere(function ($q) use ($authId, $user) {
            $q->where('sender_id', $user->id)
                ->where('receiver_id', $authId);
        })->orderBy('created_at')->get();

        // Priority 1: Product selected via request (e.g., when buyer manually picks a product before chatting)
        if ($request->filled('product_id')) {
            $product = products::find($request->input('product_id'));
        }

        // Priority 2: Fallback to most recent product-based message
        if (empty($product)) {
            $lastMessageWithProduct = $messages->whereNotNull('product_id')->last();
            $product = $lastMessageWithProduct?->product;
        }

        return view('chatroom.show', compact('user', 'messages', 'product'));
    }


    public function store(Request $request, User $user)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $user->id,
            'message' => $request->message,
            'product_id' => $request->product_id

        ]);

        return back();
    }
}
