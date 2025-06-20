<!DOCTYPE html>
<html class="scroll-smooth" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sigma Shop - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Farro&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: "Farro", Helvetica, sans-serif;
            background-color: #121212;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen text-white">
    <!-- Navigation -->
    <nav class="bg-gray-900 shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo Section -->
                <div class="flex items-center">
                    <a href="/" class="text-2xl font-bold text-white">SIGMA</a>
                </div>
                
                <!-- Center Navigation Section -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-300 hover:text-white">Home</a>
                    <a href="/products" class="text-gray-300 hover:text-white">Shop</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                        @endif
                    @endauth
                </div>
                
                <!-- Right Section - Cart and User Actions -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/cart" class="text-gray-300 hover:text-white relative">
                        <i class="fas fa-shopping-cart"></i>
                        @auth
                            @php
                                $cartCount = auth()->user()->cart()->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        @endauth
                    </a>
                    @auth
                        <a href="/profile" class="text-gray-300 hover:text-white">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="/login" class="text-gray-300 hover:text-white">Login</a>
                        <a href="/register" class="text-gray-300 hover:text-white">Register</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button type="button" class="text-gray-300 hover:text-white focus:outline-none focus:text-white" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="md:hidden hidden" id="mobile-menu">
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <a href="/" class="block px-3 py-2 text-gray-300 hover:text-white">Home</a>
                    <a href="/products" class="block px-3 py-2 text-gray-300 hover:text-white">Shop</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 text-gray-300 hover:text-white">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                        @endif
                    @endauth
                    <a href="/cart" class="block px-3 py-2 text-gray-300 hover:text-white relative">
                        <i class="fas fa-shopping-cart"></i>
                        @auth
                            @php
                                $cartCount = auth()->user()->cart()->sum('quantity');
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        @endauth
                    </a>
                    @auth
                        <a href="/profile" class="block px-3 py-2 text-gray-300 hover:text-white">
                            <i class="fas fa-user"></i>
                        </a>
                    @else
                        <a href="/login" class="block px-3 py-2 text-gray-300 hover:text-white">Login</a>
                        <a href="/register" class="block px-3 py-2 text-gray-300 hover:text-white">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow bg-gray-900">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-center py-6 mt-auto">
        <p class="text-sm sm:text-base">
            © 2025 Sigma Shop. All rights reserved.
        </p>
    </footer>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }
    </script>
</body>
</html> 