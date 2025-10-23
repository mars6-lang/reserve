@can('user-access')
    @extends('layouts.Users.Homeapp')

    @section('content')

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style>
            html,
            body {
                overflow-x: hidden;
                /* prevent horizontal scroll */
            }

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .bg-bj {
                background-color: #b5ccc9ff;
            }

            .tool-icon {
                font-size: 2rem;
            }

            @media (max-width: 576px) {
                .container.py-4:last-of-type {
                    margin-bottom: 40px;
                    /* enough space above nav */
                }


                .card-body {
                    padding: 0.75rem;
                    /* less padding */
                }
            }






            .text-messages {
                color: #08695cff;
            }
        </style>

        <div class="container py-4">

            <!-- ✅ Welcome Section -->
            <div class="bg-bj p-4 rounded shadow-sm mb-6 text-center">
                <h2 class="fw-bold text-dark mb-2">Welcome, {{ auth()->user()->name }}!</h2>
                <p class="text-muted fs-6 mb-0">
                    Manage your profile, track your activities, and explore opportunities in the marketplace.
                    Use the tools below to get started — whether buying, selling, or connecting with others.
                </p>
            </div>

            <!-- ✅ Toolkits Section -->
            <h4 class="fw-bold text-dark mb-2">Your Toolkits</h4>
            <div class="bg-white p-4 rounded shadow-sm">
                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3">

                    <!-- Reserved Products -->
                    <div class="col">
                        <a href="{{ route('users.reservations.track') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Box Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9mb-2 text-gray-400 mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 7l9-4 9 4-9 4-9-4zm0 6l9 4 9-4" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Track Reservations</h6>
                                    
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- My Reviews -->
                    <div class="col">
                        <a href="{{ route('users.userReviews') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Star Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-gray-400 mx-auto"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.06 3.263a1 1 0 00.95.69h3.46c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.06 3.263c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.06-3.263a1 1 0 00-.364-1.118L2.45 8.69c-.783-.57-.38-1.81.588-1.81h3.46a1 1 0 00.95-.69l1.06-3.263z" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">My Reviews</h6>
                                   
                                </div>
                            </div>
                        </a>
                    </div>


                    <!-- Messages -->
                    <div class="col">
                        <a href="{{ route('chatroom.index') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Chat Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-messages mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Messages</h6>
                                    
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>


        </div>

    @endsection
@endcan