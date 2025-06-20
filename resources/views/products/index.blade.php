@extends('layouts.app')

@section('title', 'Shop')

@section('content')
    <div class="flex items-baseline justify-between border-b border-gray-700 pb-6">
        <h1 class="text-4xl font-extrabold tracking-tight text-white">Shop</h1>
    </div>

    <!-- Filters -->
    <div class="pt-6 pb-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-6">
                <a href="{{ route('products.index') }}" 
                   class="text-sm font-medium transition-colors duration-200 {{ !$currentCategory ? 'text-white border-b-2 border-blue-500' : 'text-gray-400 hover:text-white' }}">
                   All Products
                </a>
                <a href="{{ route('products.index', ['category' => 'men']) }}" 
                   class="text-sm font-medium transition-colors duration-200 {{ $currentCategory == 'men' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400 hover:text-white' }}">
                   Men
                </a>
                <a href="{{ route('products.index', ['category' => 'women']) }}" 
                   class="text-sm font-medium transition-colors duration-200 {{ $currentCategory == 'women' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400 hover:text-white' }}">
                   Women
                </a>
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" 
                   class="text-sm font-medium transition-colors duration-200 {{ $currentCategory == 'accessories' ? 'text-white border-b-2 border-blue-500' : 'text-gray-400 hover:text-white' }}">
                   Accessories
                </a>
            </div>

            <!-- Search Form -->
            <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                <input type="search" name="search" placeholder="Search products..." value="{{ request('search') }}"
                       class="w-full max-w-xs px-4 py-2 bg-gray-800 border border-gray-700 rounded-l-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Product grid -->
    <div class="mt-6 grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        @foreach($products as $product)
        <div class="group relative">
            <a href="{{ route('products.show', $product->slug) }}">
                <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="h-full w-full object-cover object-center group-hover:opacity-75">
                </div>
            </a>
            <div class="mt-4 flex justify-between">
                <div>
                    <h3 class="text-sm text-gray-300">
                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-white transition-colors duration-200">
                            {{ $product->name }}
                        </a>
                    </h3>
                    <p class="mt-1 text-sm text-gray-400">{{ $product->category }}</p>
                </div>
                <p class="text-sm font-medium text-white">RM{{ number_format($product->price, 2) }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8 text-white">
        {{ $products->appends(request()->query())->links() }}
    </div>
@endsection 