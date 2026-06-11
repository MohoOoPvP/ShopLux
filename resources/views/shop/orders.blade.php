@extends('layouts.shop')
@section('title', 'My Orders')
@section('content')

<div class="container" style="padding:2.5rem 1.5rem">
    <h1 style="font-size:2rem;font-weight:800;color:#1a1a2e;margin-bottom:2rem">
        <i class="fas fa-box" style="color:#e94560"></i> My Orders
    </h1>

    @forelse($orders as $order)
    <div style="background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.06);margin-bottom:1.5rem;overflow:hidden">
        <div style="padding:1.2rem 1.5rem;background:#f8f9fa;display:flex;justify-content:space-between;align-items:center">
            <div>
                <strong>Order #{{ $order->id }}</strong>
                <span style="color:#999;font-size:.85rem;margin-left:1rem">{{ $order->created_at->format('M d, Y') }}</span>
            </div>
            <div style="display:flex;align-items:center;gap:1rem">
                <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span>
                <strong style="color:#e94560">${{ number_format($order->total_amount, 2) }}</strong>
            </div>
        </div>
        <div style="padding:1.2rem 1.5rem">
            @foreach($order->items as $item)
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid #f5f5f5">
                <div>
                    <span style="font-weight:500">{{ $item->product->name }}</span>
                    <span style="color:#999;font-size:.85rem"> × {{ $item->quantity }}</span>
                </div>
                <span>${{ number_format($item->subtotal, 2) }}</span>
            </div>
            @endforeach
            <div style="margin-top:.8rem;font-size:.85rem;color:#777">
                <i class="fas fa-map-marker-alt"></i> {{ $order->shipping_address }}
            </div>
        </div>
    </div>
    @empty
    <div style="text-align:center;padding:5rem;background:#fff;border-radius:16px;box-shadow:0 2px 12px rgba(0,0,0,.06)">
        <i class="fas fa-box-open" style="font-size:3.5rem;color:#ddd;display:block;margin-bottom:1rem"></i>
        <h3 style="color:#999;margin-bottom:1rem">No orders yet</h3>
        <a href="{{ route('shop.products') }}" class="btn btn-primary">Start Shopping</a>
    </div>
    @endforelse
</div>

@endsection
