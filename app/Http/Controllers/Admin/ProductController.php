<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->get();
        $categories = Category::where('status', true)->get();
        $totalProducts = Product::count();
        $availableProducts = Product::where('stock', '>', 0)->count();
        $outOfStockProducts = Product::where('stock', '<=', 0)->count();
        
        return view('admin.products', compact('products', 'categories', 'totalProducts', 'availableProducts', 'outOfStockProducts'));
    }

    public function store(Request $request)
    {
        // Kiểm tra giới hạn 100 sản phẩm
        $productCount = Product::count();
        if ($productCount >= 100) {
            return response()->json([
                'success' => false, 
                'message' => 'Đã đạt giới hạn 100 sản phẩm. Vui lòng xóa sản phẩm cũ trước khi thêm mới.'
            ], 400);
        }

        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'status' => 'required|boolean'
            ]);

            $product = Product::create([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']) . '-' . time(),
                'description' => $validated['description'] ?? '',
                'price' => $validated['price'],
                'sale_price' => null,
                'image' => 'istockphoto-1278802435-612x612.jpg',
                'stock' => $validated['quantity'],
                'category_id' => $validated['category_id'],
                'status' => $validated['status'],
                'featured' => false
            ]);

            return response()->json(['success' => true, 'product' => $product, 'message' => 'Thêm sản phẩm thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json(['success' => true, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'category_id' => 'required|exists:categories,id',
                'price' => 'required|numeric|min:0',
                'quantity' => 'required|integer|min:0',
                'description' => 'nullable|string',
                'status' => 'required|boolean'
            ]);

            $product->update([
                'name' => $validated['name'],
                'slug' => Str::slug($validated['name']) . '-' . $product->id,
                'description' => $validated['description'] ?? '',
                'price' => $validated['price'],
                'stock' => $validated['quantity'],
                'category_id' => $validated['category_id'],
                'status' => $validated['status']
            ]);

            return response()->json(['success' => true, 'product' => $product, 'message' => 'Cập nhật sản phẩm thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            
            return response()->json(['success' => true, 'message' => 'Xóa sản phẩm thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Lỗi: ' . $e->getMessage()], 500);
        }
    }
}
