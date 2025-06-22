<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    public function add(Product $product, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'size' => 'required|string|in:' . implode(',', $product->productSizes()->pluck('size')->toArray())
        ]);

        // Get stock for the specific size
        $stockForSize = $product->getStockForSize($request->size);
        
        // Validate quantity against size-specific stock
        if ($request->quantity > $stockForSize) {
            return back()->withErrors(['quantity' => "Only {$stockForSize} items available in size {$request->size}."]);
        }

        $existingCartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->where('size', $request->size)
            ->first();

        if ($existingCartItem) {
            $newQuantity = $existingCartItem->quantity + $request->quantity;
            if ($newQuantity > $stockForSize) {
                return back()->withErrors(['quantity' => "Cannot add more items. Only {$stockForSize} items available in size {$request->size}."]);
            }
            $existingCartItem->quantity = $newQuantity;
            $existingCartItem->save();
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'size' => $request->size
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully.');
    }

    public function remove(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully.');
    }

    public function update(Cart $cart, Request $request)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Get stock for the specific size
        $stockForSize = $cart->product->getStockForSize($cart->size);
        
        // Validate quantity against size-specific stock
        if ($request->quantity > $stockForSize) {
            return back()->withErrors(['quantity' => "Only {$stockForSize} items available in size {$cart->size}."]);
        }

        $cart->quantity = $request->quantity;
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }
} 