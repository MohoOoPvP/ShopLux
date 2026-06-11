@extends('layouts.shop')
@section('title', 'ShopLux — Premium E-Commerce')
@section('content')

{{-- Hero --}}
<section style="background:linear-gradient(135deg,#1a1a2e 0%,#0f3460 100%);color:#fff;padding:5rem 0;text-align:center">
    <div class="container">
        <h1 style="font-size:3rem;font-weight:900;margin-bottom:1rem">Shop the <span style="color:#e94560">Best</span> Products</h1>
        <p style="font-size:1.2rem;color:rgba(255,255,255,.7);margin-bottom:2rem">Discover our curated collection of premium items</p>
        <a href="{{ route('shop.products') }}" class="btn btn-primary" style="padding:.85rem 2.5rem;font-size:1rem;border-radius:30px">
            <i class="fas fa-shopping-bag"></i> Shop Now
        </a>
    </div>
</section>

{{-- Categories --}}
@if($categories->count())
<section style="padding:4rem 0;background:#f8f9fa">
    <div class="container">
        <div style="text-align:center;margin-bottom:2.5rem">
            <h2 class="section-title">Shop by Category</h2>
            <p class="section-sub">Find exactly what you're looking for</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:1rem">
            @foreach($categories as $cat)
            <a href="{{ route('shop.products', ['category' => $cat->slug]) }}" style="text-decoration:none">
                <div style="background:#fff;border-radius:12px;padding:1.5rem;text-align:center;box-shadow:0 2px 12px rgba(0,0,0,.06);transition:transform .2s" onmouseover="this.style.transform='translateY(-4px)'" onmouseout="this.style.transform=''">
                    <div style="width:56px;height:56px;background:rgba(233,69,96,.1);border-radius:12px;display:flex;align-items:center;justify-content:center;margin:0 auto 1rem;font-size:1.5rem;color:#e94560">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div style="font-weight:700;color:#1a1a2e">{{ $cat->name }}</div>
                    <div style="font-size:.8rem;color:#999;margin-top:.2rem">{{ $cat->products_count }} products</div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Featured Products --}}
@if($featured->count())
<section style="padding:4rem 0">
    <div class="container">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem">
            <div>
                <h2 class="section-title">Featured Products</h2>
                <p class="section-sub" style="margin:0">Handpicked just for you</p>
            </div>
            <a href="{{ route('shop.products') }}" class="btn btn-outline">View All <i class="fas fa-arrow-right"></i></a>
        </div>
        <div class="products-grid">
            @foreach($featured as $product)
            @include('shop.partials.product-card')
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Newest --}}
@if($newest->count())
<section style="padding:4rem 0;background:#f8f9fa">
    <div class="container">
        <div style="margin-bottom:2rem">
            <h2 class="section-title">New Arrivals</h2>
            <p class="section-sub">Just landed in our store</p>
        </div>
        <div class="products-grid">
            @foreach($newest as $product)
            @include('shop.partials.product-card')
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection
