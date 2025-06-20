@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900 py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-gray-800 border-b border-gray-700">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-white">Profile Information</h2>
                    <div class="flex space-x-3">
                        <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                            Edit Profile
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 text-white border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-red-700 transition-colors duration-200">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

                @if (session('success'))
                    <div class="mb-4 bg-green-900 border border-green-700 text-green-200 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-white">Personal Information</h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300">Name</label>
                                <p class="mt-1 text-sm text-white">{{ $user->name }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300">Email</label>
                                <p class="mt-1 text-sm text-white">{{ $user->email }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300">Phone</label>
                                <p class="mt-1 text-sm text-white">{{ $user->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-medium text-white">Address Information</h3>
                        <div class="mt-4 space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-300">Address</label>
                                <p class="mt-1 text-sm text-white">{{ $user->address }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300">City</label>
                                <p class="mt-1 text-sm text-white">{{ $user->city }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300">State</label>
                                <p class="mt-1 text-sm text-white">{{ $user->state }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300">ZIP Code</label>
                                <p class="mt-1 text-sm text-white">{{ $user->zip_code }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-300">Country</label>
                                <p class="mt-1 text-sm text-white">{{ $user->country }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order History Section -->
                <div class="mt-12">
                    <h3 class="text-lg font-medium text-white mb-6">Order History</h3>
                    @if($user->orders->count() > 0)
                        <div class="space-y-6">
                            @foreach($user->orders()->with('items.product')->latest()->get() as $order)
                                <div class="bg-gray-700 rounded-lg p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <div>
                                            <h4 class="text-lg font-medium text-white">Order #{{ $order->id }}</h4>
                                            <p class="text-sm text-gray-300">{{ $order->created_at->format('F j, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-lg font-medium text-white">{{ $order->formatted_total }}</p>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($order->status === 'processing') bg-blue-100 text-blue-800
                                                @elseif($order->status === 'completed') bg-green-100 text-green-800
                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-gray-100 text-gray-800 @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 space-y-4">
                                        @foreach($order->items as $item)
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-16 h-16">
                                                    <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover rounded-md">
                                                </div>
                                                <div class="ml-4 flex-1">
                                                    <h5 class="text-sm font-medium text-white">{{ $item->product->name }}</h5>
                                                    <p class="text-sm text-gray-300">Qty: {{ $item->quantity }}</p>
                                                    <p class="text-sm text-gray-300">RM{{ number_format($item->price, 2) }} each</p>
                                                </div>
                                                <div class="ml-4 text-right">
                                                    <p class="text-sm font-medium text-white">RM{{ number_format($item->total, 2) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-4 pt-4 border-t border-gray-600">
                                        <a href="{{ route('orders.show', $order) }}" class="text-sm font-medium text-white hover:text-gray-300 transition-colors duration-200">
                                            View Order Details <span aria-hidden="true"> &rarr;</span>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-300">You haven't placed any orders yet.</p>
                            <a href="{{ route('products.index') }}" class="mt-4 inline-flex items-center px-4 py-2 bg-white text-gray-900 border border-transparent rounded-md font-semibold text-xs uppercase tracking-widest hover:bg-gray-200 transition-colors duration-200">
                                Start Shopping
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 