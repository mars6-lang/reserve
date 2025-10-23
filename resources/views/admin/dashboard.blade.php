@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')

    <style>
        html, body {
            overflow-x: hidden;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .bg-admin-header {
            background: linear-gradient(135deg, #e8f5f3 0%, #d4efe9 100%);
            border-radius: 12px;
            border-left: 5px solid #069c88;
        }

        .bg-admin-header h2 {
            color: #056659;
            font-size: 1.8rem;
        }

        .bg-admin-header p {
            color: #08695c;
            font-weight: 500;
        }

        .bg-toolkit {
            background-color: #ffffff;
            border-radius: 12px;
            border: 1px solid #f0f0f0;
        }

        .bg-toolkit h2 {
            color: #056659;
            font-size: 1.3rem;
            letter-spacing: 0.3px;
        }

        .admin-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            background: linear-gradient(135deg, #ffffff 0%, #f8fffe 100%);
            text-align: center;
            padding: 24px 18px;
            height: 100%;
            border: 1px solid #f0f9f7;
            position: relative;
            overflow: hidden;
        }

        .admin-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(6, 156, 136, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            transition: all 0.35s ease;
        }

        .admin-card:hover {
            box-shadow: 0 12px 28px rgba(6, 156, 136, 0.18);
            transform: translateY(-8px);
            border-color: #d4efe9;
        }

        .admin-card:hover::before {
            transform: scale(1.2) translate(20px, 20px);
        }

        .admin-card-icon {
            font-size: 2.8rem;
            color: #069c88;
            margin-bottom: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 65px;
            height: 65px;
            background: linear-gradient(135deg, rgba(6, 156, 136, 0.1) 0%, rgba(5, 102, 89, 0.05) 100%);
            border-radius: 12px;
            margin-left: auto;
            margin-right: auto;
            transition: all 0.35s ease;
        }

        .admin-card:hover .admin-card-icon {
            background: linear-gradient(135deg, rgba(6, 156, 136, 0.2) 0%, rgba(5, 102, 89, 0.1) 100%);
            transform: scale(1.1) rotate(5deg);
        }

        .admin-card-label {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 10px;
            font-weight: 600;
            letter-spacing: 0.2px;
            text-transform: uppercase;
        }

        .admin-card-value {
            font-size: 2.2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #069c88 0%, #056659 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -1px;
        }

        .admin-card-badge {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 700;
            color: #069c88;
            background: rgba(6, 156, 136, 0.1);
            padding: 4px 10px;
            border-radius: 20px;
            margin-top: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .admin-card a {
            text-decoration: none;
            color: inherit;
        }

        .admin-card a:hover {
            color: inherit;
        }

        /* Animation */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .admin-card {
            animation: slideInUp 0.5s ease-out forwards;
        }

        .admin-card:nth-child(1) { animation-delay: 0.05s; }
        .admin-card:nth-child(2) { animation-delay: 0.1s; }
        .admin-card:nth-child(3) { animation-delay: 0.15s; }
        .admin-card:nth-child(4) { animation-delay: 0.2s; }
        .admin-card:nth-child(5) { animation-delay: 0.25s; }

        @media (max-width: 576px) {
            .admin-card {
                padding: 18px 12px;
            }

            .admin-card-icon {
                font-size: 2.2rem;
                width: 55px;
                height: 55px;
            }

            .admin-card-value {
                font-size: 1.8rem;
            }

            .bg-admin-header h2 {
                font-size: 1.5rem;
            }

            .bg-toolkit h2 {
                font-size: 1.1rem;
            }
        }
    </style>

    <div class="container-lg py-5">

        <!-- ✅ Welcome Section with Enhanced Design -->
        <div class="bg-admin-header p-5 rounded-lg shadow-sm mb-5">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="fw-bold mb-2">👋 Welcome back, Admin!</h2>
                    <p class="text-muted mb-0">
                        <i class="fas fa-chart-line text-primary me-2"></i>
                        Monitor your marketplace, manage users, review reports, and handle seller applications efficiently.
                    </p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="badge bg-success bg-opacity-10 text-success p-2 rounded-3">
                        <i class="fas fa-circle-check me-1"></i> System Online
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Toolkit -->
        <div class="bg-toolkit p-5 rounded-lg shadow-sm">
            <div class="mb-4">
                <h2 class="h5 fw-bold mb-1">
                    <i class="fas fa-toolbox me-2" style="color: #069c88;"></i> Admin Toolkit
                </h2>
                <p class="text-muted small mb-0">Quick access to key management features</p>
            </div>

            <div class="row row-cols-1 row-cols-sm-2 g-4">

                <!-- Total Users -->
                <div class="col">
                    <a href="{{ route('admin.users.index') }}" class="text-decoration-none">
                        <div class="card admin-card">
                            <div class="admin-card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <h6 class="admin-card-label">Total Users</h6>
                            <p class="admin-card-value">{{ $userLoginCount ?? 0 }}</p>
                            <div class="admin-card-badge">View All</div>
                        </div>
                    </a>
                </div>

                <!-- Seller Applications -->
                <div class="col">
                    <a href="{{ route('admin.Apkindex') }}" class="text-decoration-none">
                        <div class="card admin-card">
                            <div class="admin-card-icon">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <h6 class="admin-card-label">Seller Apps</h6>
                            <p class="admin-card-value">{{ $sellerApps ?? 0 }}</p>
                            <div class="admin-card-badge">Pending</div>
                        </div>
                    </a>
                </div>

            </div>
        </div>

    </div>

    @endsection
@endcan