@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Checkout</h1>
            <a href="{{ route('profile.show') }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                Back to Profile
            </a>
        </div>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mt-12 lg:grid lg:grid-cols-12 lg:gap-x-12 lg:items-start">
            <div class="lg:col-span-7">
                <form action="{{ route('orders.store') }}" method="POST" class="bg-gray-800 rounded-lg shadow-md p-6">
                    @csrf
                    <h2 class="text-xl font-semibold text-white mb-4">Shipping Information</h2>
                    
                    <div class="mb-4">
                        <label for="shipping_address" class="block text-gray-300 font-medium mb-2">Address</label>
                        <input type="text" name="shipping_address" id="shipping_address" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('shipping_address') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="shipping_city" class="block text-gray-300 font-medium mb-2">City</label>
                        <input type="text" name="shipping_city" id="shipping_city" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('shipping_city') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="shipping_state" class="block text-gray-300 font-medium mb-2">State</label>
                        <input type="text" name="shipping_state" id="shipping_state" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('shipping_state') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="shipping_zip_code" class="block text-gray-300 font-medium mb-2">ZIP Code</label>
                        <input type="text" name="shipping_zip_code" id="shipping_zip_code" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('shipping_zip_code') }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="shipping_country" class="block text-gray-300 font-medium mb-2">Country</label>
                        <input type="text" name="shipping_country" id="shipping_country" 
                               class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                               value="{{ old('shipping_country') }}" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-300 font-medium mb-2">Payment Method</label>
                        <div class="space-y-2">
                            <label class="flex items-center text-gray-300">
                                <input type="radio" name="payment_method" value="credit_card" 
                                       class="mr-2" {{ old('payment_method') == 'credit_card' ? 'checked' : '' }} required>
                                <span>Credit Card</span>
                            </label>
                            <label class="flex items-center text-gray-300">
                                <input type="radio" name="payment_method" value="paypal" 
                                       class="mr-2" {{ old('payment_method') == 'paypal' ? 'checked' : '' }} required>
                                <span>PayPal</span>
                            </label>
                        </div>
                    </div>

                    <button type="button" 
                            onclick="showOrderConfirmation()"
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200">
                        Place Order
                    </button>
                </form>
            </div>

            <div class="mt-10 lg:mt-0 lg:col-span-5">
                <div class="sticky top-6">
                    <h2 class="text-lg font-medium text-white">Order Summary</h2>

                    <div class="mt-4 bg-gray-800 border border-gray-700 rounded-lg shadow-sm">
                        <ul role="list" class="divide-y divide-gray-700">
                            @foreach($cartItems as $item)
                            <li class="flex py-6 px-4 sm:px-6">
                                <div class="flex-shrink-0">
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-20 rounded-md">
                                </div>

                                <div class="ml-6 flex-1 flex flex-col">
                                    <div class="flex">
                                        <div class="min-w-0 flex-1">
                                            <h4 class="text-sm">
                                                <a href="{{ route('products.show', $item->product) }}" class="font-medium text-gray-300 hover:text-white transition-colors duration-200">
                                                    {{ $item->product->name }}
                                                </a>
                                            </h4>
                                            <p class="mt-1 text-sm text-gray-400">Size: {{ $item->size }}</p>
                                            <p class="mt-1 text-sm text-gray-400">Quantity: {{ $item->quantity }}</p>
                                        </div>

                                        <div class="ml-4 flex-shrink-0 flow-root">
                                            <p class="text-sm font-medium text-white">RM{{ number_format($item->total, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        <div class="border-t border-gray-700 py-6 px-4 sm:px-6">
                            <div class="flex justify-between text-base font-medium text-white">
                                <p>Total</p>
                                <p>RM{{ number_format($total, 2) }}</p>
                            </div>
                            <p class="mt-0.5 text-sm text-gray-400">Shipping and taxes calculated at checkout.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Order Confirmation Dialog -->
<div id="orderConfirmationDialog" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
        <div class="px-6 py-4 border-b border-gray-700">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-medium text-white">Confirm Your Order</h3>
                <button onclick="hideOrderConfirmation()" class="text-gray-400 hover:text-white transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="px-6 py-4">
            <div class="space-y-4">
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-medium mb-2">Order Summary</h4>
                    <div class="space-y-2">
                        @foreach($cartItems as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-300">{{ $item->product->name }} ({{ $item->size }})</span>
                            <span class="text-white">RM{{ number_format($item->total, 2) }}</span>
                        </div>
                        @endforeach
                        <div class="border-t border-gray-600 pt-2 mt-2">
                            <div class="flex justify-between font-medium">
                                <span class="text-white">Total</span>
                                <span class="text-white">RM{{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-medium mb-2">Shipping Address</h4>
                    <p class="text-gray-300 text-sm" id="shippingAddressDisplay"></p>
                </div>
                
                <div class="bg-gray-700 rounded-lg p-4">
                    <h4 class="text-white font-medium mb-2">Payment Method</h4>
                    <p class="text-gray-300 text-sm" id="paymentMethodDisplay"></p>
                </div>
            </div>
        </div>
        
        <div class="px-6 py-4 border-t border-gray-700 flex space-x-3">
            <button onclick="hideOrderConfirmation()" class="flex-1 px-4 py-2 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-700 transition-colors duration-200">
                Cancel
            </button>
            <button onclick="submitOrder()" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                Confirm Order
            </button>
        </div>
    </div>
</div>

<script>
function showOrderConfirmation() {
    // Get form values
    const address = document.getElementById('shipping_address').value;
    const city = document.getElementById('shipping_city').value;
    const state = document.getElementById('shipping_state').value;
    const zipCode = document.getElementById('shipping_zip_code').value;
    const country = document.getElementById('shipping_country').value;
    
    // Get selected payment method
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
    
    // Validate form
    if (!address || !city || !state || !zipCode || !country) {
        alert('Please fill in all shipping information.');
        return;
    }
    
    if (!paymentMethod) {
        alert('Please select a payment method.');
        return;
    }
    
    // Display shipping address
    document.getElementById('shippingAddressDisplay').textContent = 
        `${address}, ${city}, ${state} ${zipCode}, ${country}`;
    
    // Display payment method
    document.getElementById('paymentMethodDisplay').textContent = 
        paymentMethod.value === 'credit_card' ? 'Credit Card' : 'PayPal';
    
    // Show dialog
    document.getElementById('orderConfirmationDialog').classList.remove('hidden');
}

function hideOrderConfirmation() {
    document.getElementById('orderConfirmationDialog').classList.add('hidden');
}

function submitOrder() {
    // Submit the form
    document.querySelector('form[action="{{ route("orders.store") }}"]').submit();
}
</script>
@endsection 