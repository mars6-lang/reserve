@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

        <style>
            /**hover para reviews */
            .Reviews {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .Reviews:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            }


            /**hover para orders */
            .Oders {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .Orders:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            }

            /**hover para payments */
            .Payments {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .Payments:hover {
                transform: translateY(-5px);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            }
        </style>



        <div class="bg-light">
            <div class="container py-6">
                <!-- Header -->
                <div class="text-center mb-5">
                    <h1 class="text-4xl fw-bold text-black">Welcome to Your Dashboard</h1>
                </div>

                <!-- Action Cards -->
                <div class="row g-1 row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 text-center justify-content-center">
                    <!-- My Reviews -->
                    <div class="col-md-4">
                        <div class="card h-100 text-center border-0 shadow-sm rounded-3 Reviews">
                            <div class="card-body py-4">
                                <i class="fas fa-comments fa-3x text-info mb-3"></i>
                                <h5 class="fw-semibold">My Reviews</h5>
                                <a href="" class="btn btn-info mt-6 text-white">View Reviews</a>
                            </div>
                        </div>
                    </div>

                    <!-- My Orders -->
                    <div class="col-md-6">
                        <div class="card h-100 text-center border-0 shadow-sm rounded-3 Orders">
                            <div class="card-body py-4">
                                <i class="fas fa-shopping-cart fa-3x text-info mb-3"></i>
                                <h5 class="fw-semibold">Reserved products</h5>
                                <a href="{{ route('users.myOrders') }}" class="btn btn-info mt-6 text-white">Manage</a>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Gateways -->
                    <div class="col-md-6">
                        <div class="card h-100 text-center border-0 shadow-sm rounded-3 Payments">
                            <div class="card-body py-4">
                                <i class="fas fa-credit-card fa-3x text-info mb-3"></i>
                                <h5 class="fw-semibold">Payment Gateways</h5>
                                <a href="" class="btn btn-info mt-6 text-white">Manage</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Seller Status -->
                <div class="text-center mt-5">

                    @if(auth()->user()->is_seller)
                        <p class="text-success fs-5"> You are a registered seller!</p>
                        <a href="{{ url('/seller/dashboard') }}" class="btn btn-info mt-2 ">
                            <i class="fas fa-store mr-1"></i> Go to Seller Dashboard
                        </a>
                    @endif
                </div>
            </div>

        </div>




    @endsection
@endcan