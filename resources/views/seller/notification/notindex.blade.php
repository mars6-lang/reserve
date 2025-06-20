@extends('layouts.Seller.Sellerapp')

@section('content')
    @if (session('success') === 'Notification deleted.')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            Notification deleted!
        </div>
    @endif

    @if (session('success') === 'All notifications deleted.')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            All shits deleted!
        </div>
    @endif






    
    <div class="container my-4">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3">
            <h4 class="fw-bold mb-3 mb-md-0">Your Notifications</h4>

            <div class="d-flex flex-column flex-md-row gap-2">
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <form action="{{ route('markAllNotificationsRead') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm d-flex align-items-center gap-1">
                            <i class="fas fa-check-double"></i> Mark All as Read
                        </button>
                    </form>
                @endif

                @if(auth()->user()->notifications->count() > 0)
                    <form action="{{ route('seller.deleteall') }}" method="POST"
                        onsubmit="return confirm('Delete all notifications?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1">
                            <i class="fas fa-trash-alt"></i> Delete All
                        </button>
                    </form>
                @endif
            </div>
        </div>

        @forelse(auth()->user()->notifications as $notification)
            @php
                $title = $notification->data['title'] ?? 'Notice';
                $message = $notification->data['message'] ?? '';
                $styles = [
                    'Banned' => ['fas fa-ban', 'text-danger', 'border-danger'],
                    'Suspended' => ['fas fa-user-slash', 'text-warning', 'border-warning'],
                    'Warned' => ['fas fa-exclamation-circle', 'text-info', 'border-info'],
                ];
                $style = $styles[$title] ?? ['fas fa-bell', 'text-secondary', 'border-secondary'];
            @endphp

            <div class="card shadow-sm mb-3 border-start {{ $style[2] }}">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between gap-3">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-1">
                            <i class="{{ $style[0] }} {{ $style[1] }} me-2"></i> {{ $title }}
                        </h5>
                        <p class="card-text mb-1">{{ $message }}</p>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>

                    <div class="d-flex flex-column gap-1 align-self-start">
                        @if($notification->unread())
                            <form action="{{ route('markNotificationRead', $notification->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-outline-primary btn-sm">Mark as Read</button>
                            </form>
                        @endif

                        <form action="{{ route('seller.notidelete', $notification->id) }}" method="POST"
                            onsubmit="return confirm('Delete this notification?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-secondary text-center">You have no notifications.</div>
        @endforelse

        <div class="mt-4 text-end">
            <span class="badge bg-danger px-3 py-2 fs-6">
                <i class="fas fa-bell me-1"></i> Unread: {{ auth()->user()->unreadNotifications->count() }}
            </span>
        </div>
    </div>


@endsection