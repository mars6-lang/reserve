@extends('layouts.Users.Homeapp')

@section('content')
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            object-fit: cover;
            height: 200px;
        }

        @media (max-width: 576px) {
            .card-img-top {
                height: 160px;
            }

            .card-title {
                font-size: 1rem;
            }

            .product-price {
                font-size: 0.95rem;
            }
        }
    </style>

    <div class="py-3 bg-light">
        <div class="container">
           
            <h5 class="mb-3">Search Results: {{ count($searchresults) }}</h5>
            <div class="row g-3">
                @forelse($searchresults as $prods)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <a href="{{ route('users.prodsDetails', $prods->id) }}" class="text-decoration-none text-dark">
                            <div class="card h-100 product-card">
                                <img src="{{ asset('storage/' . $prods->image) }}" class="card-img-top"
                                    alt="{{ $prods->title }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title fw-bold">{{ $prods->title }}</h5>
                                    <p class="product-price text-danger mb-1">Per Kilo ₱{{ number_format($prods->price, 2) }}
                                    </p>
                                    <div class="rating-stars text-warning mb-2">★★★★☆</div>
                                    <span class="mt-auto text-primary fw-semibold">Check Details</span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <p>No products found.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection