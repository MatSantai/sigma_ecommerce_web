@extends('layouts.app')

@section('title', $product->name)

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="lg:grid lg:grid-cols-2 lg:gap-x-8">
            <!-- Product image -->
            <div class="lg:max-w-lg lg:self-end">
                <div class="aspect-w-1 aspect-h-1 rounded-lg overflow-hidden">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-center object-cover">
                </div>
            </div>

            <!-- Product details -->
            <div class="mt-10 px-4 sm:px-0 sm:mt-16 lg:mt-0">
                <h1 class="text-3xl font-extrabold tracking-tight text-white">{{ $product->name }}</h1>
                <div class="mt-3">
                    <h2 class="sr-only">Product information</h2>
                    <p class="text-3xl text-white">RM{{ number_format($product->price, 2) }}</p>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm text-gray-300">Description</h3>
                    <div class="mt-2 text-base text-gray-400 space-y-6">
                        <p>{{ $product->description }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm text-gray-300">Category</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-400">{{ ucfirst($product->category) }}</p>
                    </div>
                </div>

                <div class="mt-6">
                    <h3 class="text-sm text-gray-300">Available Sizes</h3>
                    <div class="mt-2">
                        <p class="text-base text-gray-400">{{ implode(', ', $product->getSizesInOrder()->pluck('size')->toArray()) }}</p>
                    </div>
                </div>

                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-6">
                    @csrf
                    <div class="mt-6">
                        <label for="size" class="block text-sm font-medium text-gray-300">Select Size</label>
                        <select name="size" id="size" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-700 bg-gray-900 text-white focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md" onchange="updateStockInfo()">
                            <option value="">Choose a size...</option>
                            @foreach($product->getSizesInOrder() as $productSize)
                                @if($productSize->stock > 0)
                                    <option value="{{ $productSize->size }}" data-stock="{{ $productSize->stock }}">{{ $productSize->size }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div id="stock-info" class="mt-4 hidden">
                        <h3 class="text-sm text-gray-300">Stock Availability</h3>
                        <div id="stock-availability"></div>
                    </div>

                    <div class="mt-6">
                        <label for="quantity" class="block text-sm font-medium text-gray-300">Quantity</label>
                        <div class="mt-1 flex items-center space-x-2">
                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="1" class="block w-24 border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-center">
                            <span class="text-gray-400 text-sm">(Max: <span id="max-quantity">1</span>)</span>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Select a size to see available quantity</p>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full bg-blue-600 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Add to Cart
                        </button>
                    </div>
                </form>
                @if($product->getTotalStock() == 0)
                <div class="mt-6">
                    <div class="bg-gray-800 border border-gray-700 rounded-md p-4">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                            <div>
                                <h4 class="text-red-400 font-medium">Currently Out of Stock</h4>
                                <p class="text-gray-400 text-sm mt-1">This item is not available for purchase at the moment.</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <script>
                    function updateStockInfo() {
                        const sizeSelect = document.getElementById('size');
                        const stockInfoDiv = document.getElementById('stock-info');
                        const stockAvailabilityDiv = document.getElementById('stock-availability');
                        const quantityInput = document.getElementById('quantity');
                        const maxQuantitySpan = document.getElementById('max-quantity');

                        if (sizeSelect.value) {
                            const selectedOption = sizeSelect.options[sizeSelect.selectedIndex];
                            const stock = parseInt(selectedOption.getAttribute('data-stock'));
                            let html = '';
                            if (stock > 0) {
                                html += `<div class='flex items-center space-x-2'>`;
                                html += `<div class='w-2 h-2 bg-green-500 rounded-full'></div>`;
                                html += `<span class='text-green-400 font-medium'>${stock} available</span>`;
                                if (stock <= 5) {
                                    html += `<span class='text-yellow-400 text-xs'>(Low stock)</span>`;
                                }
                                html += `</div>`;
                            } else {
                                html += `<div class='flex items-center space-x-2'>`;
                                html += `<div class='w-2 h-2 bg-red-500 rounded-full'></div>`;
                                html += `<span class='text-red-400 font-medium'>Out of stock</span>`;
                                html += `</div>`;
                            }
                            stockAvailabilityDiv.innerHTML = html;
                            stockInfoDiv.classList.remove('hidden');

                            // Update quantity input
                            quantityInput.max = stock;
                            maxQuantitySpan.textContent = stock;
                            if (parseInt(quantityInput.value) > stock) {
                                quantityInput.value = stock;
                            }
                        } else {
                            stockAvailabilityDiv.innerHTML = '';
                            stockInfoDiv.classList.add('hidden');
                            quantityInput.max = 1;
                            maxQuantitySpan.textContent = '1';
                            quantityInput.value = 1;
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection 