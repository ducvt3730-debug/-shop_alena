<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->where('status', true)->firstOrFail();
        
        $products = Product::where('category_id', $category->id)
            ->where('status', true)
            ->paginate(12);
            
        $categories = Category::where('status', true)->get();
        
        return view('category', compact('category', 'products', 'categories'));
    }
}