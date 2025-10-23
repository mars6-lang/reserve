@extends('layouts.Users.Homeapp')
@section('content')
    <div class="container mb-6 max-w-xl mx-auto">


        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif
        <div class="bg-light">
            <div class="container">
                <div class="mx-auto" style="max-width: 600px;">
                    <h2 class="text-center mb-4 fw-bold text-black text-2xl">Edit Product</h2>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('seller.sellerManageProds', $product->id) }}" method="POST"
                        enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Edit product name</label>
                            <input type="text" name="title" id="title" class="form-control" required
                                value="{{ old('title', $product->title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Edit description</label>
                            <input type="text" name="description" id="description" class="form-control" required
                                value="{{ old('description', $product->description) }}">
                        </div>

                        <!-- Price -->
                        <div class="mb-3">
                            <label for="price" class="form-label">Price (₱)</label>
                            <input type="number" name="price" id="price" step="0.01" min="0" class="form-control" required
                                value="{{ old('price', $product->price) }}">
                        </div>

                        <!-- Discount Section -->
                        <div class="mb-4 p-3 bg-light rounded border">
                            <h5 class="fw-semibold mb-2">Optional: Discount</h5>

                            <div class="mb-2">
                                <label for="discount_percent" class="form-label">Discount (%)</label>
                                <input type="number" name="discount_percent" id="discount_percent" class="form-control"
                                    min="0" max="100" step="1"
                                    value="{{ old('discount_percent', $product->discount_percent ?? '') }}"
                                    placeholder="Enter discount percent (0 to remove)">
                            </div>
                            <small class="text-muted">Set to 0 if no discount is needed.</small>
                        </div>

                        <!-- Product Image -->
                        <div class="mb-4">
                            <label for="image" class="form-label">Product Image</label>
                            <input type="file" name="image" id="image" class="form-control" enctype="multipart/form-data">
                            @if($product->image)
                                <div class="mt-3">
                                    <img id="newImg" src="{{ asset('storage/' . $product->image) }}" alt="Current Image"
                                        class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover;">
                                    <p class="text-muted mt-1">Current Image</p>
                                </div>
                            @endif
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <a href="{{ route('seller.sellerManageProds.ManageProdsEdit', $product->id) }}"
                                class="btn btn-secondary">
                                Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                Update Product
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('image').addEventListener('change', function (event) {
                const preview = document.getElementById('newImg');
                const file = event.target.files[0];

                if (file && preview) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        preview.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
@endsection