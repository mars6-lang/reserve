@extends('layouts.Seller.Sellerapp')

@section('content')

    <style>
        .Manage-products {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .Manage-products:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }



        .Add-Products {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .Add-Products:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }



        .Product-Ratings {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .Product-Ratings:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .Comments {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .Comments:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .Notification {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .Notification:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }
    </style>

    @if (session('success') === 'You are now registered as a seller!')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            You are now registered as seller
        </div>
    @endif


    @if (session('success') === 'Product updated!')
        <div x-data="{ show: true }" x-show="show" x-transition.opacity.duration.1000ms
            x-init="setTimeout(() => show = false, 3000)" class="text-center text-green-600 font-medium text-lg mb-6">
            Product updated
        </div>
    @endif

    <div class="bg-light">
        <div class="container">
            <div class="d-flex justify-content-center">
                <h1 class="text-3xl text-muted py-6">Hello, {{ auth()->user()->name }}!</h1>
            </div>
            <div class="text-center mb-4">
                <h1 class="text-4xl font-bold text-black">Welcome to Seller Dashboard</h1>
            </div>

            <div class="row row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                <!-- Manage Products route-->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 text-center Manage-products">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <i class="fas fa-boxes fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold">Manage Products</h5>
                            <a href="{{ route('seller.ManageProds') }}" class="btn btn-info text-white mt-3">Manage</a>
                        </div>
                    </div>
                </div>

                <!-- Add Product -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 text-center Add-Products">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <i class="fas fa-plus-circle fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold">Add New Product</h5>
                            <a href="{{ route('seller.sellerAdd') }}" class="btn btn-info text-white mt-3">Add Product</a>
                        </div>
                    </div>
                </div>

                <!-- your product ratings and comments -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 text-center Product-Ratings">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <i class="fas fa-star fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold">Product Ratings</h5>
                            <a href="{{ route('seller.productsRatings') }}" class="btn btn-info text-white mt-3">View
                                Ratings</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 text-center Add-Products">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <i class="fas fa-shopping-cart fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold">Reserve List</h5>
                            <a href="{{ route('seller.ordersList') }}" class="btn btn-info text-white mt-3">See Orders</a>
                        </div>
                    </div>
                </div>



                <div class="card h-100 border-0 shadow-sm rounded-3 text-center Add-Products">
                    <div class="card-body py-5">
                        <div class="mb-3">
                            <i class="fas fa-shopping-cart fa-3x text-info"></i>
                        </div>
                        <h5 class="card-title fw-bold">Contacts</h5>
                        <a href="{{ route('chatroom.index') }}" class="btn btn-info text-white mt-3">See My Messages</a>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 text-center Manage-products">
                        <div class="card-body py-5">
                            <div class="mb-3">
                                <i class="fas fa-boxes fa-3x text-info"></i>
                            </div>
                            <h5 class="card-title fw-bold">Market Analysis</h5>
                            <a href="{{ route('seller.analysis.marketanalysis') }}" class="btn btn-info text-white mt-3">See
                                detailed analysis</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <footer class="bg-light py-4 text-center text-muted mt-5">
                <small>&copy; {{ now()->year }} A Web-Based App — All rights reserved.</small>
            </footer>
        </div>
    </div>
@endsection