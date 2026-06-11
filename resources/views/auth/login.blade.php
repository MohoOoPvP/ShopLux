<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — ShopLux</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',sans-serif; background: linear-gradient(135deg,#1a1a2e 0%,#16213e 50%,#0f3460 100%); min-height:100vh; display:flex; align-items:center; justify-content:center; }
        .card { background:#fff; border-radius:20px; padding:2.5rem; width:100%; max-width:420px; box-shadow:0 20px 60px rgba(0,0,0,.4); }
        .brand { text-align:center; margin-bottom:2rem; }
        .brand h1 { font-size:2rem; font-weight:800; color:#1a1a2e; }
        .brand h1 span { color:#e94560; }
        .brand p { color:#777; font-size:.9rem; margin-top:.3rem; }
        .form-group { margin-bottom:1.2rem; }
        .form-group label { display:block; margin-bottom:.4rem; font-size:.85rem; font-weight:600; color:#555; }
        .input-wrap { position:relative; }
        .input-wrap i { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#aaa; }
        .form-control { width:100%; padding:.65rem .9rem .65rem 2.5rem; border:1.5px solid #ddd; border-radius:10px; font-size:.9rem; transition:border .2s; }
        .form-control:focus { outline:none; border-color:#e94560; box-shadow:0 0 0 3px rgba(233,69,96,.1); }
        .btn { width:100%; padding:.75rem; background:#e94560; color:#fff; border:none; border-radius:10px; font-size:1rem; font-weight:600; cursor:pointer; transition:background .2s; }
        .btn:hover { background:#c73652; }
        .error-msg { color:#e94560; font-size:.8rem; margin-top:.3rem; }
        .link { text-align:center; margin-top:1.2rem; font-size:.85rem; color:#777; }
        .link a { color:#e94560; font-weight:600; }
        .demo { background:#f8f9fa; border-radius:10px; padding:1rem; margin-bottom:1.5rem; font-size:.82rem; color:#666; }
        .demo strong { color:#1a1a2e; }
    </style>
</head>
<body>
<div class="card">
    <div class="brand">
        <h1>Shop<span>Lux</span></h1>
        <p>Sign in to your account</p>
    </div>

    <div class="demo">
        <strong>Demo accounts:</strong><br>
        Admin: admin@shoplux.com / password<br>
        Customer: customer@shoplux.com / password
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <label>Email Address</label>
            <div class="input-wrap">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="your@email.com" required>
            </div>
            @error('email')<div class="error-msg">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <div class="input-wrap">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
        </div>
        <button type="submit" class="btn">Sign In</button>
    </form>
    <div class="link">Don't have an account? <a href="{{ route('register') }}">Create one</a></div>
</div>
</body>
</html>
