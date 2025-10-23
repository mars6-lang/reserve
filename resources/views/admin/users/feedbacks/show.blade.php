@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')
        <style>
            .feedbacks-header {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                color: white;
                padding: 30px;
                border-radius: 12px;
                margin-bottom: 30px;
                box-shadow: 0 4px 15px rgba(245, 158, 11, 0.2);
            }

            .feedbacks-header h2 {
                margin: 0;
                font-size: 2rem;
                font-weight: 800;
                letter-spacing: 0.5px;
            }

            .feedbacks-header p {
                margin: 8px 0 0 0;
                opacity: 0.9;
                font-size: 0.95rem;
            }

            .feedbacks-count {
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
                border: 1px solid #fef3c7;
            }

            .table-wrapper table {
                margin: 0;
            }

            .table thead th {
                background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
                color: #92400e;
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
                background: linear-gradient(90deg, #fffbeb 0%, #fef3c7 100%);
                box-shadow: inset 0 0 10px rgba(245, 158, 11, 0.05);
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

            .rating-stars {
                color: #f59e0b;
                font-size: 1.1rem;
            }

            .comment-text {
                max-width: 300px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
                color: #666;
            }

            .date-badge {
                display: inline-block;
                background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(217, 119, 6, 0.05) 100%);
                color: #92400e;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 0.85rem;
                font-weight: 600;
            }

            .pagination-wrapper {
                display: flex;
                justify-content: center;
                padding: 20px 16px;
                background: #fffbeb;
                border-top: 1px solid #fef3c7;
            }

            .pagination {
                margin: 0;
            }

            .pagination .page-link {
                color: #f59e0b;
                border: 1px solid #fef3c7;
                border-radius: 6px;
                margin: 0 4px;
                padding: 8px 12px;
                transition: all 0.3s ease;
            }

            .pagination .page-link:hover {
                background: #f59e0b;
                color: white;
                border-color: #f59e0b;
            }

            .pagination .page-item.active .page-link {
                background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
                border-color: #d97706;
            }

            .empty-state {
                text-align: center;
                padding: 60px 20px;
                color: #999;
            }

            .empty-state i {
                font-size: 4rem;
                color: #fef3c7;
                margin-bottom: 20px;
            }
        </style>

        <div style="width: 100%;">
            <!-- Header Section -->
            <div class="feedbacks-header">
                <h2>
                    <i class="fas fa-star me-3"></i> User Feedbacks
                </h2>
                <p>View and manage all user feedback and ratings</p>
                <div class="feedbacks-count">
                    <i class="fas fa-comments me-2"></i> Total Feedbacks: {{count($allfeedbacks)}}
                </div>
            </div>

            <!-- Feedbacks Table -->
            <div class="table-wrapper" style="width: 100%;">
                @if($allfeedbacks->count() > 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><i class="fas fa-envelope me-2"></i>Email</th>
                                <th><i class="fas fa-star me-2"></i>Rating</th>
                                <th><i class="fas fa-comment me-2"></i>Comments</th>
                                <th><i class="fas fa-calendar me-2"></i>Date Submitted</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allfeedbacks as $feedback)
                            <tr>
                                <td>{{$feedback->email}}</td>
                                <td>
                                    <span class="rating-stars">
                                        @for($i = 0; $i < $feedback->rate; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor
                                        @for($i = $feedback->rate; $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </span>
                                </td>
                                <td>
                                    <span class="comment-text" title="{{$feedback->comments}}">
                                        {{$feedback->comments}}
                                    </span>
                                </td>
                                <td>
                                    <span class="date-badge">
                                        <i class="fas fa-clock me-1"></i>
                                        {{$feedback->created_at->format('d/m/Y H:i')}}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="pagination-wrapper">
                        {{$allfeedbacks->links()}}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h5>No Feedbacks Yet</h5>
                        <p>There are no user feedbacks at this time.</p>
                    </div>
                @endif
            </div>
        </div>
    @endsection
@endcan