@extends('layouts.Users.Homeapp')

@section('content')
    <div class="max-w-5xl mx-auto py-8 px-4">
        <h1 class="text-center text-3xl font-semibold mb-8">My Reviews</h1>

        @forelse ($reviews as $review)
            <a href="{{ $review->product ? route('users.prodsDetails', $review->product->id) . '#reviews-section' : '#' }}"
                class="group block no-underline">
                <div
                    class="bg-white rounded-2xl shadow-md hover:shadow-lg transition p-5 mb-5 flex flex-col sm:flex-row items-start sm:items-center gap-5 border border-gray-100">

                    <!-- Product Image -->
                    <div class="flex-shrink-0 w-28 h-28 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">
                        @if ($review->product && $review->product->image)
                            <img src="{{ asset('storage/' . $review->product->image) }}" alt="{{ $review->product->title }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('images/default-product.png') }}" alt="No image"
                                class="w-full h-full object-cover opacity-70">
                        @endif
                    </div>

                    <!-- Review Info -->
                    <div class="flex-1">
                        @if ($review->product)
                            <h2 class="text-2xl font-semibold text-gray-800">{{ $review->product->title }}</h2>
                            <p class="text-sm text-gray-500">
                                Seller: <span class="font-medium text-gray-700">
                                    {{ $review->product->user->name ?? 'Unknown Seller' }}
                                </span>
                            </p>
                        @else
                            <h2 class="text-lg font-semibold text-gray-800">[Deleted Product]</h2>
                            <p class="text-sm text-gray-500">Seller: Unknown</p>
                        @endif

                        <div class="mt-2 text-gray-700">
                            <p><span class="font-medium">Comment:</span> {{ $review->comment }}</p>
                            <p class="mt-1">
                                <span class="font-medium">Rating:</span>
                                @if ($review->rating)
                                    <span class="text-yellow-500">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                    </span>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-20 text-gray-500 text-lg">
                You haven’t written any reviews yet.
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            if (window.location.hash === "#reviews-section") {
                const section = document.querySelector("#reviews-section");
                if (section) {
                    section.scrollIntoView({ behavior: "smooth", block: "start" });
                }
            }
        });
    </script>
@endpush