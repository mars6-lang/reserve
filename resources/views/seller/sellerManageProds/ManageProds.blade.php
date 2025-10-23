@extends('layouts.Users.Homeapp')
@section('content')

    @if (session('success') === 'success')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            Product updated!
        </div>
    @endif



    <div class="bg-light p-3 p-md-5 rounded">

        <div class="container py-5">
            @forelse($products as $product)
                <div class="card mb-3 p-3">
                    <div class="d-flex align-items-start gap-3 flex-wrap">

                        {{-- Product Image --}}

                        <div class="w-full sm:w-28 h-28 mb-3 sm:mb-0 flex-shrink-0">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100' }}"
                                alt="{{ $product->title }}" class="w-full h-full object-cover rounded-lg border">
                        </div>


                        {{-- Product Info --}}
                        <div class="flex-grow-1 d-flex flex-column flex-md-row justify-content-between w-100">
                            <div class="pe-3" style="min-width: 0;">
                                <h5 class="mb-1 text-break" style="word-wrap: break-word;">
                                    {{ $product->title }}
                                </h5>

                                @php
                                    $hasDiscount = $product->discount_percent && $product->discount_percent > 0;
                                    $discountedPrice = $hasDiscount
                                        ? $product->price - ($product->price * $product->discount_percent / 100)
                                        : $product->price;
                                @endphp

                                <input type="hidden" id="unitPrice" value="{{ $discountedPrice }}">

                                <p class="mb-0">
                                    <strong class="text-success small">₱{{ number_format($discountedPrice, 2) }}
                                        /
                                        kilo</strong>
                                    @if($hasDiscount)
                                        <span class="text-muted text-decoration-line-through small">
                                            ₱{{ number_format($product->price, 2) }}
                                        </span><br>
                                        <span class="badge bg-danger">{{ $product->discount_percent }}% OFF</span>
                                    @endif
                                </p>
                            </div>

                            {{-- Actions --}}
                            <div class="mt-3 mt-md-0 d-flex flex-column gap-4 align-items-md-end">
                                <a href="{{ route('seller.sellerManageProds.ManageProdsEdit', $product->id) }}"
                                    class="btn btn-warning btn-sm w-100">Edit</a>

                                <form action="{{ route('seller.deleteProds', $product->id) }}" method="POST" class="w-100">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            @empty
                <div class="text-center text-muted mt-5">
                    <p class="text-lg">No products found.</p>
                </div>
            @endforelse
        </div>

    </div>

@endsection