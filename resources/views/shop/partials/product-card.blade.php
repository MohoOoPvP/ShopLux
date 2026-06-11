<div class="product-card">
    <a href="{{ route('shop.product', $product) }}">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
        @else
            <div style="width:100%;height:200px;background:linear-gradient(135deg,#f0f0f0,#e0e0e0);display:flex;align-items:center;justify-content:center;color:#bbb;font-size:2rem">
                <i class="fas fa-box"></i>
            </div>
        @endif
    </a>
    <div class="product-card-body">
        <div style="display:flex;gap:.4rem;margin-bottom:.5rem">
            @if($product->is_featured) <span class="badge-featured">⭐ Featured</span> @endif
            @if($product->sale_price) <span class="badge-sale">SALE</span> @endif
        </div>
        <div class="product-card-title">
            <a href="{{ route('shop.product', $product) }}" style="color:inherit">{{ $product->name }}</a>
        </div>
        <div style="font-size:.8rem;color:#999;margin-bottom:.5rem">{{ $product->category->name }}</div>
        <div class="product-card-price">
            ${{ number_format($product->sale_price ?? $product->price, 2) }}
            @if($product->sale_price)
                <span class="original">${{ number_format($product->price, 2) }}</span>
            @endif
        </div>
        <div style="margin-top:.75rem">
            @if($product->stock > 0)
                <form method="POST" action="{{ route('shop.cart.add', $product) }}">
                    @csrf
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn btn-primary btn-sm" style="width:100%">
                        <i class="fas fa-cart-plus"></i> Add to Cart
                    </button>
                </form>
            @else
                <button class="btn btn-secondary btn-sm" style="width:100%" disabled>Out of Stock</button>
            @endif
        </div>
    </div>
</div>
