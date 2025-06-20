<style>
    .hover-bg:hover {
        background-color: rgb(157, 227, 255);
        /* Light gray, adjust as needed */
    }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<nav x-data="{ sidebarOpen: false, dropdownOpen: false }" class="top-0 left-0 w-full border-b border-gray-100 py-3">
    <div class="max-w-7xl mx-auto px-4 sm:px-1 lg:px-8">
        <div class="flex justify-between items-center">

            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('users.HomePage.index') }}">
                    <img src="{{ asset('images/loko.jpg') }}" alt="Logo"
                        class="w-14 h-auto rounded-full object-cover" />
                </a>
            </div>

            <!-- Center Nav Links -->
            <div class="flex space-x-4 items-center text-base font-medium">
                <a href="{{ route('users.HomePage.index') }}" class="nav-link px-3 py-2 rounded hover-bg">Home</a>
                <a href="{{ route('users.Market.index') }}" class="nav-link px-3 py-2 rounded hover-bg">Market</a>
            </div>

            <!-- Sidebar Toggle Button -->
            <div class="flex items-center">

                <button @click="sidebarOpen = true"
                    class="p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @php
        $user = Auth::user();
    @endphp

    <!-- Sidebar Panel -->
    <aside x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="translate-x-full"
        class="fixed right-0 top-0 h-full w-64 bg-white shadow-xl z-50 px-6 py-8 space-y-4" style="display: none;">

        <!-- Sidebar Header -->
        <div class="flex items-center justify-between px-4 pt-4 pb-2">
            <button @click="sidebarOpen = false" class="text-3xl text-gray-600 hover:text-red-500 focus:outline-none">
                &times;
            </button>
            <h5 class="text-lg font-semibold text-gray-800">Menu</h5>
        </div>

        <!-- Profile Info Section -->
        <div class="max-w-md mx-auto p-4 sm:p-6 bg-white">
            <div class="flex items-center gap-4">
                <!-- Profile Picture -->
                <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}'s Photo"
                    class="w-16 h-16 rounded-full object-cover border border-gray-300 shadow-sm aspect-square ring-2 ring-blue-500">

                <!-- Name & Role -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-lg font-semibold text-gray-900">{{ $user->name }}</h2>

                    @if ($user->is_seller)
                        <span
                            class="mt-1 inline-flex items-center gap-1 text-sm font-medium text-green-700 bg-green-100 px-2 py-0.5 rounded-full w-fit">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Verified Seller
                        </span>
                    @else
                        <span class="mt-1 text-sm text-gray-500 italic">Regular User</span>
                    @endif
                </div>
            </div>
        </div>

        <hr class="border-t border-gray-800 mt-1">



        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-5 text-lg text-gray-700 mt-5">
            <a href="{{ route('users.dashboard.index') }}"
                class="nav-link px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>
            <a href="{{ route('users.about') }}" class="nav-link px-3 py-2 rounded hover:bg-gray-100">About</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-left text-red-500 px-3 py-2 rounded hover:bg-red-100 hover:text-red-700 w-full">
                    Log Out
                </button>
            </form>
        </nav>
    </aside>
    @yield('scripts')
</nav>