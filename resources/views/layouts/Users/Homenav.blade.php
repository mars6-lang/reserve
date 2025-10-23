<body>
    <style>
        .the-loko {
            height: 90px;
            width: 130px;
            text-decoration: none;
        }

        .hover-underline:hover {
            text-decoration: underline;
        }

        .font-sans {
            font-family: 'Manrope', 'Poppins', 'Montserrat', sans-serif;
            font-weight: 500;
        }

        .Reg-btn {
            background-color: blue;
            padding: 5px;
        }

        .Login-btn {
            text-decoration: underline;
        }

        /* Prevent mobile nav from overflowing screen and hide scrollbars cleanly */
        .mobile-scroll-nav {
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }

        .mobile-scroll-nav::-webkit-scrollbar {
            height: 6px;
        }

        .mobile-scroll-nav::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }

        .whitespace-nowrap {
            text-decoration: none;
        }

        @media (min-width: 768px) {
            .mobile-bottom-nav {
                display: none;
            }
        }

        .mobile-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            background-color: white;
            border-top: 1px solid #d1d5db;
            box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.1);
            z-index: 50;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            margin-top: 0.25rem;
            padding: 0;
        }

        .nav-inner {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0.5rem 0;
            gap: 3.25rem;
            color: #374151;
            font-size: 0.875rem;
        }

        .nav-icon-link {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            text-decoration: none;
            color: inherit;
            font-size: 0.75rem;
            transition: background-color 0.2s ease-in-out;
        }

        .nav-icon-link i {
            font-size: 1.25rem;
            margin-bottom: 0.25rem;
        }

        .nav-icon-link:hover {
            background-color: #e0f2fe;
        }

        .bg-color {
            background-color: #009483ff;
            height: 85px;
            width: auto;


        }

        .search-area {
            width: 500px;
            border-radius: 10px;

        }

        .btn-SearchBTN {
            background-color: #007979ff;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .btn-SearchBTN:hover {
            background-color: #00adadff;
            color: #fff;
        }

        .bg-bluetooth {
            background-color: #00adadff;
        }

        .divide-custom {
            background-color: #d6f7f1ff;
        }


        .dropdown-menu-custom {
            top: 60px;
        }

        @media (max-width: 640px) {
            .dropdown-menu-custom {
                top: 65px;
                width: 90%;
                right: -9%;
            }
        }


        .dropdown-desktop {
            min-width: 250px;
            max-width: 300px;
            padding: 0.75rem 0;
            top: 60px;
        }

        .dropdown-desktop a,
        .dropdown-desktop button {
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
        }

        @media (min-width: 1024px) {
            .dropdown-desktop {
                top: 65px;
                height: 350px;
                right: -20px;
            }
        }

        .bg-Login {
            background-color: #00adadff;
        }

        .bg-custom {
            background-color: #00adadff;
        }

        .bg-prof {
            background-color: #00adadff;
            transition: transform 0.2s ease-in-out;
            height: 60px;
            display: flex;
            align-items: center;
            padding: 0 12px;
            border-radius: 10px;
        }

        .bg-buttons {
            transition: transform 0.2s ease-in-out;
        }

        .bg-buttons:hover {
            transform: scale(1.05);
        }

        .nav-bar,
        .nav-bar {
            padding: 6px 12px;
            /* spacing like buttons */
            border-radius: 6px;
            /* rounded corners */
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-bar:hover,
        .nav-bar:hover {
            background-color: #00756dff;
            /* teal hover bg */
            color: #fff !important;
            /* white text */
            text-decoration: none;
            /* remove underline */
        }

        .bg-graay {
            background-color: #e7e7e7ff;
        }


        .second-navbar {
            border-bottom: none !important;
            /* remove thin gray line */
            margin-bottom: 0;
        }

        .second-navbar a {
            color: #333;
            text-decoration: none;
            transition: color 0.2s;
        }

        .second-navbar a:hover {
            color: #00adad;
        }

        @media (min-width: 768px) {
            .second-navbar {
                display: block;
            }
        }

        .notif-dot {
            position: absolute;
            top: 0;
            right: 0;
            width: 12px;
            height: 12px;
            background-color: #e02424;
            /* solid red */
            border-radius: 50%;
            border: 2px solid white;
            z-index: 999;
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.3);
                opacity: 0.7;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>

    <nav class="second-navbar bg-graay border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-6 sm:px-4 lg:px-6">
            <div class="flex justify-between items-center h-10 text-sm text-gray-700">

                <!-- Left side links -->
                <div class="flex space-x-4">


                </div>

                <!-- Right side: Auth section -->
                <div class="flex space-x-4 items-center relative">
                    @auth
                        @php $user = Auth::user(); @endphp

                        {{-- Seller Section --}}
                        @if ($user->is_seller)
                            <a href="{{ route('seller.dashboard.index') }}"
                                class="text-sm font-medium text-teal-600 hover:underline">Seller Dashboard</a>
                        @else
                            <a href="{{ route('users.registeraccount') }}"
                                class="text-sm font-medium text-teal-600 hover:underline">Register as Seller</a>
                        @endif

                        {{-- Profile with Dropdown --}}
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none group">
                                <img src="{{ $user->profile_photo_url ?? asset('images/default-user.png') }}" alt="Profile"
                                    class="w-8 h-8 rounded-full object-cover border border-gray-300 group-hover:border-teal-500 transition">
                                <span class="font-medium text-gray-800 group-hover:text-teal-600">{{ $user->name }}</span>
                                <svg class="w-4 h-4 text-gray-500 group-hover:text-teal-600" fill="none"
                                    stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div x-show="open" @click.away="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg z-50 py-2">

                                <a href="{{ route('users.dashboard.index') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Activities</a>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My
                                    Profile</a>
                                <a href="{{ route('users.feedback.create') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Share Feedback</a>
                                <a href="{{ route('users.appinfo.about') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">About</a>

                                <div class="border-t my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline">Log In</a>
                        <a href="{{ route('register') }}" class="hover:underline font-semibold text-teal-600">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>



    <nav x-data="{ sidebarOpen: false }" class="w-ful bg-color">
        <div class="max-w-7xl mx-auto px-8 sm:px-4 lg:px-6">
            <div class="flex justify-between items-center">

                <!-- Logo -->
                <div class="flex-shrink-1 flex items-center the-loko">
                    <a href="{{ route('users.HomePage.index') }}" class="text-white" style="text-decoration: none;">
                        Logo none
                    </a>
                </div>


                <!-- Desktop Nav -->
                <div class="hidden md:flex space-x-3 items-center text-base font-medium font-serif">

                    <a href="{{ route('users.HomePage.index') }}" class="nav-bar px-3 py-2 rounded text-white font-sans"
                        style="text-decoration: none;">Home</a>
                    <a href="{{ route('users.Market.index') }}" class="nav-bar px-3 py-2 rounded text-white font-sans"
                        style="text-decoration: none;">Market</a>

                    <!-- Search Area + Notification -->
                    <div class="flex items-center gap-3 w-full max-w-md search-area">

                        <!-- Search Form -->
                        <form action="{{ route('users.searchproducts') }}" method="GET" id="searchForm" class="flex-1">
                            @csrf
                            <div class="flex items-center gap-2">
                                <!-- Search Input -->
                                <input type="text" name="keyword"
                                    class="flex-1 form-control form-control-sm py-2 border-0 rounded-pill font-sans"
                                    placeholder="Search..." value="{{ request()->keyword }}">

                                <!-- Search Button -->
                                <button class="btn btn-sm py-2 px-4 text-white font-sans rounded-pill" type="submit"
                                    style="background-color: #007979ff; transition: background-color 0.3s ease;">
                                    Search
                                </button>
                            </div>
                        </form>



                        <!-- Unified Notification Bell (for Buyers & Sellers) -->
                        <div id="notification-bell" class="relative flex-shrink-0 flex items-center space-x-3">
                            <a href="{{ route('notifications.index') }}" class="relative">
                                <button type="button"
                                    class="relative focus:outline-none cursor-pointer hover:scale-105 transition">
                                    <!-- Bell Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-white hover:text-gray-200 transition" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0
                    10-12 0v3.159c0 .538-.214 1.055-.595
                    1.436L4 17h5m6 0v1a3 3 0
                    11-6 0v-1m6 0H9" />
                                    </svg>

                                    <!-- Notification Dot -->
                                    @if(Auth::check())
                                        @php
                                            $hasUnreadNotifications = \App\Models\User::find(Auth::id())
                                                ->unreadNotifications()
                                                ->whereIn('type', [
                                                    \App\Notifications\ReservedOrdersNotification::class,
                                                    \App\Notifications\NewReplyNotification::class,
                                                ])
                                                ->exists();
                                        @endphp

                                        @if($hasUnreadNotifications)
                                            <span id="notif-dot" class="notif-dot"></span>
                                        @endif
                                    @endif


                                </button>
                            </a>
                        </div>



                    </div>

                </div>




                <div class="md:hidden flex items-center justify-end w-full px-2 py-2">
                    @auth
                        @php $user = Auth::user(); @endphp

                        <!-- Unified Notification Bell (for Buyers & Sellers) -->
                        <div id="notification-bell" class="relative flex-shrink-0 flex items-center space-x-3">
                            <a href="{{ route('notifications.index') }}" class="relative">
                                <button type="button"
                                    class="relative focus:outline-none cursor-pointer hover:scale-105 transition">
                                    <!-- Bell Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-white hover:text-gray-200 transition" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0
                                                                                    10-12 0v3.159c0 .538-.214 1.055-.595
                                                                                    1.436L4 17h5m6 0v1a3 3 0
                                                                                    11-6 0v-1m6 0H9" />
                                    </svg>

                                    <!-- Notification Dot -->
                                    @if(Auth::check() && $hasUnreadNotifications)
                                        <span id="notif-dot"
                                            class="absolute top-0 right-0 w-3 h-3 bg-red-600 rounded-full border-2 border-white z-10"></span>
                                    @endif
                                </button>
                            </a>
                        </div>



                        <!-- Profile Dropdown -->
                        <div x-data="{ open: false }" class="relative flex items-center gap-3">
                            <button @click.stop="open = !open"
                                class="flex items-center gap-1 px-3 py-1.5 rounded-full bg-prof focus:outline-none">
                                <img src="{{ $user->profile_photo_url ?? asset('images/default-user.png') }}"
                                    class="w-8 h-8 rounded-full object-cover border border-white/20" alt="Profile">
                                <span class="text-white font-medium text-sm truncate max-w-[100px]">{{ $user->name }}</span>
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="open" x-cloak @click.outside="open = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 w-56 bg-white border border-gray-200 rounded-lg shadow-lg z-50 py-2"
                                style="top: 70px;">

                                <a href="{{ route('users.dashboard.index') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                    style="text-decoration: none;">My Activities</a>

                                @if ($user->is_seller)
                                    <a href="{{ route('seller.dashboard.index') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                        style="text-decoration: none;">Seller Dashboard</a>
                                @else
                                    <a href="{{ route('users.registeraccount') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                        style="text-decoration: none;">Register Seller</a>
                                @endif

                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                    style="text-decoration: none;">My Profile</a>

                                <a href="{{ route('users.feedback.create') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                    style="text-decoration: none;">Share Feedback</a>

                                <a href="{{ route('users.appinfo.about') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                    style="text-decoration: none;">About</a>

                                <div class="border-t my-1"></div>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-gray-100">
                                        Log Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-Login text-white px-4 py-2 rounded-full text-sm font-medium">
                            Login
                        </a>
                    @endauth
                </div>

            </div>


            <div class="mobile-bottom-nav md:hidden bg-white border-t shadow-sm">
                <div class="nav-inner flex justify-around py-2">
                    <a href="{{ route('users.HomePage.index') }}" class="flex flex-col items-center text-gray-800"
                        style="text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l9-9 9 9M4 10v10a1 1 0 001 1h6m8-11v10a1 1 0 01-1 1h-6" />
                        </svg>
                        <span class="text-xs text-gray-800">Home</span>
                    </a>

                    <a href="{{ route('users.Market.index') }}" class="flex flex-col items-center text-gray-800"
                        style="text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 3h18l-1 9H4L3 3zm3 13a4 4 0 108 0 4 4 0 00-8 0z" />
                        </svg>
                        <span class="text-xs text-gray-800">Market</span>
                    </a>

                    <a href="{{ route('users.searchIndex') }}" class="flex flex-col items-center text-gray-800"
                        style="text-decoration: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-800" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <circle cx="11" cy="11" r="8" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        <span class="text-xs text-gray-800">Search</span>
                    </a>
                </div>
            </div>
            @yield('scripts')
    </nav>
    <script>
        // Check notifications and toggle the red & green dots. Runs after DOM ready.
        async function checkNotifications() {
            const buyerDots = [
                document.getElementById('notif-dot'),
                document.getElementById('notif-dot-mobile')
            ].filter(Boolean);

            const sellerDots = [
                document.getElementById('seller-notif-dot'),
                document.getElementById('seller-notif-dot-mobile')
            ].filter(Boolean);

            if (buyerDots.length === 0 && sellerDots.length === 0) return;

            try {
                const res = await fetch("{{ route('notifications.check') }}", {
                    method: 'GET',
                    credentials: 'same-origin',
                    headers: { 'Accept': 'application/json' }
                });

                const ok = res.ok && (res.headers.get('content-type') || '').includes('application/json');
                const data = ok ? await res.json() : null;

                // Toggle buyer dots
                buyerDots.forEach(dot => {
                    if (data && data.hasUnread) dot.classList.remove('hidden');
                    else dot.classList.add('hidden');
                });

                // Optional: seller dots — for now they show same unread status as buyers
                sellerDots.forEach(dot => {
                    if (data && data.hasUnread) dot.classList.remove('hidden');
                    else dot.classList.add('hidden');
                });

            } catch (err) {
                console.error('Notification check error', err);
                buyerDots.forEach(dot => dot.classList.add('hidden'));
                sellerDots.forEach(dot => dot.classList.add('hidden'));
            }
        }

        // initial check
        document.addEventListener('DOMContentLoaded', () => {
            checkNotifications();

            // poll every 10 seconds (only set one interval per page)
            if (!window._notifIntervalSet) {
                setInterval(checkNotifications, 10000);
                window._notifIntervalSet = true;
            }
        });
    </script>

</body>