@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-3xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Order Details</h1>
                <div class="flex space-x-3">
                    <button onclick="printReceipt()" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
                        <i class="fas fa-print mr-2"></i>
                        Print Receipt
                    </button>
                <a href="{{ route('profile.show') }}" class="bg-gray-700 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Back to Profile
                </a>
                </div>
            </div>

            <!-- Print-friendly receipt -->
            <div id="printable-receipt" class="hidden print:block">
                <div class="bg-white text-black p-8 max-w-2xl mx-auto">
                    <!-- Receipt Header -->
                    <div class="text-center border-b-2 border-gray-300 pb-4 mb-6">
                        <h1 class="text-3xl font-bold text-gray-800">SIGMA SHOP</h1>
                        <p class="text-gray-600 mt-2">Premium Clothing Collection</p>
                        <p class="text-gray-600">Order Receipt</p>
                    </div>

                    <!-- Order Information -->
                    <div class="mb-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">Order #{{ $order->id }}</h2>
                                <p class="text-gray-600">Date: {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                                <p class="text-gray-600">Status: {{ ucfirst($order->status) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-600">Customer: {{ $order->user->name }}</p>
                                <p class="text-gray-600">Email: {{ $order->user->email }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Shipping Information -->
                    <div class="mb-6 border-b border-gray-300 pb-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">Shipping Address</h3>
                        <p class="text-gray-700">{{ $order->shipping_address }}</p>
                        <p class="text-gray-700">{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip_code }}</p>
                        <p class="text-gray-700">{{ $order->shipping_country }}</p>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Order Items</h3>
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="border-b-2 border-gray-300">
                                    <th class="text-left py-2 text-gray-800">Item</th>
                                    <th class="text-center py-2 text-gray-800">Size</th>
                                    <th class="text-center py-2 text-gray-800">Qty</th>
                                    <th class="text-right py-2 text-gray-800">Price</th>
                                    <th class="text-right py-2 text-gray-800">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr class="border-b border-gray-200">
                                    <td class="py-3 text-gray-700">
                                        <div class="flex items-center">
                                            <img class="h-12 w-12 rounded object-cover mr-3" src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                            <span class="font-medium">{{ $item->product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="py-3 text-center text-gray-700">{{ $item->size }}</td>
                                    <td class="py-3 text-center text-gray-700">{{ $item->quantity }}</td>
                                    <td class="py-3 text-right text-gray-700">RM{{ number_format($item->price, 2) }}</td>
                                    <td class="py-3 text-right font-medium text-gray-800">RM{{ number_format($item->total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Order Summary -->
                    <div class="border-t-2 border-gray-300 pt-4">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-gray-600">Payment Method: {{ ucfirst($order->payment_method) }}</p>
                                <p class="text-gray-600">Payment Status: {{ ucfirst($order->payment_status) }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-gray-800">Total: RM{{ number_format($order->total, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="mt-8 text-center text-gray-600 text-sm">
                        <p>Thank you for your purchase!</p>
                        <p>For any questions, please contact our customer support.</p>
                        <p class="mt-4">Printed on {{ now()->format('F j, Y \a\t g:i A') }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-gray-800 rounded-lg shadow overflow-hidden">
                <!-- Order Header -->
                <div class="px-4 py-5 sm:px-6 border-b border-gray-700">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-lg leading-6 font-medium text-white">Order #{{ $order->id }}</h3>
                            <p class="mt-1 text-sm text-gray-400">Placed on {{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
                        </div>
                        <div class="px-3 py-1 rounded-full text-sm font-medium
                            @if($order->status === 'processing') bg-blue-100 text-blue-800
                            @elseif($order->status === 'completed') bg-green-100 text-green-800
                            @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($order->status) }}
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="px-4 py-5 sm:px-6 border-b border-gray-700">
                    <h3 class="text-lg font-medium text-white mb-4">Order Summary</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-400">Total Amount</p>
                            <p class="text-lg font-medium text-white">RM{{ number_format($order->total, 2) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Payment Method</p>
                            <p class="text-lg font-medium text-white">{{ ucfirst($order->payment_method) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Payment Status</p>
                            <p class="text-lg font-medium text-white">{{ ucfirst($order->payment_status) }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Items</p>
                            <p class="text-lg font-medium text-white">{{ $order->items->count() }} items</p>
                        </div>
                    </div>
                </div>

                <!-- Shipping Information -->
                <div class="px-4 py-5 sm:px-6 border-b border-gray-700">
                    <h3 class="text-lg font-medium text-white mb-4">Shipping Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-400">Address</p>
                            <p class="text-white">{{ $order->shipping_address }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">City</p>
                            <p class="text-white">{{ $order->shipping_city }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">State</p>
                            <p class="text-white">{{ $order->shipping_state }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">ZIP Code</p>
                            <p class="text-white">{{ $order->shipping_zip_code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-400">Country</p>
                            <p class="text-white">{{ $order->shipping_country }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order Items -->
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg font-medium text-white mb-4">Order Items</h3>
                    <ul role="list" class="divide-y divide-gray-700">
                        @foreach($order->items as $item)
                            <li class="py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-16 w-16 rounded-md object-cover" src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <h4 class="text-sm font-medium text-white">{{ $item->product->name }}</h4>
                                            <p class="mt-1 text-sm text-gray-400">Size: {{ $item->size }}</p>
                                            <p class="mt-1 text-sm text-gray-400">Quantity: {{ $item->quantity }}</p>
                                            <p class="mt-1 text-sm text-gray-400">Price: RM{{ number_format($item->price, 2) }} each</p>
                                        </div>
                                    </div>
                                    <div class="ml-4 text-right">
                                        <p class="text-sm font-medium text-white">RM{{ number_format($item->total, 2) }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <!-- Order Total -->
                    <div class="mt-6 border-t border-gray-700 pt-6">
                        <div class="flex justify-between text-base font-medium text-white">
                            <p>Total</p>
                            <p>RM{{ number_format($order->total, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        body * {
            visibility: hidden !important;
        }
        #printable-receipt, #printable-receipt * {
            visibility: visible !important;
        }
        #printable-receipt {
            position: absolute !important;
            left: 0 !important;
            top: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: white !important;
            color: black !important;
        }
        .print\:block {
            display: block !important;
        }
    }
</style>

<script>
    function printReceipt() {
        window.print();
    }
</script>
@endsection 