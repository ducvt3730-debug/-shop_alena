@extends('layouts.app')

@section('title', 'Đặt hàng thành công - Alena')

@section('content')
<div style="text-align: center; padding: 60px 20px;">
    <i class="fas fa-check-circle" style="font-size: 80px; color: #27ae60; margin-bottom: 20px;"></i>
    <h2 style="color: #27ae60; margin-bottom: 10px;">Đặt hàng thành công!</h2>
    <p style="color: #666; margin-bottom: 30px;">Đang xử lý đơn hàng...</p>
</div>

<script>
    // Lấy thông tin từ session
    const cart = @json(session('cart', []));
    const customer = @json(session('customer', []));
    
    if (cart && Object.keys(cart).length > 0 && customer) {
        // Tạo đơn hàng từ giỏ hàng
        let orderHistory = JSON.parse(localStorage.getItem('orderHistory')) || [];
        
        // Tính tổng tiền
        let subtotal = 0;
        const products = [];
        
        Object.values(cart).forEach(item => {
            subtotal += item.price * item.quantity;
            products.push({
                id: item.id,
                name: item.name,
                price: item.price,
                image: item.image,
                quantity: item.quantity,
                slug: item.slug
            });
        });
        
        const newOrder = {
            orderId: 'DH' + Date.now(),
            orderDate: new Date().toISOString(),
            status: 'Đang xử lý',
            products: products,
            customer: customer,
            subtotal: subtotal,
            shipping: 30000,
            total: subtotal + 30000
        };
        
        orderHistory.unshift(newOrder);
        
        // Giới hạn 10 đơn hàng
        if (orderHistory.length > 10) {
            orderHistory = orderHistory.slice(0, 10);
        }
        
        localStorage.setItem('orderHistory', JSON.stringify(orderHistory));
        sessionStorage.setItem('orderSuccess', JSON.stringify(newOrder));
        
        // Chuyển đến trang chi tiết đơn hàng
        window.location.href = '{{ route("order.success") }}';
    } else {
        window.location.href = '{{ route("home") }}';
    }
</script>
@endsection
