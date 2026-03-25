@extends('layouts.app')

@section('title', 'Chính sách giao hàng - Alena')

@section('content')
<style>
    .policy-container {
        margin: 50px 0;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .page-title {
        font-size: 28px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 40px;
        color: #333;
    }
    
    .policy-content {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        line-height: 1.8;
    }
    
    .policy-content h3 {
        font-size: 20px;
        font-weight: bold;
        margin: 25px 0 15px 0;
        color: #d32f2f;
    }
    
    .policy-content p {
        margin-bottom: 15px;
        color: #333;
    }
    
    .policy-content ul {
        margin-bottom: 15px;
        padding-left: 20px;
    }
    
    .policy-content li {
        margin-bottom: 8px;
        color: #333;
    }
</style>

<div class="container">
    <div class="policy-container">
        <h1 class="page-title">Chính sách giao hàng</h1>
        
        <div class="policy-content">
            <h3>1. Phạm vi giao hàng</h3>
            <p>Alena cung cấp dịch vụ giao hàng trên toàn quốc với các hình thức sau:</p>
            <ul>
                <li>Giao hàng nhanh trong nội thành Hà Nội và TP.HCM</li>
                <li>Giao hàng tiêu chuẩn cho các tỉnh thành khác</li>
                <li>Giao hàng tận nơi cho đơn hàng trên 500.000đ</li>
            </ul>
            
            <h3>2. Thời gian giao hàng</h3>
            <ul>
                <li><strong>Nội thành Hà Nội, TP.HCM:</strong> 1-2 ngày làm việc</li>
                <li><strong>Các tỉnh thành khác:</strong> 2-5 ngày làm việc</li>
                <li><strong>Vùng sâu, vùng xa:</strong> 5-7 ngày làm việc</li>
            </ul>
            
            <h3>3. Phí giao hàng</h3>
            <ul>
                <li>Miễn phí giao hàng cho đơn hàng từ 498.000đ trở lên</li>
                <li>Phí giao hàng nội thành: 30.000đ</li>
                <li>Phí giao hàng ngoại thành: 50.000đ</li>
                <li>Phí giao hàng các tỉnh: 70.000đ</li>
            </ul>
            
            <h3>4. Quy trình giao hàng</h3>
            <p><strong>Bước 1:</strong> Sau khi đặt hàng thành công, bạn sẽ nhận được email xác nhận đơn hàng.</p>
            <p><strong>Bước 2:</strong> Chúng tôi sẽ liên hệ xác nhận thông tin giao hàng trong vòng 2 giờ.</p>
            <p><strong>Bước 3:</strong> Đơn hàng được đóng gói và chuyển cho đơn vị vận chuyển.</p>
            <p><strong>Bước 4:</strong> Bạn nhận được mã vận đơn để theo dõi tình trạng giao hàng.</p>
            <p><strong>Bước 5:</strong> Nhận hàng và thanh toán (nếu chọn COD).</p>
            
            <h3>5. Lưu ý quan trọng</h3>
            <ul>
                <li>Vui lòng cung cấp đầy đủ và chính xác thông tin giao hàng</li>
                <li>Có mặt tại địa chỉ giao hàng trong khung giờ đã hẹn</li>
                <li>Kiểm tra kỹ sản phẩm trước khi nhận hàng</li>
                <li>Liên hệ hotline 1900 6750 nếu có vấn đề về giao hàng</li>
            </ul>
            
            <h3>6. Trường hợp không giao được hàng</h3>
            <p>Nếu không liên lạc được với khách hàng sau 3 lần gọi hoặc khách hàng không có mặt tại địa chỉ giao hàng, đơn hàng sẽ được chuyển về kho. Khách hàng vui lòng liên hệ để sắp xếp lại thời gian giao hàng.</p>
        </div>
    </div>
</div>
@endsection