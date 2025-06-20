@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex justify-between items-center">
            <h1 class="text-3xl font-extrabold tracking-tight text-white">Manage Products</h1>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Add New Product
            </a>
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
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-300 sm:pl-6">Product</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-300">Category</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-300">Price</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-300">Stock</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-300">Featured</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Actions</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700 bg-gray-900">
                                @foreach($products as $product)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ $product->image }}" alt="{{ $product->name }}">
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-white">{{ $product->name }}</div>
                                                <div class="text-gray-400">{{ $product->size }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                        {{ ucfirst($product->category) }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                        RM{{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                        {{ $product->getTotalStock() }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                        <label for="featured-{{ $product->id }}" class="flex items-center cursor-pointer">
                                            <div class="relative">
                                                <input type="checkbox" id="featured-{{ $product->id }}" class="sr-only" 
                                                       onchange="toggleFeatured('{{ $product->slug }}')" {{ $product->featured ? 'checked' : '' }}>
                                                <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                                                <div class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"></div>
                                            </div>
                                        </label>
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-400 hover:text-blue-300 mr-4">Edit</a>
                                        <button type="button" 
                                                class="text-red-400 hover:text-red-300" 
                                                onclick="showDeleteModal('{{ $product->id }}', '{{ $product->name }}', '{{ $product->image }}')">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-gray-800 rounded-lg shadow-xl max-w-md w-full mx-4 transform transition-all">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b border-gray-700">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                    </div>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-medium text-white">Delete Product</h3>
                    <p class="text-sm text-gray-400">This action cannot be undone</p>
                </div>
            </div>
            <button type="button" onclick="hideDeleteModal()" class="text-gray-400 hover:text-gray-300">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="p-6">
            <div class="flex items-center space-x-4">
                <img id="modalProductImage" src="" alt="Product" class="w-16 h-16 rounded-lg object-cover">
                <div class="flex-1">
                    <h4 class="text-white font-medium" id="modalProductName"></h4>
                    <p class="text-gray-400 text-sm">Are you sure you want to delete this product?</p>
                </div>
            </div>
            
            <div class="mt-6 bg-red-900 border border-red-700 rounded-lg p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-info-circle text-red-400"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-400">Warning</h3>
                        <div class="mt-2 text-sm text-red-300">
                            <p>This will permanently delete the product and remove it from all orders. This action cannot be undone.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="flex items-center justify-end space-x-3 px-6 py-4 border-t border-gray-700">
            <button type="button" 
                    onclick="hideDeleteModal()" 
                    class="px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                Cancel
            </button>
            <form id="deleteForm" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" 
                        class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>
                    Delete Product
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function showDeleteModal(productId, productName, productImage) {
        // Set modal content
        document.getElementById('modalProductName').textContent = productName;
        document.getElementById('modalProductImage').src = productImage;
        document.getElementById('deleteForm').action = `/admin/products/${productId}`;
        
        // Show modal with animation
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('animate-fadeIn');
        
        // Add backdrop click to close
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                hideDeleteModal();
            }
        });
        
        // Add escape key to close
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideDeleteModal();
            }
        });
    }
    
    function hideDeleteModal() {
        const modal = document.getElementById('deleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('animate-fadeIn');
    }

    function toggleFeatured(productSlug) {
        fetch(`/admin/products/${productSlug}/toggle-featured`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            // You can add a success notification here if you like
        })
        .catch(error => {
            console.error('Error:', error);
            // You can add an error notification here
        });
    }
</script>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out;
    }

    /* Toggle switch styling */
    input:checked ~ .dot {
        transform: translateX(100%);
        background-color: #48bb78;
    }
    input:checked ~ .block {
        background-color: #2f855a;
    }
    
    /* Default state (unchecked) */
    input:not(:checked) ~ .dot {
        transform: translateX(0);
        background-color: #ffffff;
    }
    input:not(:checked) ~ .block {
        background-color: #4b5563;
    }
</style>
@endsection 