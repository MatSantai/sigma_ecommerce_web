@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-white">Edit Product</h3>
                    <p class="mt-1 text-sm text-gray-400">
                        Update the product information. All fields are required.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-6 py-8 bg-gray-800 space-y-8 sm:p-8">
                            <!-- Basic Information Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Product Information</h3>
                                
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">{{ old('description', $product->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Pricing & Category Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Pricing & Category</h3>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="price" class="block text-sm font-medium text-gray-300 mb-2">Price (RM)</label>
                                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                                        <select name="category" id="category" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                            <option value="men" {{ old('category', $product->category) == 'men' ? 'selected' : '' }}>Men</option>
                                            <option value="women" {{ old('category', $product->category) == 'women' ? 'selected' : '' }}>Women</option>
                                            <option value="accessories" {{ old('category', $product->category) == 'accessories' ? 'selected' : '' }}>Accessories</option>
                                        </select>
                                        @error('category')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Product Sizes & Stock Section -->
                            <div class="space-y-6">
                                <div class="flex items-center justify-between border-b border-gray-700 pb-3">
                                    <h3 class="text-lg font-medium text-white">Product Sizes & Stock</h3>
                                    <button type="button" onclick="toggleSizeSection()" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                                        <i class="fas fa-edit mr-2"></i> <span id="toggle-text">Edit Sizes</span>
                                    </button>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-4">Current sizes and stock quantities</label>
                                    
                                    <!-- Display current sizes -->
                                    @if($product->productSizes->count() > 0)
                                        <div class="mb-6 p-4 bg-gray-700 rounded-lg">
                                            <h4 class="text-white font-medium mb-3">Current Stock:</h4>
                                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                                @foreach($product->productSizes as $productSize)
                                                    <div class="flex items-center justify-between bg-gray-800 rounded px-3 py-2">
                                                        <span class="text-gray-300 text-sm">Size {{ $productSize->size }}</span>
                                                        <span class="text-green-400 text-sm font-medium">{{ $productSize->stock }} items</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                    
                                    <div id="size-edit-section" class="hidden">
                                        <label class="block text-sm font-medium text-gray-300 mb-4">Add new sizes or update existing ones</label>
                                        <div id="sizes-container" class="space-y-4">
                                            <div class="size-row flex items-center space-x-4 p-4 bg-gray-700 rounded-lg">
                                                <select name="sizes[]" class="flex-1 border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                                    <option value="">Select a size...</option>
                                                    <option value="S">Small (S)</option>
                                                    <option value="M">Medium (M)</option>
                                                    <option value="L">Large (L)</option>
                                                    <option value="XL">Extra Large (XL)</option>
                                                </select>
                                                <input type="number" name="stock[]" placeholder="Quantity" min="0" class="w-32 border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3 text-center">
                                                <button type="button" onclick="removeSize(this)" class="text-red-400 hover:text-red-300 p-2">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-between mt-4">
                                            <button type="button" onclick="addSize()" class="text-blue-400 hover:text-blue-300 text-sm font-medium">
                                                <i class="fas fa-plus mr-2"></i> Add Another Size
                                            </button>
                                            <button type="button" onclick="clearAllSizes()" class="text-gray-400 hover:text-gray-300 text-sm font-medium">
                                                <i class="fas fa-times mr-2"></i> Clear All Sizes
                                            </button>
                                        </div>
                                        @error('sizes')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                        @error('stock')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                    <p class="text-xs text-gray-500 mt-2">Note: Click "Edit Sizes" above if you want to modify sizes and stock. Otherwise, current sizes will remain unchanged.</p>
                                </div>
                            </div>

                            <!-- Product Image Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Product Image</h3>
                                
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-300 mb-4">Update product image</label>
                                    
                                    <!-- Current Image Preview -->
                                    @if($product->image)
                                        <div class="mb-4">
                                            <p class="text-sm text-gray-400 mb-3">Current Image:</p>
                                            <img src="{{ $product->image }}" alt="Current product image" class="h-32 w-32 object-cover rounded-lg border border-gray-600">
                                        </div>
                                    @endif
                                    
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-700 border-dashed rounded-lg">
                                        <div class="space-y-2 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-400 justify-center">
                                                <label for="image" class="relative cursor-pointer bg-gray-800 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload a new file</span>
                                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB (leave empty to keep current image)</p>
                                        </div>
                                    </div>
                                    <div id="image-preview" class="mt-4 hidden">
                                        <p class="text-sm text-gray-400 mb-2">New Image Preview:</p>
                                        <img id="preview-img" src="" alt="Preview" class="h-32 w-32 object-cover rounded-lg">
                                    </div>
                                    @error('image')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-gray-800 text-right sm:px-8">
                            <a href="{{ route('admin.products.index') }}" class="inline-flex justify-center py-3 px-6 border border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="ml-4 inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Update Product
                            </button>
                        </div>
                    </div>
                </form>

                <script>
                    function previewImage(input) {
                        const preview = document.getElementById('image-preview');
                        const previewImg = document.getElementById('preview-img');
                        
                        if (input.files && input.files[0]) {
                            const reader = new FileReader();
                            
                            reader.onload = function(e) {
                                previewImg.src = e.target.result;
                                preview.classList.remove('hidden');
                            }
                            
                            reader.readAsDataURL(input.files[0]);
                        } else {
                            preview.classList.add('hidden');
                        }
                    }

                    function addSize() {
                        const container = document.getElementById('sizes-container');
                        const newRow = document.createElement('div');
                        newRow.className = 'size-row flex items-center space-x-4 p-4 bg-gray-700 rounded-lg';
                        newRow.innerHTML = `
                            <select name="sizes[]" class="flex-1 border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                <option value="">Select a size...</option>
                                <option value="S">Small (S)</option>
                                <option value="M">Medium (M)</option>
                                <option value="L">Large (L)</option>
                                <option value="XL">Extra Large (XL)</option>
                            </select>
                            <input type="number" name="stock[]" placeholder="Quantity" min="0" class="w-32 border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3 text-center">
                            <button type="button" onclick="removeSize(this)" class="text-red-400 hover:text-red-300 p-2">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                        container.appendChild(newRow);
                    }

                    function removeSize(button) {
                        const container = document.getElementById('sizes-container');
                        const rows = container.querySelectorAll('.size-row');
                        if (rows.length > 1) {
                            button.closest('.size-row').remove();
                        }
                    }

                    function clearAllSizes() {
                        const container = document.getElementById('sizes-container');
                        const rows = container.querySelectorAll('.size-row');
                        rows.forEach(row => row.remove());
                    }

                    function toggleSizeSection() {
                        const sizeEditSection = document.getElementById('size-edit-section');
                        const toggleText = document.getElementById('toggle-text');
                        
                        if (sizeEditSection.classList.contains('hidden')) {
                            sizeEditSection.classList.remove('hidden');
                            toggleText.textContent = 'Hide Sizes';
                        } else {
                            sizeEditSection.classList.add('hidden');
                            toggleText.textContent = 'Edit Sizes';
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</div>
@endsection 