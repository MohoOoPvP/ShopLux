<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — ShopLux Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-w: 260px;
            --primary: #1a1a2e;
            --accent: #e94560;
            --accent2: #f5a623;
            --surface: #16213e;
            --text: #eee;
            --muted: #8892b0;
            --border: rgba(255,255,255,0.08);
            --card: #0f3460;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; min-height: 100vh; }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-w); background: var(--primary); color: var(--text);
            position: fixed; top: 0; left: 0; height: 100vh; overflow-y: auto;
            display: flex; flex-direction: column; z-index: 100;
        }
        .sidebar-brand {
            padding: 1.5rem; font-size: 1.4rem; font-weight: 800;
            background: var(--accent); color: #fff; letter-spacing: 1px;
        }
        .sidebar-brand span { color: var(--accent2); }
        .sidebar-menu { padding: 1rem 0; flex: 1; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 12px; padding: 12px 20px;
            color: var(--muted); text-decoration: none; font-size: 0.9rem;
            transition: all .2s; border-left: 3px solid transparent;
        }
        .sidebar-menu a:hover, .sidebar-menu a.active {
            color: #fff; background: rgba(233,69,96,.15); border-left-color: var(--accent);
        }
        .sidebar-menu a i { width: 20px; text-align: center; }
        .sidebar-section { padding: 8px 20px; font-size: .7rem; color: var(--muted); text-transform: uppercase; letter-spacing: 2px; margin-top: 10px; }
        .sidebar-footer { padding: 1rem 20px; border-top: 1px solid var(--border); }
        .sidebar-footer a { color: var(--muted); text-decoration: none; font-size: .85rem; }
        .sidebar-footer a:hover { color: var(--accent); }

        /* Main */
        .main { margin-left: var(--sidebar-w); flex: 1; display: flex; flex-direction: column; }
        .topbar {
            background: #fff; padding: 1rem 2rem; display: flex; justify-content: space-between;
            align-items: center; border-bottom: 1px solid #e0e0e0; position: sticky; top: 0; z-index: 50;
        }
        .topbar h1 { font-size: 1.2rem; color: #333; font-weight: 600; }
        .topbar-user { display: flex; align-items: center; gap: 10px; }
        .topbar-user .avatar {
            width: 36px; height: 36px; background: var(--accent); border-radius: 50%;
            display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700;
        }
        .content { padding: 2rem; flex: 1; }

        /* Cards */
        .card { background: #fff; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,.06); margin-bottom: 1.5rem; overflow: hidden; }
        .card-header { padding: 1.2rem 1.5rem; border-bottom: 1px solid #f0f0f0; display: flex; justify-content: space-between; align-items: center; }
        .card-header h2 { font-size: 1rem; font-weight: 600; color: #333; }
        .card-body { padding: 1.5rem; }

        /* Table */
        table { width: 100%; border-collapse: collapse; }
        th { background: #f8f9fa; padding: .75rem 1rem; text-align: left; font-size: .8rem; color: #666; text-transform: uppercase; letter-spacing: .5px; }
        td { padding: .85rem 1rem; border-bottom: 1px solid #f5f5f5; color: #444; font-size: .9rem; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafafa; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; gap: 6px; padding: .5rem 1rem; border-radius: 8px; border: none; cursor: pointer; font-size: .85rem; font-weight: 500; text-decoration: none; transition: all .2s; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #c73652; }
        .btn-secondary { background: #6c757d; color: #fff; }
        .btn-success { background: #28a745; color: #fff; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-warning { background: var(--accent2); color: #fff; }
        .btn-sm { padding: .3rem .7rem; font-size: .8rem; }
        .btn-outline { background: transparent; border: 1px solid currentColor; }

        /* Forms */
        .form-group { margin-bottom: 1.2rem; }
        .form-group label { display: block; margin-bottom: .4rem; font-size: .85rem; font-weight: 600; color: #555; }
        .form-control { width: 100%; padding: .6rem .9rem; border: 1px solid #ddd; border-radius: 8px; font-size: .9rem; transition: border .2s; background: #fff; }
        .form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(233,69,96,.1); }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
        .form-check { display: flex; align-items: center; gap: 8px; }
        .form-check input { width: 18px; height: 18px; cursor: pointer; }

        /* Alerts */
        .alert { padding: .9rem 1.2rem; border-radius: 8px; margin-bottom: 1rem; font-size: .9rem; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger  { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .alert-warning { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }

        /* Badges */
        .badge { padding: .25rem .6rem; border-radius: 20px; font-size: .75rem; font-weight: 600; }
        .badge-success { background: #d4edda; color: #155724; }
        .badge-danger  { background: #f8d7da; color: #721c24; }
        .badge-warning { background: #fff3cd; color: #856404; }
        .badge-info    { background: #d1ecf1; color: #0c5460; }
        .badge-primary { background: #cce5ff; color: #004085; }
        .badge-secondary { background: #e2e3e5; color: #383d41; }

        /* Stat cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.2rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; border-radius: 12px; padding: 1.5rem; box-shadow: 0 2px 10px rgba(0,0,0,.06); display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
        .stat-icon.red { background: rgba(233,69,96,.15); color: var(--accent); }
        .stat-icon.blue { background: rgba(0,123,255,.15); color: #007bff; }
        .stat-icon.green { background: rgba(40,167,69,.15); color: #28a745; }
        .stat-icon.orange { background: rgba(245,166,35,.15); color: var(--accent2); }
        .stat-value { font-size: 1.8rem; font-weight: 800; color: #333; line-height: 1; }
        .stat-label { font-size: .8rem; color: #999; margin-top: 2px; }

        /* Pagination */
        .pagination { display: flex; gap: 4px; justify-content: center; margin-top: 1rem; }
        .pagination a, .pagination span { padding: .4rem .75rem; border-radius: 6px; font-size: .85rem; text-decoration: none; border: 1px solid #ddd; color: #555; }
        .pagination .active span { background: var(--accent); color: #fff; border-color: var(--accent); }

        /* Image preview */
        .img-preview { width: 48px; height: 48px; object-fit: cover; border-radius: 8px; }
    </style>
    @stack('styles')
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-brand">Shop<span>Lux</span> <small style="font-size:.65rem;opacity:.7">Admin</small></div>
    <nav class="sidebar-menu">
        <div class="sidebar-section">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <div class="sidebar-section">Catalog</div>
        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Categories
        </a>
        <a href="{{ route('admin.subcategories.index') }}" class="{{ request()->routeIs('admin.subcategories*') ? 'active' : '' }}">
            <i class="fas fa-layer-group"></i> Subcategories
        </a>
        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="fas fa-box"></i> Products
        </a>

        <div class="sidebar-section">Commerce</div>
        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="fas fa-shopping-bag"></i> Orders
        </a>

        <div class="sidebar-section">Access</div>
        <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Users & Roles
        </a>

        <div class="sidebar-section">Site</div>
        <a href="{{ route('shop.index') }}" target="_blank">
            <i class="fas fa-store"></i> View Shop
        </a>
    </nav>
    <div class="sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:none;border:none;cursor:pointer;color:#8892b0;font-size:.85rem;">
                <i class="fas fa-sign-out-alt"></i> Logout ({{ auth()->user()->name }})
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <div class="topbar">
        <h1>@yield('title', 'Dashboard')</h1>
        <div class="topbar-user">
            <div class="avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div style="font-weight:600;font-size:.9rem">{{ auth()->user()->name }}</div>
                <div style="font-size:.75rem;color:#999">Administrator</div>
            </div>
        </div>
    </div>
    <div class="content">
        @if(session('success'))
            <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif
        @yield('content')
    </div>
</div>

@stack('scripts')
</body>
</html>
