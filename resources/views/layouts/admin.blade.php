<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Shop Alena')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background-color: #343a40; }
        .sidebar .nav-link { color: #adb5bd; }
        .sidebar .nav-link:hover { color: white; }
        .sidebar .nav-link.active { color: white; background-color: #495057; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">Admin Panel</h4>
                    </div>
                    
                    <ul class="nav flex-column">
                                                        <li class="nav-item">
                                                            <a class="nav-link @if(Route::is('admin.orders')) active @endif" href="{{ route('admin.orders') }}">
                                                                <i class="fas fa-receipt me-2"></i>Đơn hàng
                                                            </a>
                                                        </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('admin.dashboard')) active @endif" href="{{ route('admin.dashboard') }}">
                                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('admin.products')) active @endif" href="{{ route('admin.products') }}">
                                    <i class="fas fa-box me-2"></i>Sản phẩm
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('admin.categories')) active @endif" href="{{ route('admin.categories') }}">
                                    <i class="fas fa-tags me-2"></i>Danh mục
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link @if(Route::is('admin.users')) active @endif" href="{{ route('admin.users') }}">
                                    <i class="fas fa-users me-2"></i>Người dùng
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.products', ['featured' => 1]) }}">
                                    <i class="fas fa-star me-2"></i>Sản phẩm nổi bật
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">
                                    <i class="fas fa-home me-2"></i>Về trang chủ
                                </a>
                            </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
                </div>

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>