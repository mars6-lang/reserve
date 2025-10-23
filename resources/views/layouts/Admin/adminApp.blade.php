<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Capstone') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Admin Content Styling -->
    <style>
        .admin-content {
            margin-top: 70px;
            padding: 30px 40px;
            min-height: calc(100vh - 70px);
            background: linear-gradient(135deg, #f8fffe 0%, #f0f9f7 100%);
            flex: 1;
        }

        .admin-content .container,
        .admin-content .container-lg,
        .admin-content .container-fluid {
            margin-left: auto;
            margin-right: auto;
            max-width: 100% !important;
            padding: 0 !important;
            width: 100% !important;
        }

        .admin-content > div {
            width: 100%;
        }

        .admin-content .bg-white {
            width: 100%;
            margin: 0;
        }

        .admin-content table {
            margin: 20px 0;
            width: 100%;
        }

        .admin-content .card,
        .admin-content table {
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f9f7;
            border-radius: 12px;
            margin: 0 0 30px 0;
            width: 100%;
        }

        .admin-content h1,
        .admin-content h2,
        .admin-content h3 {
            color: #056659;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .admin-content {
                margin-top: 60px;
                padding: 15px;
            }
        }
    </style>

    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])





</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="flex flex-col min-h-screen">
        <!-- Top Navigation -->
        @include('layouts.partials.admin-navigation-topnav')

        <!-- Main Content Area -->
        <div class="admin-content" id="adminContent">
            @yield('content')
        </div>

        @yield('scripts')
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>