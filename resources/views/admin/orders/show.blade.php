@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="md:flex md:items-center md:justify-between">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-white sm:text-3xl sm:truncate">
                    Order #{{ $order->id }}
                </h2>
            </div>
            <div class="mt-4 flex md:mt-0 md:ml-4">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-700 rounded-md shadow-sm text-sm font-medium text-gray-300 bg-gray-800 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Back to Orders
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-4 bg-green-500 text-white p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <!-- Order Information -->
            <div class="bg-gray-800 shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-white">Order Information</h3>
                    <div class="mt-5 border-t border-gray-700">
                        <dl class="divide-y divide-gray-700">
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-300">Customer</dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $order->user->name }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-300">Email</dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $order->user->email }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-300">Order Date</dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</dd>
                            </div>
                            <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                <dt class="text-sm font-medium text-gray-300">Status</dt>
                                <dd class="mt-1 text-sm text-white sm:mt-0 sm:col-span-2">
                                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center space-x-4">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-700 bg-gray-900 text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md">
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Update
                                        </button>
                                    </form>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="bg-gray-800 shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-white">Order Summary</h3>
                    <div class="mt-5">
                        <div class="flow-root">
                            <ul role="list" class="-my-5 divide-y divide-gray-700">
                                @foreach($order->items as $item)
                                    <li class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex-shrink-0">
                                                <img class="h-12 w-12 rounded-md object-cover" src="{{ $item->product->image }}" alt="{{ $item->product->name }}">
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-white truncate">
                                                    {{ $item->product->name }}
                                                </p>
                                                <p class="text-sm text-gray-400">
                                                    Size: {{ $item->size }} | Quantity: {{ $item->quantity }}
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0 text-sm text-white">
                                                RM{{ number_format($item->total, 2) }}
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
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
</div>
@endsection 