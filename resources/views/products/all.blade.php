@extends('layouts.app')
@section('title', 'Sản phẩm')
@section('content')
<div class="container">
    <h1>Tất cả Sản phẩm</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4">
            <div class="product-card">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="img-fluid">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <div class="price">{{ number_format($product->price) }}₫</div>
                <a href="{{ route('product', $product->slug) }}" class="btn btn-primary">Xem chi tiết</a>
                
                    @csrf
                    <button type="submit" class="btn btn-success">Thêm vào giỏ hàng</button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function addToCart(e, productId) {
    e.preventDefault();
    fetch("{{ route('cart.add') }}", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            updateCartCount(data.cart_count);
            showCartAddedMessage();
        }
    });
    return false;
}

function showCartAddedMessage() {
    let msg = document.getElementById('cart-added-message');
    if (!msg) {
        msg = document.createElement('div');
        msg.id = 'cart-added-message';
        msg.style.position = 'fixed';
        msg.style.top = '30px';
        msg.style.right = '30px';
        msg.style.background = '#27ae60';
        msg.style.color = 'white';
        msg.style.padding = '18px 32px';
        msg.style.borderRadius = '8px';
        msg.style.fontSize = '18px';
        msg.style.zIndex = 9999;
        msg.style.boxShadow = '0 2px 10px rgba(0,0,0,0.15)';
        document.body.appendChild(msg);
    }
    msg.textContent = 'Sản phẩm đã được thêm vào giỏ hàng!';
    msg.style.display = 'block';
    setTimeout(() => { msg.style.display = 'none'; }, 1800);
}
</script>
@endsection
