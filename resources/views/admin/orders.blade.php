@extends('layouts.admin')

@section('title', 'Quản lý đơn hàng')
@section('page-title', 'Quản lý đơn hàng')

@section('content')
<style>
    .order-card {
        background: white;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        padding-bottom: 15px;
        border-bottom: 2px solid #f0f0f0;
    }
    
    .order-code {
        font-size: 18px;
        font-weight: bold;
        color: #2c3e50;
    }
    
    .order-date {
        font-size: 13px;
        color: #666;
        margin-top: 5px;
    }
    
    .status-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }
    
    .status-pending { background: #fff3cd; color: #856404; }
    .status-confirmed { background: #d1ecf1; color: #0c5460; }
    .status-shipping { background: #cce5ff; color: #004085; }
    .status-completed { background: #d4edda; color: #155724; }
    .status-cancelled { background: #f8d7da; color: #721c24; }
    .status-optional { background: #e2e3e5; color: #383d41; }
    .status-failed_delivery { background: #f5c6cb; color: #721c24; }
    .status-refunded { background: #cce5ff; color: #004085; }
    
    .order-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
        margin-bottom: 15px;
    }
    
    .info-item {
        font-size: 14px;
    }
    
    .info-label {
        font-weight: 600;
        color: #666;
    }
    
    .order-actions {
        display: flex;
        gap: 10px;
        margin-top: 15px;
        flex-wrap: wrap;
    }
    
    .btn {
        padding: 8px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
    }
    
    .btn-confirm { background: #28a745; color: white; }
    .btn-shipping { background: #17a2b8; color: white; }
    .btn-complete { background: #007bff; color: white; }
    .btn-cancel { background: #dc3545; color: white; }
    .btn-failed { background: #6c757d; color: white; }
    .btn-refund { background: #ffc107; color: #000; }
    .btn-view { background: #6c757d; color: white; }
    
    .btn:hover { opacity: 0.8; }
    
    .status-select {
        padding: 8px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        cursor: pointer;
    }
    
    .status-select.pending { border-color: #ffc107; background: #fff3cd; }
    .status-select.confirmed { border-color: #17a2b8; background: #d1ecf1; }
    .status-select.shipping { border-color: #004085; background: #cce5ff; }
    .status-select.completed { border-color: #28a745; background: #d4edda; }
    .status-select.cancelled { border-color: #dc3545; background: #f8d7da; }
    .status-select.failed_delivery { border-color: #721c24; background: #f5c6cb; }
    .status-select.refunded { border-color: #ffc107; background: #fff3cd; }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }
    
    .empty-state i {
        font-size: 64px;
        color: #ddd;
        margin-bottom: 20px;
    }
</style>

<div class="card">
    <div class="card-header">
        <h3>Danh sách đơn hàng</h3>
    </div>
    
    <div id="ordersList">
@if($orders->isEmpty())
            <div class="empty-state">
                <i class="fas fa-shopping-bag"></i>
                <h3>Chưa có đơn hàng nào</h3>
            </div>
        @else
            @foreach($orders as $order)
                <div class="order-card" id="order-{{ $order->id }}">
                    <div class="order-header">
                        <div>
                            <div class="order-code">{{ $order->order_code }}</div>
                            <div class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                        <span class="status-badge status-{{ $order->status }}">{{ $order->status_text }}</span>
                    </div>
                    
                    <div class="order-info">
                        <div class="info-item">
                            <span class="info-label">Khách hàng:</span> {{ $order->customer_name }}
                        </div>
                        <div class="info-item">
                            <span class="info-label">SĐT:</span> {{ $order->customer_phone }}
                        </div>
                        <div class="info-item">
                            <span class="info-label">Email:</span> {{ $order->customer_email ?? 'Không có' }}
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tổng tiền:</span> <strong style="color: #e74c3c;">{{ number_format($order->total) }}₫</strong>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Thanh toán:</span> 
                            {{ $order->payment_method == 'cod' ? 'COD' : 'Chuyển khoản' }}
                        </div>
                        <div class="info-item">
                            <span class="info-label">User ID:</span> {{ $order->user_id ?? 'Khách vãng lai' }}
                            @if($order->user)
                                ({{ $order->user->name }})
                            @endif
                        </div>
                        <div class="info-item">
                            <span class="info-label">Trạng thái:</span>
                            <select class="status-select {{ $order->status }}" onchange="updateOrderStatus({{ $order->id }}, this.value)">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="shipping" {{ $order->status == 'shipping' ? 'selected' : '' }}>Đang giao</option>
                                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn tất</option>
                                <option value="failed_delivery" {{ $order->status == 'failed_delivery' ? 'selected' : '' }}>Giao thất bại</option>
                                <option value="refunded" {{ $order->status == 'refunded' ? 'selected' : '' }}>Đã hoàn</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Items list -->
                    @if($order->items->count() > 0)
                    <div style="margin: 15px 0; padding: 15px; background: #f9f9f9; border-radius: 4px;">
                        <h4 style="margin-bottom: 10px;">Sản phẩm:</h4>
                        @foreach($order->items as $item)
                            <div style="display: flex; gap: 15px; align-items: center; margin-bottom: 10px;">
                                <div style="font-weight: 600;">{{ $item->product_name }}</div>
                                <div style="color: #666;">x{{ $item->quantity }}</div>
                                <div style="color: #e74c3c;">{{ number_format($item->price * $item->quantity) }}₫</div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    
                    <div class="order-actions">
                        @if($order->status == 'pending')
                            <button class="btn btn-confirm" onclick="updateOrderStatus({{ $order->id }}, 'confirmed')">Xác nhận</button>
                            <button class="btn btn-cancel" onclick="updateOrderStatus({{ $order->id }}, 'cancelled')">Hủy đơn</button>
                        @endif
                        @if($order->status == 'confirmed')
                            <button class="btn btn-shipping" onclick="updateOrderStatus({{ $order->id }}, 'shipping')">Giao hàng</button>
                        @endif
                        @if($order->status == 'shipping')
                            <button class="btn btn-complete" onclick="updateOrderStatus({{ $order->id }}, 'completed')">Hoàn thành</button>
                            <button class="btn btn-failed" onclick="updateOrderStatus({{ $order->id }}, 'failed_delivery')">Giao thất bại</button>
                        @endif
                        @if($order->status == 'failed_delivery')
                            <button class="btn btn-refund" onclick="updateOrderStatus({{ $order->id }}, 'refunded')">Hoàn tiền</button>
                        @endif
                        <button class="btn btn-view" onclick="viewOrderDetail('{{ $order->order_code }}')">Xem chi tiết</button>
                    </div>
                </div>
            @endforeach
            <div style="text-align: center; margin-top: 30px;">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    var updateStatusUrl = "{{ url('/admin/orders') }}";
    var orderDetailUrl = "{{ route('order.search') }}";
    
    function updateOrderStatus(orderId, newStatus) {
        if (!confirm('Xác nhận chuyển trạng thái đơn hàng?')) {
            return;
        }
        
        fetch(updateStatusUrl + '/' + orderId + '/status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                status: newStatus
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert('Có lỗi xảy ra: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra. Vui lòng thử lại!');
        });
    }
    
    function viewOrderDetail(orderCode) {
        window.location.href = orderDetailUrl + '?order_code=' + orderCode;
    }
</script>
@endsection

