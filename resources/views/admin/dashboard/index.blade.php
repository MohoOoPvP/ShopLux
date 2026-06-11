@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon red"><i class="fas fa-shopping-bag"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_orders'] }}</div>
            <div class="stat-label">Total Orders</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class="fas fa-box"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_products'] }}</div>
            <div class="stat-label">Products</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class="fas fa-users"></i></div>
        <div>
            <div class="stat-value">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Customers</div>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon orange"><i class="fas fa-dollar-sign"></i></div>
        <div>
            <div class="stat-value">${{ number_format($stats['revenue'], 0) }}</div>
            <div class="stat-label">Revenue</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h2><i class="fas fa-clock"></i> Recent Orders</h2>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm">View All</a>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>#</th><th>Customer</th><th>Amount</th><th>Status</th><th>Date</th><th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats['recent_orders'] as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>${{ number_format($order->total_amount, 2) }}</td>
                    <td><span class="badge badge-{{ $order->status_badge }}">{{ ucfirst($order->status) }}</span></td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary btn-sm">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" style="text-align:center;color:#999;padding:2rem">No orders yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem">
    <div class="card">
        <div class="card-header"><h2>Quick Actions</h2></div>
        <div class="card-body" style="display:flex;flex-direction:column;gap:.7rem">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Product</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary"><i class="fas fa-plus"></i> Add Category</a>
            <a href="{{ route('admin.users.create') }}" class="btn btn-warning"><i class="fas fa-user-plus"></i> Add User</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h2>Categories ({{ $stats['total_categories'] }})</h2></div>
        <div class="card-body">
            <p style="color:#777;font-size:.9rem">Manage your product catalog by adding and organizing categories and subcategories.</p>
            <div style="margin-top:1rem;display:flex;gap:.5rem">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline btn-sm" style="border:1px solid #e94560;color:#e94560">Categories</a>
                <a href="{{ route('admin.subcategories.index') }}" class="btn btn-outline btn-sm" style="border:1px solid #6c757d;color:#6c757d">Subcategories</a>
            </div>
        </div>
    </div>
</div>

@endsection
