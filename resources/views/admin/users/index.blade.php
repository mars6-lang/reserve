@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')
        <style>
            .users-header {
                background: linear-gradient(135deg, #069c88 0%, #056659 100%);
                color: white;
                padding: 30px;
                border-radius: 12px;
                margin-bottom: 30px;
                box-shadow: 0 4px 15px rgba(6, 156, 136, 0.2);
            }

            .users-header h2 {
                margin: 0;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: 0.5px;
            }

            .users-header p {
                margin: 8px 0 0 0;
                opacity: 0.9;
                font-size: 0.95rem;
            }

            .users-count {
                display: inline-block;
                background: rgba(255, 255, 255, 0.2);
                padding: 6px 14px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.9rem;
                margin-top: 12px;
            }

            .table-wrapper {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                border: 1px solid #f0f9f7;
            }

            .table-wrapper table {
                margin: 0;
            }

            .table thead th {
                background: linear-gradient(135deg, #f0f9f7 0%, #e8f5f3 100%);
                color: #056659;
                font-weight: 700;
                padding: 18px 16px;
                text-transform: uppercase;
                font-size: 0.85rem;
                letter-spacing: 0.5px;
                border: none;
            }

            .table tbody tr {
                border-bottom: 1px solid #f0f0f0;
                transition: all 0.3s ease;
            }

            .table tbody tr:hover {
                background: linear-gradient(90deg, #f8fffe 0%, #f0f9f7 100%);
                box-shadow: inset 0 0 10px rgba(6, 156, 136, 0.05);
            }

            .table tbody tr:last-child {
                border-bottom: none;
            }

            .table tbody td {
                padding: 16px;
                vertical-align: middle;
                color: #333;
                font-size: 0.95rem;
            }

            .user-name {
                font-weight: 600;
                color: #056659;
            }

            .user-email {
                color: #666;
                font-size: 0.9rem;
            }

            .view-btn {
                display: inline-block;
                background: linear-gradient(135deg, #069c88 0%, #056659 100%);
                color: white;
                padding: 8px 16px;
                border-radius: 6px;
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
                border: none;
                cursor: pointer;
                font-size: 0.9rem;
            }

            .view-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(6, 156, 136, 0.3);
                color: white;
                text-decoration: none;
            }

            .pagination-wrapper {
                display: flex;
                justify-content: center;
                padding: 20px 16px;
                background: #f8fffe;
                border-top: 1px solid #f0f0f0;
            }

            .pagination {
                margin: 0;
            }

            .pagination .page-link {
                color: #069c88;
                border: 1px solid #d4efe9;
                border-radius: 6px;
                margin: 0 4px;
                padding: 8px 12px;
                transition: all 0.3s ease;
            }

            .pagination .page-link:hover {
                background: #069c88;
                color: white;
                border-color: #069c88;
            }

            .pagination .page-item.active .page-link {
                background: linear-gradient(135deg, #069c88 0%, #056659 100%);
                border-color: #056659;
            }

            .empty-state {
                text-align: center;
                padding: 60px 20px;
                color: #999;
            }

            .empty-state i {
                font-size: 4rem;
                color: #d4efe9;
                margin-bottom: 20px;
            }
        </style>

        <div style="width: 100%;">
            <!-- Header Section -->
            <div class="users-header">
                <h2>
                    <i class="fas fa-users me-3"></i> User Management
                </h2>
                <p>Manage and monitor all registered users on your platform</p>
                <div class="users-count">
                    <i class="fas fa-user-circle me-2"></i> Total Users: {{count($allusers)}}
                </div>
            </div>

            <!-- Users Table -->
            <div class="table-wrapper" style="width: 100%;">
                @if($allusers->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>Name</th>
                                <th><i class="fas fa-envelope me-2"></i>Email</th>
                                <th><i class="fas fa-calendar me-2"></i>Date Created</th>
                                <th style="text-align: center;"><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allusers as $user)
                            <tr>
                                <td>
                                    <span class="user-name">{{$user->name}}</span>
                                </td>
                                <td>
                                    <span class="user-email">{{$user->email}}</span>
                                </td>
                                <td>
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    {{date('d/m/Y H:i A', strtotime($user->created_at))}}
                                </td>
                                <td style="text-align: center;">
                                    <a href="" class="view-btn">
                                        <i class="fas fa-eye me-1"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{$allusers->links()}}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Users Found</h5>
                        <p>There are no registered users at this time.</p>
                    </div>
                @endif
            </div>
        </div>
    @endsection
@endcan