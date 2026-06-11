@extends('layouts.shop')
@section('title', 'All Products')
@section('content')

<div class="container" style="padding-top:2rem;padding-bottom:3rem">
    <div style="display:grid;grid-template-columns:240px 1fr;gap:2rem;align-items:start">

        {{-- Sidebar Filters --}}
        <aside>
            <div style="background:#fff;border-radius:12px;padding:1.5rem;box-shadow:0 2px 12px rgba(0,0,0,.06);position:sticky;top:80px">
                <h3 style="font-weight:700;margin-bottom:1.2rem;color:#1a1a2e">Filters</h3>
                <form method="GET" action="{{ route('shop.products') }}">
                    <div class="form-group">
                        <label style="font-size:.85rem;font-weight:600;color:#555">Search</label>
                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Search products...">
                    </div>
                    <div class="form-group">
                        <label style="font-size:.85rem;font-weight:600;color:#555">Category</label>
                        <select name="category" class="form-control">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="font-size:.85rem;font-weight:600;color:#555">Price Range</label>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:.5rem">
                            <input type="number" name="min_price" class="form-control" placeholder="Min" value="{{ request('min_price') }}" min="0">
                            <input type="number" name="max_price" class="form-control" placeholder="Max" value="{{ request('max_price') }}" min="0">
                        </div>
                    </div>
                    <div class="form-group">
                        <label style="font-size:.85rem;font-weight:600;color:#555">Sort By</label>
                        <select name="sort" class="form-control">
                            <option value="">Newest</option>
                            <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price: Low → High</option>
                            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High → Low</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" style="width:100%"><i class="fas fa-filter"></i> Apply</button>
                    <a href="{{ route('shop.products') }}" class="btn btn-secondary" style="width:100%;margin-top:.5rem;text-align:center">Clear</a>
                </form>
            </div>
        </aside>

        {{-- Products Grid --}}
        <div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1.5rem">
                <h2 style="font-size:1.3rem;font-weight:700;color:#1a1a2e">
                    {{ $products->total() }} Products Found
                </h2>
            </div>

            @if($products->count())
                <div class="products-grid">
                    @foreach($products as $product)
                        @include('shop.partials.product-card')
                    @endforeach
                </div>
                <div style="margin-top:2rem">{{ $products->links() }}</div>
            @else
                <div style="text-align:center;padding:4rem;color:#999">
                    <i class="fas fa-search" style="font-size:3rem;margin-bottom:1rem;display:block"></i>
                    <p style="font-size:1.1rem">No products found. Try different filters.</p>
                    <a href="{{ route('shop.products') }}" class="btn btn-primary" style="margin-top:1rem">View All Products</a>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
