<style>
    /* Navigation header: sticky, high z-index, white background */
    .site-header {
        position: sticky;
        top: 0;
        z-index: 999;
        background-color: #ffffff;
        border-bottom: 1px solid #d1d5db;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        width: 100%;
    }
    .site-header .topbar {
        background-color: #f9fafb;
        border-bottom: 1px solid #e5e7eb;
    }
    .site-header .primary-nav {
        background-color: #ffffff;
    }
    .site-header a {
        color: #064e3b;
        text-decoration: none;
    }
    .site-header a:hover {
        text-decoration: underline;
    }
    .site-header a.brand {
        font-weight: 700;
        font-size: 1.125rem;
    }
    .the-loko {
        display: flex;
        align-items: center;
        height: auto;
        min-width: 130px;
    }
    @media (max-width: 768px) {
        .the-loko {
            min-width: 110px;
        }
    }
    /* Cart icon badge */
    .cart-badge {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 1.5rem;
        height: 1.5rem;
        background-color: #dc2626;
        color: white;
        border-radius: 50%;
        font-size: 0.75rem;
        font-weight: 700;
        margin-left: 0.25rem;
    }
    .cart-icon-link {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        cursor: pointer;
        color: #064e3b;
        text-decoration: none;
        position: relative;
    }
    .cart-icon-link:hover {
        text-decoration: underline;
    }
    /* Notification bell badge */
    .notification-badge {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.5rem;
        height: 1.5rem;
        background-color: #f59e0b;
        color: white;
        border-radius: 50%;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0 0.25rem;
        margin-left: 0.25rem;
    }
    .notification-bell-link {
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
        cursor: pointer;
        color: #064e3b;
        text-decoration: none;
        position: relative;
    }
    .notification-bell-link:hover {
        text-decoration: underline;
    }
    .notification-bell-link svg {
        stroke: #064e3b;
    }
</style>

<header class="site-header">
    <!-- Top bar with auth links -->
    <div class="topbar">
        <div style="max-width: 80rem; margin: 0 auto; padding: 0.5rem 1.5rem;">
            <div style="display: flex; justify-content: flex-end; align-items: center; height: 2.5rem; font-size: 0.875rem; gap: 1rem;">
                @auth
                    @php $user = Auth::user(); @endphp
                    
                    {{-- Reservations Cart Icon --}}
                    @if (!$user->is_seller)
                        @php
                            $reservationCount = \App\Models\Users\orders::where('user_id', $user->id)
                                ->whereNotIn('status', ['completed', 'cancelled'])
                                ->count();
                        @endphp
                        <a href="{{ route('users.reservations.track') }}" class="cart-icon-link" title="View all reservations">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" style="width: 1.25rem; height: 1.25rem;">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.28l-.31-1.243A1 1 0 005 4H3z" />
                                <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0zM4 12a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @if ($reservationCount > 0)
                                <span class="cart-badge">{{ $reservationCount }}</span>
                            @endif
                        </a>
                    @endif
                    
                    @if ($user->is_seller)
                        {{-- Seller Notifications Bell --}}
                        @php
                            $allNotifications = auth()->user()->notifications;
                            $unreadNotificationsCount = auth()->user()->unreadNotifications->count();
                        @endphp
                        <a href="{{ route('notifications.index') }}" class="notification-bell-link" title="View notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="notification-badge">{{ $unreadNotificationsCount }}</span>
                        </a>
                        <a href="{{ route('seller.dashboard.index') }}" style="color: #064e3b;">Seller Dashboard</a>
                    @else
                        <a href="{{ route('users.registeraccount') }}" style="color: #064e3b;">Register as Seller</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #064e3b; cursor: pointer; text-decoration: none; font-size: 0.875rem;">Log Out</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="color: #064e3b;">Log In</a>
                    <a href="{{ route('register') }}" style="color: #064e3b; font-weight: 600;">Register</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Primary navigation -->
    <nav class="primary-nav">
        <div style="max-width: 80rem; margin: 0 auto; padding: 0 1.5rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <!-- Brand -->
                <div class="the-loko">
                    <a href="{{ route('home') }}" class="brand" style="color: #064e3b; text-decoration: none;">Aparri Fish Market</a>
                </div>

                <!-- Desktop nav links -->
                <div style="display: none; gap: 1.5rem; align-items: center; font-size: 1rem; font-weight: 500;" class="desktop-nav">
                    <a href="{{ route('home') }}" style="color: #064e3b; padding: 0.5rem 0.75rem; border-radius: 0.375rem;">Home</a>
                    @if (!auth()->check() || !auth()->user()->is_seller)
                        <a href="{{ route('users.Market.index') }}" style="color: #064e3b; padding: 0.5rem 0.75rem; border-radius: 0.375rem;">Market</a>
                    @endif
                </div>

                <!-- Mobile hamburger -->
                <div style="display: none;" class="mobile-menu">
                    <button style="padding: 0.5rem; border-radius: 0.375rem; background: none; border: none; cursor: pointer;">
                        <svg class="h-6 w-6" style="width: 1.5rem; height: 1.5rem; color: #374151;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    // Show desktop nav on medium+ screens
    const desktopNav = document.querySelector('.desktop-nav');
    const mobileMenu = document.querySelector('.mobile-menu');
    
    function updateNav() {
        if (window.innerWidth >= 768) {
            desktopNav.style.display = 'flex';
            mobileMenu.style.display = 'none';
        } else {
            desktopNav.style.display = 'none';
            mobileMenu.style.display = 'block';
        }
    }
    
    // Initial check and on resize
    updateNav();
    window.addEventListener('resize', updateNav);
</script>
