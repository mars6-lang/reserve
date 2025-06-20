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

        .product-desc {
            max-height: 80px;
            overflow: hidden;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .product-price {
            color: #e53935;
            font-size: 1.25rem;
            font-weight: 700;
        }

        .rating-stars {
            color: #ffc107;
        }

        @media (max-width: 576px) {
            .product-card-lazada img {
                aspect-ratio: 1 / 1 !important;
                height: auto !important;
            }
        }
    </style>

    <div class="bg-light">
        <div class="container py-5">
            <div class="d-flex justify-content-center mt-1">
                <form action="{{ route('users.searchproducts') }}" method="GET" class="w-100 px-3" id="searchForm">
                    @csrf
                    <div class="row g-2 justify-content-center">
                        {{-- serch bar and cat--}}
                        <div class="col-12 col-md-8 d-flex gap-2">
                            <input type="text" name="keyword"
                                class="form-control form-control-sm border-0 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400 shadow-sm focus:shadow-lg transition"
                                placeholder="Search..." value="{{ request()->keyword }}">
                            {{-- cat dropdown --}}
                            <select name="category"
                                class="form-select form-select-sm py-2 w-auto focus:outline-none focus:ring-2 focus:ring-blue-400"
                                onchange="document.getElementById('searchForm').submit();" style="min-width: 120px;">
                                <option value="">All</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ request()->category == $cat ? 'selected' : '' }}>
                                        {{ ucfirst($cat) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <button class="btn btn-sm btn-info w-100 py-2 text-white" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="bg-light">
        <div class="container py-5">
            @forelse($allproducts as $sellerId => $products)
                <div class="mb-5">
                    <div class="mb-3 border-bottom pb-2">
                        <h4 class="text-primary text-dark">
                            {{ $products->first()->user->name ?? 'Unknown Seller' }}'s Store
                        </h4>
                    </div>

                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                        @foreach($products as $product)
                            <div class="col">
                                <a href="{{ route('users.prodsDetails', $product->id) }}" class="text-decoration-none text-dark">
                                    <div class="card h-100 border-0 shadow-sm product-card-lazada">
                                        <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400x300?text=No+Image' }}"
                                            alt="{{ $product->title }}" class="card-img-top object-cover w-100"
                                            style="aspect-ratio: 1 / 1; max-height: 250px;">
                                        <div class="card-body d-flex flex-column">
                                            <h5 class="product-title text-sm fw-bold">{{ $product->title }}</h5>

                                            @php
    $hasDiscount = $product->discount_percent && $product->discount_percent > 0;
    $discountedPrice = $hasDiscount
        ? $product->price - ($product->price * $product->discount_percent / 100)
        : $product->price;
@endphp

<p class="product-price mt-0 mb-1">
    <strong class="text-sm text-success">
        Per/Kilo ₱{{ number_format($discountedPrice, 2) }}
    </strong>

    @if($hasDiscount)
        <span class="text-muted text-decoration-line-through ms-1 text-sm">
            ₱{{ number_format($product->price, 2) }}
        </span>
        <span class="badge bg-danger text-white ms-2">{{ $product->discount_percent }}% OFF</span>
    @endif
</p>

                                            @php
                                                $average = number_format($product->reviews->avg('rating'), 1);
                                                $count = $product->reviews->count();
                                            @endphp
                                            <p class="text-sm text-yellow-500 mb-4">
                                                <strong>Ratings:</strong>
                                                {{ str_repeat('★', round($average)) }}{{ str_repeat('☆', 5 - round($average)) }}
                                                <span class="text-sm text-gray-600">({{ $count }} reviews)</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="text-center text-muted mt-5">
                    <h4>No products found.</h4>
                </div>
            @endforelse
        </div>
    </div>
@endsection