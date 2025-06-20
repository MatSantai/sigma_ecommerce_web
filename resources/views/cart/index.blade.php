@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Shopping Cart</h1>

        @if($cartItems->count() > 0)
            <div class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
                <div class="lg:col-span-7">
                    <div class="border-t border-gray-700 pt-10">
                        <ul role="list" class="divide-y divide-gray-700">
                            @foreach($cartItems as $item)
                            <li class="flex py-6 sm:py-10">
                                <div class="flex-shrink-0">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-24 h-24 rounded-md object-center object-cover sm:w-32 sm:h-32">
                                </div>

                                <div class="ml-4 flex-1 flex flex-col sm:ml-6">
                                    <div>
                                        <div class="flex justify-between">
                                            <h4 class="text-sm">
                                                <a href="{{ route('products.show', $item->product) }}" class="font-medium text-white hover:text-gray-300 transition-colors duration-200">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h4>
                                            <p class="ml-4 text-sm font-medium text-white">RM{{ number_format($item->total, 2) }}</p>
                                        </div>
                                        <p class="mt-1 text-sm text-gray-400">Size: {{ $item->size }}</p>
                                        <p class="mt-1 text-sm text-gray-400">{{ $item->product->category }}</p>
                                    </div>

                                    <div class="mt-4 flex-1 flex items-end justify-between">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center">
                                                <label for="quantity-{{ $item->id }}" class="mr-2 text-sm text-gray-300">Quantity:</label>
                                                @php
                                                    $productSize = $item->product->productSizes->where('size', $item->size)->first();
                                                    $maxStock = $productSize ? $productSize->stock : 0;
                                                @endphp
                                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input 
                                                        type="number" 
                                                        name="quantity" 
                                                        id="quantity-{{ $item->id }}" 
                                                        value="{{ $item->quantity }}"
                                                        min="1" 
                                                        max="{{ $maxStock }}"
                                                        class="w-20 rounded-md border-gray-700 bg-gray-800 text-white py-1.5 px-2 text-base leading-5 focus:border-blue-500 focus:outline-none focus:ring-blue-500 sm:text-sm transition-colors duration-200 text-center"
                                                        onchange="this.form.submit()"
                                                        onblur="this.form.submit()"
                                                    >
                                                </form>
                                            </div>
                                        </div>

                                        <div class="flex">
                                            <form action="{{ route('cart.remove', $item) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="font-medium text-red-400 hover:text-red-300 transition-colors duration-200">
                                                    <i class="fas fa-trash mr-1"></i>Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="mt-10 lg:mt-0 lg:col-span-5">
                    <div class="sticky top-6">
                        <h2 class="text-lg font-medium text-white">Order Summary</h2>

                        <div class="mt-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                            <div class="border-t border-gray-700 py-6 px-4 sm:px-6">
                                <div class="flex justify-between text-base font-medium text-white">
                                    <p>Subtotal</p>
                                    <p>RM{{ number_format($cartItems->sum('total'), 2) }}</p>
                                </div>
                                <p class="mt-0.5 text-sm text-gray-400">Shipping and taxes calculated at checkout.</p>
                                <div class="mt-6">
                                    <a href="{{ route('orders.checkout') }}" class="flex justify-center items-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-gray-900 bg-white hover:bg-gray-200 transition-colors duration-200">
                                        Checkout
                                    </a>
                                </div>
                                <div class="mt-6 flex justify-center text-sm text-center text-gray-400">
                                    <p>
                                        or
                                        <a href="{{ route('products.index') }}" class="text-white font-medium hover:text-gray-300 transition-colors duration-200">
                                            Continue Shopping<span aria-hidden="true"> &rarr;</span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-300">Your cart is empty.</p>
                <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</div>
@endsection 