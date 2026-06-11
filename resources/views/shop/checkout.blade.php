@extends('layouts.shop')
@section('title', 'Checkout')
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <h1 style="font-size:2rem;font-weight:800;color:#1a1a2e;margin-bottom:2rem">
        <i class="fas fa-lock" style="color:#e94560"></i> Checkout
    </h1>

    <div style="display:grid;grid-template-columns:3fr 2fr;gap:2rem;align-items:start">
        {{-- Shipping Form --}}
        <div style="background:#fff;border-radius:16px;padding:2rem;box-shadow:0 2px 12px rgba(0,0,0,.06)">
            <h3 style="font-weight:700;margin-bottom:1.5rem;color:#1a1a2e">Shipping Information</h3>
            <form method="POST" action="{{ route('shop.order.place') }}">
                @csrf
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" disabled style="background:#f8f9fa">
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->email }}" disabled style="background:#f8f9fa">
                </div>
                <div class="form-group">
                    <label>Phone Number *</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}" required placeholder="+1 (555) 000-0000">
                    @error('phone')<small style="color:#e94560">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label>Shipping Address *</label>
                    <textarea name="shipping_address" class="form-control" rows="3" required placeholder="Street, City, State, ZIP">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                    @error('shipping_address')<small style="color:#e94560">{{ $message }}</small>@enderror
                </div>
                <div class="form-group">
                    <label>Order Notes <small style="color:#999">(optional)</small></label>
                    <textarea name="notes" class="form-control" rows="2" placeholder="Any special instructions?">{{ old('notes') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100%;padding:.9rem;font-size:1rem">
                    <i class="fas fa-check-circle"></i> Place Order
                </button>
            </form>
        </div>

        {{-- Order Summary --}}
        <div style="background:#fff;border-radius:16px;padding:1.5rem;box-shadow:0 2px 12px rgba(0,0,0,.06)">
            <h3 style="font-weight:700;margin-bottom:1.2rem;color:#1a1a2e">Your Order</h3>
            @php $total = 0; @endphp
            @foreach($cart as $item)
                @php $sub = $item['price'] * $item['quantity']; $total += $sub; @endphp
                <div style="display:flex;justify-content:space-between;margin-bottom:.8rem;font-size:.9rem">
                    <span>{{ $item['name'] }} <span style="color:#999">x{{ $item['quantity'] }}</span></span>
                    <span style="font-weight:600">${{ number_format($sub, 2) }}</span>
                </div>
            @endforeach
            <hr style="border:none;border-top:1px solid #f0f0f0;margin:1rem 0">
            <div style="display:flex;justify-content:space-between;font-size:1.15rem;font-weight:800">
                <span>Total</span>
                <span style="color:#e94560">${{ number_format($total, 2) }}</span>
            </div>
            <div style="margin-top:1rem;padding:.8rem;background:#f8f9fa;border-radius:8px;font-size:.82rem;color:#777">
                <i class="fas fa-shield-alt" style="color:#28a745"></i> Secure checkout. Your info is safe.
            </div>
        </div>
    </div>
</div>

@endsection
