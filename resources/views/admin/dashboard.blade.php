@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gray-900">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-500 bg-opacity-20">
                            <i class="fas fa-box text-2xl text-blue-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-300">Total Products</h3>
                            <p class="text-2xl font-bold text-white">{{ $stats['total_products'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-500 bg-opacity-20">
                            <i class="fas fa-shopping-cart text-2xl text-green-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-300">Total Orders</h3>
                            <p class="text-2xl font-bold text-white">{{ $stats['total_orders'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-500 bg-opacity-20">
                            <i class="fas fa-dollar-sign text-2xl text-yellow-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-300">Total Revenue</h3>
                            <p class="text-2xl font-bold text-white">RM{{ number_format($stats['total_revenue'], 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800 rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-500 bg-opacity-20">
                            <i class="fas fa-envelope text-2xl text-purple-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-gray-300">Unread Messages</h3>
                            <p class="text-2xl font-bold text-white">{{ \App\Models\Contact::unread()->count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Recent Orders -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Recent Orders</h2>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Order ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Customer</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Total</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($stats['recent_orders'] as $order)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-300">#{{ $order->id }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-300">{{ $order->user->name }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-300">RM{{ number_format($order->total, 2) }}</td>
                                    <td class="px-4 py-3 text-sm">
                                        <span class="px-2 py-1 text-xs rounded-full {{ $order->status === 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} text-white">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Low Stock Products -->
                <div class="bg-gray-800 rounded-lg p-6">
                    <h2 class="text-xl font-bold text-white mb-4">Low Stock Products</h2>
                    @if($stats['low_stock_products']->count() > 0)
                        <div class="space-y-4">
                            @foreach($stats['low_stock_products'] as $product)
                                <div class="border border-gray-700 rounded-lg p-4">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-12 h-12 rounded-lg object-cover">
                                            <div>
                                                <h3 class="text-white font-medium">{{ $product->name }}</h3>
                                                <p class="text-gray-400 text-sm">{{ ucfirst($product->category) }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="text-blue-500 hover:text-blue-400 text-sm font-medium">
                                            Update Stock
                                        </a>
                                    </div>
                                    
                                    <div class="space-y-2">
                                        <h4 class="text-gray-300 text-sm font-medium">Low Stock Sizes:</h4>
                                        <div class="grid grid-cols-2 gap-2">
                                            @foreach($product->productSizes as $productSize)
                                                @if($productSize->stock < 10)
                                                    <div class="flex items-center justify-between bg-gray-700 rounded px-3 py-2">
                                                        <span class="text-gray-300 text-sm">Size {{ $productSize->size }}</span>
                                                        <span class="text-{{ $productSize->stock <= 5 ? 'red' : 'yellow' }}-400 text-sm font-medium">
                                                            {{ $productSize->stock }} left
                                                            @if($productSize->stock <= 5)
                                                                <i class="fas fa-exclamation-triangle ml-1"></i>
                                                            @endif
                                                        </span>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-check-circle text-green-500 text-3xl mb-3"></i>
                            <p class="text-gray-400">All products have sufficient stock!</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8">
                <h2 class="text-xl font-bold text-white mb-4">Quick Actions</h2>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <a href="{{ route('admin.products.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white rounded-lg p-4 text-center transition">
                        <i class="fas fa-plus text-2xl mb-2"></i>
                        <span class="block font-medium">Add New Product</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="bg-green-500 hover:bg-green-600 text-white rounded-lg p-4 text-center transition">
                        <i class="fas fa-edit text-2xl mb-2"></i>
                        <span class="block font-medium">Manage Products</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg p-4 text-center transition">
                        <i class="fas fa-list text-2xl mb-2"></i>
                        <span class="block font-medium">View All Orders</span>
                    </a>
                    <a href="{{ route('admin.contacts.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white rounded-lg p-4 text-center transition">
                        <i class="fas fa-envelope text-2xl mb-2"></i>
                        <span class="block font-medium">Contact Messages</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 