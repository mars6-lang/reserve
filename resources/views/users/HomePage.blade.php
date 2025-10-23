@extends('layouts.Users.Homeapp')
@section('content')
    <style>
        /* Hero */
        .amazon-hero {
            height: 60vh;
            background-size: cover;
            background-color: #056659;
            background-position: center;
            width: 100%;
            position: relative;
            color: white;
            padding: 0;
        }

        /* Product Cards */
        .product-card {
            border-radius: 10px;
            transition: 0.3s;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        .btn-SearchBTN {
            background-color: #08665bff;
        }

        @media (max-width: 576px) {
            .amazon-hero {
                height: auto;
                clip-path: none;
            }

            .card-body {
                padding: 0.75rem;
            }

            .container.py-1:last-of-type {
                margin-bottom: 50px;
            }
        }

        .recommended-train {
            position: relative;
            width: 100%;
            overflow-x: hidden;
        }

        .train-track {
            display: flex;
            gap: 0px;
            animation: autoScroll 30s linear infinite;
        }

        /* Smooth slide effect */
        @keyframes autoScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .bg-darkNi {
            background-color: #056659ff;
        }

        #feedbackCarousel .carousel-item {
            height: 450px;
            object-fit: cover;
        }

        .bg-mama-mo-green {
            background-color: #056659ff;
        }
    </style>

    <div class="">
        {{-- Carousel Section --}}
        @if(isset($carouselProducts) && $carouselProducts->count())
            <div id="salesCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner rounded shadow-sm">
                    @foreach($carouselProducts as $index => $product)
                        @php
                            $imgPath = $product->image ?? $product->photo ?? null;
                            $imgUrl = $imgPath
                                ? asset('storage/' . $imgPath)
                                : 'https://via.placeholder.com/1200x300?text=' . urlencode($product->title ?? 'Product');
                            $title = $product->title ?? 'Untitled';
                            $totalSold = $product->orders_sum_quantity ?? 0;
                            $avgRating = $product->reviews_avg_rating ?? 0;
                        @endphp

                        <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                            <a href="{{ route('users.prodsDetails', $product->id) }}" class="d-block">
                                <img src="{{ $imgUrl }}" class="d-block w-100" id="sellsItems" alt="{{ $title }}">
                                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-2">
                                    <h5 class="mb-1">
                                        {{ $title }}
                                        @if($index < $bestSelling->count())
                                            <span class="badge bg-success ms-2">Best Seller</span>
                                        @else
                                            <span class="badge bg-warning text-dark ms-2">Low Sales</span>
                                        @endif
                                    </h5>
                                    <small>Sold: {{ $totalSold }} • ⭐ {{ number_format($avgRating, 1) }}</small>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#salesCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#salesCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators">
                    @foreach($carouselProducts as $i => $p)
                        <button type="button" data-bs-target="#salesCarousel" data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}"></button>
                    @endforeach
                </div>
            </div>
        @else
            {{-- Static fallback carousel --}}
            <div id="feedbackCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
                <div class="carousel-inner rounded shadow-sm">
                    <div class="carousel-item active bg-mama-mo-green">
                        <img src="#" class="d-block w-100 bg-mama-mo-green" alt="Welcome-Feedback">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>We Value Your Voice</h5>
                            <p>Share your experience and help us improve our system.</p>
                            <a href="{{ route('users.feedback.create') }}" class="btn btn-primary btn-sm">Leave Feedback</a>
                        </div>
                    </div>
                    <div class="carousel-item bg-mama-mo-green">
                        <img src="#" class="d-block w-100" alt="Star Ratings">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Quick Star Ratings</h5>
                            <p>Rate your journey with just one click – from Poor ★ to Outstanding ★★★★★.</p>
                        </div>
                    </div>
                    <div class="carousel-item bg-mama-mo-green">
                        <img src="#" class="d-block w-100" alt="Honest Feedback">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Your Comments Matter</h5>
                            <p>Tell us what’s working and what’s not – your words shape the system.</p>
                        </div>
                    </div>
                    <div class="carousel-item bg-mama-mo-green">
                        <img src="#" class="d-block w-100" alt="Transparency">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>We Listen. We Improve.</h5>
                            <p>Your feedback drives real improvements across our platform.</p>
                        </div>
                    </div>
                    <div class="carousel-item bg-mama-mo-green">
                        <img src="#" class="d-block w-100" alt="Community Impact">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded p-3">
                            <h5>Be Part of the Change</h5>
                            <p>Join thousands of users making the system better every day.</p>
                            <a href="{{ route('users.feedback.index') }}" class="btn btn-light btn-sm">See Feedbacks</a>
                        </div>
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#feedbackCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators">
                    @for ($i = 0; $i < 5; $i++)
                        <button type="button" data-bs-target="#feedbackCarousel" data-bs-slide-to="{{ $i }}"
                            class="{{ $i === 0 ? 'active' : '' }}"></button>
                    @endfor
                </div>
            </div>
        @endif
    </div>
@endsection