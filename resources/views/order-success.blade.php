@extends('layouts.app')

@section('title', 'Đặt hàng thành công - Alena')

@section('content')
<style>
    .success-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
    }
    
    .success-icon {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .success-icon i {
        font-size: 80px;
        color: #27ae60;
        animation: scaleIn 0.5s ease-out;
    }
    
    @keyframes scaleIn {
        from { transform: scale(0); }
        to { transform: scale(1); }
    }
    
    .success-title {
        text-align: center;
        font-size: 28px;
        font-weight: bold;
        color: #27ae60;
        margin-bottom: 10px;
    }
    
    .success-message {
        text-align: center;
        color: #666;
        margin-bottom: 40px;
    }
    
    .order-summary-box {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }
    
    .section-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #2c3e50;
        border-bottom: 2px solid #e74c3c;
        padding-bottom: 10px;
    }
    
    .info-row {
        display: flex;
        padding: 12px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .info-label {
        width: 150px;
        font-weight: 600;
        color: #555;
    }
    
    .info-value {
        flex: 1;
        color: #333;
    }
    
    .product-summary {
        display: flex;
        gap: 20px;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .product-img {
        width: 100px;
        height: 100px;
        border-radius: 8px;
        object-fit: cover;
    }
    
    .product-info {
        flex: 1;
    }
    
    .product-name {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 8px;
    }
    
    .product-meta {
        color: #666;
        margin-bottom: 5px;
    }
    
    .total-section {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        margin-top: 20px;
    }
    
    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        font-size: 16px;
    }
    
    .total-final {
        display: flex;
        justify-content: space-between;
        padding: 15px 0;
        font-size: 20px;
        font-weight: bold;
        color: #e74c3c;
        border-top: 2px solid #ddd;
        margin-top: 10px;
    }
    
    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 30px;
    }
    
    .btn {
        flex: 1;
        padding: 15px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        display: inline-block;
    }
    
    .btn-primary {
        background: #e74c3c;
        color: white;
    }
    
    .btn-secondary {
        background: #95a5a6;
        color: white;
    }
    
    .btn:hover {
        opacity: 0.9;
    }
    
    .note-box {
        background: #fff3cd;
        border-left: 4px solid #ffc107;
        padding: 15px;
        border-radius: 4px;
        margin-top: 20px;
    }
    
    .note-box strong {
        color: #856404;
    }
</style>

<div class="success-container">
    @if(isset($order))
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        
        <h1 class="success-title">Đặt hàng thành công!</h1>
        <p class="success-message">Cảm ơn bạn đã tin tưởng và mua sắm tại Alena. Đơn hàng của bạn đã được ghi nhận thành công!</p>
        
        <div class="order-summary-box">
            <h2 class="section-title">Thông tin đơn hàng</h2>
            
            <div class="info-row">
                <div class="info-label">Mã đơn hàng:</div>
                <div class="info-value">#{{ $order->order_code }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Ngày đặt:</div>
                <div class="info-value">{{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Trạng thái:</div>
                <div class="info-value"><span style="color: #f39c12; font-weight: 600;">{{ $order->status_text }}</span></div>
            </div>
        </div>
        
        <div class="order-summary-box">
            <h2 class="section-title">Thông tin khách hàng</h2>
            
            <div class="info-row">
                <div class="info-label">Họ và tên:</div>
                <div class="info-value">{{ $order->customer_name }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Số điện thoại:</div>
                <div class="info-value">{{ $order->customer_phone }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Email:</div>
                <div class="info-value">{{ $order->customer_email ?? 'Không có' }}</div>
            </div>
            
            <div class="info-row">
                <div class="info-label">Địa chỉ:</div>
                <div class="info-value">{{ $order->customer_address }}</div>
            </div>
            
            @if($order->note)
            <div class="info-row">
                <div class="info-label">Ghi chú:</div>
                <div class="info-value">{{ $order->note }}</div>
            </div>
            @endif
            
            <div class="info-row">
                <div class="info-label">Phương thức thanh toán:</div>
                <div class="info-value">
                    @if($order->payment_method == 'cod')
                        Thanh toán khi nhận hàng (COD)
                    @else
                        Chuyển khoản ngân hàng
                    @endif
                </div>
            </div>
        </div>
        
        <div class="order-summary-box">
            <h2 class="section-title">Sản phẩm đã đặt</h2>
            
            @foreach($order->items as $item)
            <div class="product-summary">
                <img src="{{ asset('images/' . $item->product_image) }}" alt="{{ $item->product_name }}" class="product-img" onerror="this.src='/images/default-product.jpg'">
                <div class="product-info">
                    <div class="product-name">{{ $item->product_name }}</div>
                    <div class="product-meta">Số lượng: {{ $item->quantity }}</div>
                    <div class="product-meta" style="color: #e74c3c; font-weight: 600; font-size: 18px;">
                        {{ number_format($item->price * $item->quantity) }}₫
                    </div>
                </div>
            </div>
            @endforeach
            
            <div class="total-section">
                <div class="total-row">
                    <span>Tạm tính:</span>
                    <span>{{ number_format($order->subtotal) }}₫</span>
                </div>
                <div class="total-row">
                    <span>Phí vận chuyển:</span>
                    <span>{{ number_format($order->shipping_fee) }}₫</span>
                </div>
                <div class="total-final">
                    <span>Tổng cộng:</span>
                    <span>{{ number_format($order->total) }}₫</span>
                </div>
            </div>
        </div>
        
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
    @else
        <div style="text-align: center; padding: 50px;">
            <h2>Không tìm thấy đơn hàng</h2>
            <p>Đơn hàng không tồn tại hoặc bạn không có quyền truy cập.</p>
            <a href="{{ route('orders') }}" class="btn btn-primary">Xem danh sách đơn hàng</a>
        </div>
    @endif
    
    <div class="note-box">
        <strong>Lưu ý:</strong> Chúng tôi sẽ liên hệ với bạn qua số điện thoại để xác nhận đơn hàng trong vòng 24h. Vui lòng giữ máy!
    </div>
    
    <div class="action-buttons">
        <a href="{{ route('home') }}" class="btn btn-primary">Về trang chủ</a>
        <a href="{{ route('orders') }}" class="btn btn-secondary">Xem đơn hàng của tôi</a>
        <a href="{{ route('shop') }}" class="btn btn-secondary">Tiếp tục mua sắm</a>
    </div>
</div>
@endsection
