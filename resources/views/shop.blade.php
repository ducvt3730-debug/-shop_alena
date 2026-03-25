@extends('layouts.app')

@section('title', 'Sản phẩm - Alena')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
    }

    /* Breadcrumb */
    .breadcrumb-section {
        background-color: white;
        padding: 15px 0;
        border-bottom: 1px solid #eee;
    }

    .breadcrumb {
        font-size: 14px;
        color: #666;
    }

    .breadcrumb a {
        color: #666;
        text-decoration: none;
        transition: color 0.2s;
    }

    .breadcrumb a:hover {
        color: #e74c3c;
    }

    .breadcrumb span {
        color: #e74c3c;
    }

    .shop-container {
        padding: 30px 0 50px;
    }
    
    .shop-header {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .shop-title {
        font-size: 28px;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 10px;
    }
    
    /* Product Categories */
    .product-categories {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }
    
    .category-item {
        padding: 10px 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        font-size: 14px;
        transition: all 0.3s;
    }
    
    .category-item.active,
    .category-item:hover {
        background-color: #d32f2f;
        color: white;
        border-color: #d32f2f;
    }

    .shop-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        padding: 15px 20px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .results-count {
        font-size: 14px;
        color: #666;
        font-weight: 500;
    }
    
    .sort-select {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        background-color: white;
        min-width: 200px;
    }

    /* Products Grid */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .product-card {
        background-color: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s, box-shadow 0.3s;
        border: 1px solid #eee;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .product-image {
        height: 280px;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Đây là chỗ để chèn ảnh sản phẩm */
    .product-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #f5f5f5 25%, #e8e8e8 25%, #e8e8e8 50%, #f5f5f5 50%, #f5f5f5 75%, #e8e8e8 75%, #e8e8e8);
        background-size: 20px 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #aaa;
        font-style: italic;
    }

    .product-image span {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background-color: #d32f2f;
        color: white;
        padding: 3px 8px;
        border-radius: 3px;
        font-size: 12px;
    }

    .product-info {
        padding: 15px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        font-size: 15px;
        margin-bottom: 8px;
        color: #2c3e50;
        height: 38px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.3;
    }

    .product-price {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
        gap: 8px;
        height: 26px;
    }

    .current-price {
        font-weight: bold;
        font-size: 16px;
        color: #e74c3c;
    }

    .old-price {
        font-size: 14px;
        color: #95a5a6;
        text-decoration: line-through;
    }

    .contact-price {
        font-weight: 600;
        color: #3498db;
        font-size: 16px;
    }

    .add-to-cart {
        flex: 1;
        padding: 10px 8px;
        background-color: #333;
        color: white;
        border: none;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s;
        margin-top: auto;
    }

    .add-to-cart:hover {
        background-color: #d32f2f;
        color: white;
        transform: translateY(-1px);
    }

    .btn-detail {
        padding: 10px 12px;
        background-color: #fff;
        color: #333;
        border: 1px solid #333;
        border-radius: 4px;
        font-weight: 600;
        cursor: pointer;
        font-size: 13px;
        text-decoration: none;
        text-align: center;
        white-space: nowrap;
        transition: all 0.3s;
        margin-top: auto;
    }

    .btn-detail:hover {
        background-color: #f5f5f5;
        color: #333;
    }

    .product-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }
    
    .pagination-wrapper nav {
        display: inline-block;
    }
    
    .pagination-wrapper nav > div {
        display: flex;
        gap: 5px;
        align-items: center;
    }
    
    .pagination-wrapper .pagination {
        display: flex;
        gap: 5px;
        list-style: none;
        padding: 0;
        margin: 0;
        align-items: center;
    }
    
    .pagination-wrapper a,
    .pagination-wrapper span {
        padding: 8px 12px;
        background: white;
        border: 1px solid #ddd;
        color: #333;
        text-decoration: none;
        border-radius: 4px;
        transition: all 0.3s;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 38px;
        height: 38px;
    }
    
    .pagination-wrapper a:hover {
        background: #d32f2f;
        color: white;
        border-color: #d32f2f;
    }
    
    .pagination-wrapper .active span {
        background: #d32f2f;
        color: white;
        border-color: #d32f2f;
    }
    
    .pagination-wrapper .disabled span {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    .pagination-wrapper svg {
        width: 16px;
        height: 16px;
    }

    /* Newsletter */
    .newsletter-section {
        background-color: #f9f9f9;
        padding: 50px 0;
        text-align: center;
        margin-top: 50px;
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

    @media (max-width: 992px) {
        .shop-controls {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }
        
        .sort-select {
            width: 100%;
        }
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
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
        
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        }
        
        .product-categories {
            gap: 10px;
        }
        
        .category-item {
            padding: 8px 15px;
            font-size: 14px;
        }
    }
</style>

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <div class="breadcrumb">
            <a href="{{ route('home') }}">Trang chủ</a> >
            <span>Sản phẩm</span>
        </div>
    </div>
</section>

<div class="shop-container">
    <div class="container">
        <!-- Shop Header -->
        <div class="shop-header">
            <h1 class="shop-title">TẤT CẢ SẢN PHẨM</h1>
            <p class="shop-subtitle">Khám phá bộ sưu tập thời trang đa dạng và phong phú từ Alena</p>
        </div>


        <!-- Product Categories -->
        <div class="product-categories">
            <div class="category-item {{ !request('category') ? 'active' : '' }}" data-category="all">
                <a href="{{ route('shop') }}" style="text-decoration: none; color: inherit;">Tất cả</a>
            </div>
            @foreach($categories as $category)
            <div class="category-item {{ request('category') == $category->slug ? 'active' : '' }}" data-category="{{ $category->slug }}">
                <a href="{{ route('shop', ['category' => $category->slug]) }}" style="text-decoration: none; color: inherit;">{{ $category->name }}</a>
            </div>
            @endforeach
        </div>

        <!-- Shop Controls -->
        <div class="shop-controls">
            <div class="results-count">
                Hiển thị {{ $products->count() }} sản phẩm
            </div>
            <select class="sort-select">
                <option>Sắp xếp theo</option>
                <option>Giá thấp đến cao</option>
                <option>Giá cao đến thấp</option>
                <option>Mới nhất</option>
                <option>Bán chạy nhất</option>
                <option>Sản phẩm nổi bật</option>
            </select>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image)
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        <!-- CHỖ ĐỂ CHÈN ẢNH SẢN PHẨM -->
                        <div class="product-image-placeholder">
                            Chèn ảnh {{ $product->name }} tại đây
                        </div>
                    @endif
                    @if($product->sale_price)
                        <span>-{{ number_format($product->price - $product->sale_price) }}₫</span>
                    @endif
                </div>
                <div class="product-info">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">
                        @if($product->sale_price)
                            <span class="current-price">{{ number_format($product->sale_price) }}₫</span>
                            <span class="old-price">{{ number_format($product->price) }}₫</span>
                        @else
                            <span class="current-price">{{ number_format($product->price) }}₫</span>
                        @endif
                    </div>
                    <div class="product-actions">
                        <button class="add-to-cart" data-product-id="{{ $product->id }}">Thêm vào giỏ hàng</button>
                        <a href="{{ route('product', $product->slug) }}" class="btn-detail">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

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