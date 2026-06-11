@extends('layouts.shop')
@section('title', 'Your Cart')
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <h1 style="font-size:2rem;font-weight:800;color:#1a1a2e;margin-bottom:2rem">
        <i class="fas fa-shopping-cart" style="color:#e94560"></i> Your Cart
    </h1>

    @if(empty($cart))
        <div style="text-align:center;padding:5rem;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
            <i class="fas fa-shopping-cart" style="font-size:4rem;color:#ddd;display:block;margin-bottom:1rem"></i>
            <h3 style="color:#999;margin-bottom:1rem">Your cart is empty</h3>
            <a href="{{ route('shop.products') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @else
        <div style="display:grid;grid-template-columns:2fr 1fr;gap:2rem;align-items:start">
            {{-- Cart Items --}}
            <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.06);overflow:hidden">
                <table>
                    <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th><th></th></tr></thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <tr>
                                <td>
                                    <div style="display:flex;align-items:center;gap:12px">
                                        @if($item['image'])
                                            <img src="{{ asset('storage/' . $item['image']) }}" style="width:56px;height:56px;object-fit:cover;border-radius:8px">
                                        @else
                                            <div style="width:56px;height:56px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#bbb"><i class="fas fa-box"></i></div>
                                        @endif
                                        <strong>{{ $item['name'] }}</strong>
                                    </div>
                                </td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td style="font-weight:700;color:#e94560">${{ number_format($subtotal, 2) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('shop.cart.remove', $id) }}">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Order Summary --}}
            <div style="background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 2px 12px rgba(0,0,0,.06)">
                <h3 style="font-weight:700;margin-bottom:1.2rem;color:#1a1a2e">Order Summary</h3>
                <div style="display:flex;justify-content:space-between;margin-bottom:.7rem;font-size:.95rem">
                    <span>Subtotal</span><span>${{ number_format($total, 2) }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;margin-bottom:.7rem;font-size:.95rem">
                    <span>Shipping</span><span style="color:#28a745">Free</span>
                </div>
                <hr style="border:none;border-top:1px solid #f0f0f0;margin:1rem 0">
                <div style="display:flex;justify-content:space-between;font-size:1.2rem;font-weight:800;color:#1a1a2e;margin-bottom:1.5rem">
                    <span>Total</span><span style="color:#e94560">${{ number_format($total, 2) }}</span>
                </div>
                @auth
                    <a href="{{ route('shop.checkout') }}" class="btn btn-primary" style="width:100%;text-align:center;padding:.85rem">
                        <i class="fas fa-lock"></i> Proceed to Checkout
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary" style="width:100%;text-align:center;padding:.85rem">
                        <i class="fas fa-sign-in-alt"></i> Login to Checkout
                    </a>
                @endauth
                <a href="{{ route('shop.products') }}" class="btn btn-secondary" style="width:100%;text-align:center;margin-top:.7rem">
                    Continue Shopping
                </a>
            </div>
        </div>
    @endif
</div>

@endsection
