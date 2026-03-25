@extends('layouts.app')

@section('title', 'Chi tiết đơn hàng - Alena')

@section('content')
<style>
    .order-detail-container {
        max-width: 900px;
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
    
    .order-card {
        background: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        overflow: hidden;
    }
    
    .order-header {
        background: #f8f9fa;
        padding: 20px;
        border-bottom: 1px solid #eee;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .order-id {
        font-size: 20px;
        font-weight: bold;
        color: #2c3e50;
    }
    
    .order-date {
        color: #666;
        font-size: 14px;
    }
    
    .order-status {
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .status-pending {
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
    
    .order-body {
        padding: 20px;
    }
    
    .info-section {
        margin-bottom: 20px;
    }
    
    .info-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    
    .info-row {
        display: flex;
        margin-bottom: 8px;
    }
    
    .info-label {
        width: 150px;
        color: #666;
    }
    
    .info-value {
        flex: 1;
        color: #333;
    }
    
    .order-product {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
        padding: 15px;
        background: #f9f9f9;
        border-radius: 8px;
    }
    
    .product-img {
        width: 100px;
        height: 100px;
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
    
    .product-price {
        color: #e74c3c;
        font-weight: 600;
        font-size: 16px;
    }
    
    .order-footer {
        border-top: 1px solid #eee;
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #f8f9fa;
    }
    
    .order-total {
        font-size: 24px;
        font-weight: bold;
        color: #e74c3c;
    }
    
    .btn-back {
        padding: 12px 25px;
        background: #3498db;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    
    .btn-back:hover {
        background: #2980b9;
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

<div class="order-detail-container">
    <h1 class="page-title">Chi tiết đơn hàng</h1>
    
    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{!! session('error') !!}</div>
    @endif
    
    @if(isset($order))
    <div class="order-card">
        <div class="order-header">
            <div>
                <div class="order-id">{{ $order->order_code }}</div>
                <div class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <span class="order-status status-{{ $order->status }}">{{ $order->status_text }}</span>
        </div>
        
        <div class="order-body">
            <div class="info-section">
                <div class="info-title">Thông tin giao hàng</div>
                <div class="info-row">
                    <span class="info-label">Người nhận:</span>
                    <span class="info-value">{{ $order->customer_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Số điện thoại:</span>
                    <span class="info-value">{{ $order->customer_phone }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $order->customer_email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Địa chỉ:</span>
                    <span class="info-value">{{ $order->customer_address }}</span>
                </div>
                @if($order->note)
                <div class="info-row">
                    <span class="info-label">Ghi chú:</span>
                    <span class="info-value">{{ $order->note }}</span>
                </div>
                @endif
            </div>
            
            <div class="info-section">
                <div class="info-title">Thông tin thanh toán</div>
                <div class="info-row">
                    <span class="info-label">Phương thức:</span>
                    <span class="info-value">
                        @if($order->payment_method == 'cod')
                            Thanh toán khi nhận hàng (COD)
                        @else
                            Chuyển khoản ngân hàng
                        @endif
                    </span>
                </div>
            </div>
            
            <div class="info-section">
                <div class="info-title">Sản phẩm</div>
                @foreach($order->items as $item)
                <div class="order-product">
                    <img src="{{ asset('images/' . $item->product_image) }}" alt="{{ $item->product_name }}" class="product-img">
                    <div class="product-details">
                        <div class="product-name">{{ $item->product_name }}</div>
                        <div class="product-meta">Số lượng: {{ $item->quantity }}</div>
                        @if($item->color)
                        <div class="product-meta">Màu: {{ $item->color }}</div>
                        @endif
                        <div class="product-price">{{ number_format($item->price * $item->quantity) }}₫</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="order-footer">
            <div>
                <div class="info-row">
                    <span class="info-label">Tạm tính:</span>
                    <span class="info-value">{{ number_format($order->subtotal) }}₫</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phí vận chuyển:</span>
                    <span class="info-value">{{ number_format($order->shipping_fee) }}₫</span>
                </div>
                <div class="order-total">Tổng: {{ number_format($order->total) }}₫</div>
            </div>
            <a href="{{ route('orders') }}" class="btn-back">Quay lại</a>
        </div>
    </div>
    @else
    <div class="order-card" style="padding: 40px; text-align: center;">
        <p style="color: #666; margin-bottom: 20px;">Không tìm thấy đơn hàng</p>
        <a href="{{ route('orders') }}" class="btn-back">Quay lại</a>
    </div>
    @endif
</div>
@endsection
