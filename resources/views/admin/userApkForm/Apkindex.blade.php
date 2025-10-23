@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')
        <style>
            .applications-header {
                background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
                color: white;
                padding: 30px;
                border-radius: 12px;
                margin-bottom: 30px;
                box-shadow: 0 4px 15px rgba(59, 130, 246, 0.2);
            }

            .applications-header h2 {
                margin: 0;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: 0.5px;
            }

            .applications-header p {
                margin: 8px 0 0 0;
                opacity: 0.9;
                font-size: 0.95rem;
            }

            .applications-count {
                display: inline-block;
                background: rgba(255, 255, 255, 0.2);
                padding: 6px 14px;
                border-radius: 20px;
                font-weight: 600;
                font-size: 0.9rem;
                margin-top: 12px;
            }

            .alert-success, .alert-danger {
                border-radius: 12px;
                border: none;
                margin-bottom: 20px;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            }

            .table-wrapper {
                background: white;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
                border: 1px solid #dbeafe;
            }

            .table-wrapper table {
                margin: 0;
            }

            .table thead th {
                background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%);
                color: #1e40af;
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
                background: linear-gradient(90deg, #eff6ff 0%, #dbeafe 100%);
                box-shadow: inset 0 0 10px rgba(59, 130, 246, 0.05);
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

            .user-info {
                font-weight: 600;
                color: #1e40af;
            }

            .status-badge {
                display: inline-block;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 0.85rem;
                font-weight: 700;
            }

            .status-pending {
                background: #fef3c7;
                color: #92400e;
            }

            .status-approved {
                background: #dcfce7;
                color: #15803d;
            }

            .status-rejected {
                background: #fee2e2;
                color: #991b1b;
            }

            .date-badge {
                display: inline-block;
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, rgba(29, 78, 216, 0.05) 100%);
                color: #1e40af;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 0.85rem;
                font-weight: 600;
            }

            .document-preview {
                max-width: 80px;
                height: 80px;
                border-radius: 8px;
                border: 2px solid #dbeafe;
                object-fit: cover;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .document-preview:hover {
                transform: scale(1.05);
                border-color: #3b82f6;
            }

            .action-buttons {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .btn-approve, .btn-reject {
                padding: 8px 14px;
                border: none;
                border-radius: 6px;
                font-weight: 600;
                cursor: pointer;
                transition: all 0.3s ease;
                font-size: 0.9rem;
            }

            .btn-approve {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: white;
            }

            .btn-approve:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(16, 185, 129, 0.3);
            }

            .btn-reject {
                background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
                color: white;
            }

            .btn-reject:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 12px rgba(239, 68, 68, 0.3);
            }

            .empty-state {
                text-align: center;
                padding: 60px 20px;
                color: #999;
            }

            .empty-state i {
                font-size: 4rem;
                color: #dbeafe;
                margin-bottom: 20px;
            }
        </style>

        <div style="width: 100%;">
            <!-- Header Section -->
            <div class="applications-header">
                <h2>
                    <i class="fas fa-handshake me-3"></i> Seller Applications
                </h2>
                <p>Review and manage seller registration applications</p>
                <div class="applications-count">
                    <i class="fas fa-briefcase me-2"></i> Pending Applications
                </div>
            </div>

            <!-- Alerts -->
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                </div>
            @endif

            <!-- Applications Table -->
            <div class="table-wrapper" style="width: 100%; overflow-x: auto;">
                @if($applications->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-user me-2"></i>User</th>
                                <th><i class="fas fa-envelope me-2"></i>Email</th>
                                <th><i class="fas fa-flag me-2"></i>Status</th>
                                <th><i class="fas fa-calendar me-2"></i>Applied At</th>
                                <th><i class="fas fa-file me-2"></i>Documents</th>
                                <th style="text-align: center;"><i class="fas fa-cogs me-2"></i>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($applications as $application)
                                <tr>
                                    <td>
                                        <span class="user-info">{{ $application->user->name }}</span>
                                    </td>
                                    <td>{{ $application->user->email }}</td>
                                    <td>
                                        <span class="status-badge status-{{ strtolower($application->status) }}">
                                            @if($application->status == 'pending')
                                                <i class="fas fa-hourglass-half me-1"></i> Pending
                                            @elseif($application->status == 'approved')
                                                <i class="fas fa-check-circle me-1"></i> Approved
                                            @else
                                                <i class="fas fa-times-circle me-1"></i> Rejected
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span class="date-badge">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $application->created_at->format('d/m/Y H:i') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($application->valid_id)
                                            <a href="{{ asset('storage/' . $application->valid_id) }}" target="_blank">
                                                <img src="{{ asset('storage/' . $application->valid_id) }}" alt="Valid ID" class="document-preview">
                                            </a>
                                        @else
                                            <em class="text-muted">No ID</em>
                                        @endif
                                    </td>
                                    <td style="text-align: center;">
                                        @if($application->status == 'pending')
                                            <div class="action-buttons">
                                                <form action="{{ route('admin.admin.approve', $application->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-approve">
                                                        <i class="fas fa-check me-1"></i> Approve
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.admin.reject', $application->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn-reject">
                                                        <i class="fas fa-times me-1"></i> Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-muted">
                                                <em>No actions</em>
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <h5>No Applications</h5>
                                            <p>There are no seller applications to review.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Applications Found</h5>
                        <p>There are no seller applications at this time.</p>
                    </div>
                @endif
            </div>
        </div>
    @endsection
@endcan