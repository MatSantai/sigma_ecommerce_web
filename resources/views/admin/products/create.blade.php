@extends('layouts.app')

@section('title', 'Add New Product')

@section('content')
<div class="bg-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-white">Add New Product</h3>
                    <p class="mt-1 text-sm text-gray-400">
                        Add a new product to your store. Fill in all the required fields.
                    </p>
                </div>
            </div>

            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-6 py-8 bg-gray-800 space-y-8 sm:p-8">
                            <!-- Basic Information Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Product Information</h3>
                                
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                    @error('name')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">{{ old('description') }}</textarea>
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
                                        <input type="number" name="price" id="price" step="0.01" value="{{ old('price') }}" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                        @error('price')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="category" class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                                        <select name="category" id="category" class="mt-1 block w-full border-gray-700 bg-gray-900 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
                                            <option value="men" {{ old('category') == 'men' ? 'selected' : '' }}>Men</option>
                                            <option value="women" {{ old('category') == 'women' ? 'selected' : '' }}>Women</option>
                                            <option value="accessories" {{ old('category') == 'accessories' ? 'selected' : '' }}>Accessories</option>
                                        </select>
                                        @error('category')
                                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Product Sizes & Stock Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Product Sizes & Stock</h3>
                                
                                <div>
                                    <label class="block text-sm font-medium text-gray-300 mb-4">Add sizes and their stock quantities</label>
                                    <div id="sizes-container" class="space-y-4">
                                        <div class="size-row flex items-center space-x-4 p-4 bg-gray-700 rounded-lg">
                                            <select name="sizes[]" class="flex-1 border-gray-600 bg-gray-800 text-white rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm px-4 py-3">
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
                                    <button type="button" onclick="addSize()" class="mt-4 text-blue-400 hover:text-blue-300 text-sm font-medium">
                                        <i class="fas fa-plus mr-2"></i> Add Another Size
                                    </button>
                                    @error('sizes')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                    @error('stock')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Image Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Product Image</h3>
                                
                                <div>
                                    <label for="image" class="block text-sm font-medium text-gray-300 mb-4">Upload product image</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-700 border-dashed rounded-lg">
                                        <div class="space-y-2 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-400 justify-center">
                                                <label for="image" class="relative cursor-pointer bg-gray-800 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                    <span>Upload a file</span>
                                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                    <div id="image-preview" class="mt-4 hidden">
                                        <img id="preview-img" src="" alt="Preview" class="h-32 w-32 object-cover rounded-lg">
                                    </div>
                                    @error('image')
                                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Product Settings Section -->
                            <div class="space-y-6">
                                <h3 class="text-lg font-medium text-white border-b border-gray-700 pb-3">Product Settings</h3>
                                
                                <div class="flex items-start space-x-4 p-4 bg-gray-700 rounded-lg">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="featured" id="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 border-gray-600 bg-gray-800 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800 rounded">
                                    </div>
                                    <div class="ml-3">
                                        <label for="featured" class="font-medium text-gray-300">Featured Product</label>
                                        <p class="text-gray-400 text-sm mt-1">Featured products will be displayed on the homepage.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 py-4 bg-gray-800 text-right sm:px-8">
                            <a href="{{ route('admin.products.index') }}" class="inline-flex justify-center py-3 px-6 border border-gray-700 shadow-sm text-sm font-medium rounded-md text-gray-300 bg-gray-700 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="ml-4 inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                Create Product
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
                </script>
            </div>
        </div>
    </div>
</div>
@endsection 