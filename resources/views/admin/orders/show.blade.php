@extends('layouts.admin')
@section('title', 'Order #' . $order->id)
@section('content')
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem">
    <div>
        <div class="card">
            <div class="card-header">
                <h2>Order #{{ $order->id }} — Items</h2>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Back</a>
            </div>
            <table>
                <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Subtotal</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>${{ $item->price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="text-align:right;font-weight:700;padding:.75rem 1rem">Total:</td>
                        <td style="font-weight:700;color:#e94560;font-size:1.1rem">${{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header"><h2>Customer & Shipping</h2></div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->user->name }}</p>
                <p style="margin:.5rem 0"><strong>Email:</strong> {{ $order->user->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p style="margin:.5rem 0"><strong>Address:</strong> {{ $order->shipping_address }}</p>
                @if($order->notes)
                    <p><strong>Notes:</strong> {{ $order->notes }}</p>
                @endif
            </div>
        </div>
        <div class="card">
            <div class="card-header"><h2>Update Status</h2></div>
            <div class="card-body">
                <p style="margin-bottom:1rem">Current: <span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></p>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf @method('PATCH')
                    <div class="form-group">
                        <select name="status" class="form-control">
                            @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-save"></i> Update Status</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
