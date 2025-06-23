<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'required|string|in:S,M,L,XL',
            'stock' => 'required|array|min:1',
            'stock.*' => 'required|integer|min:0',
            'category' => 'required|string|in:men,women,accessories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
            'featured' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('products', $imageName, 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->has('featured');

        // Create the product
        $product = Product::create($validated);

        // Create product size records with stock
        foreach ($validated['sizes'] as $index => $size) {
            $product->productSizes()->create([
                'size' => $size,
                'stock' => $validated['stock'][$index]
            ]);
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'sizes' => 'nullable|array',
            'sizes.*' => 'required|string|in:S,M,L,XL',
            'stock' => 'nullable|array',
            'stock.*' => 'required|integer|min:0',
            'category' => 'required|string|in:men,women,accessories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240', // 10MB max
            'featured' => 'boolean'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('products', $imageName, 'public');
            $validated['image'] = '/storage/' . $imagePath;
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->has('featured');

        // Update the product
        $product->update($validated);

        // Only update sizes and stock if they are provided
        if ($request->has('sizes') && $request->has('stock') && count($request->sizes) > 0) {
            // Filter out empty size entries
            $validSizes = [];
            $validStock = [];
            
            foreach ($request->sizes as $index => $size) {
                if (!empty($size) && isset($request->stock[$index]) && !empty($request->stock[$index])) {
                    $validSizes[] = $size;
                    $validStock[] = $request->stock[$index];
                }
            }
            
            // Only process if we have valid sizes
            if (count($validSizes) > 0) {
                // Get existing sizes for this product
                $existingSizes = $product->productSizes()->pluck('size')->toArray();
                
                // Process each valid size from the form
                foreach ($validSizes as $index => $size) {
                    $stock = $validStock[$index];
                    
                    // Check if this size already exists
                    if (in_array($size, $existingSizes)) {
                        // Update existing size stock
                        $product->productSizes()->where('size', $size)->update(['stock' => $stock]);
                    } else {
                        // Create new size record
                        $product->productSizes()->create([
                            'size' => $size,
                            'stock' => $stock
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully.');
    }

    public function toggleFeatured(Product $product)
    {
        $product->featured = !$product->featured;
        $product->save();

        return response()->json(['featured' => $product->featured]);
    }
} 