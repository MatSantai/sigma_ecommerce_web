<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sigma - Premium Streetwear</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-gray-100 dark:bg-gray-900">
        <div class="relative min-h-screen">
            <!-- Navigation -->
            <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <a href="{{ route('welcome') }}" class="text-2xl font-bold text-gray-800 dark:text-white">
                                    SIGMA
                                </a>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('products.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                Shop
                            </a>
                            <a href="{{ route('cart.index') }}" class="inline-flex items-center px-1 pt-1 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out">
                                Cart
                            </a>
                        </div>

                        <!-- Right Side -->
                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            @auth
                                <div class="flex items-center space-x-4">
                                    <a href="{{ route('profile.show') }}" class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-sm text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white">Logout</button>
                                    </form>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-300 underline">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-300 underline">Register</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Hero Section -->
            <div class="relative bg-white dark:bg-gray-800 overflow-hidden">
                <div class="max-w-7xl mx-auto">
                    <div class="relative z-10 pb-8 bg-white dark:bg-gray-800 sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
                        <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                            <div class="sm:text-center lg:text-left">
                                <h1 class="text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
                                    <span class="block">Elevate Your Style</span>
                                    <span class="block text-indigo-600 dark:text-indigo-400">With Sigma Streetwear</span>
                                </h1>
                                <p class="mt-3 text-base text-gray-500 dark:text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
                                    Discover our latest collection of premium streetwear. Quality fabrics, bold designs, and unmatched comfort.
                                </p>
                                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                                    <div class="rounded-md shadow">
                                        <a href="{{ route('products.index') }}" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 md:py-4 md:text-lg md:px-10">
                                            Shop Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
                <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
                    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src="https://images.unsplash.com/photo-1551488831-00ddcb6c6bd3?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80" alt="Sigma Streetwear">
                </div>
            </div>

            <!-- Featured Categories -->
            <div class="bg-gray-100 dark:bg-gray-900">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                        Featured Categories
                    </h2>
                    <div class="mt-10 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                        <!-- Category 1 -->
                        <div class="relative rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="T-Shirts" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                <h3 class="text-2xl font-bold text-white">T-Shirts</h3>
                            </div>
                        </div>
                        <!-- Category 2 -->
                        <div class="relative rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1541099649105-f69ad21f3246?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" alt="Hoodies" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                <h3 class="text-2xl font-bold text-white">Hoodies</h3>
                            </div>
                        </div>
                        <!-- Category 3 -->
                        <div class="relative rounded-lg overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1542272604-787c3835535d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1026&q=80" alt="Accessories" class="w-full h-64 object-cover">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                <h3 class="text-2xl font-bold text-white">Accessories</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white dark:bg-gray-800 border-t border-gray-100 dark:border-gray-700">
                <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">About Sigma</h3>
                            <p class="mt-4 text-base text-gray-500 dark:text-gray-400">
                                Premium streetwear for those who dare to be different. Quality meets style in every piece.
                            </p>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Quick Links</h3>
                            <ul class="mt-4 space-y-4">
                                <li>
                                    <a href="{{ route('products.index') }}" class="text-base text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                        Shop
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cart.index') }}" class="text-base text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                                        Cart
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Contact</h3>
                            <ul class="mt-4 space-y-4">
                                <li class="text-base text-gray-500 dark:text-gray-400">
                                    Email: info@sigma.com
                                </li>
                                <li class="text-base text-gray-500 dark:text-gray-400">
                                    Phone: +1 (555) 123-4567
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8">
                        <p class="text-base text-gray-400 text-center">
                            &copy; {{ date('Y') }} Sigma. All rights reserved.
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
