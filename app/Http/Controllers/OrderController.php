<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();
        $total = $cartItems->sum('total');
        
        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'shipping_address' => 'required|string',
                'shipping_city' => 'required|string',
                'shipping_state' => 'required|string',
                'shipping_zip_code' => 'required|string',
                'shipping_country' => 'required|string',
                'payment_method' => 'required|string|in:credit_card,paypal',
            ]);

            $cartItems = auth()->user()->cart()->with('product')->get();
            
            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Your cart is empty.');
            }

            $total = $cartItems->sum('total');

            DB::beginTransaction();

            // Create order with payment status as 'paid' for dummy payment
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'processing', // Set initial status as processing
                'total' => $total,
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zip_code' => $request->shipping_zip_code,
                'shipping_country' => $request->shipping_country,
                'payment_method' => $request->payment_method,
                'payment_status' => 'paid', // Set payment status as paid
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'size' => $item->size,
                    'price' => $item->product->price,
                    'total' => $item->total
                ]);

                // Update product stock for specific size
                $productSize = $item->product->productSizes()->where('size', $item->size)->first();
                if ($productSize) {
                    $productSize->decrement('stock', $item->quantity);
                }
            }

            // Clear the cart
            auth()->user()->cart()->delete();

            DB::commit();

            return redirect()->route('profile.show')
                ->with('success', 'Order placed successfully! Thank you for your purchase.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $this->authorize('view', $order);
        return view('orders.show', compact('order'));
    }

    public function index()
    {
        $orders = auth()->user()->orders()->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }
} 