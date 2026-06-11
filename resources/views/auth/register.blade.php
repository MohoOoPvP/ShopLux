<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register — ShopLux</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family:'Segoe UI',sans-serif; background:linear-gradient(135deg,#1a1a2e,#0f3460); min-height:100vh; display:flex; align-items:center; justify-content:center; }
        .card { background:#fff; border-radius:20px; padding:2.5rem; width:100%; max-width:440px; box-shadow:0 20px 60px rgba(0,0,0,.4); }
        .brand { text-align:center; margin-bottom:2rem; }
        .brand h1 { font-size:2rem; font-weight:800; color:#1a1a2e; }
        .brand h1 span { color:#e94560; }
        .brand p { color:#777; font-size:.9rem; }
        .form-group { margin-bottom:1.1rem; }
        .form-group label { display:block; margin-bottom:.35rem; font-size:.85rem; font-weight:600; color:#555; }
        .input-wrap { position:relative; }
        .input-wrap i { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:#aaa; }
        .form-control { width:100%; padding:.65rem .9rem .65rem 2.5rem; border:1.5px solid #ddd; border-radius:10px; font-size:.9rem; }
        .form-control:focus { outline:none; border-color:#e94560; }
        .btn { width:100%; padding:.75rem; background:#e94560; color:#fff; border:none; border-radius:10px; font-size:1rem; font-weight:600; cursor:pointer; }
        .btn:hover { background:#c73652; }
        .error-msg { color:#e94560; font-size:.8rem; margin-top:.3rem; }
        .link { text-align:center; margin-top:1.2rem; font-size:.85rem; color:#777; }
        .link a { color:#e94560; font-weight:600; }
    </style>
</head>
<body>
<div class="card">
    <div class="brand">
        <h1>Shop<span>Lux</span></h1>
        <p>Create your account</p>
    </div>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <label>Full Name</label>
            <div class="input-wrap">
                <i class="fas fa-user"></i>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="John Doe" required>
            </div>
            @error('name')<div class="error-msg">{{ $message }}</div>@enderror
        </div>
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
                <input type="password" name="password" class="form-control" placeholder="Min 6 characters" required>
            </div>
            @error('password')<div class="error-msg">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <div class="input-wrap">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Repeat password" required>
            </div>
        </div>
        <button type="submit" class="btn">Create Account</button>
    </form>
    <div class="link">Already have an account? <a href="{{ route('login') }}">Sign in</a></div>
</div>
</body>
</html>
