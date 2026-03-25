<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

// User Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/shop/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/product/{slug}', [HomeController::class, 'product'])->name('product');

// Product sub pages
Route::get('/products/shirt', function() {
    $products = \App\Models\Product::where('status', true)->where('name', 'like', '%sơ mi%')->get();
    return view('products.shirt', compact('products'));
});
Route::get('/products/shirt-short', function() {
    $products = \App\Models\Product::where('status', true)->where('name', 'like', '%ngắn tay%')->get();
    return view('products.shirt-short', compact('products'));
});
Route::get('/products/shirt-long', function() {
    $products = \App\Models\Product::where('status', true)->where('name', 'like', '%dài tay%')->get();
    return view('products.shirt-long', compact('products'));
});
Route::get('/products/trousers', function() {
    $products = \App\Models\Product::where('status', true)->where('name', 'like', '%quần âu%')->get();
    return view('products.trousers', compact('products'));
});
Route::get('/products/shorts', function() {
    $products = \App\Models\Product::where('status', true)->where('name', 'like', '%short%')->get();
    return view('products.shorts', compact('products'));
});

// Cart Routes - Yêu cầu đăng nhập
Route::get('/cart', [CartController::class, 'index'])->name('cart')->middleware('auth');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update')->middleware('auth');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove')->middleware('auth');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout')->middleware('auth');
Route::post('/checkout/process', [CartController::class, 'processCheckout'])->name('checkout.process')->middleware('auth');
Route::post('/checkout/save-info', [CartController::class, 'saveCheckoutInfo'])->name('checkout.save-info')->middleware('auth');
Route::get('/checkout/success', function() { return view('checkout-success'); })->name('checkout.success')->middleware('auth');

// Buy Now Routes DISABLED - Redirected to normal checkout flow
// Route::get('/buy-now', [CartController::class, 'buyNow'])->name('buy-now')->middleware('auth');
// Route::post('/buy-now/process', [CartController::class, 'processBuyNow'])->name('buy-now.process')->middleware('auth');
Route::get('/order-success/{order_code}', [OrderController::class, 'success'])->name('order.success')->middleware('auth');
Route::get('/orders', [OrderController::class, 'index'])->name('orders')->middleware('auth');

// Order Search & Cancel Routes - Yêu cầu đăng nhập
Route::get('/order/search', [OrderController::class, 'search'])->name('order.search')->middleware('auth');
Route::post('/order/cancel/{id}', [OrderController::class, 'cancel'])->name('order.cancel')->middleware('auth');

// News Routes
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Other Pages
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'submitContact'])->name('contact.submit');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/size-guide', [HomeController::class, 'sizeGuide'])->name('size-guide');
Route::get('/shipping-policy', [HomeController::class, 'shippingPolicy'])->name('shipping-policy');
Route::get('/return-policy', [HomeController::class, 'returnPolicy'])->name('return-policy');
Route::get('/privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// User Dashboard (after login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/account', [AuthController::class, 'account'])->name('account');
    Route::get('/account/orders', [AuthController::class, 'orders'])->name('account.orders');
    Route::get('/account/profile', [AuthController::class, 'profile'])->name('account.profile');
    Route::post('/account/profile', [AuthController::class, 'updateProfile'])->name('account.profile.update');
    Route::get('/account/addresses', [AuthController::class, 'addresses'])->name('account.addresses');
    Route::get('/account/wishlist', [AuthController::class, 'wishlist'])->name('account.wishlist');
});

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::delete('/categories/{id}', [AdminController::class, 'destroyCategory'])->name('categories.destroy');
    
    // Product Routes
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::post('/orders/{id}/status', [AdminController::class, 'updateOrderStatus'])->name('orders.updateStatus');
    Route::get('/customers', [AdminController::class, 'customers'])->name('customers');
    Route::get('/news', [AdminController::class, 'news'])->name('news');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});
