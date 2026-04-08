<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'ShopKita') }} — Belanja Seru, Harga Bersahabat</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --primary: #7c3aed;
            --primary-light: #a78bfa;
            --secondary: #ec4899;
            --accent: #f59e0b;
            --dark: #0f0a1e;
            --card-bg: rgba(255,255,255,0.07);
            --font: 'Plus Jakarta Sans', sans-serif;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font);
            background: var(--dark);
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ===== BG GRADIENT ===== */
        .bg-scene {
            position: fixed;
            inset: 0;
            z-index: 0;
            background: radial-gradient(ellipse at 20% 20%, #3b1a6e 0%, transparent 55%),
                        radial-gradient(ellipse at 80% 10%, #1e1150 0%, transparent 50%),
                        radial-gradient(ellipse at 70% 80%, #4a1080 0%, transparent 50%),
                        linear-gradient(135deg, #0f0a1e 0%, #150d30 50%, #0a0a1a 100%);
        }

        /* Floating blobs */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.25;
            animation: floatBlob 12s ease-in-out infinite;
            z-index: 0;
        }
        .blob-1 { width: 600px; height: 600px; background: #7c3aed; top: -150px; left: -100px; animation-delay: 0s; }
        .blob-2 { width: 500px; height: 500px; background: #ec4899; bottom: -100px; right: -100px; animation-delay: 4s; }
        .blob-3 { width: 400px; height: 400px; background: #f59e0b; top: 40%; left: 50%; transform: translateX(-50%); animation-delay: 8s; }

        @keyframes floatBlob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33%       { transform: translate(30px, -40px) scale(1.08); }
            66%       { transform: translate(-20px, 30px) scale(0.94); }
        }

        /* ===== LAYOUT ===== */
        .wrapper { position: relative; z-index: 1; }

        /* ===== NAVBAR ===== */
        nav.topnav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.2rem 2.5rem;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(20px);
            background: rgba(15, 10, 30, 0.55);
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .nav-logo {
            font-size: 1.4rem;
            font-weight: 800;
            background: linear-gradient(90deg, #a78bfa, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }
        .nav-actions { display: flex; gap: .75rem; align-items: center; }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: .4rem;
            padding: .5rem 1.25rem;
            border-radius: 999px;
            font-weight: 600;
            font-size: .875rem;
            text-decoration: none;
            transition: all .25s ease;
            cursor: pointer;
            border: none;
        }
        .btn-ghost {
            background: transparent;
            color: rgba(255,255,255,.75);
            border: 1px solid rgba(255,255,255,.15);
        }
        .btn-ghost:hover {
            background: rgba(255,255,255,.08);
            color: #fff;
            border-color: rgba(255,255,255,.3);
        }
        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #ec4899);
            color: #fff;
            box-shadow: 0 4px 20px rgba(124,58,237,.4);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(124,58,237,.5);
        }
        .btn-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,.25);
        }
        .btn-outline:hover {
            border-color: #a78bfa;
            background: rgba(124,58,237,.15);
            color: #a78bfa;
        }
        .btn-lg {
            padding: .9rem 2.25rem;
            font-size: 1rem;
        }

        /* ===== HERO ===== */
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 6rem 1.5rem 5rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            padding: .35rem 1rem;
            border-radius: 999px;
            font-size: .78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 2rem;
            background: rgba(124,58,237,.2);
            border: 1px solid rgba(167,139,250,.3);
            color: #a78bfa;
            animation: fadeDown .7s ease both;
        }
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: #a78bfa;
            box-shadow: 0 0 8px #a78bfa;
            animation: pulse 1.8s ease-in-out infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.3; }
        }

        .hero-title {
            font-size: clamp(2.5rem, 7vw, 4.5rem);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 1.5rem;
            animation: fadeDown .7s .1s ease both;
        }
        .hero-title .gradient-text {
            background: linear-gradient(90deg, #a78bfa 0%, #ec4899 50%, #f59e0b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-sub {
            font-size: 1.15rem;
            color: rgba(255,255,255,.6);
            max-width: 580px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            animation: fadeDown .7s .2s ease both;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 4rem;
            animation: fadeDown .7s .3s ease both;
        }

        /* ===== STATS ===== */
        .stats {
            display: flex;
            gap: 2px;
            background: rgba(255,255,255,.05);
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 16px;
            overflow: hidden;
            width: 100%;
            max-width: 680px;
            animation: fadeUp .7s .4s ease both;
        }
        .stat-item {
            flex: 1;
            padding: 1.2rem 1rem;
            text-align: center;
            background: rgba(255,255,255,.03);
            transition: background .2s;
        }
        .stat-item:hover { background: rgba(255,255,255,.07); }
        .stat-num {
            display: block;
            font-size: 1.6rem;
            font-weight: 800;
            background: linear-gradient(90deg, #a78bfa, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .stat-label {
            font-size: .75rem;
            color: rgba(255,255,255,.45);
            font-weight: 500;
            letter-spacing: .3px;
        }

        /* ===== FEATURES ===== */
        .section {
            padding: 5rem 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .section-header {
            text-align: center;
            margin-bottom: 3.5rem;
        }
        .section-tag {
            display: inline-block;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #a78bfa;
            margin-bottom: .75rem;
        }
        .section-title {
            font-size: clamp(1.7rem, 4vw, 2.5rem);
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1.2;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.25rem;
        }

        .card {
            background: var(--card-bg);
            border: 1px solid rgba(255,255,255,.09);
            border-radius: 20px;
            padding: 2rem 1.75rem;
            backdrop-filter: blur(16px);
            transition: all .3s ease;
            position: relative;
            overflow: hidden;
        }
        .card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(124,58,237,.1), transparent 60%);
            opacity: 0;
            transition: opacity .3s;
        }
        .card:hover {
            transform: translateY(-6px);
            border-color: rgba(167,139,250,.3);
            box-shadow: 0 20px 50px rgba(124,58,237,.2);
        }
        .card:hover::before { opacity: 1; }

        .card-icon {
            width: 52px; height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1.25rem;
        }
        .icon-purple { background: rgba(124,58,237,.2); }
        .icon-pink   { background: rgba(236,72,153,.2); }
        .icon-amber  { background: rgba(245,158,11,.2); }
        .icon-teal   { background: rgba(20,184,166,.2); }
        .icon-blue   { background: rgba(59,130,246,.2); }
        .icon-rose   { background: rgba(244,63,94,.2); }

        .card-title {
            font-size: 1.05rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }
        .card-desc {
            font-size: .875rem;
            color: rgba(255,255,255,.5);
            line-height: 1.6;
        }

        /* ===== CTA BANNER ===== */
        .cta-banner {
            margin: 0 1.5rem 5rem;
            padding: 3.5rem 2.5rem;
            border-radius: 28px;
            background: linear-gradient(135deg, #7c3aed 0%, #ec4899 60%, #f59e0b 100%);
            text-align: center;
            position: relative;
            overflow: hidden;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }
        .cta-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 400px; height: 400px;
            background: rgba(255,255,255,.1);
            border-radius: 50%;
            filter: blur(60px);
        }
        .cta-banner::after {
            content: '';
            position: absolute;
            bottom: -60%;
            right: -10%;
            width: 500px; height: 500px;
            background: rgba(255,255,255,.08);
            border-radius: 50%;
            filter: blur(80px);
        }
        .cta-title {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            letter-spacing: -1px;
            margin-bottom: 1rem;
            position: relative;
            z-index: 1;
        }
        .cta-sub {
            font-size: 1rem;
            opacity: .85;
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
        }
        .cta-actions {
            display: flex;
            gap: .75rem;
            justify-content: center;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }
        .btn-white {
            background: #fff;
            color: #7c3aed;
            font-weight: 700;
        }
        .btn-white:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,.2);
        }
        .btn-white-outline {
            background: transparent;
            color: #fff;
            border: 2px solid rgba(255,255,255,.5);
        }
        .btn-white-outline:hover {
            background: rgba(255,255,255,.15);
            border-color: #fff;
        }

        /* ===== FOOTER ===== */
        footer {
            border-top: 1px solid rgba(255,255,255,.07);
            padding: 2rem 2.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .footer-brand {
            font-size: 1.1rem;
            font-weight: 700;
            background: linear-gradient(90deg, #a78bfa, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .footer-copy {
            font-size: .8rem;
            color: rgba(255,255,255,.3);
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 640px) {
            nav.topnav { padding: 1rem 1.25rem; }
            .hero { padding: 4rem 1.25rem 3.5rem; }
            .stats { flex-direction: column; }
            .cta-banner { padding: 2.5rem 1.5rem; margin: 0 1rem 3rem; }
            footer { justify-content: center; text-align: center; }
        }
    </style>
</head>

<body>
    <div class="bg-scene"></div>
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>

    <div class="wrapper">
        <!-- NAVBAR -->
        <nav class="topnav">
            <span class="nav-logo">🛍 {{ config('app.name', 'ShopKita') }}</span>
            <div class="nav-actions">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-primary">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-ghost">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Daftar Gratis</a>
                        @endif
                    @endauth
                @endif
            </div>
        </nav>

        <!-- HERO -->
        <section class="hero">
            <div class="badge">
                <span class="badge-dot"></span>
                Platform Belanja Modern & Terpercaya
            </div>
            <h1 class="hero-title">
                Belanja <span class="gradient-text">Lebih Seru</span>,<br>
                Harga Lebih <span class="gradient-text">Hemat</span>
            </h1>
            <p class="hero-sub">
                Temukan ribuan produk pilihan dari berbagai kategori.
                Belanja mudah, aman, dan super cepat — langsung dari genggamanmu.
            </p>
            <div class="hero-actions">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-primary btn-lg">Mulai Belanja →</a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Mulai Belanja →</a>
                    <a href="{{ route('login') }}" class="btn btn-outline btn-lg">Masuk Sekarang</a>
                @endauth
            </div>
            <div class="stats">
                <div class="stat-item">
                    <span class="stat-num">10K+</span>
                    <span class="stat-label">Produk</span>
                </div>
                <div class="stat-item">
                    <span class="stat-num">50K+</span>
                    <span class="stat-label">Pelanggan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-num">99%</span>
                    <span class="stat-label">Puas</span>
                </div>
                <div class="stat-item">
                    <span class="stat-num">24/7</span>
                    <span class="stat-label">Support</span>
                </div>
            </div>
        </section>

        <!-- FEATURES -->
        <section class="section">
            <div class="section-header">
                <span class="section-tag">✦ Kenapa Pilih Kami?</span>
                <h2 class="section-title">Pengalaman Belanja<br>yang Tak Terlupakan</h2>
            </div>
            <div class="cards-grid">
                <div class="card">
                    <div class="card-icon icon-purple">🚀</div>
                    <div class="card-title">Checkout Super Cepat</div>
                    <div class="card-desc">Proses pembayaran hanya beberapa klik. Keranjang belanja yang intuitif membuat belanja jadi mudah.</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-pink">🔒</div>
                    <div class="card-title">Transaksi 100% Aman</div>
                    <div class="card-desc">Sistem keamanan berlapis melindungi setiap transaksimu. Belanja tenang tanpa khawatir.</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-amber">💸</div>
                    <div class="card-title">Harga Terbaik</div>
                    <div class="card-desc">Dapatkan produk berkualitas dengan harga yang bersahabat di kantong. Flash sale setiap hari!</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-teal">📦</div>
                    <div class="card-title">Pengiriman Kilat</div>
                    <div class="card-desc">Pesanan diproses langsung dan dikirim dalam hitungan jam. Lacak paketmu secara realtime.</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-blue">❤️</div>
                    <div class="card-title">Wishlist Favorit</div>
                    <div class="card-desc">Simpan produk impianmu ke wishlist dan dapatkan notifikasi saat harga turun.</div>
                </div>
                <div class="card">
                    <div class="card-icon icon-rose">🎧</div>
                    <div class="card-title">Support 24 Jam</div>
                    <div class="card-desc">Tim support kami siap membantu kamu kapanpun dan dimanapun. Chat langsung, respon cepat!</div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <div style="padding: 0 1.5rem; max-width: 1200px; margin: 0 auto 5rem;">
            <div class="cta-banner">
                <h2 class="cta-title">Siap Mulai Belanja?</h2>
                <p class="cta-sub">Daftar sekarang gratis dan dapatkan voucher welcome untuk pembelian pertamamu!</p>
                <div class="cta-actions">
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-white btn-lg">Ke Beranda →</a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-white btn-lg">Daftar Sekarang</a>
                        <a href="{{ route('login') }}" class="btn btn-white-outline btn-lg">Sudah punya akun?</a>
                    @endauth
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer>
            <span class="footer-brand">🛍 {{ config('app.name', 'ShopKita') }}</span>
            <span class="footer-copy">© {{ date('Y') }} {{ config('app.name', 'ShopKita') }}. Dibuat dengan ❤️ untuk PKL XI 2025.</span>
        </footer>
    </div>
</body>
</html>
