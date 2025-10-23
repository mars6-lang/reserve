<style>
    .admin-sidebar {
        position: fixed;
        left: 0;
        top: 0;
        width: 280px;
        height: 100vh;
        background: linear-gradient(180deg, #069c88 0%, #047a6b 50%, #056659 100%);
        z-index: 1000;
        overflow-y: auto;
        box-shadow: 2px 0 12px rgba(0, 0, 0, 0.15);
    }

    .admin-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .admin-sidebar::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .admin-sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .admin-sidebar::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    .admin-topbar {
        position: fixed;
        top: 0;
        left: 280px;
        right: 0;
        height: 70px;
        background: linear-gradient(90deg, #ffffff 0%, #fafafa 100%);
        border-bottom: 1px solid #e5e7eb;
        z-index: 999;
        display: flex;
        align-items: center;
        padding: 0 30px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
    }

    .admin-content {
        margin-left: 280px;
        margin-top: 70px;
        padding: 30px;
        min-height: calc(100vh - 70px);
        background: linear-gradient(135deg, #f8fffe 0%, #f0f9f7 100%);
    }

    .sidebar-header {
        padding: 24px 20px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.15);
        color: white;
        text-align: center;
    }

    .sidebar-header .logo {
        width: 65px;
        height: 65px;
        border-radius: 12px;
        margin: 0 auto 12px;
        display: block;
        object-fit: cover;
        border: 3px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }

    .sidebar-header .logo:hover {
        transform: scale(1.05);
        border-color: rgba(255, 255, 255, 0.4);
    }

    .sidebar-header h3 {
        margin: 0;
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .sidebar-header p {
        margin: 6px 0 0 0;
        font-size: 0.8rem;
        opacity: 0.85;
        font-weight: 500;
    }

    .sidebar-menu {
        padding: 20px 0;
    }

    .sidebar-menu a,
    .sidebar-menu button {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 20px;
        color: rgba(255, 255, 255, 0.75);
        text-decoration: none;
        font-size: 0.95rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        background: none;
        cursor: pointer;
        width: 100%;
        text-align: left;
        font-weight: 500;
        position: relative;
    }

    .sidebar-menu a::before,
    .sidebar-menu button::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        width: 4px;
        background: rgba(255, 255, 255, 0.3);
        transform: scaleY(0);
        transform-origin: center;
        transition: transform 0.3s ease;
    }

    .sidebar-menu a:hover,
    .sidebar-menu button:hover {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        padding-left: 26px;
    }

    .sidebar-menu a:hover::before,
    .sidebar-menu button:hover::before {
        transform: scaleY(1);
    }

    .sidebar-menu a.active {
        background: rgba(255, 255, 255, 0.18);
        color: white;
        border-left: 3px solid white;
        padding-left: 17px;
    }

    .sidebar-menu a.active::before {
        transform: scaleY(1);
    }

    .sidebar-menu i {
        width: 20px;
        text-align: center;
        font-size: 1.1rem;
    }

    .topbar-title {
        font-size: 1.4rem;
        font-weight: 800;
        color: #056659;
        letter-spacing: 0.2px;
    }

    .topbar-title i {
        margin-right: 8px;
        color: #069c88;
    }

    .topbar-user {
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #069c88;
        box-shadow: 0 2px 8px rgba(6, 156, 136, 0.2);
        transition: all 0.3s ease;
    }

    .user-avatar:hover {
        transform: scale(1.05);
        border-color: #056659;
        box-shadow: 0 4px 12px rgba(6, 156, 136, 0.3);
    }

    .topbar-user span {
        font-weight: 600;
        color: #056659;
    }

    /* Table Styling */
    .admin-content table {
        width: 100%;
        margin: 0;
        background: white;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
    }

    .admin-content table thead {
        background: linear-gradient(135deg, #069c88 0%, #056659 100%);
        color: white;
    }

    .admin-content table thead th {
        padding: 16px;
        font-weight: 700;
        text-align: left;
        border: none;
        font-size: 0.95rem;
        letter-spacing: 0.3px;
    }

    .admin-content table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: all 0.3s ease;
    }

    .admin-content table tbody tr:hover {
        background: #f8fffe;
    }

    .admin-content table tbody tr:last-child {
        border-bottom: none;
    }

    .admin-content table tbody td {
        padding: 14px 16px;
        border: none;
        font-size: 0.95rem;
        color: #333;
    }

    .admin-content table tbody td a {
        color: #069c88;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .admin-content table tbody td a:hover {
        color: #056659;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .admin-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            width: 250px;
        }

        .admin-sidebar.active {
            transform: translateX(0);
        }

        .admin-topbar {
            left: 0;
        }

        .admin-content {
            margin-left: 0;
        }

        .admin-content table {
            font-size: 0.85rem;
        }

        .admin-content table thead th,
        .admin-content table tbody td {
            padding: 10px 12px;
        }
    }
</style>

<!-- Top Bar -->
<div class="admin-topbar">
    <button id="sidebarToggle" class="md:hidden text-2xl text-gray-700 mr-5">
        <i class="fas fa-bars"></i>
    </button>
    <h1 class="topbar-title">
        <i class="fas fa-store"></i> Aparri Fish Market
    </h1>
    <div class="topbar-user">
        @auth
            <span class="text-sm">{{ Auth::user()->name }}</span>
            <img src="{{ Auth::user()->profile_photo_url ?? 'https://via.placeholder.com/40' }}" 
                 alt="Profile" class="user-avatar">
        @endauth
    </div>
</div>

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-header">
        <img src="{{ asset('images/loko.jpg') }}" alt="Logo" class="logo">
        <h3>Admin Panel</h3>
        <p>{{ Auth::user()?->name ?? 'Administrator' }}</p>
    </div>

    <nav class="sidebar-menu">
        <a href="{{ route('dashboard') }}" class="@if(Route::is('dashboard')) active @endif">
            <i class="fas fa-chart-bar"></i>
            <span>Dashboard</span>
        </a>
        
        <a href="{{ route('admin.users.index') }}">
            <i class="fas fa-user-tie"></i>
            <span>Manage Users</span>
        </a>

        <a href="{{ route('admin.Apkindex') }}">
            <i class="fas fa-handshake"></i>
            <span>Seller Applications</span>
        </a>

        <hr style="border: 1px solid rgba(255, 255, 255, 0.1); margin: 15px 0;">

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">
                <i class="fas fa-door-open"></i>
                <span>Log Out</span>
            </button>
        </form>
    </nav>
</aside>

<!-- Main Content Wrapper -->
<div class="admin-content" id="adminContent">
</div>

<script>
    const sidebarToggle = document.getElementById('sidebarToggle');
    const adminSidebar = document.getElementById('adminSidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            adminSidebar.classList.toggle('active');
        });

        // Close sidebar when a link is clicked
        document.querySelectorAll('.sidebar-menu a').forEach(link => {
            link.addEventListener('click', function() {
                adminSidebar.classList.remove('active');
            });
        });
    }
</script>
</nav>
