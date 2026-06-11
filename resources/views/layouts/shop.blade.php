<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopLux') — Premium E-Commerce</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1a1a2e;
            --accent: #e94560;
            --accent2: #f5a623;
            --light: #f8f9fa;
            --text: #333;
            --muted: #777;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; color: var(--text); background: #fff; }
        a { text-decoration: none; color: inherit; }

        /* Navbar */
        .navbar {
            background: var(--primary); color: #fff; padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between;
            height: 64px; position: sticky; top: 0; z-index: 100;
            box-shadow: 0 2px 20px rgba(0,0,0,.3);
        }
        .navbar-brand { font-size: 1.5rem; font-weight: 800; letter-spacing: 1px; }
        .navbar-brand span { color: var(--accent); }
        .navbar-nav { display: flex; align-items: center; gap: 1.5rem; list-style: none; }
        .navbar-nav a { color: rgba(255,255,255,.8); font-size: .9rem; transition: color .2s; }
        .navbar-nav a:hover { color: #fff; }
        .navbar-actions { display: flex; align-items: center; gap: 1rem; }
        .cart-btn {
            background: var(--accent); color: #fff; padding: .5rem 1.2rem;
            border-radius: 25px; font-size: .85rem; display: flex; align-items: center; gap: 8px;
            transition: transform .2s;
        }
        .cart-btn:hover { transform: scale(1.05); }
        .cart-count {
            background: var(--accent2); color: #fff; border-radius: 50%;
            width: 20px; height: 20px; display: flex; align-items: center; justify-content: center;
            font-size: .75rem; font-weight: 700;
        }

        /* Main */
        main { min-height: calc(100vh - 64px - 80px); }

        /* Footer */
        footer {
            background: var(--primary); color: rgba(255,255,255,.6);
            text-align: center; padding: 1.5rem; font-size: .85rem;
        }
        footer span { color: var(--accent); }

        /* Alert */
        .alert { padding: .9rem 1.5rem; font-size: .9rem; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger  { background: #f8d7da; color: #721c24; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: .55rem 1.2rem; border-radius: 8px; border: none; cursor: pointer; font-size: .9rem; font-weight: 500; transition: all .2s; text-decoration: none; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #c73652; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-outline { background: transparent; border: 2px solid var(--accent); color: var(--accent); }
        .btn-outline:hover { background: var(--accent); color: #fff; }
        .btn-dark { background: var(--primary); color: #fff; }
        .btn-sm { padding: .35rem .8rem; font-size: .82rem; }

        /* Container */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 1.5rem; }

        /* Product card */
        .product-card {
            border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,.08);
            transition: transform .2s, box-shadow .2s; background: #fff;
        }
        .product-card:hover { transform: translateY(-4px); box-shadow: 0 8px 24px rgba(0,0,0,.14); }
        .product-card img { width: 100%; height: 200px; object-fit: cover; background: #f0f0f0; }
        .product-card-body { padding: 1rem; }
        .product-card-title { font-weight: 600; margin-bottom: .3rem; font-size: .95rem; }
        .product-card-price { color: var(--accent); font-weight: 700; font-size: 1.1rem; }
        .product-card-price .original { color: #aaa; text-decoration: line-through; font-size: .85rem; font-weight: 400; margin-left: 6px; }
        .badge-featured { background: var(--accent2); color: #fff; font-size: .7rem; padding: .2rem .6rem; border-radius: 20px; font-weight: 600; }
        .badge-sale { background: var(--accent); color: #fff; font-size: .7rem; padding: .2rem .6rem; border-radius: 20px; font-weight: 600; }

        /* Grid */
        .products-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(230px, 1fr)); gap: 1.5rem; }

        /* Forms */
        .form-control { width: 100%; padding: .65rem .9rem; border: 1px solid #ddd; border-radius: 8px; font-size: .9rem; }
        .form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(233,69,96,.1); }
        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; margin-bottom: .4rem; font-size: .85rem; font-weight: 600; color: #555; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: .75rem 1rem; text-align: left; font-size: .8rem; color: #666; text-transform: uppercase; }
        td { padding: .85rem 1rem; border-bottom: 1px solid #f0f0f0; }

        /* Badge */
        .badge { padding: .25rem .6rem; border-radius: 20px; font-size: .75rem; font-weight: 600; }
        .badge-success  { background: #d4edda; color: #155724; }
        .badge-warning  { background: #fff3cd; color: #856404; }
        .badge-info     { background: #d1ecf1; color: #0c5460; }
        .badge-primary  { background: #cce5ff; color: #004085; }
        .badge-danger   { background: #f8d7da; color: #721c24; }
        .badge-secondary{ background: #e2e3e5; color: #383d41; }

        /* Section heading */
        .section-title { font-size: 1.8rem; font-weight: 800; color: var(--primary); margin-bottom: .4rem; }
        .section-sub { color: var(--muted); margin-bottom: 2rem; }
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar">
    <a class="navbar-brand" href="{{ route('shop.index') }}">Shop<span>Lux</span></a>
    <ul class="navbar-nav">
        <li><a href="{{ route('shop.index') }}">Home</a></li>
        <li><a href="{{ route('shop.products') }}">Products</a></li>
        @auth
            <li><a href="{{ route('shop.orders') }}">My Orders</a></li>
            @if(auth()->user()->isAdmin())
                <li><a href="{{ route('admin.dashboard') }}" style="color:var(--accent2);font-weight:600">Admin Panel</a></li>
            @endif
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit" style="background:none;border:none;color:rgba(255,255,255,.8);cursor:pointer;font-size:.9rem">Logout</button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}" style="color:var(--accent2)">Register</a></li>
        @endauth
    </ul>
    <a href="{{ route('shop.cart') }}" class="cart-btn">
        <i class="fas fa-shopping-cart"></i>
        Cart
        @php $cartCount = count(session()->get('cart', [])); @endphp
        @if($cartCount > 0)
            <span class="cart-count">{{ $cartCount }}</span>
        @endif
    </a>
</nav>

<main>
    @if(session('success'))
        <div class="alert alert-success" style="text-align:center"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" style="text-align:center">{{ session('error') }}</div>
    @endif
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} <span>ShopLux</span>. All rights reserved.</p>
</footer>

@stack('scripts')
</body>
</html>
