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

        $products = $query->latest()->paginate(12);

        return view('products.index', compact('products', 'currentCategory'));
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