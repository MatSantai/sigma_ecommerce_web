@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">My Orders</h1>

            @if(session('success'))
                <div class="mt-4 bg-green-500 text-white p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-8 space-y-6">
                @forelse($orders as $order)
                    <div class="bg-gray-800 rounded-lg shadow overflow-hidden">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg leading-6 font-medium text-white">Order #{{ $order->id }}</h3>
                                    <p class="mt-1 max-w-2xl text-sm text-gray-400">Placed on {{ $order->created_at->format('F j, Y') }}</p>
                                </div>
                                <div class="text-right">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($order->status === 'processing') bg-blue-100 text-blue-800
                                        @elseif($order->status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-700 px-4 py-5 sm:px-6">
                            <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-400">Total Amount</dt>
                                    <dd class="mt-1 text-sm text-white">RM{{ number_format($order->total, 2) }}</dd>
                                </div>
                                <div class="sm:col-span-1">
                                    <dt class="text-sm font-medium text-gray-400">Items</dt>
                                    <dd class="mt-1 text-sm text-white">{{ $order->items->count() }} items</dd>
                                </div>
                            </dl>
                        </div>

                        <div class="border-t border-gray-700 px-4 py-5 sm:px-6">
                            <a href="{{ route('orders.show', $order) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                View Details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <p class="text-gray-400">You haven't placed any orders yet.</p>
                        <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Start Shopping
                        </a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection 