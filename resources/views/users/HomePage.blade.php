@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Home Page</title>

            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <script src="{{ asset('js/app.js') }}" defer></script>

            <!-- Font Awesome -->
            <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">

            <style>
                .bg-welcome {
                    background-color: #87CEEB;
                }

                .hover-card {
                    transition: transform 0.3s ease, box-shadow 0.3s ease;
                }

                .hover-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
                }
            </style>
        </head>

        <body>
            <!-- Welcome Header -->
            <header class="bg-welcome text-white py-5 border-bottom d-flex align-items-center" style="height: 50vh;">
                <div class="container text-center">
                    <h1 class="display-4 fw-bold">Welcome, {{ Auth::user()->name }}</h1>
                    <p class="lead mt-3">Empowering fishers and sellers with digital tools for smarter trading and insights.</p>
                </div>
            </header>

            <!-- Features Section -->
            <section class="py-5 bg-white">
                <div class="container">
                    <div
                        class="row g-1 row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 text-center justify-content-center">

                        <div class="col-md-6">
                            <a href="{{ route('users.dashboard.index') }}" class="text-decoration-none text-dark">
                                <div class="card h-100 text-center border-0 shadow-sm rounded-3 Orders hover-card">
                                    <div class="card-body py-4">
                                        <i class="fas fa-table-columns fa-3x text-info mb-3"></i>
                                        <h5 class="fw-semibold">Dashboard</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        @if(auth()->user()->is_seller)
                            <div class="col-md-6">
                                <a href="{{ url('/seller/dashboard') }}" class="text-decoration-none text-dark">
                                    <div class="card h-100 text-center border-0 shadow-sm rounded-3 Orders hover-card">
                                        <div class="card-body py-4">
                                            <i class="fas fa-user fa-3x text-info mb-3"></i>
                                            <h5 class="fw-semibold">Seller Dashboard</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @else
                            <div class="col-md-6">
                                <a href="{{ route('users.registeraccount') }}" class="text-decoration-none text-dark">
                                    <div class="card h-100 text-center border-0 shadow-sm rounded-3 Orders hover-card">
                                        <div class="card-body py-4">
                                            <i class="fas fa-user fa-3x text-info mb-3"></i>
                                            <h5 class="fw-semibold">Register account</h5>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif

                        <div class="col-md-6">
                            <a href="{{ route('profile.edit') }}" class="text-decoration-none text-dark">
                                <div class="card h-100 text-center border-0 shadow-sm rounded-3 Orders hover-card">
                                    <div class="card-body py-4">
                                        <i class="fas fa-user fa-3x text-info mb-3"></i>
                                        <h5 class="fw-semibold">Profile</h5>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="{{ route('chatroom.index') }}" class="text-decoration-none text-dark">
                                <div class="card h-100 text-center border-0 shadow-sm rounded-3 Orders hover-card">
                                    <div class="card-body py-4">
                                        <i class="fas fa-comment fa-3x text-info mb-3"></i>
                                        <h5 class="fw-semibold">My chats</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Saka -->
            <footer class="bg-light py-4 text-center text-muted mt-5">
                <small>&copy; {{ now()->year }} A Web-Based App — All rights reserved.</small>
            </footer>
        </body>

        </html>


    @endsection
@endcan