@extends('layouts.app')

@section('title', 'Về chúng tôi - Alena')

@section('content')
<style>
    .about-container {
        margin: 50px 0;
    }
    
    .page-title {
        font-size: 32px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 50px;
        color: #333;
    }
    
    .about-content {
        background: white;
        padding: 50px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        line-height: 1.8;
        font-size: 16px;
        color: #333;
    }
    
    .about-content h2 {
        font-size: 24px;
        font-weight: bold;
        margin: 30px 0 20px 0;
        color: #d32f2f;
    }
    
    .about-content p {
        margin-bottom: 20px;
    }
    
    .stats-section {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        margin: 50px 0;
    }
    
    @media (max-width: 768px) {
        .stats-section {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    .stat-item {
        text-align: center;
        background: white;
        padding: 30px 20px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .stat-number {
        font-size: 36px;
        font-weight: bold;
        color: #d32f2f;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 16px;
        color: #666;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="about-container">
        <h1 class="page-title">Về chúng tôi</h1>
        
        <div class="about-content">
            <h2>Câu chuyện của Alena</h2>
            <p>
                Alena được thành lập với sứ mệnh mang đến những sản phẩm thời trang chất lượng cao, 
                phù hợp với phong cách sống hiện đại của người Việt Nam. Chúng tôi tin rằng thời trang 
                không chỉ là cách thể hiện cá tính mà còn là cách để mỗi người tự tin thể hiện bản thân.
            </p>
            
            <p>
                Từ những ngày đầu khởi nghiệp, Alena đã không ngừng nỗ lực để tìm kiếm và lựa chọn 
                những sản phẩm tốt nhất từ các nhà cung cấp uy tín. Chúng tôi luôn đặt chất lượng 
                và sự hài lòng của khách hàng lên hàng đầu.
            </p>
            
            <h2>Tầm nhìn và sứ mệnh</h2>
            <p>
                <strong>Tầm nhìn:</strong> Trở thành thương hiệu thời trang hàng đầu Việt Nam, 
                được khách hàng tin tưởng và lựa chọn.
            </p>
            
            <p>
                <strong>Sứ mệnh:</strong> Mang đến những sản phẩm thời trang chất lượng cao với 
                giá cả hợp lý, giúp khách hàng thể hiện phong cách riêng và tự tin trong cuộc sống.
            </p>
            
            <h2>Giá trị cốt lõi</h2>
            <p>
                <strong>Chất lượng:</strong> Chúng tôi cam kết chỉ cung cấp những sản phẩm đạt 
                tiêu chuẩn chất lượng cao nhất.
            </p>
            
            <p>
                <strong>Dịch vụ:</strong> Đội ngũ nhân viên chuyên nghiệp, nhiệt tình luôn sẵn sàng 
                hỗ trợ khách hàng.
            </p>
            
            <p>
                <strong>Đổi mới:</strong> Không ngừng cập nhật xu hướng thời trang mới nhất để 
                mang đến cho khách hàng những lựa chọn đa dạng.
            </p>
            
            <p>
                <strong>Trách nhiệm:</strong> Cam kết với cộng đồng và môi trường thông qua các 
                hoạt động kinh doanh bền vững.
            </p>
        </div>
        
        <div class="stats-section">
            <div class="stat-item">
                <div class="stat-number">10,000+</div>
                <div class="stat-label">Khách hàng hài lòng</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-number">5,000+</div>
                <div class="stat-label">Sản phẩm đa dạng</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-number">50+</div>
                <div class="stat-label">Thương hiệu đối tác</div>
            </div>
            
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Hỗ trợ khách hàng</div>
            </div>
        </div>
    </div>
</div>
@endsection