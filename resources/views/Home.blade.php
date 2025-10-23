@extends('layouts.Users.Homeapp')
@section('content')

    <style>
        html,
        body {
            overflow-x: hidden;
            /* prevent horizontal scroll */
        }


        .hero-header {
            height: 70vh;
            background-color: #069c88ff;

            background-size: cover;
            background-position: center;
            border-radius: 10px;
            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);
            position: relative;
        }

        .dark-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(54, 54, 54, 0.5);
            z-index: 1;
        }

        .hero-center {
            position: relative;
            z-index: 2;
        }

        .bg-alert {
            background-color: #0d6efd;
            height: 60px;
            width: auto;
        }

        @keyframes fadeInHero {
            from {
                opacity: 0;
                transform: translate(-50%, -60%);
                /* Slight up for nicer effect */
            }

            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Responsive adjustments for portrait mobile */
        @media (max-width: 768px) and (orientation: portrait) {
            .hero-header {
                height: auto;
                /* let content determine height */
                padding: 50px 15px;
                clip-path: none;
                /* optional: remove trapezoid on small screens */
            }

            .hero-center h1 {
                font-size: 1.8rem;
            }

            .hero-center p {
                font-size: 0.95rem;
            }
        }

        .feature-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .square-img {
            height: 180px;
            width: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .bg-arlert {
            background-color: #069c88ff;

        }

        .bg-darkNi {
            background-color: #056659ff;
        }

        .bg-lighter {
            background-color: #e4e4e4ff;

        }

        .bg-wow {
            background-color: #e4e4e4ff;

        }

        .btn-prima {
            background-color: #00584dff;
        }
    </style>




    <!-- Hero Header -->
    <header class="hero-header position-relative text-white d-flex align-items-center">
        <div class="dark-overlay"></div>

        <div class="container hero-center py-4">
            <h1 class="display-4 fw-bold mb-3">
             
            </h1>

            <p class="lead mb-3">
                @auth
                        {{ auth()->user()->is_seller
                    ? 'Manage your sales, track reviews, and connect with your buyers today.'
                    : 'Discover today’s freshest seafood deals directly from Aparri’s fishermen.' }}
                @else
                    Join Aparri Fish Market and experience fresh, sustainable seafood trading online.
                @endauth
            </p>

            <p class="text-white-50 mb-4">
                Aparri Fish Market is a community-driven platform designed to connect local fishermen
                and seafood sellers<br>with buyers across the region.<br>Our goal is to bring
                <strong>fresh, traceable, and affordable seafood</strong> directly to your table while
                supporting the livelihood of our fisherfolk through digital trade.
            </p>
        </div>
    </header>


    <!-- Feature Highlights -->
    <section class="py-5 bg-lighter text-center">
        <div class="container">
            <div class="row" data-aos="fade-up">

                <div class="col-md-4">
                    <div class="icon-badge mx-auto mb-2">
                        <!-- Example: replace src with asset('images/fresh-catch.png') when local -->
                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=120&q=80&auto=format&fit=crop"
                            alt="Fresh Catch" loading="lazy">
                    </div>
                    <h5>Fresh Catch Daily</h5>
                    <p class="mb-0">Get live updates on market listings straight from verified sellers.</p>
                </div>

                <div class="col-md-4">
                    <div class="icon-badge mx-auto mb-2">
                        <img src="https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=120&q=80&auto=format&fit=crop"
                            alt="Payments" loading="lazy">
                    </div>
                    <h5>Compact Payments</h5>
                    <p class="mb-0">Pay securely with various methods from e-wallets to cash-on-pickup.</p>
                </div>

                <div class="col-md-4">
                    <div class="icon-badge mx-auto mb-2">
                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=120&q=80&auto=format&fit=crop"
                            alt="Delivery" loading="lazy">
                    </div>
                    <h5>Reliable Delivery</h5>
                    <p class="mb-0">We ensure timely and safe delivery of your seafood orders.</p>
                </div>

            </div>
        </div>
    </section>


    <!-- Promo Alert -->
    <section class="text-white text-center py-3 bg-arlert" data-aos="flip-up">
        First-time user? Get ₱50 off your first order! <a href="{{ route('register') }}"
            class="text-white fw-bold text-decoration-underline">Sign up now</a>
    </section>

    <!-- Gallery or Info Section -->
    <section class="py-5 bg-wow">
        <div class="container">
            <div class="row align-items-center">
                <!-- Text -->
                <div class="col-md-6 mb-4" data-aos="fade-right">
                    <h3 class="fw-bold">Why Choose Us?</h3>
                    <p>Our platform connects local fishermen with digital buyers to ensure traceable, sustainable
                        seafood trading.</p>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">Explore More</a>
                </div>

                <!-- Images -->
                <div class="col-md-6" data-aos="fade-left">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="{{ asset('images/pexels-mali-229789.jpg') }}" class="square-img" alt="">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/pexels-kindelmedia-8351639.jpg') }}" class="square-img" alt="">
                        </div>
                        <div class="col-12">
                            <img src="{{ asset('images/pexels-pixabay-61153.jpg') }}" class="square-img" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

  




@endsection