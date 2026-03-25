@extends('layouts.app')
@section('title', 'Sơ mi dài tay')
@section('content')
<style>
    .container { padding: 40px 0; }
    h1 { text-align: center; margin-bottom: 40px; font-weight: 700; color: #333; }
    .row { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
    @media (max-width: 992px) { .row { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 576px) { .row { grid-template-columns: 1fr; } }
    .product-card { background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); transition: transform 0.3s; display: flex; flex-direction: column; }
    .product-card:hover { transform: translateY(-5px); box-shadow: 0 5px 20px rgba(0,0,0,0.15); }
    .product-card img { width: 100%; height: 280px; object-fit: cover; }
    .product-card h3 { padding: 15px 20px 10px; font-size: 16px; font-weight: 600; color: #333; height: 50px; overflow: hidden; }
    .product-card p { padding: 0 20px; color: #666; font-size: 14px; margin-bottom: 15px; height: 40px; overflow: hidden; }
    .price { padding: 0 20px; font-size: 18px; font-weight: 700; color: #d32f2f; margin-bottom: 15px; }
    .product-card .btn { margin: 0 10px 15px; padding: 10px 20px; border-radius: 5px; font-weight: 600; text-decoration: none; display: inline-block; font-size: 13px; }
    .btn-primary { background: #333; color: white; border: none; }
    .btn-primary:hover { background: #d32f2f; }
    .btn-success { background: #27ae60; color: white; border: none; cursor: pointer; }
    .btn-success:hover { background: #229954; }
</style>
<div class="container">
    <h1>Sơ mi dài tay</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="product-card">
            <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
            <h3>{{ $product->name }}</h3>
            <p>{{ $product->description }}</p>
            <div class="price">{{ number_format($product->price) }}₫</div>
            <a href="{{ route('product', $product->slug) }}" class="btn btn-primary">Xem chi tiết</a>
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline-block;">
                @csrf
                <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
            </form>
        </div>
        @endforeach
    </div>
</div>
@endsection
