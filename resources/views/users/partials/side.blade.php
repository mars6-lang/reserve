<style>
    .sidebar {
        width: 240px;
        background-color: #f8f9fa;
        min-height: 100vh;
    }

    .sidebar a {
        display: block;
        padding: 12px 20px;
        color: #333;
        text-decoration: none;
        transition: background 0.3s, color 0.3s;
        font-weight: 500;
    }

    .sidebar a:hover,
    .sidebar a.active {
        background-color: #007bff;
        color: white;
    }
</style>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="{{ route('seller.ManageProds') }}"
            class="{{ request()->routeIs('seller.ManageProds') ? 'active' : '' }}">Manage Products</a>
        <a href="{{ route('seller.sellerAdd') }}"
            class="{{ request()->routeIs('seller.sellerAdd') ? 'active' : '' }}">Add Product</a>
        <a href="{{ route('seller.productsRatings') }}"
            class="{{ request()->routeIs('seller.productsRatings') ? 'active' : '' }}">Product Ratings</a>
        <a href="{{ route('seller.ordersList') }}"
            class="{{ request()->routeIs('seller.ordersList') ? 'active' : '' }}">Reserve List</a>
        <a href="{{ route('chatroom.index') }}"
            class="{{ request()->routeIs('chatroom.index') ? 'active' : '' }}">Messages</a>
        <a href="{{ route('seller.analysis.marketanalysis') }}"
            class="{{ request()->routeIs('seller.analysis.marketanalysis') ? 'active' : '' }}">Market Analysis</a>
        <a href="{{ route('seller.notindex') }}"
            class="{{ request()->routeIs('seller.notindex') ? 'active' : '' }}">Notifications</a>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 p-4">
        <h1 class="text-3xl text-muted py-6 text-center">Hello, {{ auth()->user()->name }}!</h1>
        <div class="text-center mb-4">
            <h1 class="text-4xl font-bold text-black">Welcome to Seller Dashboard</h1>
        </div>

        @yield('seller-dashboard-content')
    </div>
</div>