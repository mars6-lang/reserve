@extends('layouts.Users.Homeapp')
@section('content')

    <div class="container mt-4 overflow-x-hidden">
        <h3 class="mb-4 text-xl font-semibold">Your Product Ratings & Comments</h3>

        @forelse ($reviews as $review)
            <div class="card mb-3 p-4 shadow-sm flex flex-col sm:flex-row gap-4 overflow-hidden"> {{-- FIXED --}}

                {{-- Product Image --}}
                <div class="flex-shrink-0">
                    @if ($review->product && $review->product->image)
                        <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->title }}"
                            class="rounded w-[100px] h-[100px] object-cover" />
                    @else
                        <img src="https://via.placeholder.com/100x100?text=No+Image" alt="No Image"
                            class="rounded w-[100px] h-[100px] object-cover" />
                    @endif
                </div>

                {{-- Review Content --}}
                <div class="flex-1 min-w-0">
                    <h5 class="text-lg font-bold break-words">
                        Product name: {{ $review->product->title ?? 'Unknown Product' }}
                    </h5>
                    <p class="mt-3">
                        <strong class="text-lg">{{ $review->user->name }} rated:</strong>
                        <span class="text-yellow-500 ml-3 text-2xl">
                            {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
                        </span>
                    </p>
                    <div class="mt-0 break-words whitespace-pre-line w-full overflow-hidden">
                        <p class="text-base break-words"><strong>Commented:</strong> {{ $review->comment }}</p>
                        <small class="text-gray-500">{{ $review->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No reviews found for your products.</p>
        @endforelse
    </div>

@endsection