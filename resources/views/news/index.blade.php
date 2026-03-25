@extends('layouts.app')

@section('title', 'Tin tức thời trang - Alena')

@section('content')
<style>
    /* Main Layout */
    .main-layout {
        display: flex;
        margin: 20px 0;
        gap: 20px;
    }
    
    /* Sidebar */
    .sidebar {
        flex: 0 0 250px;
    }
    
    .sidebar-box {
        background-color: white;
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
    }
    
    .sidebar-title {
        background-color: #f8f8f8;
        padding: 12px 15px;
        font-weight: bold;
        border-bottom: 1px solid #e0e0e0;
        color: #333;
    }
    
    .sidebar-list {
        list-style: none;
    }
    
    .sidebar-list li {
        border-bottom: 1px solid #e0e0e0;
    }
    
    .sidebar-list li:last-child {
        border-bottom: none;
    }
    
    .sidebar-list a {
        display: block;
        padding: 12px 15px;
        color: #333;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .sidebar-list a:hover {
        background-color: #f8f8f8;
        color: #d32f2f;
    }
    
    /* Content */
    .content {
        flex: 1;
    }
    
    /* Featured News */
    .featured-news {
        background-color: white;
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 15px;
        background-color: #f8f8f8;
        border-bottom: 1px solid #e0e0e0;
    }
    
    .section-title {
        font-weight: bold;
        color: #333;
        font-size: 18px;
    }
    
    .view-all {
        color: #d32f2f;
        text-decoration: none;
        font-size: 14px;
        display: flex;
        align-items: center;
    }
    
    .view-all i {
        margin-left: 5px;
    }
    
    .featured-list {
        list-style: none;
        padding: 15px;
    }
    
    .featured-item {
        display: flex;
        align-items: flex-start;
        padding: 12px 0;
        border-bottom: 1px dashed #e0e0e0;
    }
    
    .featured-item:last-child {
        border-bottom: none;
    }
    
    .featured-content {
        flex: 1;
    }
    
    .featured-content a {
        color: #333;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        line-height: 1.4;
        display: block;
        margin-bottom: 5px;
    }
    
    .featured-content a:hover {
        color: #d32f2f;
    }
    
    .featured-meta {
        font-size: 12px;
        color: #999;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .featured-meta i {
        color: #d32f2f;
    }
    
    .featured-views {
        display: flex;
        align-items: center;
        gap: 3px;
    }
    
    .item-number {
        background-color: #d32f2f;
        color: white;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        margin-right: 12px;
        flex-shrink: 0;
    }
    
    /* Articles */
    .articles-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .article-card {
        background-color: white;
        border: 1px solid #e0e0e0;
        padding: 20px;
    }
    
    .article-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }
    
    .article-title {
        font-size: 20px;
        font-weight: bold;
        color: #333;
        margin-bottom: 5px;
    }
    
    .article-meta {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
    }
    
    .article-meta span {
        margin-right: 15px;
    }
    
    .article-content {
        display: flex;
        gap: 20px;
    }
    
    .article-text {
        flex: 1;
    }
    
    .article-text p {
        margin-bottom: 15px;
        color: #555;
        line-height: 1.6;
    }
    
    .read-more {
        color: #d32f2f;
        text-decoration: none;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }
    
    .read-more i {
        margin-left: 5px;
    }
    
    .article-image {
        flex: 0 0 200px;
        height: 150px;
        background-color: #f0f0f0;
        background-size: cover;
        background-position: center;
        border-radius: 4px;
    }
    
    /* Newsletter */
    .newsletter-section {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
        margin-bottom: 50px;
    }
    
    .newsletter-title {
        font-size: 28px;
        margin-bottom: 15px;
        color: #000;
        font-weight: bold;
    }
    
    .newsletter-desc {
        font-size: 16px;
        margin-bottom: 30px;
        color: #666;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .newsletter-form {
        display: flex;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .newsletter-input {
        flex: 1;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 4px 0 0 4px;
        font-size: 15px;
    }
    
    .newsletter-btn {
        padding: 0 30px;
        background-color: #d32f2f;
        color: white;
        border: none;
        border-radius: 0 4px 4px 0;
        font-weight: 600;
        cursor: pointer;
        font-size: 15px;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .main-layout {
            flex-direction: column;
        }
        
        .sidebar {
            flex: none;
            width: 100%;
        }
        
        .article-content {
            flex-direction: column;
        }
        
        .article-image {
            flex: none;
            width: 100%;
            height: 200px;
            order: -1;
            margin-bottom: 15px;
        }
    }
    
    @media (max-width: 576px) {
        .newsletter-form {
            flex-direction: column;
        }
        
        .newsletter-input, .newsletter-btn {
            width: 100%;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        
        .newsletter-btn {
            padding: 15px;
        }
    }
</style>

<!-- Main Content -->
<div class="container">
    <div class="main-layout">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-box">
                <div class="sidebar-title">DANH MỤC TIN TỨC</div>
                <ul class="sidebar-list">
                    <li><a href="{{ route('news') }}">Tin tức thời trang</a></li>
                    <li><a href="{{ route('news') }}">Mẹo vặt hay</a></li>
                    <li><a href="{{ route('news') }}">Sao mặc đẹp</a></li>
                    <li><a href="{{ route('contact') }}">Tư vấn - Hỏi đáp</a></li>
                </ul>
            </div>
            
            <!-- Tin tức nổi bật -->
            <section class="featured-news">
                <div class="section-header">
                    <div class="section-title">TIN TỨC NỔI BẬT</div>
                    <a href="{{ route('news') }}" class="view-all">Xem thêm <i class="fas fa-arrow-right"></i></a>
                </div>
                <ul class="featured-list">
                    <li class="featured-item">
                        <div class="item-number">1</div>
                        <div class="featured-content">
                            <a href="{{ route('news.show', 'cach-phoi-do-he-nam') }}">Cách Phối Đồ Hè Nam Thời Trang 2024</a>
                            <div class="featured-meta">
                                <i class="far fa-calendar-alt"></i> 15/12/2023
                                <span class="featured-views"><i class="fas fa-eye"></i> 1.2K</span>
                            </div>
                        </div>
                    </li>
                    <li class="featured-item">
                        <div class="item-number">2</div>
                        <div class="featured-content">
                            <a href="{{ route('news.show', 'cach-phoi-do-voi-quan-the-thao-nam') }}">Xu Hướng Thời Trang Nam Mùa Hè</a>
                            <div class="featured-meta">
                                <i class="far fa-calendar-alt"></i> 12/12/2023
                                <span class="featured-views"><i class="fas fa-eye"></i> 980</span>
                            </div>
                        </div>
                    </li>
                    <li class="featured-item">
                        <div class="item-number">3</div>
                        <div class="featured-content">
                            <a href="{{ route('news.show', 'cach-phoi-do-so-mi-nam') }}">Bí Quyết Chọn Trang Phục Phù Hợp</a>
                            <div class="featured-meta">
                                <i class="far fa-calendar-alt"></i> 10/12/2023
                                <span class="featured-views"><i class="fas fa-eye"></i> 756</span>
                            </div>
                        </div>
                    </li>
                    <li class="featured-item">
                        <div class="item-number">4</div>
                        <div class="featured-content">
                            <a href="#">Thời Trang Công Sở Hiện Đại</a>
                            <div class="featured-meta">
                                <i class="far fa-calendar-alt"></i> 08/12/2023
                                <span class="featured-views"><i class="fas fa-eye"></i> 642</span>
                            </div>
                        </div>
                    </li>
                    <li class="featured-item">
                        <div class="item-number">5</div>
                        <div class="featured-content">
                            <a href="#">Phụ Kiện Thời Trang 2024</a>
                            <div class="featured-meta">
                                <i class="far fa-calendar-alt"></i> 05/12/2023
                                <span class="featured-views"><i class="fas fa-eye"></i> 523</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
        </aside>
        
        <!-- Main Content -->
        <main class="content">
            <!-- Articles -->
            <div class="articles-list">
                @foreach($news as $article)
                <!-- Article {{ $loop->iteration }} -->
                <article class="article-card">
                    <div class="article-header">
                        <div>
                            <h2 class="article-title">{{ $article['title'] }}</h2>
                            <div class="article-meta">
                                <span><i class="fas fa-user"></i> {{ $article['author'] }}</span>
                                <span><i class="far fa-calendar"></i> {{ date('d/m/Y', strtotime($article['date'])) }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="article-content">
                        <div class="article-text">
                            <p>{{ $article['excerpt'] }}</p>
                            <a href="{{ route('news.show', $article['slug']) }}" class="read-more">Xem thêm <i class="fas fa-arrow-right"></i></a>
                        </div>
                        <div class="article-image" style="background-image: url('/images/news/news-1.jpg'); background-size: cover; background-position: center;">
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </main>
    </div>
</div>

<!-- NEWSLETTER -->
<section class="newsletter-section">
    <div class="container">
        <h2 class="newsletter-title">NHẬP THÔNG TIN KHUYẾN MÃI TỪ CHÚNG TÔI</h2>
        <p class="newsletter-desc">Đăng ký ngay để nhận thông tin khuyến mãi mới nhất và ưu đãi đặc biệt từ Alena Fashion</p>
        <form class="newsletter-form">
            <input type="email" class="newsletter-input" placeholder="Nhập email của bạn">
            <button type="submit" class="newsletter-btn">ĐĂNG KÝ</button>
        </form>
    </div>
</section>

<script>
// Xử lý đăng ký newsletter
document.querySelector('.newsletter-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('.newsletter-input').value;
    
    if (email) {
        alert(`Cảm ơn bạn đã đăng ký nhận khuyến mãi với email: ${email}`);
        this.querySelector('.newsletter-input').value = '';
    } else {
        alert('Vui lòng nhập email của bạn!');
    }
});
</script>
@endsection