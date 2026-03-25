@extends('layouts.app')

@section('title', 'Chính sách bảo mật - Alena')

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
        <h1 class="page-title">Chính sách bảo mật</h1>
        
        <div class="policy-content">
            <h3>1. Cam kết bảo mật thông tin</h3>
            <p>Alena cam kết bảo vệ thông tin cá nhân của khách hàng theo các tiêu chuẩn bảo mật cao nhất. Chúng tôi không bán, chia sẻ hay trao đổi thông tin cá nhân của khách hàng cho bên thứ ba khi chưa có sự đồng ý.</p>
            
            <h3>2. Thông tin chúng tôi thu thập</h3>
            <p>Khi bạn sử dụng dịch vụ của Alena, chúng tôi có thể thu thập các thông tin sau:</p>
            <ul>
                <li>Thông tin cá nhân: Họ tên, email, số điện thoại, địa chỉ</li>
                <li>Thông tin đơn hàng: Sản phẩm đã mua, lịch sử giao dịch</li>
                <li>Thông tin kỹ thuật: Địa chỉ IP, loại trình duyệt, thời gian truy cập</li>
                <li>Thông tin thanh toán: Thông tin thẻ tín dụng (được mã hóa)</li>
            </ul>
            
            <h3>3. Mục đích sử dụng thông tin</h3>
            <p>Thông tin của bạn được sử dụng cho các mục đích sau:</p>
            <ul>
                <li>Xử lý đơn hàng và giao hàng</li>
                <li>Cung cấp dịch vụ khách hàng</li>
                <li>Gửi thông tin khuyến mãi (nếu bạn đồng ý)</li>
                <li>Cải thiện chất lượng dịch vụ</li>
                <li>Tuân thủ các yêu cầu pháp lý</li>
            </ul>
            
            <h3>4. Bảo vệ thông tin</h3>
            <p>Chúng tôi áp dụng các biện pháp bảo mật sau:</p>
            <ul>
                <li>Mã hóa SSL cho tất cả giao dịch trực tuyến</li>
                <li>Hệ thống firewall và phần mềm chống virus</li>
                <li>Kiểm soát truy cập nghiêm ngặt</li>
                <li>Sao lưu dữ liệu định kỳ</li>
                <li>Đào tạo nhân viên về bảo mật thông tin</li>
            </ul>
            
            <h3>5. Chia sẻ thông tin với bên thứ ba</h3>
            <p>Chúng tôi chỉ chia sẻ thông tin của bạn trong các trường hợp sau:</p>
            <ul>
                <li>Với đơn vị vận chuyển để giao hàng</li>
                <li>Với ngân hàng/cổng thanh toán để xử lý giao dịch</li>
                <li>Khi có yêu cầu từ cơ quan pháp luật</li>
                <li>Khi có sự đồng ý rõ ràng từ bạn</li>
            </ul>
            
            <h3>6. Quyền của khách hàng</h3>
            <p>Bạn có quyền:</p>
            <ul>
                <li>Yêu cầu xem thông tin cá nhân mà chúng tôi lưu trữ</li>
                <li>Yêu cầu chỉnh sửa hoặc cập nhật thông tin</li>
                <li>Yêu cầu xóa thông tin cá nhân</li>
                <li>Từ chối nhận email marketing</li>
                <li>Khiếu nại về việc sử dụng thông tin cá nhân</li>
            </ul>
            
            <h3>7. Cookie và công nghệ theo dõi</h3>
            <p>Website của chúng tôi sử dụng cookie để:</p>
            <ul>
                <li>Ghi nhớ thông tin đăng nhập</li>
                <li>Lưu trữ giỏ hàng</li>
                <li>Phân tích lưu lượng truy cập</li>
                <li>Cá nhân hóa trải nghiệm người dùng</li>
            </ul>
            <p>Bạn có thể tắt cookie trong cài đặt trình duyệt, nhưng điều này có thể ảnh hưởng đến trải nghiệm sử dụng website.</p>
            
            <h3>8. Thay đổi chính sách</h3>
            <p>Chúng tôi có thể cập nhật chính sách bảo mật này theo thời gian. Mọi thay đổi sẽ được thông báo trên website và có hiệu lực ngay khi được đăng tải.</p>
            
            <h3>9. Liên hệ</h3>
            <p>Nếu bạn có câu hỏi về chính sách bảo mật, vui lòng liên hệ:</p>
            <ul>
                <li>Email: privacy@alena.com</li>
                <li>Hotline: 1900 6750</li>
                <li>Địa chỉ: Tầng 6, Tòa nhà Ladeco, 266 Đội Cấn, Ba Đình, Hà Nội</li>
            </ul>
        </div>
    </div>
</div>
@endsection