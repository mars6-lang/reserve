@extends('layouts.Users.Homeapp')

@section('content')

    <style>
        .product-card-lazada {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card-lazada:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .product-title {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .product-price {
            color: #e53935;
            font-size: 1rem;
            font-weight: 700;
        }

        .rating-stars {
            color: #ffc107;
        }

        .text-custom {
            color: #0a4aac;
        }

        .btn-outline-custom {
            color: #0a4aac;
            border: 2px solid #0a4aac;
            background-color: transparent;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background-color: #0a4aac;
            color: #fff;
        }

        @media (max-width: 576px) {
            .product-card-lazada img {
                aspect-ratio: 1 / 1 !important;
                height: auto !important;
            }
        }


        .card-img-top {
            max-height: 250px;
        }

        @media (max-width: 576px) {
            .container.py-4:last-of-type {
                margin-bottom: 30px;
            }

            .card-body {
                padding: 0.75rem;
            }
        }

        #sellsItems {
            height: 450px;
            object-fit: cover;
        }


        .btn-greenS {
            background-color: #056659ff;
        }

        .bg-opai {
            opacity: 80%;
        }
    </style>

    <div class="testing">
        {{-- Shop by Seller Stall --}}
        <div class="testing bg-gray-200">
            <div class="container py-4">

                {{-- Sorting Filter --}}
                <div class="container py-0 d-flex justify-content-end mt-4">
                    <form method="GET" action="{{ route('users.Market.index') }}">
                        @if(request('keyword'))
                            <input type="hidden" name="keyword" value="{{ request('keyword') }}">
                        @endif
                        <select name="sort" class="form-select form-select-sm w-auto" onchange="this.form.submit()">
                            <option value="newest" {{ $sort == 'newest' ? 'selected' : '' }}>Newest</option>
                            <option value="oldest" {{ $sort == 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="price_low_high" {{ $sort == 'price_low_high' ? 'selected' : '' }}>Price: Low to
                                High
                            </option>
                            <option value="price_high_low" {{ $sort == 'price_high_low' ? 'selected' : '' }}>Price: High to
                                Low
                            </option>
                        </select>
                    </form>
                </div>
                <h4 class="fw-bold mb-3 text-dark">Shop by Seller</h4>

                @forelse($productsBySeller as $index => $seller)
                    @php
                        $totalProducts = $seller->products->count();
                    @endphp

                    <div class="mb-5 border rounded shadow-sm bg-white p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h3 class="fw-bold text-custom mb-0">{{ $seller->name }}</h3>

                            @if ($totalProducts > 4)
                                <button class="btn btn-outline-custom btn-sm" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#sellerProducts{{ $index }}" aria-expanded="false"
                                    aria-controls="sellerProducts{{ $index }}">
                                    Show More
                                </button>
                            @endif
                        </div>

                        {{-- Always show first 4 products --}}
                        <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                            @foreach($seller->products->take(4) as $product)
                                <div class="col">
                                    <a href="{{ route('users.prodsDetails', $product->id) }}"
                                        class="text-decoration-none text-dark">
                                        <div class="card h-100 border-0 product-card-lazada">
                                            <div class="position-relative">
                                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                                    class="card-img-top object-cover w-100" loading="lazy"
                                                    style="aspect-ratio: 1/1; max-height: 250px;" alt="{{ $product->title }}">
                                            </div>
                                            <div class="card-body p-2">
                                                <h6 class="fw-bold product-title mb-1">{{ $product->title }}</h6>

                                                @php
                                                    $avgRating = $product->reviews->avg('rating') ?? 0;
                                                    $fullStars = floor($avgRating);
                                                    $halfStar = ($avgRating - $fullStars) >= 0.5 ? 1 : 0;
                                                    $emptyStars = 5 - ($fullStars + $halfStar);
                                                @endphp

                                                <div class="d-flex align-items-center mb-1">
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @endfor
                                                    @if ($halfStar)
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    @endif
                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <i class="far fa-star text-warning"></i>
                                                    @endfor
                                                    <span class="ms-1 text-muted" style="font-size: 0.85rem;">
                                                        ({{ $avgRating ? number_format($avgRating, 1) : '0.0' }})
                                                    </span>
                                                </div>

                                                <p class="product-price mb-0 text-success fw-bold">
                                                    ₱{{ number_format($product->price, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        {{-- Hidden extra products --}}
                        @if ($totalProducts > 4)
                            <div class="collapse mt-3" id="sellerProducts{{ $index }}">
                                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                                    @foreach($seller->products->slice(4) as $product)
                                        <div class="col">
                                            <a href="{{ route('users.prodsDetails', $product->id) }}"
                                                class="text-decoration-none text-dark">
                                                <div class="card h-100 border-0 product-card-lazada">
                                                    <div class="position-relative">
                                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                                            class="card-img-top object-cover w-100" loading="lazy"
                                                            style="aspect-ratio: 1/1; max-height: 250px;" alt="{{ $product->title }}">
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <h6 class="fw-bold product-title mb-1">{{ $product->title }}</h6>
                                                        <p class="product-price mb-0 text-success fw-bold">
                                                            ₱{{ number_format($product->price, 2) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="text-center mt-3">
                                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#sellerProducts{{ $index }}">
                                        Show Less
                                    </button>
                                </div>
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-muted">No seller stalls found.</p>
                @endforelse
            </div>
        </div>

    </div>

    {{-- Countdown script (keeps only relevant JS) --}}
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function updateCountdowns() {
                document.querySelectorAll(".countdown").forEach(function (el) {
                    let endTime = new Date(el.getAttribute("data-endtime")).getTime();
                    let now = new Date().getTime();
                    let distance = endTime - now;

                    if (distance <= 0) {
                        el.innerHTML = "Expired";
                        el.classList.remove("bg-dark");
                        el.classList.add("bg-secondary");
                    } else {
                        let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        el.innerHTML =
                            String(hours).padStart(2, "0") + ":" +
                            String(minutes).padStart(2, "0") + ":" +
                            String(seconds).padStart(2, "0");
                    }
                });
            }

            updateCountdowns();
            setInterval(updateCountdowns, 1000);
        });
    </script>

@endsection