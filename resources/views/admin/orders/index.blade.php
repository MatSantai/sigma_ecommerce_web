@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-xl font-semibold text-white">Orders</h1>
                <p class="mt-2 text-sm text-gray-400">A list of all orders in the system.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mt-4 bg-green-500 text-white p-4 rounded-md">
                {{ session('success') }}
            </div>
        @endif

        <div class="mt-8 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-700">
                            <thead class="bg-gray-800">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-6">Order ID</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Customer</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Date</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Total</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-white">Status</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700 bg-gray-900">
                                @forelse($orders as $order)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-6">
                                            #{{ $order->id }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                            {{ $order->created_at->format('M d, Y H:i') }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                            RM{{ number_format($order->total, 2) }}
                                        </td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm">
                                            <span class="inline-flex rounded-full px-2 text-xs font-semibold leading-5 
                                                @if($order->status === 'completed') bg-green-100 text-green-800
                                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-blue-100 text-blue-800
                                                @endif">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-400 hover:text-blue-300">
                                                View Details
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-3 py-4 text-sm text-gray-300 text-center">
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection 