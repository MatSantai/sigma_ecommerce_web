@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div class="flex-1">
                    <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">Welcome to Sigma</h1>
                    <p class="mt-6 text-xl max-w-3xl text-gray-300">Discover our premium collection of clothing that defines modern style and comfort.</p>
                    <div class="mt-10">
                        <a href="{{ route('products.index') }}" class="inline-block bg-white text-gray-900 px-8 py-3 rounded-md font-medium hover:bg-gray-200 transition-colors duration-200">
                            Shop Now
                        </a>
                    </div>
                </div>
                <div class="mt-8 lg:mt-0 lg:ml-8">
                    <div class="bg-gray-800 rounded-lg p-6 text-center">
                        <div class="text-2xl font-bold text-white mb-2" id="current-time">Loading...</div>
                        <div class="text-sm text-gray-300" id="current-date">Loading...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            
            // Update time
            const timeString = now.toLocaleTimeString('en-US', {
                hour12: true,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.getElementById('current-time').textContent = timeString;
            
            // Update date
            const dateString = now.toLocaleDateString('en-US', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
            document.getElementById('current-date').textContent = dateString;
        }
        
        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>

    <!-- Featured Products -->
    <div class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-white mb-4">Featured Products</h2>
                <p class="text-lg text-gray-400 max-w-2xl mx-auto">Discover our handpicked collection of premium streetwear and accessories</p>
                <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 mx-auto mt-6 rounded-full"></div>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts as $product)
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

                        <!-- Featured Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gradient-to-r from-yellow-400 to-orange-500 text-white shadow-lg">
                                <i class="fas fa-star mr-1"></i>
                                Featured
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-2">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                {{ $product->category }}
                            </span>
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

            <!-- View All Products Button -->
            <div class="text-center mt-12">
                <a href="{{ route('products.index') }}" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <span>View All Products</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Featured Categories -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-3xl font-bold text-white mb-8">Shop by Category</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="relative group">
                <a href="{{ route('products.index', ['category' => 'men']) }}">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8" alt="Men's Collection" class="object-cover object-center group-hover:opacity-75">
                    </div>
                </a>
                <h3 class="mt-4 text-lg font-medium text-white">Men's Collection</h3>
                <a href="{{ route('products.index', ['category' => 'men']) }}" class="mt-2 text-sm text-gray-400 hover:text-white transition-colors duration-200">Shop Now →</a>
            </div>
            <div class="relative group">
                <a href="{{ route('products.index', ['category' => 'women']) }}">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1581044777550-4cfa60707c03" alt="Women's Collection" class="object-cover object-center group-hover:opacity-75">
                    </div>
                </a>
                <h3 class="mt-4 text-lg font-medium text-white">Women's Collection</h3>
                <a href="{{ route('products.index', ['category' => 'women']) }}" class="mt-2 text-sm text-gray-400 hover:text-white transition-colors duration-200">Shop Now →</a>
            </div>
            <div class="relative group">
                <a href="{{ route('products.index', ['category' => 'accessories']) }}">
                    <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-lg bg-gray-800">
                        <img src="https://images.unsplash.com/photo-1515886657613-9f3515b0c78f" alt="Accessories" class="object-cover object-center group-hover:opacity-75">
                    </div>
                </a>
                <h3 class="mt-4 text-lg font-medium text-white">Accessories</h3>
                <a href="{{ route('products.index', ['category' => 'accessories']) }}" class="mt-2 text-sm text-gray-400 hover:text-white transition-colors duration-200">Shop Now →</a>
            </div>
        </div>
    </div>

    <!-- Newsletter Section -->
    <div class="bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="px-6 py-6 bg-gray-800 rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
                <div class="xl:w-0 xl:flex-1">
                    <h2 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                        Stay updated with our latest collections
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-gray-300">
                        Sign up for our newsletter to receive updates on new arrivals and special offers.
                    </p>
                </div>
                <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                    <form class="sm:flex">
                        <label for="email-address" class="sr-only">Email address</label>
                        <input id="email-address" name="email" type="email" required 
                            class="w-full rounded-md border-gray-700 bg-gray-900 text-white px-5 py-3 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800" 
                            placeholder="Enter your email">
                        <button type="submit" 
                            class="mt-3 w-full flex items-center justify-center px-5 py-3 border border-transparent shadow text-base font-medium rounded-md text-white bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800 sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0 transition-colors duration-200">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
</div>

<!-- Welcome Popup Example -->
<div id="welcomePopup" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4">
        <div class="px-6 py-4 border-b border-gray-700 flex justify-between items-center">
            <h3 class="text-lg font-medium text-white">Welcome to Sigma Shop!</h3>
            <button onclick="closeWelcomePopup()" class="text-gray-400 hover:text-white text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="px-6 py-4">
            <p class="text-gray-300 mb-4">
                Welcome to our premium streetwear collection! Discover the latest trends and exclusive designs.
            </p>
            <div class="flex justify-end">
                <button onclick="closeWelcomePopup()" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-200">
                    Get Started
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Show welcome popup when page loads (only once)
    window.onload = function() {
        // Check if user has already seen the popup
        const hasSeenPopup = localStorage.getItem('hasSeenWelcomePopup');
        
        if (!hasSeenPopup) {
            // Show popup after 2 seconds only if they haven't seen it
            setTimeout(function() {
                showWelcomePopup();
            }, 2000);
        }
    };
    
    function showWelcomePopup() {
        document.getElementById('welcomePopup').classList.remove('hidden');
        // Mark that user has seen the popup
        localStorage.setItem('hasSeenWelcomePopup', 'true');
    }
    
    function closeWelcomePopup() {
        document.getElementById('welcomePopup').classList.add('hidden');
    }
    
    // Close popup when clicking outside
    document.getElementById('welcomePopup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeWelcomePopup();
        }
    });
    
    // Close popup with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeWelcomePopup();
        }
    });
</script>

@endsection 