<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category',
        'image',
        'featured'
    ];

    protected $casts = [
        'featured' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function getStockForSize($size)
    {
        $productSize = $this->productSizes()->where('size', $size)->first();
        return $productSize ? $productSize->stock : 0;
    }

    public function getTotalStock()
    {
        return $this->productSizes()->sum('stock');
    }

    public function hasStockForSize($size)
    {
        return $this->getStockForSize($size) > 0;
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getSizesInOrder()
    {
        $sizeOrder = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];
        
        return $this->productSizes()
            ->get()
            ->sortBy(function ($productSize) use ($sizeOrder) {
                $index = array_search(strtoupper($productSize->size), array_map('strtoupper', $sizeOrder));
                return $index !== false ? $index : 999; // Put unknown sizes at the end
            });
    }
} 