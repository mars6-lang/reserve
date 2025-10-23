@can('seller-access')
    @include('seller.partials.terms-modal')
    <!-- @extends('layouts.Users.Homeapp') -->
    @section('content')


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

            .bg-toolkit {
                background-color: #ffffffff;
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


            .text-icons {
                color: #08695cff;
            }


            .text-icons {
                transition: transform 0.2s ease-in-out;
            }

            .text-icons:hover {
                transform: scale(1.05);
            }
        </style>


        <div class="container py-4">

            <!-- ✅ Welcome Section -->
            <div class="bg-bj p-4 rounded shadow-sm mb-4 text-center">
                <h2 class="fw-bold text-dark mb-2">Welcome, {{ auth()->user()->name }}!</h2>
                <p class="text-muted fs-6 mb-0">
                    We're glad to have you here. This is your personal space where you can
                    manage your orders, track reviews, update your profile, and connect with others.
                    If you’re ready, you can also start your journey as a seller and grow your business.
                </p>
            </div>



            <div class="bg-toolkit p-4 rounded shadow-sm">
                <h2 class="text-xl font-semibold mb-1">Seller toolkit</h2>

                <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-3 mt-1">

                    <!-- Add New Product -->
                    <div class="col text-icons">
                        <a href="{{ route('seller.sellerAdd') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Plus/Box Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-icons mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Add new product</h6>
                                </div>
                            </div>
                        </a>
                    </div>


                    <!-- Manage Products -->
                    <div class="col text-icons">
                        <a href="{{ route('seller.ManageProds') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Clipboard/List Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V7a2 2 0 012-2h3l1-2h2l1 2h3a2 2 0 012 2v12a2 2 0 01-2 2z" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Manage products</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Ratings -->
                    <div class="col text-icons">
                        <a href="{{ route('seller.productsRatings') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Star Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-icons mx-auto"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.06 3.263a1 1 0 00.95.69h3.46c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.06 3.263c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.176 0l-2.8 2.034c-.785.57-1.84-.197-1.54-1.118l1.06-3.263a1 1 0 00-.364-1.118L2.45 8.69c-.783-.57-.38-1.81.588-1.81h3.46a1 1 0 00.95-.69l1.06-3.263z" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Ratings</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Reserve List -->
                    <div class="col text-icons">
                        <a href="{{ route('seller.ordersList') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Clipboard Check Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-icons mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 11l3 3L22 4M4 7h16M4 11h16M4 15h16M4 19h16" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Reserve list</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Chats -->
                    <div class="col text-icons">
                        <a href="{{ route('chatroom.index') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Chat Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-icons mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 10h.01M12 10h.01M16 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Chats</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Market Analysis -->
                    <div class="col text-icons">
                        <a href="{{ route('seller.analysis.marketanalysis') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Chart Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-icons mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 17v-6m4 6V7m4 10V3" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">Market analysis</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Notifications -->
                    <div class="col text-icons">
                        <a href="{{ route('notifications.index') }}" class="text-decoration-none text-dark">
                            <div class="card h-100 text-center shadow-sm border-0 hover-shadow">
                                <div class="card-body p-3">
                                    <!-- Bell Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9 mb-2 text-icons mx-auto" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <h6 class="fw-bold mb-1">System notifications</h6>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>


        </div>






    @endsection
@endcan