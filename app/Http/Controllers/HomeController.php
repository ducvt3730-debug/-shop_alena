<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', true)->orWhereNull('featured')->inRandomOrder()->take(8)->get();
        $onsaleProducts = Product::whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price')->take(6)->get();
        $hotProducts = Product::where('featured', true)->take(6)->get();
        $newProducts = Product::orderBy('created_at', 'desc')->take(6)->get();
        $goodPriceProducts = Product::whereNotNull('sale_price')->take(6)->get();
        $categories = Category::where('status', true)->take(6)->get();
        
        // Static news data
        $news = [
            [
                'title' => 'Cách phối đồ hè nam',
                'author' => 'Cafein Team',
                'date' => '27/05/2022',
                'desc' => '1. Sơ mi hoa tiết + quần denim + giày sneaker. Hãy tranh thủ những ngày hè để diện ngay chiếc áo sơ mi hoa tiết cá tính...',
                'link' => route('news')
            ],
            [
                'title' => 'Cách phối đồ với quần thể thao nam',
                'author' => 'Cafein Team',
                'date' => '27/05/2022',
                'desc' => '1. Quần jogger thể thao phối với áo khoác da. Nếu bạn nghĩ rằng áo khoác da chỉ có thể kết hợp với quần jeans...',
                'link' => route('news')
            ],
            [
                'title' => 'Cách phối đồ sơ mi nam',
                'author' => 'Cafein Team',
                'date' => '27/05/2022',
                'desc' => '1. Quần jean ống đứng. Cách phối đồ với áo sơ mi nam đầu tiên mà chúng tôi gợi ý cho các bạn là mix áo sơ mi với quần jean...',
                'link' => route('news')
            ]
        ];
        
        return view('home', compact(
            'featuredProducts', 'onsaleProducts', 'categories',
            'hotProducts', 'newProducts', 'goodPriceProducts', 'news'
        ));
    }

    public function shop(Request $request)
    {
        $query = Product::where('status', true);
        
        // Lọc theo danh mục
        if ($request->has('category') && $request->category) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }
        
        // Tìm kiếm
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Nếu là AJAX request, trả về JSON cho suggestions
        if ($request->ajax || $request->has('ajax')) {
            $products = $query->select('id', 'name', 'slug')->limit(5)->get();
            return response()->json(['products' => $products]);
        }
        
        // Lọc theo giá
        if ($request->has('min_price') && $request->min_price) {
            $query->where('price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price) {
            $query->where('price', '<=', $request->max_price);
        }
        
        // Tìm kiếm
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        // Sắp xếp
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->get();
        $categories = Category::where('status', true)->get();
        
        return view('shop', compact('products', 'categories'));
    }

    public function product($slug)
    {
        $product = Product::where('slug', $slug)->where('status', true)->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', true)
            ->limit(8)
            ->latest()
            ->get();
            
        return view('product', compact('product', 'relatedProducts'));
    }
    
    public function contact()
    {
        return view('contact');
    }
    
    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);
        
        // Gửi email (có thể implement sau)
        // Mail::to('admin@alena.com')->send(new ContactMail($request->all()));
        
        return back()->with('success', 'Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi sớm nhất có thể.');
    }
    
    public function about()
    {
        return view('about');
    }
    
    public function sizeGuide()
    {
        return view('size-guide');
    }
    
    public function shippingPolicy()
    {
        return view('shipping-policy');
    }
    
    public function returnPolicy()
    {
        return view('return-policy');
    }
    
    public function privacyPolicy()
    {
        return view('privacy-policy');
    }
    
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        
        // Lưu email vào database hoặc gửi đến service email marketing
        // Newsletter::create(['email' => $request->email]);
        
        return response()->json([
            'success' => true,
            'message' => 'Cảm ơn bạn đã đăng ký nhận tin!'
        ]);
    }
}