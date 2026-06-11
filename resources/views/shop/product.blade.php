@extends('layouts.shop')
@section('title', $product->name)
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    {{-- Breadcrumb --}}
    <div style="font-size:.85rem;color:#999;margin-bottom:1.5rem">
        <a href="{{ route('shop.index') }}" style="color:#e94560">Home</a> /
        <a href="{{ route('shop.products') }}" style="color:#e94560">Products</a> /
        {{ $product->name }}
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:3rem;align-items:start">
        {{-- Image --}}
        <div>
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                     style="width:100%;border-radius:16px;box-shadow:0 8px 30px rgba(0,0,0,.12)">
            @else
                <div style="width:100%;padding-top:100%;background:linear-gradient(135deg,#f0f0f0,#e0e0e0);border-radius:16px;position:relative">
                    <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;color:#bbb;font-size:4rem">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div>
            <div style="display:flex;gap:.5rem;margin-bottom:.8rem">
                @if($product->is_featured) <span class="badge" style="background:rgba(245,166,35,.15);color:#f5a623">⭐ Featured</span> @endif
                @if($product->sale_price)  <span class="badge" style="background:rgba(233,69,96,.15);color:#e94560">SALE</span>   @endif
                <span class="badge badge-{{ $product->stock > 0 ? 'success' : 'danger' }}">
                    {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ')' : 'Out of Stock' }}
                </span>
            </div>

            <h1 style="font-size:2rem;font-weight:800;color:#1a1a2e;margin-bottom:.5rem">{{ $product->name }}</h1>

            <div style="font-size:.9rem;color:#999;margin-bottom:1rem">
                <a href="{{ route('shop.products', ['category' => $product->category->slug]) }}" style="color:#e94560">{{ $product->category->name }}</a>
                @if($product->subcategory) / {{ $product->subcategory->name }} @endif
            </div>

            <div style="margin-bottom:1.5rem">
                <span style="font-size:2.5rem;font-weight:900;color:#e94560">
                    ${{ number_format($product->sale_price ?? $product->price, 2) }}
                </span>
                @if($product->sale_price)
                    <span style="font-size:1.2rem;text-decoration:line-through;color:#aaa;margin-left:.5rem">${{ number_format($product->price, 2) }}</span>
                    <span style="font-size:.9rem;color:#28a745;margin-left:.5rem">
                        Save ${{ number_format($product->price - $product->sale_price, 2) }}
                    </span>
                @endif
            </div>

            @if($product->description)
                <p style="color:#555;line-height:1.7;margin-bottom:1.5rem">{{ $product->description }}</p>
            @endif

            @if($product->stock > 0)
                <form method="POST" action="{{ route('shop.cart.add', $product) }}">
                    @csrf
                    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:1rem">
                        <label style="font-weight:600">Quantity:</label>
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               style="width:80px;padding:.5rem;border:1.5px solid #ddd;border-radius:8px;text-align:center;font-size:1rem">
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%;padding:.85rem;font-size:1rem">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary" style="width:100%;padding:.85rem" disabled>Out of Stock</button>
            @endif
        </div>
    </div>

    {{-- Related Products --}}
    @if($related->count())
    <div style="margin-top:4rem">
        <h2 style="font-size:1.5rem;font-weight:700;color:#1a1a2e;margin-bottom:1.5rem">Related Products</h2>
        <div class="products-grid">
            @foreach($related as $product)
                @include('shop.partials.product-card')
            @endforeach
        </div>
    </div>
    @endif
</div>

@endsection
