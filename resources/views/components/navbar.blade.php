@props(['active'])

<nav x-data="{ sidebarOpen: false, dropdownOpen: false }" class="top-0 left-0 w-full bg-white border-b border-gray-100 py-2">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="{{ route('users.HomePage.index') }}">
                    <img src="{{ asset('images/wow.jpg') }}" alt="Logo" class="w-12 h-12 rounded-full object-cover" />
                </a>
            </div>

            <!-- Center Nav Links -->
            <div class="hidden md:flex space-x-6 items-center">
                <a href="{{ route('users.HomePage.index') }}" class="hover:text-red-600">House</a>
                <a href="#" class="hover:text-red-600">Contacts</a>
                <a href="#" class="hover:text-red-600">About</a>
k
                <!-- Dropdown -->
                <div class="relative" x-data="{ dropdownOpen: false }">
                    <button @click="dropdownOpen = !dropdownOpen" class="hover:text-red-600">Services</button>
                    <div x-show="dropdownOpen" @click.away="dropdownOpen = false"
                         class="absolute mt-2 w-40 bg-white border rounded-md shadow-lg z-50">
                        <a href="{{ route('users.Market.index') }}" class="block px-4 py-2 hover:bg-gray-100">E-Market</a>
                        <a href="{{ route('users.analytics.index') }}" class="block px-4 py-2 hover:bg-gray-100">Catch Analysis</a>
                    </div>
                </div>
            </div>

            <!-- Sidebar Toggle Button -->
            <div class="flex items-center">
                <button @click="sidebarOpen = true"
                        class="p-2 rounded-md text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Panel -->
    <aside x-show="sidebarOpen"
           x-transition:enter="transition ease-out duration-300"
           x-transition:enter-start="translate-x-full"
           x-transition:enter-end="translate-x-0"
           x-transition:leave="transition ease-in duration-200"
           x-transition:leave-start="translate-x-0"
           x-transition:leave-end="translate-x-full"
           class="fixed right-0 top-0 h-full w-64 bg-white shadow-xl z-50 px-6 py-8 space-y-4"
           style="display: none;">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold">Menu</h2>
            <button @click="sidebarOpen = false" class="text-2xl text-gray-600 hover:text-red-500">&times;</button>
        </div>
        <nav class="flex flex-col space-y-5 text-lg text-gray-700">
            <a href="{{ route('users.Dashboard.index') }}" class="hover:underline">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="hover:underline">Profile</a>
            <a href="{{ route('users.accountsittings') }}" class="hover:underline">Account Settings</a>
            <a href="{{ route('users.addressbook') }}" class="hover:underline">Address Book</a>
            <a href="{{ route('users.Dashboard.index') }}" class="hover:underline">My Reviews</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-left text-red-500 hover:underline">Log Out</button>
            </form>
        </nav>
    </aside>

    <!-- Mobile Dropdown -->
    <div :class="{ 'block': sidebarOpen, 'hidden': !sidebarOpen }" class="hidden md:hidden px-4 pb-4">
        <a href="{{ route('users.HomePage.index') }}" class="block py-2">Home</a>
        <a href="#" class="block py-2">Contacts</a>
        <a href="#" class="block py-2">Services</a>
        <a href="#" class="block py-2">About</a>
    </div>

    @yield('scripts')
</nav>