@extends('layouts.app')
@section('title', 'Phụ kiện')
@section('content')
<div class="container">
    <h1>Phụ kiện thời trang</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="product-card">
                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <div class="price">{{ number_format($product->price) }}₫</div>
                <a href="{{ route('product', $product->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
