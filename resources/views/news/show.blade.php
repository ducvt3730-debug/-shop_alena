@extends('layouts.app')

@section('title', $article['title'] . ' - Alena')

@section('content')
<style>
    .article-container {
        margin: 50px 0;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    
    .article-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .article-title {
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;
        line-height: 1.3;
    }
    
    .article-meta {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        font-size: 14px;
        color: #666;
        margin-bottom: 30px;
    }
    
    .article-meta i {
        margin-right: 8px;
        color: #d32f2f;
    }
    
    .article-image {
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #f5f5f5 25%, #e8e8e8 25%, #e8e8e8 50%, #f5f5f5 50%, #f5f5f5 75%, #e8e8e8 75%, #e8e8e8);
        background-size: 20px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-style: italic;
        border-radius: 8px;
        margin-bottom: 40px;
    }
    
    .article-content {
        background: white;
        padding: 40px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        line-height: 1.8;
        font-size: 16px;
        color: #333;
    }
    
    .article-content h2 {
        font-size: 24px;
        font-weight: bold;
        margin: 30px 0 15px 0;
        color: #333;
    }
    
    .article-content p {
        margin-bottom: 20px;
    }
    
    .article-navigation {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 40px;
        padding-top: 30px;
        border-top: 1px solid #eee;
    }
    
    .back-to-news {
        display: inline-block;
        padding: 12px 25px;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 4px;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    
    .back-to-news:hover {
        background-color: #d32f2f;
        color: white;
    }
    
    .share-buttons {
        display: flex;
        gap: 10px;
        align-items: center;
    }
    
    .share-text {
        margin-right: 10px;
        color: #666;
        font-weight: 600;
    }
    
    .share-btn {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        font-size: 16px;
        transition: transform 0.3s;
    }
    
    .share-btn:hover {
        transform: scale(1.1);
    }
    
    .share-facebook {
        background-color: #3b5998;
    }
    
    .share-twitter {
        background-color: #1da1f2;
    }
    
    .share-linkedin {
        background-color: #0077b5;
    }
    
    .related-articles {
        margin-top: 60px;
    }
    
    .related-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 30px;
        color: #333;
        text-align: center;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    
    .related-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        transition: transform 0.3s;
    }
    
    .related-card:hover {
        transform: translateY(-3px);
    }
    
    .related-image {
        height: 150px;
        background: linear-gradient(135deg, #f5f5f5 25%, #e8e8e8 25%, #e8e8e8 50%, #f5f5f5 50%, #f5f5f5 75%, #e8e8e8 75%, #e8e8e8);
        background-size: 15px 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-size: 12px;
    }
    
    .related-content {
        padding: 20px;
    }
    
    .related-card-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .related-card-title a {
        color: #333;
        text-decoration: none;
    }
    
    .related-card-title a:hover {
        color: #d32f2f;
    }
    
    .related-date {
        font-size: 13px;
        color: #666;
    }
</style>

<div class="container">
    <div class="article-container">
        <div class="article-header">
            <h1 class="article-title">{{ $article['title'] }}</h1>
            
            <div class="article-meta">
                <span>
                    <i class="fas fa-user"></i> {{ $article['author'] }}
                </span>
                <span>
                    <i class="far fa-calendar-alt"></i> {{ date('d/m/Y', strtotime($article['date'])) }}
                </span>
                <span>
                    <i class="far fa-eye"></i> 1,234 lượt xem
                </span>
            </div>
        </div>
        
        <div class="article-image">
            Ảnh bài viết: {{ $article['title'] }}
        </div>
        
        <div class="article-content">
            {!! $article['content'] !!}
        </div>
        
        <div class="article-navigation">
            <a href="{{ route('news') }}" class="back-to-news">
                <i class="fas fa-arrow-left"></i> Quay lại tin tức
            </a>
            
            <div class="share-buttons">
                <span class="share-text">Chia sẻ:</span>
                <a href="#" class="share-btn share-facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="share-btn share-twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="share-btn share-linkedin">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
        
        <div class="related-articles">
            <h3 class="related-title">Bài viết liên quan</h3>
            
            <div class="related-grid">
                <div class="related-card">
                    <div class="related-image">Ảnh bài viết liên quan 1</div>
                    <div class="related-content">
                        <h4 class="related-card-title">
                            <a href="#">Xu hướng thời trang mùa hè 2024</a>
                        </h4>
                        <div class="related-date">15/01/2024</div>
                    </div>
                </div>
                
                <div class="related-card">
                    <div class="related-image">Ảnh bài viết liên quan 2</div>
                    <div class="related-content">
                        <h4 class="related-card-title">
                            <a href="#">Cách chọn trang phục phù hợp</a>
                        </h4>
                        <div class="related-date">12/01/2024</div>
                    </div>
                </div>
                
                <div class="related-card">
                    <div class="related-image">Ảnh bài viết liên quan 3</div>
                    <div class="related-content">
                        <h4 class="related-card-title">
                            <a href="#">Phụ kiện thời trang không thể thiếu</a>
                        </h4>
                        <div class="related-date">10/01/2024</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection