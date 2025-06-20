@extends('layouts.Seller.Sellerapp')
@section('content')


    @if (session('success') === 'Product added successfully!')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            Product added!
        </div>
    @endif


    <div class="bg-light">
        <div class="container py-5">
            <h2 class="mb-4 fw-bold">Add New Product</h2>

            <form action="{{ url('/seller/sellerStore') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Product Title</label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₱) Per/kilo</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>



                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" name="category" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Add Product</button>
            </form>
        </div>
    </div>



@endsection