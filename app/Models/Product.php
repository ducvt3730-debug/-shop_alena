<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'sale_price', 
        'image', 'gallery', 'stock', 'category_id', 'featured', 'status'
    ];

    protected $casts = [
        'gallery' => 'array',
        'featured' => 'boolean',
        'status' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}