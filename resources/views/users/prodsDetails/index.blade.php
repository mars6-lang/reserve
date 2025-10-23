@extends('layouts.Users.Homeapp')
@section('content')

    


    <div class="w-full min-h-screen bg-gray-200 py-6 px-3 sm:px-6">
        <div class="max-w-8xl mx-auto bg-white rounded-lg p-4 sm:p-8">
            @if (session('success'))
                <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                    x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
                    ✅ {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
                    x-init="setTimeout(() => show = false, 3000)" class="text-center text-red-600 font-medium text-lg mb-6">
                    ❌ {{ session('error') }}
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

            <div class="container">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-2">

                    {{-- LEFT SIDE: Product Image --}}
                    <div x-data="{ open: false }" class="relative space-y-4">
                        <img @click="open = true"
                            src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                            alt="{{ $product->title }}"
                            class="w-full h-72 md:h-96 object-cover rounded-lg cursor-zoom-in ring-1 ring-gray-200" />

                        <!-- Fullscreen Modal -->
                        <div x-show="open" x-transition
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-80"
                            @click="open = false">
                            <div class="relative max-w-4xl w-full mx-auto p-4" @click.stop>
                                <button @click="open = false"
                                    class="absolute top-3 right-3 text-white text-3xl">&times;</button>
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                    alt="{{ $product->title }}" class="w-full h-auto object-contain rounded-lg" />
                            </div>
                        </div>
                    </div>

                    {{-- RIGHT SIDE: Title, Description, Payment Options --}}
                    <div class="flex flex-col justify-between space-y-2 py-1">

                        <!-- Product Title -->
                        <h2 class="font-bold mb-2 text-2xl text-gray-900 break-words leading-tight">
                            {{ $product->title }}
                        </h2>

                        <!-- Description -->
                        <div class="text-gray-700 mb-2 text-lg leading-relaxed break-words max-h-48 overflow-auto pr-2">
                            <p>{{ $product->description }}</p>
                        </div>

                        <!-- Ratings -->
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

                        <!-- Order Form -->
                        <form action="{{ route('users.order') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" id="unitPrice" value="{{ $product->price }}">

                            <!-- Quantity -->
                            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-4 gap-3">
                                <div class="flex items-center gap-3">
                                    <label for="quantity" class="text-sm font-medium">Qty (kg):</label>
                                    <input type="number" name="quantity" id="quantity" min="1" class="form-control w-24"
                                        value="1" required />
                                </div>
                            </div>

                            <!-- Total Price Display -->
                            <div class="bg-gray-100 p-4 rounded-lg border-2 border-gray-300">
                                <p class="text-center text-lg font-bold text-gray-800">
                                    Total Price: <span class="text-green-600">₱<span id="totalPrice">0.00</span></span>
                                </p>
                            </div>

                            <!-- Reserve Button -->
                            <div class="flex justify-center">
                                @auth
                                    <button type="submit"
                                        class="w-full sm:w-auto px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200 font-semibold text-lg">
                                        Reserve
                                    </button>
                                @else
                                    <a href="{{ route('login') }}"
                                        class="w-full sm:w-auto block text-center px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700 transition duration-200 font-semibold text-lg"
                                        style="text-decoration: none;">
                                        Log in
                                    </a>
                                @endauth
                            </div>
                        </form>
                    </div>
                </div>

                {{-- SELLER INFO CARD --}}
                <div class="bg-white shadow-md rounded-lg p-4 flex justify-between items-center mb-6">
                    <div class="flex items-center gap-3">
                        <img src="{{ $product->user->profile_photo_url ?? asset('images/default-user.png') }}"
                            alt="{{ $product->user->name ?? 'Seller' }}'s Photo"
                            class="w-12 h-12 rounded-full object-cover ring-2 ring-blue-400" />
                        <div>
                            <h4 class="text-lg font-semibold text-gray-800">
                                {{ $product->user->name ?? 'Unknown Seller' }}'s Store
                            </h4>
                            <p class="text-sm text-gray-500">Trusted Seller</p>
                        </div>
                    </div>

                    <div>
                        <a href="{{ route('chatroom.show', ['user' => $product->user->id, 'product_id' => $product->id]) }}"
                            class="bg-blue-50 p-3 rounded-full hover:bg-blue-100 transition">
                            <i class="fas fa-comment-alt text-2xl text-blue-500 hover:text-blue-700"></i>
                        </a>
                    </div>
                </div>

                {{-- COMMENTS / REVIEWS SECTION --}}
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h4 class="text-lg font-semibold mb-4">Reviews</h4>

                    @php
                        $allReviews = $product->reviews->sortByDesc('created_at');
                        $visibleReviews = $allReviews->take(2);
                        $hiddenReviews = $allReviews->skip(2);
                    @endphp

                    <div x-data="{ showMore: false }">
                        @foreach ($visibleReviews as $review)
                            @include('components.review-card', ['review' => $review])
                        @endforeach

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

                    {{-- Leave Review --}}
                    @auth
                        @php
                            // Only count RECEIVED orders, not completed (completed = no longer active reservation)
                            $hasReceivedOrder = \App\Models\Users\orders::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->where('status', 'received')
                                ->exists();
                            
                            $hasExistingReview = \App\Models\Users\reviewcomments::where('user_id', auth()->id())
                                ->where('product_id', $product->id)
                                ->exists();
                            
                            $canReview = $hasReceivedOrder && !$hasExistingReview;
                        @endphp

                        @if ($canReview)
                            <div class="mt-8 border-t pt-4">
                                <h5 class="text-lg font-semibold mb-4">Leave a Review</h5>
                                <form action="{{ route('users.prodsDetails', $product->id) }}" method="POST"
                                    enctype="multipart/form-data" class="space-y-4">
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
                            <div class="mt-8 border-t pt-4">
                                @if ($hasExistingReview)
                                    <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded">
                                        <p class="text-green-800 font-medium">
                                            ✅ Thank you! You have already reviewed this product. One review per product per buyer.
                                        </p>
                                    </div>
                                @else
                                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
                                        <p class="text-yellow-800 font-medium">
                                            📦 You can leave a review after you have received your reserved product.
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="d-flex justify-center">
                            <strong>
                                <p class="mt-3 text-sm">Please <a href="{{ route('login') }}"
                                        class="text-blue-600 hover:underline">login</a> to leave a review.</p>
                            </strong>
                        </div>
                    @endauth
                </div>
            </div>
        </div>

        


        <!-- Live Calculation Script -->
        <script>
            // Global functions for edit modal
            function editReview(reviewId, rating, comment) {
                document.getElementById('editReviewId').value = reviewId;
                document.getElementById('editRating').value = rating;
                document.getElementById('editComment').value = comment;
                document.getElementById('editReviewModal').style.display = 'block';
            }

            function closeEditModal() {
                document.getElementById('editReviewModal').style.display = 'none';
            }

            window.onclick = function(event) {
                const modal = document.getElementById('editReviewModal');
                if (modal && event.target === modal) {
                    modal.style.display = 'none';
                }
            }

            document.addEventListener("DOMContentLoaded", function () {
                const quantityInput = document.getElementById('quantity');
                const totalPriceEl = document.getElementById('totalPrice');
                const unitPrice = parseFloat(document.getElementById('unitPrice').value);

                function updateTotal() {
                    const qty = parseFloat(quantityInput.value) || 1;
                    const total = unitPrice * qty;
                    totalPriceEl.textContent = total.toFixed(2);
                }

                quantityInput.addEventListener('input', () => {
                    updateTotal();
                });

                updateTotal();
            });
        </script>

        {{-- Edit Review Modal --}}
        <div id="editReviewModal" class="hidden" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
            <div class="bg-white rounded-lg shadow-lg p-6 m-auto mt-20" style="width: 90%; max-width: 500px;">
                <span onclick="closeEditModal()" style="float: right; cursor: pointer; font-size: 28px; font-weight: bold;">&times;</span>
                <h2 class="text-2xl font-bold mb-4">Edit Review</h2>
                
                <form id="editReviewForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editReviewId" name="review_id">

                    <div>
                        <label for="editRating" class="form-label">Rating</label>
                        <select name="rating" id="editRating" class="form-select" required>
                            <option value="">-Select Rating-</option>
                            @for($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div>
                        <label for="editComment" class="form-label">Comment</label>
                        <textarea name="comment" id="editComment" rows="3" class="form-control" required></textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Review</button>
                        <button type="button" class="btn btn-secondary" onclick="closeEditModal()">Cancel</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function submitEditForm(e) {
                e.preventDefault();
                const reviewId = document.getElementById('editReviewId').value;
                const form = document.getElementById('editReviewForm');
                
                fetch(`/users/reviews/${reviewId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({
                        rating: form.rating.value,
                        comment: form.comment.value
                    })
                })
                .then(response => {
                    // Check if response is valid JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        throw new Error('Server returned non-JSON response (HTTP ' + response.status + ')');
                    }
                    return response.json().then(data => ({
                        status: response.status,
                        data: data
                    }));
                })
                .then(result => {
                    if (result.status === 200 && result.data.success) {
                        alert(result.data.message || 'Review updated successfully!');
                        closeEditModal();
                        window.location.reload();
                    } else {
                        alert(result.data.message || 'Error updating review');
                    }
                })
                .catch(err => {
                    console.error('Error:', err);
                    alert('Error updating review: ' + err.message);
                });
            }

            // Attach form submit handler when DOM is ready
            document.addEventListener('DOMContentLoaded', function() {
                const editForm = document.getElementById('editReviewForm');
                if (editForm) {
                    editForm.addEventListener('submit', submitEditForm);
                }
            });
        </script>

@endsection