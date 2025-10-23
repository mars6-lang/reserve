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
</style>

<header class="site-header">
    <!-- Top bar with auth links -->
    <div class="topbar">
        <div style="max-width: 80rem; margin: 0 auto; padding: 0.5rem 1.5rem;">
            <div style="display: flex; justify-content: flex-end; align-items: center; height: 2.5rem; font-size: 0.875rem; gap: 1rem;">
                @auth
                    @php $user = Auth::user(); @endphp
                    @if ($user->is_seller)
                        <a href="{{ route('seller.dashboard.index') }}" style="color: #064e3b;">Seller Dashboard</a>
                    @else
                        <a href="{{ route('users.registeraccount') }}" style="color: #064e3b;">Register as Seller</a>
                    @endif
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
                    <a href="{{ route('users.HomePage.index') }}" class="brand" style="color: #064e3b; text-decoration: none;">Aparri Fish Market</a>
                </div>

                <!-- Desktop nav links -->
                <div style="display: none; gap: 1.5rem; align-items: center; font-size: 1rem; font-weight: 500;" class="desktop-nav">
                    <a href="{{ route('users.HomePage.index') }}" style="color: #064e3b; padding: 0.5rem 0.75rem; border-radius: 0.375rem;">Home</a>
                    <a href="{{ route('users.Market.index') }}" style="color: #064e3b; padding: 0.5rem 0.75rem; border-radius: 0.375rem;">Market</a>
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
