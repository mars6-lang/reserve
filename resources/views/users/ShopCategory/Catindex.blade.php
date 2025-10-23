@extends('layouts.Users.Homeapp')

@section('content')
    <div class="bg-gray-200">
        <div class="container py-4">
            <!-- ✅ Category Section -->
            <h3 class="fw-bold mb-4 text-dark">All {{ $category }} Products</h3>

            <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                @forelse($products as $product)
                    <div class="col">
                        <a href="{{ route('users.prodsDetails', $product->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 border-0 product-card-lazada">
                                <div class="position-relative">
                                    <!-- ✅ Product Image -->
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                        class="card-img-top object-cover w-100" style="aspect-ratio: 1/1; max-height: 250px;"
                                        alt="{{ $product->title }}">
                                </div>
                                <div class="card-body p-2">
                                    <!-- Product Title -->
                                    <h6 class="fw-bold product-title mb-1">{{ $product->title }}</h6>

                                    <!-- ✅ Seller Name -->
                                    <p class="mb-1 text-muted" style="font-size: 0.85rem;">
                                        Seller: <span class="fw-semibold">{{ $product->user->name ?? 'Unknown Seller' }}</span>
                                    </p>

                                    <!-- ✅ Ratings -->
                                    @php
                                        $avgRating = $product->reviews->avg('rating');
                                        $fullStars = floor($avgRating);
                                        $halfStar = ($avgRating - $fullStars) >= 0.5 ? 1 : 0;
                                        $emptyStars = 5 - ($fullStars + $halfStar);
                                    @endphp
                                    <div class="d-flex align-items-center mb-1">
                                        @for($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star text-warning"></i>
                                        @endfor
                                        @if($halfStar)
                                            <i class="fas fa-star-half-alt text-warning"></i>
                                        @endif
                                        @for($i = 0; $i < $emptyStars; $i++)
                                            <i class="far fa-star text-warning"></i>
                                        @endfor
                                        <span class="ms-1 text-muted" style="font-size: 0.85rem;">
                                            ({{ number_format($avgRating, 1) ?? '0.0' }})
                                        </span>
                                    </div>

                                    <!-- Price -->
                                    <p class="product-price mb-0 text-success fw-bold">
                                        ₱{{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p class="text-muted">No products available for this category.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection