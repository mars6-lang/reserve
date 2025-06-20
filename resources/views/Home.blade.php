<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Capstone') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('build/bootstrap/bootstrap.v5.3.2.min.css') }}">

    <!-- Font Awesome -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" />
    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Theme Styles -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />

    <style>
        .bg-welcome {
            background-color: #87CEEB;
        }

        .hover-bg:hover {
            background-color: rgb(255, 238, 172);
        }

        .bg-welcome {
            background-color:rgb(123, 184, 250);
            
        }
    </style>
</head>

<body class="antialiased">
    <nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
        <div class="container-fluid px-6 d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <a href="#" class="d-flex align-items-center text-decoration-none">
                <img src="{{ asset('images/loko.jpg') }}" alt="Logo" class="rounded-circle me-2"
                    style="width: 50px; height: 50px; object-fit: cover;">
            </a>

            <!-- Auth Links -->
            <div class="d-flex align-items-center">
                <a href="{{ route('login') }}" class="btn btn-outline-info me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-info">Register</a>
            </div>
        </div>
    </nav>

    <!-- Welcome Header -->
    <header class="bg-welcome text-white d-flex align-items-center" style="height: 90vh;">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Welcome</h1>
            <p class="lead mt-3">Empowering fishers and sellers with digital tools for smarter trading and insights.</p>
        </div>
    </header>

    <!-- Features Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">What This Platform Offers</h2>
                <p class="text-muted">A digital ecosystem for modern fish trading and management</p>
            </div>
            <div
                class="row g-1 row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 text-center justify-content-center">

                @php
                    $features = [
                        ['icon' => 'shop', 'title' => 'Market Sales', 'desc' => 'Buy and sell seafood products directly with verified users in a secure environment.'],
                        ['icon' => 'briefcase', 'title' => 'Seller Tools', 'desc' => 'Manage your products, view ratings, and track earnings in your dedicated seller dashboard.'],
                        ['icon' => 'chart-line', 'title' => 'Market Analysis', 'desc' => 'Visualize your market and monitor sales data over time.'],
                        ['icon' => 'box-open', 'title' => 'Order System', 'desc' => 'Stay updated with your purchase and sales orders from anywhere.'],
                        ['icon' => 'wallet', 'title' => 'Secure Payments', 'desc' => 'Seamless integration with payment gateways for efficient transactions.'],
                        ['icon' => 'star', 'title' => 'Ratings & Feedback', 'desc' => 'Gain trust with user feedback and ratings for all your listed products.'],
                    ];
                @endphp

                @foreach($features as $feature)
                    <div class="col-md-4">
                        <div class="p-4 border rounded shadow-sm h-100">
                            <i class="fa-solid fa-{{ $feature['icon'] }} fa-3x text-info mb-3"></i>
                            <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                            <p class="text-muted small">{{ $feature['desc'] }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-light py-4 text-center text-muted mt-5">
        <small>&copy; {{ now()->year }} A Web-Based App — All rights reserved.</small>
    </footer>
</body>

</html>