@extends('layouts.Users.Homeapp')
@section('content')

    @if (session('success') === 'success')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" 
            class="fixed top-4 left-1/2 -translate-x-1/2 z-50 bg-gradient-to-r from-green-400 to-emerald-500 text-white px-8 py-4 rounded-xl font-medium shadow-2xl">
            <div class="flex items-center gap-2">
                <i class="bi bi-check-circle text-lg"></i>
                <span>Product updated successfully!</span>
            </div>
        </div>
    @endif

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 px-4 md:px-6 py-8">
        <div class="max-w-6xl mx-auto">
            
            {{-- Header Section --}}
            <div class="mb-12">
                <div class="flex items-center gap-3 mb-2">
                    <div class="h-1 w-12 bg-gradient-to-r from-blue-500 to-emerald-500 rounded-full"></div>
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Manage Products</h1>
                </div>
                <p class="text-gray-500 text-sm md:text-base">Organize and manage your product listings</p>
            </div>

            {{-- Products Table --}}
            @if($products->count() > 0)
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-blue-50 to-emerald-50 border-b-2 border-gray-200">
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Product</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Original Price</th>
                                    {{-- <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Discount</th> --}}
                                    {{-- <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Final Price</th> --}}
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-900">Status</th>
                                    <th class="px-6 py-4 text-center text-sm font-bold text-gray-900">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($products as $product)
                                    @php
                                        $hasDiscount = $product->discount_percent && $product->discount_percent > 0;
                                        $discountedPrice = $hasDiscount
                                            ? $product->price - ($product->price * $product->discount_percent / 100)
                                            : $product->price;
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition-colors duration-200 border-b border-gray-100">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div class="w-16 h-16 flex-shrink-0">
                                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/64?text=No+Image' }}"
                                                        alt="{{ $product->title }}" 
                                                        class="w-full h-full object-cover rounded-lg border border-gray-200">
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $product->title }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-sm font-semibold text-gray-900">₱{{ number_format($product->price, 2) }}</span>
                                        </td>
                                        {{-- <td class="px-6 py-4">
                                            @if($hasDiscount)
                                                <span class="inline-block bg-gradient-to-r from-red-100 to-pink-100 text-red-700 px-3 py-1 rounded-full text-sm font-bold">
                                                    -{{ $product->discount_percent }}%
                                                </span>
                                            @else
                                                <span class="text-sm text-gray-400">—</span>
                                            @endif
                                        </td> --}}
                                        {{-- <td class="px-6 py-4">
                                            <span class="text-sm font-bold bg-gradient-to-r from-blue-600 to-emerald-600 bg-clip-text text-transparent">
                                                ₱{{ number_format($discountedPrice, 2) }}
                                            </span>
                                        </td> --}}
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                <span class="inline-block w-2 h-2 bg-green-500 rounded-full"></span>
                                                <span class="text-sm font-medium text-green-700">Available</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('seller.sellerManageProds.ManageProdsEdit', $product->id) }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded-lg transition-all duration-200 hover:shadow-lg no-underline">
                                                    <span>✎</span>
                                                    <span>Edit</span>
                                                </a>

                                                <form action="{{ route('seller.deleteProds', $product->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                        style="background-color: #ef4444; color: white !important;"
                                                        class="inline-flex items-center gap-2 px-4 py-2 text-white font-semibold rounded-lg transition-all duration-200 hover:shadow-lg cursor-pointer hover:bg-red-600"
                                                        onclick="return confirm('Are you sure you want to delete this product? This action cannot be undone.')">
                                                        <span style="color: white !important;">🗑</span>
                                                        <span style="color: white !important;">Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="py-20">
                    <div class="text-center">
                        <div class="mb-4">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-blue-100 to-emerald-100 rounded-full">
                                <i class="bi bi-inbox text-4xl text-blue-500"></i>
                            </div>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">No Products Yet</h2>
                        <p class="text-gray-500 mb-6">Start by adding your first product to get started</p>
                        <a href="{{ route('seller.sellerManageProds.create') ?? '#' }}" class="inline-block bg-gradient-to-r from-blue-500 to-emerald-500 hover:from-blue-600 hover:to-emerald-600 text-white font-semibold py-2 px-6 rounded-lg transition-all duration-200 transform hover:scale-105 active:scale-95">
                            + Add Your First Product
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection