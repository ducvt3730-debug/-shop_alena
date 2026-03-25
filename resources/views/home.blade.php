@extends('layouts.app')

@section('title', 'Alena - Thời trang và Phụ kiện')

@section('content')
<style>
/* Full Trangchu.html CSS - inline for now */
* { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Arial', sans-serif; }
.main-banner { width: 100%; height: 500px; position: relative; overflow: hidden; }
.banner-video { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: 0; }
.banner-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); z-index: 1; }
.banner-slide { position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; transition: opacity 0.8s ease-in-out; display: flex; align-items: center; justify-content: center; z-index: 2; }
.banner-slide.active { opacity: 1; }
.banner-content { text-align: center; color: #fff; padding: 0 20px; }
.banner-content h2 { font-size: 42px; font-weight: 800; text-shadow: 2px 2px 8px rgba(0,0,0,0.5); margin-bottom: 12px; letter-spacing: 1px; }
.banner-content p { font-size: 18px; text-shadow: 1px 1px 4px rgba(0,0,0,0.5); margin-bottom: 24px; opacity: 0.9; }
.banner-btn { display: inline-block; padding: 14px 36px; background: #d32f2f; color: #fff; font-weight: 700; font-size: 15px; border-radius: 4px; text-decoration: none; letter-spacing: 1px; transition: background 0.3s; }
.banner-btn:hover { background: #b71c1c; color: #fff; }
.banner-dots { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 3; }
.banner-dot { width: 12px; height: 12px; border-radius: 50%; background: rgba(255,255,255,0.5); cursor: pointer; transition: all 0.3s; border: none; }
.banner-dot.active { background: white; transform: scale(1.2); }
.promo-section { background-color: #fff; padding: 30px 0; }
.promo-container { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }
.promo-item { text-align: center; padding: 25px 20px; background-color: #f9f9f9; border-radius: 8px; border: 1px solid #eee; }
.promo-title { font-size: 18px; font-weight: bold; color: #d32f2f; margin-bottom: 5px; }
.section-title { font-size: 28px; font-weight: bold; text-align: center; margin: 40px 0 30px; color: #000; }
.products-section { margin-bottom: 50px; }
.products-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 25px; margin-bottom: 30px; }
.product-card { background-color: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #eee; transition: transform 0.3s; }
.product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
.product-image { height: 220px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; position: relative; }
.product-image img { width: 100%; height: 100%; object-fit: cover; }
.product-info { padding: 20px; }
.product-name { font-weight: 600; font-size: 16px; margin-bottom: 10px; color: #333; }
.product-price { display: flex; align-items: center; margin-bottom: 15px; }
.current-price { font-weight: bold; font-size: 18px; color: #d32f2f; }
.old-price { font-size: 14px; color: #999; text-decoration: line-through; margin-left: 10px; }
.contact-price { color: #d32f2f; font-weight: bold; margin-left: 10px; }
.product-actions { display: flex; gap: 8px; }
.add-to-cart { flex: 1; padding: 12px 8px; background-color: #333; color: white; border: none; border-radius: 4px; font-weight: 600; cursor: pointer; font-size: 13px; text-decoration: none; text-align: center; }
.add-to-cart:hover { background-color: #d32f2f; color: white; }
.btn-detail { padding: 12px 12px; background-color: #fff; color: #333; border: 1px solid #333; border-radius: 4px; font-weight: 600; cursor: pointer; font-size: 13px; text-decoration: none; text-align: center; white-space: nowrap; }
.btn-detail:hover { background-color: #f5f5f5; color: #333; }
.sale-banner { background-color: #d32f2f; color: white; padding: 60px 0; text-align: center; margin: 50px 0; }
.sale-title { font-size: 36px; font-weight: 800; margin-bottom: 15px; }
.sale-subtitle { font-size: 24px; font-weight: 600; margin-bottom: 20px; }
.news-section { margin: 50px 0; }
.news-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
.news-card { background-color: #fff; border-radius: 8px; overflow: hidden; border: 1px solid #eee; }
.news-content { padding: 25px; }
.news-title { font-size: 20px; font-weight: bold; margin-bottom: 15px; color: #000; }
.news-meta { display: flex; align-items: center; margin-bottom: 15px; font-size: 13px; color: #666; }
.news-desc { color: #666; line-height: 1.6; margin-bottom: 20px; }
.brands-section { background-color: #f9f9f9; padding: 40px 0; margin: 50px 0; }
.brands-container { display: flex; justify-content: center; flex-wrap: wrap; gap: 30px; }
.brand-logo { font-weight: bold; font-size: 20px; color: #333; padding: 15px 25px; border: 1px solid #ddd; border-radius: 4px; background-color: #fff; min-width: 200px; }
.product-categories { display: flex; justify-content: center; gap: 15px; margin-bottom: 30px; flex-wrap: wrap; }
.category-item { padding: 10px 25px; background-color: #fff; border: 1px solid #ddd; border-radius: 4px; font-weight: 600; cursor: pointer; }
.category-item.active { background-color: #d32f2f; color: white; border-color: #d32f2f; }
.newsletter-section { background-color: #f9f9f9; padding: 50px 0; text-align: center; margin-bottom: 50px; }
.newsletter-title { font-size: 28px; margin-bottom: 15px; color: #000; font-weight: bold; }
.newsletter-form { display: flex; max-width: 500px; margin: 0 auto; }
.newsletter-input { flex: 1; padding: 15px; border: 1px solid #ddd; border-radius: 4px 0 0 4px; font-size: 15px; }
.newsletter-btn { padding: 15px 30px; background-color: #d32f2f; color: white; border: none; border-radius: 0 4px 4px 0; font-weight: 600; cursor: pointer; }
@media (max-width: 992px) { .products-grid { grid-template-columns: repeat(2, 1fr); } .news-grid { grid-template-columns: repeat(2, 1fr); } }
@media (max-width: 576px) { .products-grid, .news-grid { grid-template-columns: 1fr; } }
</style>

<!-- Main Banner với Video nền -->
<section class="main-banner">
    <video class="banner-video" autoplay muted loop playsinline>
        <source src="{{ asset('videos/UQ_CMS_video_jp_2026_HOME_GL_Aseets_PJ_JWA_home_w_Grand_pc.mp4') }}" type="video/mp4">
        <source src="{{ asset('videos/UQ_CMS_video_jp_2026_HOME_GL_Aseets_PJ_JWA_home_m_Grand_pc.mp4') }}" type="video/mp4">
    </video>
    <div class="banner-overlay"></div>
    <div class="banner-slide active">
        <div class="banner-content">
            <h2>BỘ SƯU TẬP MÙA XUÂN</h2>
            <p>Phong cách hiện đại - Chất liệu cao cấp</p>
            <a href="{{ route('shop') }}" class="banner-btn">KHÁM PHÁ NGAY</a>
        </div>
    </div>
    <div class="banner-slide">
        <div class="banner-content">
            <h2>THỜI TRANG CÔNG SỞ</h2>
            <p>Lịch lãm - Sang trọng - Tự tin</p>
            <a href="{{ route('shop') }}" class="banner-btn">XEM BỘ SƯU TẬP</a>
        </div>
    </div>
    <div class="banner-slide">
        <div class="banner-content">
            <h2>SALE ĐẾN 50%</h2>
            <p>Ưu đãi có hạn - Đừng bỏ lỡ</p>
            <a href="{{ route('shop') }}" class="banner-btn">MUA NGAY</a>
        </div>
    </div>
    <div class="banner-dots">
        <div class="banner-dot active" data-slide="0"></div>
        <div class="banner-dot" data-slide="1"></div>
        <div class="banner-dot" data-slide="2"></div>
    </div>
</section>

<!-- Promo Section -->
<section class="promo-section">
    <div class="container">
        <div class="promo-container">
            <div class="promo-item">
                <div class="promo-title">MUA 2 SẢN PHẨM TĂNG 20%</div>
                <div class="promo-desc">Từ 10 - 16/12</div>
            </div>
            <div class="promo-item">
                <div class="free-badge">FREE</div>
                <div class="promo-title">MIỄN PHÍ GIAO HÀNG</div>
                <div class="promo-desc">Miễn phí ship với đơn hàng > 498K</div>
            </div>
            <div class="promo-item">
                <div class="promo-title">THANH TOÁN COD</div>
                <div class="promo-desc">Thanh toán khi nhận hàng (COD)</div>
            </div>
            <div class="promo-item">
                <div class="promo-title">HỖ TRỢ BẢO HÀNH</div>
                <div class="promo-desc">Đổi, sửa đổi tại tất cả store</div>
            </div>
        </div>
    </div>
</section>

<!-- SẢN PHẨM HOT -->
<section class="products-section">
    <div class="container">
        <h2 class="section-title">SẢN PHẨM HOT</h2>
        <div class="product-categories">
            <div class="category-item active" data-cat="all">Quần áo</div>
            <div class="category-item" data-cat="accessories">Phụ kiện</div>
            <div class="category-item" data-cat="shoes">Giầy dép</div>
            <div class="category-item" data-cat="girl">Bé gái</div>
            <div class="category-item" data-cat="boy">Bé trai</div>
        </div>
        <div class="products-grid">
            @forelse($hotProducts ?? [] as $product)
            <div class="product-card" data-cat="{{ strtolower($product->category->name ?? 'all') }}">
                <div class="product-image">
                    @if($product->image)
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                    <div class="product-image-placeholder">Chèn ảnh sản phẩm</div>
                    @endif
                    @if($product->sale_price) <span>-{{ number_format($product->price - $product->sale_price) }}₫</span> @endif
                </div>
                <div class="product-info">
                    <div class="product-name">{{ Str::limit($product->name, 50) }}</div>
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
            @empty
            <div class="no-products" style="grid-column: 1/-1; text-align: center; padding: 50px; color: #999;">
                Chưa có sản phẩm hot. <a href="{{ route('shop') }}">Xem shop →</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- HÀNG MỚI VỀ -->
<section class="products-section">
    <div class="container">
        <h2 class="section-title">HÀNG MỚI VỀ</h2>
        <div class="products-grid">
            @forelse($newProducts ?? [] as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image) <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"> @endif
                </div>
                <div class="product-info">
                    <div class="product-name">{{ Str::limit($product->name, 50) }}</div>
                    <div class="product-price">
                        <span class="current-price">{{ number_format($product->price) }}₫</span>
                    </div>
                    <div class="product-actions">
                        <button class="add-to-cart" data-product-id="{{ $product->id }}">Thêm vào giỏ hàng</button>
                        <a href="{{ route('product', $product->slug) }}" class="btn-detail">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #999;">Chưa có sản phẩm mới</div>
            @endforelse
        </div>
    </div>
</section>

<!-- SALE BANNER -->
<section class="sale-banner">
    <div class="container">
        <h2 class="sale-title">SALE ĐỒNG GIÁ - ĐỪNG LO VỀ GIÁ</h2>
        <h3 class="sale-subtitle">MINI COLLECTION - "LẠC QUAN" MANG VẺ ĐẸP ĐẾN CHO BẠN</h3>
        <p class="sale-text">"Tặng nhau tích cực - Ship kèm niềm vui"</p>
        <a href="{{ route('shop') }}" class="sale-btn">MUA NGAY KẺO LỠ</a>
    </div>
</section>

<!-- SẢN PHẨM GIÁ TỐT -->
<section class="products-section">
    <div class="container">
        <h2 class="section-title">SẢN PHẨM GIÁ TỐT</h2>
        <div class="products-grid">
            @forelse($goodPriceProducts ?? [] as $product)
            <div class="product-card">
                <div class="product-image">
                    @if($product->image) <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}"> @endif
                    @if($product->sale_price) <span>-{{ number_format($product->price - $product->sale_price) }}₫</span> @endif
                </div>
                <div class="product-info">
                    <div class="product-name">{{ Str::limit($product->name, 50) }}</div>
                    <div class="product-price">
                        @if($product->sale_price)
                        <span class="current-price">{{ number_format($product->sale_price) }}₫</span>
                        <span class="old-price">{{ number_format($product->price) }}₫</span>
                        @endif
                    </div>
                    <div class="product-actions">
                        <button class="add-to-cart" data-product-id="{{ $product->id }}">Thêm vào giỏ hàng</button>
                        <a href="{{ route('product', $product->slug) }}" class="btn-detail">Xem chi tiết</a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1/-1; text-align: center; padding: 50px; color: #999;">Chưa có sản phẩm khuyến mãi</div>
            @endforelse
        </div>
    </div>
</section>

<!-- TIN TỨC THỜI TRANG -->
<section class="news-section">
    <div class="container">
        <h2 class="section-title">TIN TỨC THỜI TRANG</h2>
        <div class="news-grid">
            @foreach($news as $item)
            <div class="news-card">
                <div class="news-content">
                    <h3 class="news-title">{{ $item['title'] }}</h3>
                    <div class="news-meta">
                        <span class="news-author"><i class="fas fa-user"></i> {{ $item['author'] }}</span>
                        <span class="news-date"><i class="far fa-calendar-alt"></i> {{ $item['date'] }}</span>
                    </div>
                    <p class="news-desc">{{ Str::limit($item['desc'], 150) }}...</p>
                    <a href="{{ $item['link'] }}" class="read-more">Xem thêm →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- BRANDS -->
<section class="brands-section">
    <div class="container">
        <div class="brands-container">
            <div class="brand-logo">CHANEL</div>
            <div class="brand-logo">LOUIS VUITTON</div>
            <div class="brand-logo">GIVENCHY</div>
            <div class="brand-logo">BALENCIAGA PARIS</div>
            <div class="brand-logo">HERMÈS PARIS</div>
        </div>
    </div>
</section>

<!-- NEWSLETTER -->
<section class="newsletter-section">
    <div class="container">
        <h2 class="newsletter-title">NHẬP THÔNG TIN KHUYẾN MÃI TỪ CHÚNG TÔI</h2>
        <p class="newsletter-desc">Đăng ký ngay để nhận thông tin khuyến mãi mới nhất và ưu đãi đặc biệt từ Alena Fashion</p>
        <form class="newsletter-form" id="newsletterForm">
            <input type="email" class="newsletter-input" placeholder="Nhập email của bạn" id="newsletterEmail">
            <button type="submit" class="newsletter-btn">ĐĂNG KÝ</button>
        </form>
    </div>
</section>

<script>
/* Trangchu.html JS - Banner, tabs, cart, newsletter, back-to-top */
let currentSlide = 0;
const slides = document.querySelectorAll('.banner-slide');
const totalSlides = slides.length;

function nextSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % totalSlides;
    slides[currentSlide].classList.add('active');
    updateDots();
}
function prevSlide() {
    slides[currentSlide].classList.remove('active');
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    slides[currentSlide].classList.add('active');
    updateDots();
}

document.querySelectorAll('.banner-dot').forEach((dot, index) => {
    dot.addEventListener('click', () => {
        slides[currentSlide].classList.remove('active');
        currentSlide = index;
        slides[currentSlide].classList.add('active');
        updateDots();
    });
});

setInterval(nextSlide, 6000);

function updateDots() {
    document.querySelectorAll('.banner-dot').forEach(dot => dot.classList.remove('active'));
    document.querySelectorAll('.banner-dot')[currentSlide].classList.add('active');
}

// Category tabs filter
document.querySelectorAll('.category-item').forEach(item => {
    item.addEventListener('click', function() {
        document.querySelectorAll('.category-item').forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        const cat = this.dataset.cat;
        document.querySelectorAll('.product-card').forEach(card => {
            if (cat === 'all' || card.dataset.cat === cat) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
});

// Add to cart
document.querySelectorAll('.add-to-cart').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        const productId = this.dataset.productId;
        // Call Laravel cart.add route
        alert(`Added product ID ${productId} to cart!`);  // Replace with actual AJAX
        this.textContent = 'Đã thêm!';
        setTimeout(() => this.textContent = 'Thêm vào giỏ hàng', 2000);
    });
});

// Newsletter
document.getElementById('newsletterForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = document.getElementById('newsletterEmail').value;
    alert(`Cảm ơn đã đăng ký với email: ${email}`);
    this.reset();
});

function updateDots() {
    document.querySelectorAll('.banner-dot').forEach(dot => dot.classList.remove('active'));
    document.querySelectorAll('.banner-dot')[currentSlide].classList.add('active');
}
</script>
@endsection

