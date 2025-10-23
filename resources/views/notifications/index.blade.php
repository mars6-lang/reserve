@extends('layouts.Users.Homeapp')

@section('content')
    <div class="max-w-4xl mx-auto p-4 sm:p-6">

        {{-- Header with Delete All --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
            <h2 class="text-2xl font-semibold">Notifications</h2>

            @if($notifications->isNotEmpty())
                <form action="{{ route('notifications.deleteAll') }}" method="POST" class="self-start sm:self-center">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 hover:text-red-800 text-sm sm:text-base font-medium flex items-center gap-1">
                        <i class="fa fa-trash"></i> Delete All
                    </button>
                </form>
            @endif
        </div>

        {{-- Notifications List --}}
        @if($notifications->isEmpty())
            <p class="text-gray-500 text-center">No notifications yet.</p>
        @else
            <div class="bg-white shadow rounded-lg divide-y">
                @foreach($notifications as $notification)
                    <div class="relative p-4 hover:bg-gray-50 transition flex items-start justify-between">

                        {{-- Notification Info --}}
                        <a href="{{ route('seller.ordersList', ['id' => $notification->id]) }}">
                            <div
                                class="flex-shrink-0 w-16 h-16 rounded-lg overflow-hidden border bg-gray-50 flex items-center justify-center">
                                @if($notification->type === \App\Notifications\ReservedOrdersNotification::class)
                                    <img src="{{ asset('storage/' . ($notification->data['product_image'] ?? '')) }}"
                                        alt="Product Image" class="w-full h-full object-cover">
                                @elseif($notification->type === \App\Notifications\NewReplyNotification::class)
                                    <i class="fa fa-comment text-xl text-gray-600"></i>
                                @else
                                    <i class="fa fa-bell text-xl text-gray-600"></i>
                                @endif
                            </div>

                            <div class="flex-1">
                                <p class="{{ $notification->read_at ? 'text-gray-500' : 'text-black font-semibold' }}">
                                    {{ $notification->data['message'] }}
                                </p>
                                <small class="text-gray-400">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </a>

                        {{-- Mark as Read Button --}}
                        @if(!$notification->read_at)
                            <form action="{{ route('notifications.read', $notification->id) }}" method="POST" class="ml-4">
                                @csrf
                                <button type="submit" class="text-blue-600 hover:underline text-sm">
                                    Mark as Read
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection