@extends('layouts.Users.Homeapp')

@section('content')
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <div class="container mx-auto p-4 bg-white my-1">
        @if (session('success') === 'success')
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                Reservation sent!
            </div>
        @endif

        @if (session('success') === 'Review submitted!')
            <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                Review submitted!
            </div>
        @endif

        <div class="mb-6 flex justify-end">
            <!-- Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click.stop="open = !open" class="text-gray-600 hover:text-black focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v.01M12 12v.01M12 18v.01" />
                    </svg>
                </button>

                <div x-show="open" @click.away="open = false" x-transition
                    class="absolute right-0 mt-2 w-32 bg-white border rounded-md shadow-lg z-50">
                    <a href="{{ route('users.ProdsReport', $product->id) }}"
                        class="block px-4 py-2 text-sm text-red-600 hover:bg-red-100">
                        Report
                    </a>
                </div>
            </div>
        </div>

        {{-- Product Section --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Product Image + Zoom Modal --}}
            <div x-data="{ open: false }" class="relative">
                <!-- Thumbnail -->
                <img @click="open = true"
                    src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                    alt="{{ $product->title }}"
                    class="w-full h-72 md:h-96 object-cover rounded-lg cursor-zoom-in ring-1 ring-gray-200" />

                <!-- Fullscreen Modal -->
                <div x-show="open" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80"
                    @click="open = false">
                    <div class="relative max-w-4xl w-full mx-auto p-4" @click.stop>
                        <button @click="open = false" class="absolute top-3 right-3 text-white text-3xl">&times;</button>
                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                            alt="{{ $product->title }}" class="w-full h-auto object-contain rounded-lg" />
                    </div>
                </div>
            </div>

            {{-- Product Info Section --}}
            <div class="flex flex-col justify-between space-y-3">
                {{-- Seller & Actions --}}
                <div class="flex justify-between items-center">
                    <!-- Left Side: Seller Profile + Name -->
                    <div class="flex items-center gap-3">
                        <img src="{{ $product->user->profile_photo_url ?? asset('images/default-user.png') }}"
                            alt="{{ $product->user->name ?? 'Seller' }}'s Photo"
                            class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-400" />
                        <div>
                            <h4 class="text-lg font-semibold">
                                {{ $product->user->name ?? 'Unknown Seller' }}'s Store
                            </h4>
                        </div>
                    </div>

                    <!-- Right Side: Message Icon -->
                    <div>
                        <a
                            href="{{ route('chatroom.show', ['user' => $product->user->id, 'product_id' => $product->id]) }}">
                            <i class="fas fa-comment-alt text-3xl text-blue-500 hover:text-blue-700"></i>
                        </a>
                    </div>
                </div>

                <hr>



                {{-- Title, Description, Price --}}
                <div>
                    <h2 class="font-bold mb-3 text-base break-words max-h-48 overflow-auto pr-2">{{ $product->title }}
                    </h2>
                    <div class="text-gray-700 mb-2 text-base break-words max-h-48 overflow-auto pr-2">
                        <p>
                            <strong class="text-muted">{{ $product->description }}</strong>
                        </p>
                    </div>

                    {{-- product discount area --}}
                    @php
                        $hasDiscount = $product->discount_percent && $product->discount_percent > 0;
                        $discountedPrice = $hasDiscount
                            ? $product->price - ($product->price * $product->discount_percent / 100)
                            : $product->price;
                    @endphp

                    {{-- for discount price --}}
                    <input type="hidden" id="unitPrice" value="{{ $discountedPrice }}">




                    {{-- Rating --}}
                    @php
                        $average = number_format($product->reviews->avg('rating'), 1);
                        $count = $product->reviews->count();
                    @endphp
                    <p class="text-yellow-500 text-lg mt-2">
                        <strong>Ratings:</strong>
                        {{ str_repeat('★', round($average)) }}{{ str_repeat('☆', 5 - round($average)) }}
                        <span class="text-gray-600">
                            ({{ $average }} / 5 from {{ $count }} review{{ $count !== 1 ? 's' : '' }})
                        </span>
                    </p>
                </div>

                {{-- Order Form --}}
                <form action="{{ route('users.order') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" id="unitPrice" value="{{ $product->price }}">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-1 gap-3">
                        <!-- Quantity -->
                        <div class="flex items-center gap-5">
                            <label for="quantity" class="text-sm font-medium">Qty (kg):</label>
                            <input type="number" name="quantity" id="quantity" min="1" class="form-control" value="1"
                                required />
                        </div>

                        <!-- Optional Custom Price -->
                        <div class="flex items-center gap-2">
                            <label for="custom_price" class="text-sm font-medium text-gray-700">Balor/Worth (₱):</label>
                            <input type="number" name="custom_price" id="custom_price" class="form-control"
                                placeholder="Or enter custom price" />
                        </div>

                    </div>

                    <!-- Payment Method & Submit -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 gap-6 justify-center">
                        <!-- Total Price Display -->
                        <div class="text-sm text-gray-800 items-center mb-1">
                            <div>
                                <p>
                                    @if($hasDiscount)
                                        <span
                                            class="text-muted text-decoration-line-through ms-2">₱{{ number_format($product->price, 2) }}</span>
                                        <span class="badge bg-danger ms-2">{{ $product->discount_percent }}% OFF</span>
                                    @endif
                                </p>
                                <span class="text-lg">Total Price:</span>
                                <strong class="text-green-700 text-lg">₱<span
                                        id="totalPrice">{{ number_format($discountedPrice, 2) }}</span></strong>
                            </div>
                        </div>



                        <div class="flex items-center gap-2">
                            <label for="payment_method" class="text-sm font-medium">Payment:</label>
                            <select name="payment_method" id="payment_method" required>
                                <option value="gcash">GCash</option>
                                <option value="cod">Cash on Pick-up</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info w-full sm:w-auto">Reserve Now!!</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- line break or liner --}}
        <hr class="my-6">

        @php
            $allReviews = $product->reviews->sortByDesc('created_at');
            $visibleReviews = $allReviews->take(2);
            $hiddenReviews = $allReviews->skip(2);
        @endphp

        <div class="mb-6" x-data="{ showMore: false }">
            <h4 class="text-lg font-semibold mb-4">Reviews</h4>

            {{-- Always show the first 2 --}}
            @foreach ($visibleReviews as $review)
                @include('components.review-card', ['review' => $review])
            @endforeach

            {{-- Collapsible hidden reviews --}}
            @if ($hiddenReviews->count())
                <div x-show="showMore" x-collapse>
                    @foreach ($hiddenReviews as $review)
                        @include('components.review-card', ['review' => $review])
                    @endforeach
                </div>

                <button @click="showMore = !showMore"
                    class="text-xs mt-2 px-2 py-1 bg-gray-100 text-gray-700 rounded hover:bg-gray-200">
                    <span x-show="!showMore">Show More Reviews</span>
                    <span x-show="showMore">Hide Reviews</span>
                </button>
            @endif
        </div>


        {{-- Leave Review Form --}}
        @auth
            <div class="mt-8">
                <h5 class="text-lg font-semibold mb-4">Leave a Review</h5>
                <form action="{{ route('users.prodsDetails', $product->id) }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf

                    <div>
                        <label for="rating" class="form-label">Rating</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">-Select Rating-</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="comment" class="form-label">Comment</label>
                        <textarea name="comment" id="comment" rows="3" class="form-control" required></textarea>
                    </div>

                    <div>
                        <label for="photo" class="form-label">Upload a Photo (optional)</label>
                        <input type="file" name="photo" id="photo" class="form-control" accept="image/*">
                    </div>

                    <button type="submit" class="btn btn-info">Submit Review</button>
                </form>
            </div>
        @else
            <p class="mt-3 text-sm">Please <a href="{{ route('login') }}" class="text-blue-600">login</a> to leave a review.
            </p>
        @endauth
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <!--report-->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Live Calculation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const quantityInput = document.getElementById('quantity');
            const customPriceInput = document.getElementById('custom_price');
            const totalPriceEl = document.getElementById('totalPrice');
            const unitPrice = parseFloat(document.getElementById('unitPrice').value);

            function updateTotal() {
                const qty = parseFloat(quantityInput.value) || 0;
                const customPrice = parseFloat(customPriceInput.value) || 0;
                let total = 0;

                if (customPrice > 0) {
                    total = customPrice;
                } else if (qty > 0) {
                    total = unitPrice * qty;
                } else {
                    total = unitPrice;
                }

                totalPriceEl.textContent = total.toFixed(2);
            }

            function toggleInputs() {
                const customPrice = parseFloat(customPriceInput.value) || 0;
                const qty = parseFloat(quantityInput.value) || 0;

                quantityInput.disabled = customPrice > 0;
                customPriceInput.disabled = qty > 0;
            }

            quantityInput.addEventListener('input', () => {
                updateTotal();
                toggleInputs();
            });

            customPriceInput.addEventListener('input', () => {
                updateTotal();
                toggleInputs();
            });

            updateTotal();
            toggleInputs();
        });
    </script>


@endsection