<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // Quản lý đơn hàng - Fixed: Load items relation
    public function orders() {
        $orders = Order::with(['user', 'items'])->latest()->paginate(10);
        return view('admin.orders', compact('orders'));
    }
    
    // Cập nhật trạng thái đơn hàng
    public function updateOrderStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,shipping,completed,cancelled,optional,failed_delivery,refunded'
        ]);
        
        $oldStatus = $order->status;
        $newStatus = $request->status;
        
        $order->status = $newStatus;
        $order->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Cập nhật trạng thái đơn hàng thành công!',
            'old_status' => $oldStatus,
            'new_status' => $newStatus,
            'status_text' => $order->status_text
        ]);
    }
    
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $featuredProducts = Product::where('featured', true)->count();
        $users = User::latest()->take(10)->get();
        $categories = Category::latest()->take(10)->get();
        $products = Product::latest()->take(10)->get();
        $featuredList = Product::where('featured', true)->latest()->take(10)->get();
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalUsers', 'featuredProducts', 'users', 'categories', 'products', 'featuredList'));
    }

    // User CRUD
    public function users() {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
    public function destroyUser($id) {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('success', 'Đã xóa người dùng!');
    }

    // Category CRUD
    public function categories() {
        $categories = Category::all();
        return view('admin.categories', compact('categories'));
    }
    
    public function storeCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'slug' => 'nullable|string|max:255|unique:categories'
        ]);
        
        Category::create([
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
        ]);
        
        return redirect()->route('admin.categories')->with('success', 'Đã thêm danh mục mới!');
    }
    
    public function destroyCategory($id) {
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories')->with('success', 'Đã xóa danh mục!');
    }

    // Product CRUD
    public function products() {
        $products = Product::all();
        $categories = Category::all();
        $totalProducts = $products->count();
        $availableProducts = $products->where('status', 1)->count();
        $outOfStockProducts = $products->where('status', 0)->count();
        return view('admin.products', compact('products', 'categories', 'totalProducts', 'availableProducts', 'outOfStockProducts'));
    }
    public function destroyProduct($id) {
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products')->with('success', 'Đã xóa sản phẩm!');
    }

    // Thêm sản phẩm mới
    public function storeProduct(\Illuminate\Http\Request $request) {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);
        $product = Product::create($validated);
        if ($request->ajax()) {
            return response()->json(['success' => true, 'product' => $product]);
        }
        return redirect()->route('admin.products')->with('success', 'Đã thêm sản phẩm!');
    }
}
