<style>
    .admin-topnav {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        background: linear-gradient(90deg, #ffffff 0%, #fafafa 100%);
        border-bottom: 2px solid #e5e7eb;
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 0 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .admin-topnav .logo-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-right: 40px;
    }

    .admin-topnav .logo-img {
        width: 45px;
        height: 45px;
        border-radius: 8px;
        object-fit: cover;
        border: 2px solid #069c88;
    }

    .admin-topnav .brand {
        font-size: 1.3rem;
        font-weight: 800;
        color: #056659;
        letter-spacing: 0.3px;
    }

    .admin-topnav .brand i {
        color: #069c88;
        margin-right: 8px;
    }

    .admin-menu {
        display: flex;
        align-items: center;
        gap: 5px;
        flex: 1;
    }

    .admin-menu a,
    .admin-menu button {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        color: #333;
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        border: none;
        background: none;
        cursor: pointer;
        font-weight: 500;
        border-radius: 8px;
        position: relative;
    }

    .admin-menu a:hover,
    .admin-menu button:hover {
        background: linear-gradient(135deg, rgba(6, 156, 136, 0.1) 0%, rgba(5, 102, 89, 0.05) 100%);
        color: #069c88;
    }

    .admin-menu a.active {
        background: linear-gradient(135deg, #069c88 0%, #056659 100%);
        color: white;
    }

    .admin-menu i {
        font-size: 1rem;
    }

    .admin-user-section {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-left: auto;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #069c88;
        box-shadow: 0 2px 8px rgba(6, 156, 136, 0.2);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .user-avatar:hover {
        transform: scale(1.05);
        border-color: #056659;
    }

    .user-name {
        font-weight: 600;
        color: #056659;
        font-size: 0.9rem;
    }

    .admin-content {
        margin-top: 70px;
        padding: 30px 40px;
        min-height: calc(100vh - 70px);
        background: linear-gradient(135deg, #f8fffe 0%, #f0f9f7 100%);
    }

    .logout-form {
        margin: 0;
    }

    .logout-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
    }

    @media (max-width: 1024px) {
        .admin-topnav {
            padding: 0 20px;
        }

        .admin-menu {
            gap: 2px;
        }

        .admin-menu a,
        .admin-menu button {
            padding: 10px 12px;
            font-size: 0.8rem;
        }

        .admin-menu span {
            display: none;
        }

        .admin-topnav .logo-section {
            margin-right: 20px;
        }

        .admin-content {
            padding: 20px;
        }
    }

    @media (max-width: 768px) {
        .admin-topnav {
            height: 60px;
            padding: 0 15px;
        }

        .admin-topnav .brand {
            font-size: 1.1rem;
        }

        .admin-menu {
            display: none;
        }

        .admin-user-section {
            margin-left: 0;
        }

        .user-name {
            display: none;
        }

        .admin-content {
            margin-top: 60px;
            padding: 15px;
        }
    }
</style>

<!-- Top Navigation Bar -->
<nav class="admin-topnav">
    <!-- Logo Section -->
    <div class="logo-section">
        <img src="{{ asset('images/loko.jpg') }}" alt="Logo" class="logo-img">
        <div class="brand">
            Fish Market
        </div>
    </div>

    <!-- Menu Items -->
    <div class="admin-menu">
        <a href="{{ route('dashboard') }}" class="@if (Route::is('dashboard')) active @endif">
            <i class="fas fa-chart-bar"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('admin.users.index') }}">
            <i class="fas fa-user-tie"></i>
            <span>Users</span>
        </a>

        <a href="{{ route('admin.Apkindex') }}">
            <i class="fas fa-handshake"></i>
            <span>Seller Apps</span>
        </a>
    </div>

    <!-- User Section -->
    <div class="admin-user-section">
        @auth
            <div style="display: flex; align-items: center; gap: 10px;">
                <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" alt="Profile"
                    class="user-avatar">
                <span class="user-name">{{ Auth::user()->name }}</span>
            </div>
        @endauth

        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-door-open"></i>
                <span>Logout</span>
            </button>
        </form>
    </div>
</nav>
