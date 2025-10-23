@extends('layouts.Users.Homeapp')@extends('layouts.Users.Homeapp')

@section('content')@section('content')



    <style>    <style>

        html, body { overflow-x: hidden; }        html,

        body {

        /* Enhanced Hero Section */            overflow-x: hidden;

        .hero-header {            /* prevent horizontal scroll */

            height: 65vh;        }

            background: linear-gradient(135deg, #069c88 0%, #056659 100%);

            background-attachment: fixed;

            margin-top: 0;        .hero-header {

            background-size: cover;            height: 70vh;

            background-position: center;            background-color: #069c88ff;

            position: relative;            margin-top: 0;

            z-index: 10;            background-size: cover;

            display: flex;            background-position: center;

            align-items: center;            border-radius: 10px;

            justify-content: center;            clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);

            overflow: hidden;            position: relative;

        }            z-index: 10;

        }

        .dark-overlay {

            position: absolute;        .dark-overlay {

            top: 0;            position: absolute;

            left: 0;            top: 0;

            width: 100%;            left: 0;

            height: 100%;            width: 100%;

            background-color: rgba(0, 0, 0, 0.35);            height: 100%;

            z-index: 1;            background-color: rgba(54, 54, 54, 0.5);

        }            z-index: 1;

        }

        .hero-center {

            position: relative;        .hero-center {

            z-index: 2;            position: relative;

            text-align: center;            z-index: 2;

            color: white;        }

        }

        .bg-alert {

        .hero-center h1 {            background-color: #0d6efd;

            font-size: 3.5rem;            height: 60px;

            font-weight: 800;            width: auto;

            margin-bottom: 1rem;        }

            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);

            line-height: 1.2;        @keyframes fadeInHero {

        }            from {

                opacity: 0;

        .hero-center .lead {                transform: translate(-50%, -60%);

            font-size: 1.5rem;                /* Slight up for nicer effect */

            font-weight: 500;            }

            margin-bottom: 1.5rem;

            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);            to {

        }                opacity: 1;

                transform: translate(-50%, -50%);

        .hero-center p {            }

            font-size: 1.1rem;        }

            line-height: 1.6;

            margin-bottom: 2rem;        /* Responsive adjustments for portrait mobile */

            max-width: 600px;        @media (max-width: 768px) and (orientation: portrait) {

            margin-left: auto;            .hero-header {

            margin-right: auto;                height: auto;

            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);                /* let content determine height */

        }                padding: 50px 15px;

                clip-path: none;

        .hero-cta {                /* optional: remove trapezoid on small screens */

            display: inline-block;            }

            padding: 14px 36px;

            background-color: #0d6efd;            .hero-center h1 {

            color: white;                font-size: 1.8rem;

            border-radius: 8px;            }

            text-decoration: none;

            font-weight: 600;            .hero-center p {

            transition: all 0.3s ease;                font-size: 0.95rem;

            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);            }

        }        }



        .hero-cta:hover {        .feature-icon {

            background-color: #0a58ca;            font-size: 2rem;

            transform: translateY(-2px);            margin-bottom: 10px;

            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.6);        }

            color: white;

        }        .square-img {

            height: 180px;

        /* Feature Cards Enhanced */            width: 100%;

        .feature-card {            object-fit: cover;

            padding: 30px 20px;            border-radius: 10px;

            border-radius: 12px;        }

            background: white;

            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);        .bg-arlert {

            transition: all 0.3s ease;            background-color: #069c88ff;

            height: 100%;

        }        }



        .feature-card:hover {        .bg-darkNi {

            transform: translateY(-8px);            background-color: #056659ff;

            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);        }

        }

        .bg-lighter {

        .feature-card h5 {            background-color: #e4e4e4ff;

            font-weight: 700;

            color: #056659;        }

            margin-bottom: 1rem;

            font-size: 1.25rem;        .bg-wow {

        }            background-color: #e4e4e4ff;



        .feature-card p {        }

            color: #666;

            font-size: 0.95rem;        .btn-prima {

            line-height: 1.6;            background-color: #00584dff;

        }        }

    </style>

        .feature-icon img {

            width: 80px;

            height: 80px;

            object-fit: cover;

            border-radius: 10px;    <!-- Hero Header -->

            margin-bottom: 15px;    <header class="hero-header position-relative text-white d-flex align-items-center">

        }        <div class="dark-overlay"></div>



        .feature-section {        <div class="container hero-center py-4">

            background: linear-gradient(to right, #f8f9fa, #ffffff);            <h1 class="display-4 fw-bold mb-3">

            padding: 60px 0;             

        }            </h1>



        /* Full-Screen Carousel */            <p class="lead mb-3">

        .carousel-section {                @auth

            background: #f8f9fa;                        {{ auth()->user()->is_seller

            padding: 60px 0;                    ? 'Manage your sales, track reviews, and connect with your buyers today.'

        }                    : 'Discover today’s freshest seafood deals directly from Aparri’s fishermen.' }}

                @else

        .carousel-container {                    Join Aparri Fish Market and experience fresh, sustainable seafood trading online.

            max-width: 100%;                @endauth

            margin: 0 auto;            </p>

            position: relative;

        }            <p class="text-white-50 mb-4">

                Aparri Fish Market is a community-driven platform designed to connect local fishermen

        .carousel-item img {                and seafood sellers<br>with buyers across the region.<br>Our goal is to bring

            height: 450px;                <strong>fresh, traceable, and affordable seafood</strong> directly to your table while

            object-fit: cover;                supporting the livelihood of our fisherfolk through digital trade.

            width: 100%;            </p>

            border-radius: 12px;        </div>

        }    </header>



        .carousel-inner {

            border-radius: 12px;    <!-- Feature Highlights -->

            overflow: hidden;    <section class="py-5 bg-lighter text-center">

            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);        <div class="container">

        }            <div class="row" data-aos="fade-up">



        .carousel-control-prev, .carousel-control-next {                <div class="col-md-4">

            width: 50px;                    <div class="icon-badge mx-auto mb-2">

            height: 50px;                        <!-- Example: replace src with asset('images/fresh-catch.png') when local -->

            background-color: rgba(6, 156, 136, 0.7);                        <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=120&q=80&auto=format&fit=crop"

            border-radius: 50%;                            alt="Fresh Catch" loading="lazy">

            top: 50%;                    </div>

            transform: translateY(-50%);                    <h5>Fresh Catch Daily</h5>

        }                    <p class="mb-0">Get live updates on market listings straight from verified sellers.</p>

                </div>

        .carousel-control-prev:hover, .carousel-control-next:hover {

            background-color: rgba(6, 156, 136, 0.9);                <div class="col-md-4">

        }                    <div class="icon-badge mx-auto mb-2">

                        <img src="https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=120&q=80&auto=format&fit=crop"

        .carousel-indicators [data-bs-target] {                            alt="Payments" loading="lazy">

            width: 12px;                    </div>

            height: 12px;                    <h5>Compact Payments</h5>

            border-radius: 50%;                    <p class="mb-0">Pay securely with various methods from e-wallets to cash-on-pickup.</p>

            background-color: rgba(6, 156, 136, 0.5);                </div>

        }

                <div class="col-md-4">

        .carousel-indicators .active {                    <div class="icon-badge mx-auto mb-2">

            background-color: #069c88;                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=120&q=80&auto=format&fit=crop"

        }                            alt="Delivery" loading="lazy">

                    </div>

        /* Promo Section */                    <h5>Reliable Delivery</h5>

        .promo-section {                    <p class="mb-0">We ensure timely and safe delivery of your seafood orders.</p>

            background: linear-gradient(135deg, #069c88 0%, #056659 100%);                </div>

            color: white;

            padding: 40px 0;            </div>

            text-align: center;        </div>

            font-weight: 500;    </section>

        }



        .promo-section a {    <!-- Promo Alert -->

            color: white;    <section class="text-white text-center py-3 bg-arlert" data-aos="flip-up">

            font-weight: 700;        First-time user? Get ₱50 off your first order! <a href="{{ route('register') }}"

            text-decoration: underline;            class="text-white fw-bold text-decoration-underline">Sign up now</a>

            transition: opacity 0.3s ease;    </section>

        }

    <!-- Gallery or Info Section -->

        .promo-section a:hover {    <section class="py-5 bg-wow">

            opacity: 0.8;        <div class="container">

        }            <div class="row align-items-center">

                <!-- Text -->

        /* Why Choose Us Section */                <div class="col-md-6 mb-4" data-aos="fade-right">

        .why-choose-section {                    <h3 class="fw-bold">Why Choose Us?</h3>

            background: white;                    <p>Our platform connects local fishermen with digital buyers to ensure traceable, sustainable

            padding: 80px 0;                        seafood trading.</p>

        }                    <a href="{{ route('register') }}" class="btn btn-outline-primary mt-2">Explore More</a>

                </div>

        .why-choose-section h3 {

            font-size: 2.5rem;                <!-- Images -->

            color: #056659;                <div class="col-md-6" data-aos="fade-left">

            font-weight: 800;                    <div class="row g-3">

            margin-bottom: 1.5rem;                        <div class="col-6">

        }                            <img src="{{ asset('images/pexels-mali-229789.jpg') }}" class="square-img" alt="">

                        </div>

        .why-choose-section p {                        <div class="col-6">

            font-size: 1.1rem;                            <img src="{{ asset('images/pexels-kindelmedia-8351639.jpg') }}" class="square-img" alt="">

            color: #555;                        </div>

            line-height: 1.8;                        <div class="col-12">

            margin-bottom: 2rem;                            <img src="{{ asset('images/pexels-pixabay-61153.jpg') }}" class="square-img" alt="">

        }                        </div>

                    </div>

        .explore-btn {                </div>

            display: inline-block;            </div>

            padding: 12px 32px;        </div>

            background-color: #069c88;    </section>

            color: white;

            border-radius: 8px;    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

            text-decoration: none;    <script>

            font-weight: 600;        AOS.init();

            transition: all 0.3s ease;    </script>

            border: 2px solid #069c88;

        }  



        .explore-btn:hover {

            background-color: #056659;

            border-color: #056659;

            color: white;@endsection
        }

        .gallery-img {
            height: 220px;
            width: 100%;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .gallery-img:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-header { height: 50vh; }
            .hero-center h1 { font-size: 2rem; }
            .hero-center .lead { font-size: 1.1rem; }
            .carousel-item img { height: 300px; }
            .why-choose-section h3 { font-size: 1.8rem; }
        }
    </style>

    <!-- Enhanced Hero Header -->
    <header class="hero-header position-relative">
        <div class="dark-overlay"></div>
        <div class="hero-center container py-5">
            <h1 class="display-3 fw-bold mb-3">Fresh Seafood, Direct Trade</h1>
            <p class="lead mb-4">
                @auth
                    {{ auth()->user()->is_seller
                        ? 'Manage your sales, track reviews, and connect with your buyers today.'
                        : 'Discover today\'s freshest seafood deals directly from Aparri\'s fishermen.' }}
                @else
                    Join Aparri Fish Market and experience fresh, sustainable seafood trading online.
                @endauth
            </p>
            <p class="mb-4">
                Aparri Fish Market is a community-driven platform designed to connect local fishermen
                and seafood sellers with buyers across the region. Our goal is to bring
                <strong>fresh, traceable, and affordable seafood</strong> directly to your table while
                supporting the livelihood of our fisherfolk through digital trade.
            </p>
            @guest
                <a href="{{ route('register') }}" class="hero-cta">Get Started Today</a>
            @endguest
        </div>
    </header>

    <!-- Feature Highlights -->
    <section class="feature-section">
        <div class="container">
            <div class="row g-4" data-aos="fade-up">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon text-center">
                            <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=150&q=80&auto=format&fit=crop"
                                alt="Fresh Catch" loading="lazy">
                        </div>
                        <h5 class="text-center">Fresh Catch Daily</h5>
                        <p class="text-center">Get live updates on market listings straight from verified sellers.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon text-center">
                            <img src="https://images.unsplash.com/photo-1545239351-1141bd82e8a6?w=150&q=80&auto=format&fit=crop"
                                alt="Secure Payments" loading="lazy">
                        </div>
                        <h5 class="text-center">Secure Payments</h5>
                        <p class="text-center">Pay securely with various methods from e-wallets to cash-on-pickup.</p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon text-center">
                            <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&q=80&auto=format&fit=crop"
                                alt="Reliable Delivery" loading="lazy">
                        </div>
                        <h5 class="text-center">Reliable Delivery</h5>
                        <p class="text-center">We ensure timely and safe delivery of your seafood orders.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Promo Alert -->
    <section class="promo-section" data-aos="flip-up">
        <div class="container">
            <h4 class="mb-0">
                🎉 First-time user? Get ₱50 off your first order! 
                <a href="{{ route('register') }}">Sign up now →</a>
            </h4>
        </div>
    </section>

    <!-- Full-Screen Image Carousel -->
    <section class="carousel-section">
        <div class="container">
            <h3 class="text-center mb-5 fw-bold" style="color: #056659; font-size: 2rem;">Featured Seafood Collections</h3>
            <div class="carousel-container">
                <div id="imageCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="0" class="active"></button>
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="2"></button>
                        <button type="button" data-bs-target="#imageCarousel" data-bs-slide-to="3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('images/pexels-mali-229789.jpg') }}" class="d-block w-100" alt="Fresh Seafood">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/pexels-kindelmedia-8351639.jpg') }}" class="d-block w-100" alt="Fish Market">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('images/pexels-pixabay-61153.jpg') }}" class="d-block w-100" alt="Seafood">
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1599599810694-cd308a4f2d4b?w=1200&q=80&auto=format&fit=crop" class="d-block w-100" alt="Catch of the Day">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#imageCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#imageCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose-section">
        <div class="container">
            <div class="row align-items-center g-5">
                <!-- Text -->
                <div class="col-md-6" data-aos="fade-right">
                    <h3>Why Choose Aparri Fish Market?</h3>
                    <p>Our platform connects local fishermen with digital buyers to ensure traceable, sustainable seafood trading. We prioritize quality, transparency, and fair pricing for both sellers and buyers.</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 8px 0;"><strong style="color: #069c88;">✓</strong> Direct from fishermen to your table</li>
                        <li style="padding: 8px 0;"><strong style="color: #069c88;">✓</strong> Guaranteed freshness with fast delivery</li>
                        <li style="padding: 8px 0;"><strong style="color: #069c88;">✓</strong> Secure and transparent transactions</li>
                        <li style="padding: 8px 0;"><strong style="color: #069c88;">✓</strong> Support local fishermen and communities</li>
                    </ul>
                    <a href="{{ route('register') }}" class="explore-btn mt-4">Explore More</a>
                </div>

                <!-- Images -->
                <div class="col-md-6" data-aos="fade-left">
                    <div class="row g-3">
                        <div class="col-6">
                            <img src="{{ asset('images/pexels-mali-229789.jpg') }}" class="gallery-img" alt="Seafood 1">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/pexels-kindelmedia-8351639.jpg') }}" class="gallery-img" alt="Seafood 2">
                        </div>
                        <div class="col-12">
                            <img src="{{ asset('images/pexels-pixabay-61153.jpg') }}" class="gallery-img" alt="Seafood 3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100
        });
    </script>

@endsection
