<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $currentCategory = null;

        if ($request->has('category')) {
            $currentCategory = $request->category;
            $query->where('category', $currentCategory);
        }

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        // Handle sorting
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low_high':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high_low':
                $query->orderBy('price', 'desc');
                break;
            case 'name_az':
                $query->orderBy('name', 'asc');
                break;
            case 'name_za':
                $query->orderBy('name', 'desc');
                break;
            case 'featured':
                $query->where('is_featured', true)->orderBy('created_at', 'desc');
                break;
            default: // 'latest'
                $query->latest();
                break;
        }

        $products = $query->paginate(12);

        return view('products.index', compact('products', 'currentCategory', 'sort'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function featured()
    {
        $featuredProducts = Product::featured()->take(8)->get();
        return view('home', compact('featuredProducts'));
    }
} 