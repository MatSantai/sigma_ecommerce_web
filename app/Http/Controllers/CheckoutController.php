<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = auth()->user()->cart()->with('product')->get();
        $total = $cartItems->sum('total');

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string',
            'shipping_city' => 'required|string',
            'shipping_state' => 'required|string',
            'shipping_zip_code' => 'required|string',
            'shipping_country' => 'required|string',
            'payment_method' => 'required|in:credit_card,paypal'
        ]);

        $cartItems = auth()->user()->cart()->with('product')->get();
        $total = $cartItems->sum('total');

        try {
            DB::beginTransaction();

            $order = Order::create([
                'user_id' => auth()->id(),
                'total' => $total,
                'status' => 'pending',
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'shipping_address' => $request->shipping_address,
                'shipping_city' => $request->shipping_city,
                'shipping_state' => $request->shipping_state,
                'shipping_zip_code' => $request->shipping_zip_code,
                'shipping_country' => $request->shipping_country
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
            }

            auth()->user()->cart()->delete();

            DB::commit();

            return redirect()->route('orders.show', $order)->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }
} 