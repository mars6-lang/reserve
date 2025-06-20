@extends('layouts.Users.Homeapp')

@section('content')



    <div class="max-w-5xl mx-auto bg-gray-50 p-6 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Chatting with {{ $user->name }}</h2>

        {{-- Message History --}}
        <div class="border rounded p-4 mb-6 bg-white h-80 overflow-y-auto space-y-2">
            @forelse($messages as $msg)
                <div class="flex {{ $msg->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="rounded-lg px-4 py-2 max-w-xs break-words
                                    {{ $msg->sender_id == auth()->id() ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-800' }}">
                        <p>{{ $msg->message }}</p>
                        <p class="text-xs text-black-300 mt-1 text-right">
                            {{ $msg->created_at->format('M d, h:i A') }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500 text-center">No messages yet. Start the conversation!</p>
            @endforelse
        </div>

        {{-- Product Preview (if any) --}}
        @if($product)
            <div class="mb-6 flex items-center gap-4 bg-gray-100 p-3 rounded shadow-sm">
                <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                    class="w-16 h-16 object-cover rounded border">
                <div>
                    <p class="font-medium text-lg">{{ $product->title }}</p>
                    <p class="text-sm text-gray-600">₱{{ number_format($product->price, 2) }}</p>
                </div>
            </div>
        @endif

        {{-- Send Message Form --}}
        <form action="{{ route('chatroom.store', $user->id) }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id ?? ''}}">

            <div class="flex gap-2">
                <input type="text" name="message"
                    class="flex-grow border rounded-lg px-4 py-2 focus:outline-none focus:ring focus:border-blue-300"
                    required placeholder="Type your message...">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                    Send
                </button>
            </div>
        </form>
    </div>


@endsection