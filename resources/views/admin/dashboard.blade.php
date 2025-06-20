@can('admin-access')
    @extends('layouts.Admin.adminApp')

    @section('content')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid py-6">
                    <h1 class="mb-5 fw-bold text-secondary">Admin Dashboard</h1>

                    <div class="row g-4">

                        <!-- Users Logged In Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card shadow-sm border-0 rounded-3 bg-primary text-dark h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-user-check fa-3x me-3 opacity-85"></i>
                                            <div class="">
                                                <h5 class="mb-1 fw-semibold">Users Logged In</h5>
                                                <small class="opacity-75">Last 24 hours</small>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold display-5">{{ $userLoginCount ?? 0 }}</h2>

                                        <div class="progress rounded-pill mt-3" style="height: 8px;">
                                            <div class="progress-bar bg-light" role="progressbar" style="width: 75%;"></div>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.users.index') }}"
                                        class="btn btn-outline-light btn-sm mt-4 w-100 text-center d-flex justify-content-center align-items-center gap-2">
                                        View Users
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- User Feedbacks Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card shadow-sm border-0 rounded-3 bg-primary text-dark h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-comments fa-3x me-3 opacity-85"></i>
                                            <div>
                                                <h5 class="mb-1 fw-semibold">User Feedbacks</h5>
                                                <small class="opacity-75">Recent responses</small>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold display-5">{{ $feedbackCount ?? 0 }}</h2>

                                        <div class="progress rounded-pill mt-3" style="height: 8px;">
                                            <div class="progress-bar bg-light" role="progressbar" style="width: 60%;"></div>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.userfeedback') }}"
                                        class="btn btn-outline-light btn-sm mt-4 w-100 text-center d-flex justify-content-center align-items-center gap-2">
                                        View Feedbacks
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Product Reports Card -->

                        <div class="col-xl-3 col-md-6">
                            <div class="card shadow-sm border-0 rounded-3 bg-primary text-danger h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-exclamation-triangle fa-3x me-3 opacity-85"></i>
                                            <div>
                                                <h5 class="mb-1 fw-semibold">Product Reports</h5>
                                                <small class="opacity-75">Pending reviews</small>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold display-5">{{ $reports ?? 0 }}</h2>

                                        <div class="progress rounded-pill mt-3" style="height: 8px;">
                                            <div class="progress-bar bg-light" role="progressbar" style="width: 40%;"></div>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.userProdsReport') }}"
                                        class="btn btn-outline-light btn-sm mt-4 w-100 text-center d-flex justify-content-center align-items-center gap-2">
                                        View Details
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Reported Users Card -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card shadow-sm border-0 rounded-3 bg-danger text-white h-100">
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="fas fa-user-slash fa-3x me-3 opacity-85"></i>
                                            <div>
                                                <h5 class="mb-1 fw-semibold">Reported Users</h5>
                                                <small class="opacity-75">Needs moderation</small>
                                            </div>
                                        </div>
                                        <h2 class="fw-bold display-5">{{ $reportedUsers ?? 0 }}</h2>
                                        <div class="progress rounded-pill mt-3" style="height: 8px;">
                                            <div class="progress-bar bg-light" role="progressbar" style="width: 55%;"></div>
                                        </div>
                                    </div>

                                    <a href=""
                                        class="btn btn-outline-light btn-sm mt-4 w-100 text-center d-flex justify-content-center align-items-center gap-2">
                                        Review Users
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </main>
        </div>

    @endsection
@endcan