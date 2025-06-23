@extends('layouts.app')

@section('title', 'Shop')

@section('content')
<div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Shop Our Collection</h1>
            <p class="text-lg text-gray-400 max-w-2xl mx-auto">Discover our complete range of premium streetwear and accessories</p>
            <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Filters and Search -->
        <div class="bg-gray-800 rounded-2xl p-6 mb-8 shadow-xl">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
                <!-- Category Filters -->
                <div class="flex flex-wrap items-center space-x-2">
                    <span class="text-gray-300 font-medium mr-4">Categories:</span>
                    <a href="{{ route('products.index') }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ !$currentCategory ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white' }}">
                       All Products
                    </a>
                    <a href="{{ route('products.index', ['category' => 'men']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $currentCategory == 'men' ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white' }}">
                       Men's Collection
                    </a>
                    <a href="{{ route('products.index', ['category' => 'women']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $currentCategory == 'women' ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white' }}">
                       Women's Collection
                    </a>
                    <a href="{{ route('products.index', ['category' => 'accessories']) }}" 
                       class="px-4 py-2 rounded-full text-sm font-medium transition-all duration-200 {{ $currentCategory == 'accessories' ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-700 text-gray-300 hover:bg-gray-600 hover:text-white' }}">
                       Accessories
                    </a>
                </div>

                <!-- Search Form -->
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-2">
                    <div class="relative">
                        <input type="search" name="search" placeholder="Search products..." value="{{ request('search') }}"
                               class="w-full lg:w-80 px-4 py-3 pl-10 bg-gray-700 border border-gray-600 rounded-full text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                    <button type="submit" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-full font-medium transition-all duration-200 transform hover:scale-105 shadow-lg">
                        Search
                    </button>
                </form>
            </div>

            <!-- Active Filters Display -->
            @if($currentCategory || request('search'))
            <div class="mt-4 pt-4 border-t border-gray-700">
                <div class="flex items-center space-x-2">
                    <span class="text-gray-400 text-sm">Active filters:</span>
                    @if($currentCategory)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-600 text-white">
                        {{ ucfirst($currentCategory) }}
                        <a href="{{ route('products.index') }}" class="ml-2 hover:text-red-300">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                    @if(request('search'))
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-600 text-white">
                        Search: "{{ request('search') }}"
                        <a href="{{ route('products.index', ['category' => $currentCategory]) }}" class="ml-2 hover:text-red-300">
                            <i class="fas fa-times"></i>
                        </a>
                    </span>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Results Count -->
        <div class="flex items-center justify-between mb-8">
            <p class="text-gray-400">
                Showing <span class="text-white font-medium">{{ $products->count() }}</span> of <span class="text-white font-medium">{{ $products->total() }}</span> products
            </p>
            <div class="flex items-center space-x-2">
                <span class="text-gray-400 text-sm">Sort by:</span>
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center space-x-2">
                    <!-- Preserve existing filters -->
                    @if($currentCategory)
                        <input type="hidden" name="category" value="{{ $currentCategory }}">
                    @endif
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    
                    <select name="sort" onchange="this.form.submit()" class="bg-gray-800 border border-gray-700 text-white rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="latest" {{ $sort == 'latest' ? 'selected' : '' }}>Latest</option>
                        <option value="price_low_high" {{ $sort == 'price_low_high' ? 'selected' : '' }}>Price: Low to High</option>
                        <option value="price_high_low" {{ $sort == 'price_high_low' ? 'selected' : '' }}>Price: High to Low</option>
                        <option value="name_az" {{ $sort == 'name_az' ? 'selected' : '' }}>Name: A to Z</option>
                        <option value="name_za" {{ $sort == 'name_za' ? 'selected' : '' }}>Name: Z to A</option>
                    </select>
                </form>
            </div>
        </div>

        <!-- Product Grid -->
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($products as $product)
            <div class="group relative bg-gray-800 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2">
                <!-- Product Image Container -->
                <div class="relative overflow-hidden">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <img src="{{ $product->image }}" 
                             alt="{{ $product->name }}" 
                             class="w-full h-64 object-cover object-center group-hover:scale-110 transition-transform duration-500">
                    </a>
                    
                    <!-- Hover Overlay -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                        <div class="opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-4 group-hover:translate-y-0">
                            <a href="{{ route('products.show', $product->slug) }}" 
                               class="inline-flex items-center px-4 py-2 bg-white text-gray-900 rounded-full font-medium hover:bg-gray-100 transition-colors duration-200">
                                <i class="fas fa-eye mr-2"></i>
                                View Details
                            </a>
                        </div>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-gray-600 to-gray-700 text-white shadow-lg">
                            {{ ucfirst($product->category) }}
                        </span>
                    </div>

                    <!-- Quick Add to Cart -->
                    <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <button class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center shadow-lg transition-colors duration-200">
                            <i class="fas fa-shopping-cart"></i>
                        </button>
                    </div>

                    <!-- Featured Badge (if featured) -->
                    @if($product->is_featured)
                    <div class="absolute top-4 left-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-lg">
                            <i class="fas fa-star mr-1"></i>
                            Featured
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div class="p-6">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center">
                            <i class="fas fa-star text-yellow-400 text-sm"></i>
                            <span class="text-sm text-gray-400 ml-1">4.8</span>
                        </div>
                    </div>

                    <h3 class="text-lg font-semibold text-white mb-2 group-hover:text-blue-400 transition-colors duration-200">
                        <a href="{{ route('products.show', $product->slug) }}">
                            {{ $product->name }}
                        </a>
                    </h3>

                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">
                        Premium quality streetwear designed for modern fashion enthusiasts.
                    </p>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="text-2xl font-bold text-white">RM{{ number_format($product->price, 2) }}</span>
                            @if($product->price > 100)
                            <span class="text-sm text-gray-500 line-through">RM{{ number_format($product->price * 1.2, 2) }}</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-500 text-white">
                                -20%
                            </span>
                            @endif
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button class="w-8 h-8 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-full flex items-center justify-center transition-colors duration-200">
                                <i class="fas fa-heart"></i>
                            </button>
                            <button class="w-8 h-8 bg-gray-700 hover:bg-gray-600 text-gray-300 rounded-full flex items-center justify-center transition-colors duration-200">
                                <i class="fas fa-share-alt"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Stock Status -->
                    <div class="mt-4 pt-4 border-t border-gray-700">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-green-400 flex items-center">
                                <i class="fas fa-check-circle mr-1"></i>
                                In Stock
                            </span>
                            <span class="text-gray-400">Free Shipping</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            <div class="bg-gray-800 rounded-2xl p-6 shadow-xl">
                <div class="flex items-center justify-center">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>

        @else
        <!-- No Products Found -->
        <div class="text-center py-16">
            <div class="bg-gray-800 rounded-2xl p-12 max-w-md mx-auto">
                <i class="fas fa-search text-gray-600 text-6xl mb-6"></i>
                <h3 class="text-2xl font-bold text-white mb-4">No Products Found</h3>
                <p class="text-gray-400 mb-8">We couldn't find any products matching your criteria. Try adjusting your search or filters.</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-home mr-2"></i>
                    View All Products
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection 