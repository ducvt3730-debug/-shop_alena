<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Alena - Thời trang và Phụ kiện')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }
        
        body {
            color: #333;
            background-color: #fff;
            font-size: 14px;
            line-height: 1.4;
        }
        
        /* Header */
        .top-header {
            background-color: #fff;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }
        
        .container {
            width: 1200px;
            max-width: 95%;
            margin: 0 auto;
        }
        
        .header-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #000;
            text-decoration: none;
        }
        
        .logo span {
            color: #d32f2f;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background-color: #f5f5f5;
            border-radius: 4px;
            padding: 10px 15px;
            width: 400px;
            position: relative;
        }
        
        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            padding-left: 10px;
            font-size: 14px;
        }
        
        .global-search-suggestions {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            border: 1px solid #ddd;
            border-radius: 0 0 8px 8px;
            max-height: 300px;
            overflow-y: auto;
            display: none;
            z-index: 2000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            margin-top: 5px;
        }
        
        .global-search-suggestions.show {
            display: block;
        }
        
        .global-suggestion-item {
            padding: 10px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
            font-size: 14px;
        }
        
        .global-suggestion-item:hover {
            background: #f8f9fa;
        }
        
        .user-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .cart-icon {
            position: relative;
            cursor: pointer;
            font-size: 20px;
            color: #333;
            text-decoration: none;
        }
        
        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #d32f2f;
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        .user-actions a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }
        
        .hotline {
            color: #d32f2f;
            font-weight: bold;
        }
        
        /* Main Navigation với slogan */
        .main-nav {
            background-color: #fff;
            border-bottom: 1px solid #eee;
            padding: 12px 0;
            position: relative;
        }
        
        .nav-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
            position: relative;
        }
        
        .nav-menu > li {
            position: relative;
        }
        
        .nav-menu > li > a {
            text-decoration: none;
            color: #333;
            font-weight: 600;
            font-size: 15px;
            padding: 8px 0;
            display: block;
        }
        
        .nav-menu > li > a:hover {
            color: #d32f2f;
        }

        /* Chỉ có mũi tên cho 2 mục có dropdown */
        .nav-menu > li:nth-child(2) > a::after,
        .nav-menu > li:nth-child(3) > a::after {
            content: " ▼";
            font-size: 10px;
            color: #888;
        }
        
        /* Khi dropdown active thì đổi thành ▲ */
        .nav-menu > li:nth-child(2).active > a::after,
        .nav-menu > li:nth-child(3).active > a::after {
            content: " ▲";
        }

        /* Dropdown Menus - Ẩn mặc định */
        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            min-width: 220px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            padding: 15px 0;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        /* Auth dropdown specific styles */
        .auth-dropdown {
            right: 0 !important;
            left: auto !important;
            min-width: 220px;
        }
        
        .auth-dropdown.active,
        .dropdown-menu.show {
            opacity: 1 !important;
            visibility: visible !important;
            transform: translateY(0) !important;
            display: block !important;
        }


        /* Hiện dropdown khi hover */
        .has-dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }
        
        /* Dropdown cho Thời trang Nam - Kích thước vừa */
        .fashion-dropdown {
            width: 400px;
            display: flex;
            gap: 20px;
        }
        
        .fashion-column {
            flex: 1;
        }
        
        /* Mũi tên cho mục có submenu */
        .dropdown-list li.has-submenu > a::after {
            content: " ▶";
            font-size: 10px;
            float: right;
            color: #888;
        }
        
        /* Submenu - Ẩn mặc định */
        .submenu {
            position: absolute;
            left: 100%;
            top: 0;
            background-color: white;
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
            min-width: 160px;
            z-index: 1001;
            display: none;
            opacity: 0;
            visibility: hidden;
            transform: translateX(-10px);
            transition: all 0.3s ease;
            padding: 10px 0;
            border: 1px solid #eee;
            border-radius: 4px;
        }
        
        /* Hiện submenu khi hover */
        .has-submenu:hover .submenu {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateX(0);
        }
        
        .submenu a {
            display: block;
            padding: 6px 15px;
            text-decoration: none;
            color: #333;
            font-size: 13px;
            transition: all 0.2s;
        }
        
        .submenu a:hover {
            background-color: #f9f9f9;
            color: #d32f2f;
            padding-left: 20px;
        }
        
        /* Dropdown cho Sản phẩm - Kích thước vừa */
        .product-dropdown {
            width: 600px;
            display: flex;
            gap: 20px;
            padding: 15px;
        }
        
        .product-column {
            flex: 1;
        }
        
        .product-category {
            margin-bottom: 25px;
        }
        
        .category-title {
            font-weight: bold;
            font-size: 16px;
            color: #000;
            margin-bottom: 12px;
            padding-bottom: 5px;
            border-bottom: 2px solid #d32f2f;
        }
        
        .category-items {
            list-style: none;
        }
        
        .category-items li {
            margin-bottom: 8px;
        }
        
        .category-items a {
            display: block;
            padding: 6px 0;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: color 0.2s;
        }
        
        .category-items a:hover {
            color: #d32f2f;
        }

        .dropdown-title {
            font-weight: bold;
            font-size: 16px;
            color: #000;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 2px solid #d32f2f;
            padding-left: 15px;
            padding-right: 15px;
        }

        .dropdown-list {
            list-style: none;
        }

        .dropdown-list li {
            margin-bottom: 10px;
            position: relative;
        }

        .dropdown-list > li > a {
            display: block;
            padding: 8px 15px;
            text-decoration: none;
            color: #333;
            font-size: 14px;
            transition: all 0.2s;
        }

        .dropdown-list > li > a:hover {
            color: #d32f2f;
            padding-left: 20px;
        }

        /* Footer */
        footer {
            background-color: #222;
            color: white;
            padding: 50px 0 30px;
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        
        @media (max-width: 992px) {
            .footer-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 576px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }
        }
        
        .footer-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: white;
        }
        
        .footer-subtitle {
            font-size: 16px;
            color: #bbb;
            margin-bottom: 25px;
        }
        
        .contact-info {
            color: #bbb;
            line-height: 1.8;
            font-size: 14px;
        }
        
        .contact-info p {
            margin-bottom: 15px;
        }
        
        .contact-info i {
            margin-right: 10px;
            color: #d32f2f;
            width: 16px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 12px;
        }
        
        .footer-links a {
            color: #bbb;
            text-decoration: none;
            font-size: 14px;
        }
        
        .footer-links a:hover {
            color: #d32f2f;
        }
        
        .copyright {
            text-align: center;
            padding-top: 30px;
            margin-top: 40px;
            border-top: 1px solid #444;
            color: #bbb;
            font-size: 14px;
        }
        
        /* Back to Top Button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background-color: #d32f2f;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        
        .back-to-top.show {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background-color: #b71c1c;
            transform: translateY(-2px);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .container {
                width: 95%;
            }
            
            .header-content {
                flex-direction: column;
                gap: 15px;
                align-items: center;
            }
            
            .search-box {
                width: 100%;
                max-width: 500px;
            }
            
            .user-actions {
                flex-direction: column;
                gap: 10px;
                text-align: center;
            }
            
            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .dropdown-menu {
                position: static;
                width: 100%;
                box-shadow: none;
                border: none;
                display: none;
            }
            
            .fashion-dropdown {
                flex-direction: column;
                width: 100%;
            }
            
            .product-dropdown {
                flex-direction: column;
                width: 100%;
            }
            
            .submenu {
                position: static;
                box-shadow: none;
                border: none;
                display: none;
                padding-left: 20px;
            }
        }
    </style>
</head>
<body>
    <!-- Top Header -->
    <header class="top-header">
        <div class="container">
            <div class="header-content">
                <a href="{{ route('home') }}" class="logo">AL<span>ENA</span></a>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" placeholder="Tìm sản phẩm bạn mong muốn" id="globalSearchInput" autocomplete="off">
                    <div class="global-search-suggestions" id="globalSearchSuggestions"></div>
                </div>
                <div class="user-actions">
<div class="user-profile-section" style="position: relative;">
                        <a href="javascript:void(0)" id="settingsIcon">
                            <i class="fas fa-user-circle" style="font-size: 24px; color: #333; cursor: pointer;"></i>
                        </a>
                        
                        <!-- Auth Dropdown -->
                        <div id="authDropdown" class="auth-dropdown dropdown-menu" style="
                            position: absolute;
                            top: 100%; right: 0;
                            background: white;
                            border: 1px solid #ddd;
                            border-radius: 8px;
                            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                            min-width: 200px;
                            padding: 10px 0;
                            z-index: 1001;
                            font-size: 14px;
                        ">

                            @auth
                                <div style="padding: 12px 20px; border-bottom: 1px solid #eee; font-weight: bold; color: #333;">
                                    {{ auth()->user()->name }}
                                </div>
                                <a href="{{ route('profile.edit') }}" style="display: block; padding: 10px 20px; color: #333; text-decoration: none;">
                                    <i class="fas fa-edit"></i> Thông tin cá nhân
                                </a>
                                <a href="{{ route('orders') }}" style="display: block; padding: 10px 20px; color: #333; text-decoration: none;">
                                    <i class="fas fa-receipt"></i> Đơn hàng của tôi
                                </a>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0; padding: 0;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; color: #d32f2f; font-weight: 500; width: 100%; text-align: left; padding: 10px 20px; cursor: pointer;">
                                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" style="display: block; padding: 12px 20px; color: #333; text-decoration: none;">
                                    <i class="fas fa-sign-in-alt"></i> Đăng nhập
                                </a>
                                <a href="{{ route('register') }}" style="display: block; padding: 12px 20px; color: #333; text-decoration: none;">
                                    <i class="fas fa-user-plus"></i> Đăng ký
                                </a>
                            @endauth
                        </div>
                    </div>
                    <a href="{{ route('admin.dashboard') }}">Admin</a>
                    <a href="{{ route('orders') }}" class="cart-icon" title="Đơn hàng của tôi" style="position: relative;">
                        <i class="fas fa-cat"></i>
                    </a>
                    <a href="{{ route('cart') }}" class="cart-icon" id="cartIcon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count" id="cartCount">{{ session('cart') ? count(session('cart')) : 0 }}</span>
                    </a>
                    <div class="hotline"><i class="fas fa-phone-alt"></i> Hotline: 1900 6750</div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Navigation với menu ẩn phân cấp -->
    <nav class="main-nav">
        <div class="container nav-container">
            <ul class="nav-menu">

                <li><a href="{{ route('home') }}">Trang chủ</a></li>

                <!-- Thời trang Nam với dropdown -->
                <li class="has-dropdown">
                    <a href="#">Thời trang Nam</a>
                    <div class="dropdown-menu">
                        <div class="dropdown-title">Thời trang Nam</div>
                        <ul class="dropdown-list">
                            <li><a href="{{ url('/products/shirt') }}">Sơ mi nam</a></li>
                            <li class="has-submenu">
                                <a href="#">Sơ mi các loại</a>
                                <div class="submenu">
                                    <a href="{{ url('/products/shirt-short') }}">Sơ mi ngắn tay</a>
                                    <a href="{{ url('/products/shirt-long') }}">Sơ mi dài tay</a>
                                </div>
                            </li>
                            <li><a href="{{ url('/products/trousers') }}">Quần âu nam</a></li>
                            <li><a href="{{ url('/products/shorts') }}">Quần short nam</a></li>
                        </ul>
                    </div>
                </li>

                <!-- Sản phẩm với dropdown -->
                <li class="has-dropdown">
                    <a href="{{ route('shop') }}">Sản phẩm</a>
                    <div class="dropdown-menu">
                        <div class="dropdown-title">Sản phẩm</div>
                        <ul class="dropdown-list">
                            <li class="has-submenu">
                                <a href="{{ route('shop') }}">Sản phẩm nổi bật</a>
                                <div class="submenu">
                                    <a href="{{ route('shop') }}">Quần áo</a>
                                    <a href="{{ route('shop') }}">Phụ kiện</a>
                                    <a href="{{ route('shop') }}">Giầy dép</a>
                                </div>
                            </li>
                            <li class="has-submenu">
                                <a href="{{ route('shop') }}">Sản phẩm hot trend</a>
                                <div class="submenu">
                                    <a href="{{ route('shop') }}">Áo thun</a>
                                    <a href="{{ route('shop') }}">Quần jeans</a>
                                    <a href="{{ route('shop') }}">Áo khoác</a>
                                    <a href="{{ route('shop') }}">Túi xách</a>
                                </div>
                            </li>
                            <li class="has-submenu">
                                <a href="{{ route('shop') }}">Sản phẩm khuyến mãi</a>
                                <div class="submenu">
                                    <a href="{{ route('shop') }}">Giày thể thao</a>
                                    <a href="{{ route('shop') }}">Giày tây</a>
                                    <a href="{{ route('shop') }}">Dép nam</a>
                                    <a href="{{ route('shop') }}">Sale 50%</a>
                                </div>
                            </li>
                            <li><a href="{{ route('shop') }}">Bé gái</a></li>
                            <li><a href="{{ route('shop') }}">Bé trai</a></li>
                        </ul>
                    </div>
                </li>

                <li><a href="{{ route('shop') }}">Bé trai</a></li>
                <li><a href="{{ route('shop') }}">Bé gái</a></li>
                <li><a href="{{ route('news') }}">Tin tức</a></li>
                <li><a href="{{ route('contact') }}">Liên hệ</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-title">Alena</div>
                    <div class="footer-subtitle">Shop Thời trang và phụ kiện Alena</div>
                    <div class="contact-info">
                        <p><i class="fas fa-map-marker-alt"></i> Tầng 6, Tòa nhà Ladeco, 266 Đội Cấn, Phường Liễu Giai, Quận Ba Đình, TP Hà Nội</p>
                        <p><i class="far fa-clock"></i> Giờ làm việc: Từ 9:00 đến 22:00 các ngày trong tuần từ Thứ 2 đến Chủ nhật</p>
                        <p><i class="fas fa-phone-alt"></i> Hotline: 1900 6750</p>
                    </div>
                </div>
                
                <div>
                    <div class="footer-title">Về chúng tôi</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Trang chủ</a></li>
                        <li><a href="{{ route('shop') }}">Thời trang Nam</a></li>
                        <li><a href="{{ route('shop') }}">Sản phẩm</a></li>
                        <li><a href="{{ route('shop') }}">Bé trai</a></li>
                        <li><a href="{{ route('shop') }}">Bé gái</a></li>
                        <li><a href="{{ route('news') }}">Tin tức</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-title">Hỗ trợ khách hàng</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('size-guide') }}">Hướng dẫn chọn size</a></li>
                        <li><a href="{{ route('shipping-policy') }}">Chính sách giao hàng</a></li>
                        <li><a href="{{ route('return-policy') }}">Chính sách đổi trả</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ hỗ trợ</a></li>
                        <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                        <li><a href="{{ route('news') }}">Tin tức</a></li>
                        <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                    </ul>
                </div>

                <div>
                    <div class="footer-title">Dịch vụ</div>
                    <ul class="footer-links">
                        <li><a href="{{ route('shop') }}">Mua sắm online</a></li>
                        <li><a href="{{ route('cart') }}">Giỏ hàng</a></li>
                        <li><a href="{{ route('checkout') }}">Thanh toán</a></li>
                        <li><a href="{{ route('privacy-policy') }}">Chính sách bảo mật</a></li>
                        <li><a href="{{ route('shipping-policy') }}">Vận chuyển</a></li>
                        <li><a href="{{ route('return-policy') }}">Đổi trả</a></li>
                        <li><a href="{{ route('contact') }}">Hỗ trợ</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2023 Alena Fashion. Tất cả các quyền được bảo lưu.</p>
                <p style="margin-top: 10px;">Website: https://template-alena.net/#</p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop">
        <i class="fas fa-chevron-up"></i>
    </button>

    <script>
        // Global Search
        const globalSearchInput = document.getElementById('globalSearchInput');
        const globalSearchSuggestions = document.getElementById('globalSearchSuggestions');
        let globalDebounceTimer;

        if (globalSearchInput) {
            globalSearchInput.addEventListener('input', function() {
                clearTimeout(globalDebounceTimer);
                const query = this.value.trim();

                if (query.length < 2) {
                    globalSearchSuggestions.classList.remove('show');
                    return;
                }

                globalDebounceTimer = setTimeout(() => {
                    fetch(`{{ route('shop') }}?search=${encodeURIComponent(query)}&ajax=1`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.products && data.products.length > 0) {
                                let html = '';
                                data.products.forEach(product => {
                                    html += `<div class="global-suggestion-item" onclick="window.location.href='{{ url('/product') }}/${product.slug}'">${product.name}</div>`;
                                });
                                globalSearchSuggestions.innerHTML = html;
                                globalSearchSuggestions.classList.add('show');
                            } else {
                                globalSearchSuggestions.innerHTML = '<div class="global-suggestion-item">Không tìm thấy sản phẩm</div>';
                                globalSearchSuggestions.classList.add('show');
                            }
                        })
                        .catch(() => globalSearchSuggestions.classList.remove('show'));
                }, 300);
            });

            globalSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    window.location.href = `{{ route('shop') }}?search=${encodeURIComponent(this.value)}`;
                }
            });

            document.addEventListener('click', function(e) {
                if (!globalSearchInput.contains(e.target) && !globalSearchSuggestions.contains(e.target)) {
                    globalSearchSuggestions.classList.remove('show');
                }
            });
        }

        // Xử lý thêm vào giỏ hàng
        const cartCountElement = document.getElementById('cartCount');
        
        // Hàm cập nhật số lượng giỏ hàng
        function updateCartCount(count) {
            if (cartCountElement) {
                cartCountElement.textContent = count;
            }
        }
        
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                
                const productCard = this.closest('.product-card');
                const productName = productCard.querySelector('.product-name').textContent;
                const productPrice = productCard.querySelector('.current-price')?.textContent 
                    || productCard.querySelector('.contact-price')?.textContent;
                
                // Nếu là sản phẩm "Liên hệ"
                if (productPrice === "Liên hệ") {
                    alert(`Đã ghi nhận yêu cầu liên hệ cho sản phẩm "${productName}". Chúng tôi sẽ liên hệ với bạn sớm!`);
                    
                    this.textContent = "Đã ghi nhận";
                    this.style.backgroundColor = "#ff9900";
                    
                    setTimeout(() => {
                        this.textContent = "Liên hệ đặt hàng";
                        this.style.backgroundColor = "#333";
                    }, 2000);
                    return;
                }
                
                // Lấy product_id từ data attribute hoặc URL
                const productId = this.dataset.productId || this.getAttribute('href').split('/').pop();
                
                // Gọi API thêm vào giỏ hàng
                fetch('{{ route("cart.add") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: 1
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Cập nhật số lượng giỏ hàng
                        updateCartCount(data.cart_count);
                        
                        alert(`Đã thêm "${productName}" vào giỏ hàng!`);
                        
                        // Hiệu ứng thay đổi nút
                        this.textContent = "Đã thêm";
                        this.style.backgroundColor = "#27ae60";
                        
                        setTimeout(() => {
                            this.textContent = "Thêm vào giỏ hàng";
                            this.style.backgroundColor = "#333";
                        }, 2000);
                    } else {
                        alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Có lỗi xảy ra khi thêm sản phẩm vào giỏ hàng!');
                });
            });
        });
        
        // Back to Top Button
        const backToTopBtn = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Xử lý dropdown menu cho mobile
        document.querySelectorAll('.has-dropdown > a').forEach(link => {
            link.addEventListener('click', function(e) {
                // Kiểm tra nếu đang ở mobile (dropdown bị ẩn)
                if (window.innerWidth <= 992) {
                    e.preventDefault();
                    const dropdown = this.parentElement.querySelector('.dropdown-menu');
                    const isActive = this.parentElement.classList.contains('active');

                    // Đóng tất cả dropdown khác
                    document.querySelectorAll('.has-dropdown').forEach(item => {
                        item.classList.remove('active');
                        item.querySelector('.dropdown-menu').style.display = 'none';
                    });

                    // Toggle dropdown hiện tại
                    if (!isActive) {
                        this.parentElement.classList.add('active');
                        dropdown.style.display = 'block';
                    } else {
                        this.parentElement.classList.remove('active');
                        dropdown.style.display = 'none';
                    }
                }
            });
        });

        // Enhanced Auth Dropdown Toggle (Fixed click functionality)
        document.addEventListener('DOMContentLoaded', function() {
            const settingsIcon = document.getElementById('settingsIcon');
            const authDropdown = document.getElementById('authDropdown');
            
            if (settingsIcon && authDropdown) {
                // Toggle on icon click
                settingsIcon.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const isVisible = authDropdown.style.display === 'block';
                    authDropdown.style.display = isVisible ? 'none' : 'block';
                    authDropdown.classList.toggle('active', !isVisible);
                });
                
                // Prevent close when clicking inside dropdown
                authDropdown.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            }
            
            // Close on outside click
            document.addEventListener('click', function(e) {
                if (authDropdown && !e.target.closest('.user-profile-section')) {
                    authDropdown.style.display = 'none';
                    authDropdown.classList.remove('active');
                }
            });
            
            // Close on ESC key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && authDropdown.style.display === 'block') {
                    authDropdown.style.display = 'none';
                    authDropdown.classList.remove('active');
                }
            });
        });


        // Đóng dropdown khi click bên ngoài
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.has-dropdown') && window.innerWidth <= 992) {
                document.querySelectorAll('.has-dropdown').forEach(item => {
                    item.classList.remove('active');
                    item.querySelector('.dropdown-menu').style.display = 'none';
                });
            }
        });
    </script>
</body>
</html>
