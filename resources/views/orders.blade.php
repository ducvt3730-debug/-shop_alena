@extends('layouts.app')

@section('title', 'Đơn hàng của tôi - Alena')

@section('content')
<style>
    .orders-container {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #2c3e50;
        text-align: center;
    }
    
    /* Search Box */
    .search-box {
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 30px;
    }
    
    .search-form {
        display: flex;
        gap: 10px;
    }
    
    .search-input {
        flex: 1;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }
    
    .search-input:focus {
        outline: none;
        border-color: #d32f2f;
    }
    
    .btn-search {
        padding: 12px 25px;
        background: #d32f2f;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
    }
    
    .btn-search:hover {
        background: #b71c1c;
    }
    
    .order-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        overflow: hidden;
    }
    
    .order-header {
        background: #f8f9fa;
        padding: 15px 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-id {
        font-weight: bold;
        color: #2c3e50;
    }
    
    .order-date {
        color: #666;
        font-size: 14px;
    }
    
    .order-status {
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .status-processing, .status-pending {
        background: #fff3cd;
        color: #856404;
    }
    
    .status-confirmed {
        background: #d1ecf1;
        color: #0c5460;
    }
    
    .status-shipping {
        background: #cce5ff;
        color: #004085;
    }
    
    .status-completed {
        background: #d4edda;
        color: #155724;
    }
    
    .status-cancelled {
        background: #f8d7da;
        color: #721c24;
    }
    
    .status-optional {
        background: #e2e3e5;
        color: #383d41;
    }
    
    .status-failed_delivery {
        background: #f5c6cb;
        color: #721c24;
    }
    
    .status-refunded {
        background: #cce5ff;
        color: #004085;
    }
    
    .btn-cancel {
        padding: 10px 20px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 600;
    }
    
    .btn-cancel:hover {
        background: #c82333;
        color: white;
    }
    
    .btn-cancel:disabled {
        background: #6c757d;
        cursor: not-allowed;
        opacity: 0.6;
    }
    
    .order-body {
        padding: 20px;
    }
    
    .order-product {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .product-img {
        width: 80px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .product-details {
        flex: 1;
    }
    
    .product-name {
        font-weight: 600;
        margin-bottom: 5px;
    }
    
    .product-meta {
        font-size: 14px;
        color: #666;
        margin-bottom: 3px;
    }
    
    .order-footer {
        border-top: 1px solid #eee;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-total {
        font-size: 18px;
        font-weight: bold;
        color: #e74c3c;
    }
    
    .btn-view {
        padding: 10px 20px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-view:hover {
        background: #2980b9;
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
    }
    
    .empty-state i {
        font-size: 80px;
        color: #95a5a6;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        color: #666;
        margin-bottom: 10px;
    }
    
    .empty-state p {
        color: #999;
        margin-bottom: 30px;
    }
    
    .btn-shop {
        padding: 15px 30px;
        background: #e74c3c;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        display: inline-block;
    }
    
    .btn-shop:hover {
        background: #c0392b;
        color: white;
    }

    .alert {
        padding: 15px;
        border-radius: 4px;
        margin-bottom: 20px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }
    
    .alert-error {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="orders-container">
    <h1 class="page-title">Đơn hàng của tôi</h1>
    
    <!-- Search Box -->
    <div class="search-box">
        <form method="GET" action="{{ route('order.search') }}" class="search-form">
            @csrf
            <input type="text" name="order_code" class="search-input" placeholder="Nhập mã đơn hàng để tìm kiếm..." required>
            <button type="submit" class="btn-search">Tìm kiếm</button>
        </form>
    </div>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <div id="ordersList">
        @php
            $orders = \App\Models\Order::where('user_id', auth()->id())->with('items')->latest()->get();
        @endphp
        
        @if($orders->isEmpty())
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <h3>Chưa có đơn hàng nào</h3>
                <p>Bạn chưa đặt hàng. Hãy bắt đầu mua sắm ngay!</p>
                <a href="{{ route('shop') }}" class="btn-shop">Bắt đầu mua sắm</a>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card" id="order-{{ $order->id }}">
                    <div class="order-header">
                        <div>
                            <div class="order-id">{{ $order->order_code }}</div>
                            <div class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <span class="order-status status-{{ $order->status }}">{{ $order->status_text }}</span>
                    </div>
                    
                    <div class="order-body">
                        @foreach($order->items as $item)
                        <div class="order-product">
                            <img src="{{ asset('images/' . $item->product_image) }}" alt="{{ $item->product_name }}" class="product-img">
                            <div class="product-details">
                                <div class="product-name">{{ $item->product_name }}</div>
                                <div class="product-meta">Số lượng: {{ $item->quantity }}</div>
                                <div class="product-meta" style="color: #e74c3c; font-weight: 600;">
                                    {{ number_format($item->price * $item->quantity) }}₫
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                        <div style="padding: 10px; background: #f9f9f9; border-radius: 4px;">
                            <div style="font-size: 14px; color: #666; margin-bottom: 5px;">
                                <strong>Người nhận:</strong> {{ $order->customer_name }} - {{ $order->customer_phone }}
                            </div>
                            <div style="font-size: 14px; color: #666;">
                                <strong>Địa chỉ:</strong> {{ $order->customer_address }}
                            </div>
                        </div>
                    </div>
                    
                    <div class="order-footer">
                        <div class="order-total">Tổng: {{ number_format($order->total) }}₫</div>
                        <div style="display: flex; gap: 10px;">
                            @if(in_array($order->status, ['pending', 'confirmed', 'optional']))
                                <button class="btn-cancel" onclick="cancelOrder({{ $order->id }})">Hủy đơn hàng</button>
                            @endif
                            <button class="btn-view" onclick="viewOrderDetail('{{ $order->order_code }}')">Xem chi tiết</button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script>
    var orderCancelUrl = "{{ url('/order/cancel') }}";
    var orderSearchUrl = "{{ route('order.search') }}";
    
    function cancelOrder(orderId) {
        if (confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?')) {
            fetch(orderCancelUrl + '/' + orderId, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                alert('Có lỗi xảy ra. Vui lòng thử lại!');
            });
        }
    }
    
    function viewOrderDetail(orderCode) {
        window.location.href = orderSearchUrl + '?order_code=' + orderCode;
    }
</script>
@endsection
