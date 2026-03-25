@extends('layouts.app')

@section('title', 'Liên hệ - Alena')

@section('content')
<style>
    .breadcrumb {
        background-color: #fff;
        padding: 15px 0;
        border-bottom: 1px solid #e0e0e0;
        font-size: 14px;
        color: #666;
    }
    
    .breadcrumb a {
        color: #666;
        text-decoration: none;
    }
    
    .breadcrumb a:hover {
        text-decoration: underline;
    }
    
    .breadcrumb span {
        color: #d32f2f;
    }
    
    .contact-content {
        padding: 30px 0;
    }
    
    .company-info {
        background-color: #fff;
        padding: 30px;
        margin-bottom: 30px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .company-title {
        font-size: 20px;
        color: #333;
        margin-bottom: 20px;
        font-weight: bold;
        text-align: center;
    }
    
    .contact-details {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }
    
    .contact-item {
        display: flex;
        align-items: flex-start;
    }
    
    .contact-item strong {
        min-width: 100px;
        color: #333;
    }
    
    .contact-item p {
        color: #555;
        margin: 0;
    }
    
    .map-section {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 30px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .map-title {
        font-size: 16px;
        color: #333;
        margin-bottom: 15px;
        font-weight: bold;
    }
    
    .map-container {
        width: 100%;
        height: 300px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid #ddd;
    }
    
    .map-link {
        display: inline-block;
        margin-top: 15px;
        color: #d32f2f;
        text-decoration: none;
        font-weight: bold;
    }
    
    .map-link:hover {
        text-decoration: underline;
    }
    
    .contact-form-container {
        background-color: #fff;
        padding: 30px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .form-title {
        font-size: 20px;
        color: #333;
        margin-bottom: 25px;
        font-weight: bold;
        text-align: center;
    }
    
    .form-group {
        margin-bottom: 20px;
    }
    
    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: bold;
    }
    
    .required::after {
        content: "*";
        color: #d32f2f;
        margin-left: 3px;
    }
    
    .form-input, .form-textarea {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        color: #333;
        box-sizing: border-box;
    }
    
    .form-input:focus, .form-textarea:focus {
        outline: none;
        border-color: #888;
    }
    
    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .submit-btn {
        background-color: #d32f2f;
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
        transition: background-color 0.3s;
    }
    
    .submit-btn:hover {
        background-color: #b71c1c;
    }
    
    .partners-section {
        background-color: #fff;
        padding: 30px;
        margin-top: 30px;
        border-radius: 4px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    
    .partners-title {
        font-size: 16px;
        color: #333;
        margin-bottom: 20px;
        font-weight: bold;
    }
    
    .partners-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    @media (min-width: 768px) {
        .partners-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    
    .partner-item {
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 4px;
        border: 1px solid #eee;
    }
    
    .partner-item p {
        margin-bottom: 5px;
        color: #333;
    }
    
    .partner-item .location {
        font-size: 12px;
        color: #666;
    }
    
    .contact-layout {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    @media (min-width: 992px) {
        .contact-layout {
            grid-template-columns: 1fr 1fr;
        }
    }
    
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        background-color: #4caf50;
        color: white;
        border-radius: 4px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        display: none;
        z-index: 1000;
    }
    
    .notification.show {
        display: block;
        animation: fadeInOut 3s ease-in-out;
    }
    
    @keyframes fadeInOut {
        0% { opacity: 0; transform: translateY(-20px); }
        10% { opacity: 1; transform: translateY(0); }
        90% { opacity: 1; transform: translateY(0); }
        100% { opacity: 0; transform: translateY(-20px); }
    }
</style>

<!-- Breadcrumb -->
<div class="breadcrumb">
    <div class="container">
        <a href="{{ route('home') }}">Trang chủ</a> > <span>Liên hệ</span>
    </div>
</div>

<div class="container">
    <div class="contact-content">
        <div class="contact-layout">
            <!-- Left column - Company info & Map -->
            <div>
                <div class="company-info">
                    <h2 class="company-title">CÔNG TY TNHH THỜI TRANG ALENA</h2>
                    
                    <div class="contact-details">
                        <div class="contact-item">
                            <strong>Địa chỉ:</strong>
                            <p>Tầng 6, Tòa nhà Ladeco, 266 Đội Cấn, Phường Liễu Giai, Quận Ba Đình, TP Hà Nội</p>
                        </div>
                        
                        <div class="contact-item">
                            <strong>Email:</strong>
                            <p>support@alena.vn</p>
                        </div>
                        
                        <div class="contact-item">
                            <strong>Hotline:</strong>
                            <p>1900 6750</p>
                        </div>
                    </div>
                </div>
                
                <!-- Map section -->
                <div class="map-section">
                    <h3 class="map-title">Bản đồ chỉ đường</h3>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.863981044343!2d105.81666031540274!3d21.036766785993215!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ab0b5b5b5b5b%3A0x5b5b5b5b5b5b5b5b!2zVOG6oW4gNiwgVMO0YSBuaMOgIExhZGVjbywgMjY2IMSQ4buLbmggQ-G6p24sIFBoxrDhu51uZyBMaeG7h3UgR2lhaSwgUXXhu5FjIELDoCDEkMO0bmgsIEhvw6AgTmjDoCBOaW5o!5e0!3m2!1svi!2s!4v1629876543210!5m2!1svi!2s" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                    <a href="https://www.google.com/maps/place/T%E1%BA%A7ng+6,+T%C3%B2a+nh%C3%A0+Ladeco,+266+%C4%90%E1%BB%99i+C%E1%BA%A5n" 
                       class="map-link" 
                       target="_blank">
                        <i class="fas fa-external-link-alt"></i> Xem bản đồ lớn hơn trên Google Maps
                    </a>
                </div>
            </div>
            
            <!-- Right column - Contact form -->
            <div>
                <div class="contact-form-container">
                    <h2 class="form-title">LIÊN HỆ VỚI CHÚNG TÔI</h2>
                    
                    @if(session('success'))
                        <div class="notification show">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('contact.submit') }}" id="contactForm">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" class="form-input" name="name" value="{{ old('name') }}" placeholder="Họ và tên">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-input" name="email" value="{{ old('email') }}" placeholder="Email">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label required">Điện thoại</label>
                            <input type="tel" class="form-input" name="phone" value="{{ old('phone') }}" placeholder="Điện thoại*" required>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Chủ đề</label>
                            <input type="text" class="form-input" name="subject" value="{{ old('subject') }}" placeholder="Chủ đề">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Nội dung</label>
                            <textarea class="form-textarea" name="message" placeholder="Nội dung">{{ old('message') }}</textarea>
                        </div>
                        
                        <button type="submit" class="submit-btn">Gửi thông tin</button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Partners section -->
        <div class="partners-section">
            <h3 class="partners-title">Đối tác của chúng tôi</h3>
            
            <div class="partners-grid">
                <div class="partner-item">
                    <p>CHANEL</p>
                    <p class="location">Thương hiệu thời trang cao cấp</p>
                </div>
                
                <div class="partner-item">
                    <p>LOUIS VUITTON</p>
                    <p class="location">Thời trang hàng hiệu</p>
                </div>
                
                <div class="partner-item">
                    <p>GIVENCHY</p>
                    <p class="location">Thời trang Pháp</p>
                </div>
                
                <div class="partner-item">
                    <p>HERMÈS PARIS</p>
                    <p class="location">Phụ kiện cao cấp</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Notification -->
<div class="notification" id="notification">
    Thông tin đã được gửi thành công!
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const notification = document.getElementById('notification');
    
    contactForm.addEventListener('submit', function(e) {
        const phone = document.querySelector('input[name="phone"]').value;
        
        if (!phone.trim()) {
            e.preventDefault();
            alert('Vui lòng nhập số điện thoại!');
            return;
        }
        
        const phoneRegex = /^(0[3|5|7|8|9])+([0-9]{8})$/;
        if (!phoneRegex.test(phone)) {
            e.preventDefault();
            alert('Vui lòng nhập số điện thoại hợp lệ (10 số, bắt đầu bằng 03, 05, 07, 08, 09)');
            return;
        }
    });
});
</script>
@endsection