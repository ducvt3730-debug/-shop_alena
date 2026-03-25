@extends('layouts.app')

@section('title', 'Chính sách đổi trả - Alena')

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
        <h1 class="page-title">Chính sách đổi trả</h1>
        
        <div class="policy-content">
            <h3>1. Điều kiện đổi trả</h3>
            <p>Alena chấp nhận đổi trả sản phẩm trong các trường hợp sau:</p>
            <ul>
                <li>Sản phẩm bị lỗi do nhà sản xuất</li>
                <li>Sản phẩm không đúng mô tả hoặc hình ảnh</li>
                <li>Giao nhầm sản phẩm, nhầm size, nhầm màu</li>
                <li>Khách hàng không hài lòng với sản phẩm (trong vòng 7 ngày)</li>
            </ul>
            
            <h3>2. Thời gian đổi trả</h3>
            <ul>
                <li><strong>Đổi sản phẩm:</strong> Trong vòng 7 ngày kể từ ngày nhận hàng</li>
                <li><strong>Trả sản phẩm:</strong> Trong vòng 7 ngày kể từ ngày nhận hàng</li>
                <li><strong>Sản phẩm lỗi:</strong> Trong vòng 30 ngày kể từ ngày mua</li>
            </ul>
            
            <h3>3. Điều kiện sản phẩm đổi trả</h3>
            <p>Sản phẩm đổi trả phải đảm bảo:</p>
            <ul>
                <li>Còn nguyên tem mác, nhãn hiệu</li>
                <li>Chưa qua sử dụng, không có dấu hiệu bẩn, rách</li>
                <li>Còn đầy đủ phụ kiện đi kèm (nếu có)</li>
                <li>Có hóa đơn mua hàng hoặc mã đơn hàng</li>
            </ul>
            
            <h3>4. Quy trình đổi trả</h3>
            <p><strong>Bước 1:</strong> Liên hệ hotline 1900 6750 hoặc email support@alena.com</p>
            <p><strong>Bước 2:</strong> Cung cấp thông tin đơn hàng và lý do đổi trả</p>
            <p><strong>Bước 3:</strong> Đóng gói sản phẩm và gửi về địa chỉ của Alena</p>
            <p><strong>Bước 4:</strong> Chúng tôi kiểm tra và xử lý đổi trả trong vòng 3-5 ngày</p>
            <p><strong>Bước 5:</strong> Gửi sản phẩm mới hoặc hoàn tiền cho khách hàng</p>
            
            <h3>5. Chi phí đổi trả</h3>
            <ul>
                <li><strong>Lỗi do Alena:</strong> Chúng tôi chịu toàn bộ chi phí vận chuyển</li>
                <li><strong>Khách hàng đổi ý:</strong> Khách hàng chịu phí vận chuyển 2 chiều</li>
                <li><strong>Đổi size:</strong> Miễn phí đổi size lần đầu, lần sau khách hàng chịu phí</li>
            </ul>
            
            <h3>6. Các trường hợp không được đổi trả</h3>
            <ul>
                <li>Sản phẩm đã qua sử dụng hoặc bị hư hỏng do khách hàng</li>
                <li>Sản phẩm đã được giặt, ủi hoặc sửa chữa</li>
                <li>Sản phẩm mua trong chương trình khuyến mãi đặc biệt</li>
                <li>Quá thời hạn đổi trả quy định</li>
                <li>Không có hóa đơn hoặc bằng chứng mua hàng</li>
            </ul>
            
            <h3>7. Hoàn tiền</h3>
            <p>Thời gian hoàn tiền: 7-15 ngày làm việc kể từ khi chúng tôi nhận được sản phẩm trả lại.</p>
            <p>Hình thức hoàn tiền: Chuyển khoản ngân hàng hoặc ví điện tử theo thông tin khách hàng cung cấp.</p>
            
            <h3>8. Liên hệ hỗ trợ</h3>
            <p>Nếu có bất kỳ thắc mắc nào về chính sách đổi trả, vui lòng liên hệ:</p>
            <ul>
                <li>Hotline: 1900 6750</li>
                <li>Email: support@alena.com</li>
                <li>Địa chỉ: Tầng 6, Tòa nhà Ladeco, 266 Đội Cấn, Ba Đình, Hà Nội</li>
            </ul>
        </div>
    </div>
</div>
@endsection