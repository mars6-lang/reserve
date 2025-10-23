<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Capstone') }}</title>

    <!-- Vite (Tailwind + JS Build) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Local Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Roboto+Slab:wght@400;700&family=Manrope:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Font Awesome & Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
        }

        .navbar,
        .navbar-nav,
        .nav-link {
            font-family: 'Montserrat', sans-serif !important;
        }
    </style>
</head>

<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        {{-- Include navbar --}}
        @include('layouts.Users.Homenav')

        {{-- Main content --}}
        <main>
            @yield('content')
        </main>

        {{-- Modals --}}
        @stack('modals')

        {{-- Notification Dot Script --}}
        @push('scripts')
            <script>
                const dot = document.getElementById('notif-dot');

                async function checkNotifications() {
                    if (!dot) return;
                    try {
                        const res = await fetch("{{ route('notifications.check') }}");
                        const data = await res.json();
                        dot.style.display = data.hasUnread ? 'block' : 'none';
                    } catch (err) {
                        console.error('Notification check failed:', err);
                    }
                }

                document.addEventListener('DOMContentLoaded', function () {
                    checkNotifications();

                    // Avoid multiple intervals if loaded multiple times
                    if (!window._notifIntervalSet) {
                        setInterval(checkNotifications, 10000); // every 10s
                        window._notifIntervalSet = true;
                    }

                    // Handle mark as read buttons
                    document.querySelectorAll('.mark-read-btn').forEach(btn => {
                        btn.addEventListener('click', async function (e) {
                            e.preventDefault();
                            const id = this.dataset.id;
                            try {
                                await fetch(`/notifications/read/${id}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                        'Accept': 'application/json',
                                    }
                                });

                                // Update dot
                                checkNotifications();

                                // Update text style
                                const p = this.closest('div').querySelector('p');
                                p.classList.remove('font-semibold', 'text-black');
                                p.classList.add('text-gray-500');

                                this.remove();
                            } catch (err) {
                                console.error(err);
                            }
                        });
                    });
                });
            </script>
        @endpush

        {{-- Scripts --}}
        @stack('scripts')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>