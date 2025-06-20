<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Get products with low stock (any size with less than 10 items)
        $lowStockProducts = Product::whereHas('productSizes', function($query) {
            $query->where('stock', '<', 10);
        })->with('productSizes')->get();

        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::where('payment_status', 'paid')->sum('total'),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
            'low_stock_products' => $lowStockProducts,
        ];

        return view('admin.dashboard', compact('stats'));
    }
} 