@extends('layouts.app')

@section('title', 'Giỏ hàng - Alena')

@section('content')
<style>
    .cart-container {
        margin: 50px 0;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }
    
    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 30px;
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .cart-table th,
    .cart-table td {
        padding: 15px;
        text-align: left;
        border-bottom: 1px solid #eee;
    }
    
    .cart-table th {
        background-color: #f8f9fa;
        font-weight: 600;
        color: #333;
    }
    
    .product-info {
        display: flex;
        align-items: center;
        gap: 15px;
    }
    
    .product-image {
        width: 80px;
        height: 80px;
        background-color: #f5f5f5;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #999;
        font-size: 12px;
    }
    
    .product-details h4 {
        margin: 0 0 5px 0;
        font-size: 16px;
        color: #333;
    }
    
    .product-price {
        color: #d32f2f;
        font-weight: 600;
    }
    
    .quantity-input {
        width: 60px;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        text-align: center;
    }
    
    .btn-remove {
        background-color: #dc3545;
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 12px;
    }
    
    .btn-remove:hover {
        background-color: #c82333;
    }
    
    .cart-summary {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 400px;
        margin-left: auto;
    }
    
    .summary-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 1px solid #eee;
    }
    
    .summary-row:last-child {
        border-bottom: none;
        font-weight: bold;
        font-size: 18px;
        color: #d32f2f;
    }
    
    .btn-checkout {
        width: 100%;
        padding: 15px;
        background-color: #d32f2f;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        margin-top: 20px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }
    
    .btn-checkout:hover {
        background-color: #b71c1c;
        color: white;
    }
    
    .empty-cart {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }
    
    .empty-cart i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .btn-continue {
        display: inline-block;
        padding: 12px 30px;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        margin-top: 20px;
    }
    
    .btn-continue:hover {
        background-color: #d32f2f;
        color: white;
    }
    
    .cart-content {
        display: flex;
        gap: 30px;
        align-items: flex-start;
    }
    
    .cart-items {
        flex: 2;
    }
    
    .cart-sidebar {
        flex: 1;
    }
    
    @media (max-width: 768px) {
        .cart-content {
            flex-direction: column;
        }
    }
</style>

<div class="container">
    <div class="cart-container">
        <h1 class="page-title">Giỏ hàng của bạn</h1>
        
        @if(empty($cart))
            <div class="empty-cart">
                <i class="fas fa-shopping-cart"></i>
                <h3>Giỏ hàng của bạn đang trống</h3>
                <p>Hãy thêm sản phẩm vào giỏ hàng để tiếp tục mua sắm</p>
                <a href="{{ route('shop') }}" class="btn-continue">Tiếp tục mua sắm</a>
            </div>
        @else
            <div class="cart-content">
                <div class="cart-items">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr data-product-id="{{ $item['id'] }}">
                                <td>
                                    <div class="product-info">
                                        <div class="product-image">
                                            @if(!empty($item['image']))
                                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}" style="max-width: 80px; max-height: 80px; border-radius: 4px;">
                                            @else
                                                <span>Ảnh sản phẩm</span>
                                            @endif
                                        </div>
<div class="product-details">
                                            <h4>{{ $item['name'] }}</h4>
                                            @if(isset($item['size']) && $item['size'])
                                                <div class="item-size" style="color: #d32f2f; font-weight: 600; font-size: 14px; margin-top: 4px;">Size: {{ $item['size'] }}</div>
                                            @endif
                                            <a href="{{ route('product', $item['slug']) }}">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-price">{{ number_format($item['price']) }}₫</td>
                                <td>
                                     <input type="number" class="quantity-input" value="{{ $item['quantity'] }}" 
                                         min="1" data-id="{{ $item['id'] }}" onchange="updateQuantity(this.getAttribute('data-id'), this.value)">
                                </td>
                                <td class="product-price">{{ number_format($item['price'] * $item['quantity']) }}₫</td>
                                <td>
                                    <button class="btn-remove" data-id="{{ $item['id'] }}" onclick="removeFromCart(this.getAttribute('data-id'))">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                <div class="cart-sidebar">
                    <div class="cart-summary">
                        <h3 class="summary-title">Tóm tắt đơn hàng</h3>
                        
                        <div class="summary-row">
                            <span>Tạm tính:</span>
                            <span>{{ number_format($total) }}₫</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Phí vận chuyển:</span>
                            <span>Miễn phí</span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Tổng cộng:</span>
                            <span>{{ number_format($total) }}₫</span>
                        </div>
                        
                        <a href="{{ route('checkout') }}" class="btn-checkout">Tiến hành thanh toán</a>
                        
                        <a href="{{ route('shop') }}" class="btn-continue">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function updateQuantity(productId, quantity) {
    fetch('{{ route("cart.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Có lỗi xảy ra!');
            // Reset về giá trị hợp lệ
            if (data.max_stock) {
                document.querySelector(`input[data-id="${productId}"]`).value = data.max_stock;
            }
            location.reload();
        }
    });
}

function removeFromCart(productId) {
    if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
        const url = `{{ url('cart/remove') }}/${productId}`;
        fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
                // Cập nhật số lượng giỏ hàng trong header
                document.getElementById('cartCount').textContent = data.cart_count;
            }
        });
    }
}
</script>
@endsection