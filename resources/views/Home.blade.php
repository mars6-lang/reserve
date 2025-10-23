@extends('layouts.Users.Homeapp')

@section('content')

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body, html { overflow-x: hidden; }

    /* ===== HERO SECTION ===== */
    .hero {
        min-height: 70vh;
        background: linear-gradient(135deg, #069c88 0%, #056659 100%);
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.3);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        text-align: center;
        color: white;
        max-width: 800px;
        padding: 40px 20px;
    }

    .hero h1 {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 20px;
        text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.4);
        line-height: 1.2;
    }

    .hero p {
        font-size: 1.3rem;
        margin-bottom: 15px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        font-weight: 500;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        margin-bottom: 30px;
        line-height: 1.8;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
    }

    .hero-buttons {
        display: flex;
        gap: 15px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-hero {
        padding: 14px 32px;
        font-size: 1rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary-hero {
        background: #0d6efd;
        color: white;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.4);
    }

    .btn-primary-hero:hover {
        background: #0a58ca;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.6);
    }

    /* ===== FEATURES SECTION ===== */
    .features {
        padding: 80px 0;
        background: #f8f9fa;
    }

    .features-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
        margin-top: 50px;
    }

    .feature-card {
        background: white;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: all 0.3s ease;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .feature-icon {
        width: 90px;
        height: 90px;
        margin: 0 auto 20px;
        border-radius: 12px;
        overflow: hidden;
    }

    .feature-icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .feature-card h3 {
        font-size: 1.5rem;
        color: #056659;
        margin-bottom: 12px;
        font-weight: 700;
    }

    .feature-card p {
        color: #666;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* ===== PROMO SECTION ===== */
    .promo {
        background: linear-gradient(135deg, #069c88 0%, #056659 100%);
        color: white;
        padding: 40px 20px;
        text-align: center;
        margin: 40px 0;
    }

    .promo h4 {
        font-size: 1.3rem;
        margin: 0;
    }

    .promo a {
        color: white;
        font-weight: 700;
        text-decoration: underline;
        margin-left: 10px;
    }

    .promo a:hover {
        opacity: 0.8;
    }

    /* ===== CAROUSEL SECTION ===== */
    .carousel-wrapper {
        padding: 80px 0;
    }

    .carousel-title {
        text-align: center;
        font-size: 2rem;
        color: #056659;
        font-weight: 800;
        margin-bottom: 40px;
    }

    .carousel-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .carousel {
        position: relative;
    }

    .carousel-slide {
        display: none;
        width: 100%;
    }

    .carousel-slide.active {
        display: block;
    }

    .carousel-slide img {
        width: 100%;
        height: 450px;
        object-fit: cover;
        border-radius: 12px;
    }

    .carousel-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        gap: 15px;
    }

    .carousel-btn {
        width: 50px;
        height: 50px;
        border: none;
        background: rgba(6, 156, 136, 0.7);
        color: white;
        border-radius: 50%;
        cursor: pointer;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .carousel-btn:hover {
        background: rgba(6, 156, 136, 0.9);
        transform: scale(1.1);
    }

    .carousel-indicators {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex: 1;
    }

    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(6, 156, 136, 0.5);
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .indicator.active {
        background: #069c88;
        width: 30px;
        border-radius: 5px;
    }

    /* ===== WHY CHOOSE SECTION ===== */
    .why-choose {
        padding: 80px 0;
        background: white;
    }

    .why-choose-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .why-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    .why-content h2 {
        font-size: 2.5rem;
        color: #056659;
        font-weight: 900;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .why-content p {
        color: #555;
        font-size: 1.05rem;
        line-height: 1.8;
        margin-bottom: 20px;
    }

    .why-list {
        list-style: none;
        margin-bottom: 30px;
    }

    .why-list li {
        padding: 12px 0;
        color: #333;
        font-size: 1rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .why-list li:last-child {
        border-bottom: none;
    }

    .why-list strong {
        color: #069c88;
        margin-right: 10px;
        font-size: 1.2rem;
    }

    .btn-explore {
        display: inline-block;
        padding: 12px 30px;
        background: #069c88;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 2px solid #069c88;
    }

    .btn-explore:hover {
        background: #056659;
        border-color: #056659;
    }

    .why-gallery {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .gallery-item {
        border-radius: 12px;
        overflow: hidden;
        height: 220px;
    }

    .gallery-item:nth-child(3) {
        grid-column: 1 / -1;
        height: 250px;
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.05);
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
        .hero h1 {
            font-size: 2rem;
        }

        .hero p {
            font-size: 1rem;
        }

        .hero-subtitle {
            font-size: 0.9rem;
        }

        .carousel-slide img {
            height: 300px;
        }

        .why-grid {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .why-content h2 {
            font-size: 1.8rem;
        }

        .features-grid {
            grid-template-columns: 1fr;
        }

        .carousel-controls {
            justify-content: center;
        }

        .carousel-btn {
            width: 40px;
            height: 40px;
        }
    }
</style>

<!-- HERO SECTION -->
<div class="hero">
    <div class="hero-content">
        <h1>Fresh Seafood, Direct Trade</h1>
        <p class="hero-p">
            @auth
                {{ auth()->user()->is_seller
                    ? 'Manage your sales, track reviews, and connect with your buyers today.'
                    : 'Discover today\'s freshest seafood deals directly from Aparri\'s fishermen.' }}
            @else
                Join Aparri Fish Market and experience fresh, sustainable seafood trading online.
            @endauth
        </p>
        <p class="hero-subtitle">
            Aparri Fish Market connects local fishermen and seafood sellers with buyers across the region.
            Our goal is to bring <strong>fresh, traceable, and affordable seafood</strong> directly to your
            table while supporting the livelihood of our fisherfolk through digital trade.
        </p>
        @guest
        <div class="hero-buttons">
            <a href="{{ route('register') }}" class="btn-hero btn-primary-hero">Get Started Today</a>
        </div>
        @endguest
    </div>
</div>

<!-- CAROUSEL SECTION -->
<section class="carousel-wrapper">
    <div class="carousel-container">
        <h2 class="carousel-title">Featured Seafood Collections</h2>
        
        <div class="carousel">
            <div class="carousel-slide active">
                <img src="{{ asset('images/pexels-mali-229789.jpg') }}" alt="Fresh Seafood">
            </div>
            <div class="carousel-slide">
                <img src="{{ asset('images/pexels-kindelmedia-8351639.jpg') }}" alt="Fish Market">
            </div>
            <div class="carousel-slide">
                <img src="{{ asset('images/pexels-pixabay-61153.jpg') }}" alt="Seafood">
            </div>
            <div class="carousel-slide">
                <img src="https://images.unsplash.com/photo-1599599810694-cd308a4f2d4b?w=1200&q=80&auto=format&fit=crop"
                    alt="Catch of the Day">
            </div>
        </div>

        <div class="carousel-controls">
            <button class="carousel-btn" onclick="prevSlide()">❮</button>
            <div class="carousel-indicators">
                <button class="indicator active" onclick="currentSlide(0)"></button>
                <button class="indicator" onclick="currentSlide(1)"></button>
                <button class="indicator" onclick="currentSlide(2)"></button>
                <button class="indicator" onclick="currentSlide(3)"></button>
            </div>
            <button class="carousel-btn" onclick="nextSlide()">❯</button>
        </div>
    </div>
</section>

<!-- WHY CHOOSE SECTION -->
<section class="why-choose">
    <div class="why-choose-container">
        <div class="why-grid">
            <div class="why-content">
                <h2>Why Choose Aparri Fish Market?</h2>
                <p>Our platform connects local fishermen with digital buyers to ensure traceable, sustainable
                    seafood trading. We prioritize quality, transparency, and fair pricing.</p>

                <ul class="why-list">
                    <li><strong>✓</strong> Direct from fishermen to your table</li>
                    <li><strong>✓</strong> Guaranteed freshness with fast delivery</li>
                    <li><strong>✓</strong> Secure and transparent transactions</li>
                    <li><strong>✓</strong> Support local fishermen and communities</li>
                </ul>

                <a href="{{ route('register') }}" class="btn-explore">Explore More</a>
            </div>

            <div class="why-gallery">
                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-mali-229789.jpg') }}" alt="Seafood 1">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-kindelmedia-8351639.jpg') }}" alt="Seafood 2">
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('images/pexels-pixabay-61153.jpg') }}" alt="Seafood 3">
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let currentIndex = 0;

    function showSlide(index) {
        const slides = document.querySelectorAll('.carousel-slide');
        const indicators = document.querySelectorAll('.indicator');

        if (index >= slides.length) {
            currentIndex = 0;
        } else if (index < 0) {
            currentIndex = slides.length - 1;
        } else {
            currentIndex = index;
        }

        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));

        slides[currentIndex].classList.add('active');
        indicators[currentIndex].classList.add('active');
    }

    function nextSlide() {
        showSlide(currentIndex + 1);
    }

    function prevSlide() {
        showSlide(currentIndex - 1);
    }

    function currentSlide(index) {
        showSlide(index);
    }

    // Auto-play carousel every 5 seconds
    setInterval(nextSlide, 5000);
</script>

@endsection
