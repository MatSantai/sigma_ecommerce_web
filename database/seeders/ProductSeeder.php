<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Sigma Ammar 1',
                'description' => 'Premium cotton t-shirt with the iconic Sigma logo. Perfect for everyday wear.',
                'price' => 29.99,
                'image' => '/storage/products/ammar-1.jpg',
                'category' => 'men',
                'featured' => true,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 25,
                    'M' => 30,
                    'L' => 25,
                    'XL' => 20,
                ],
            ],
            [
                'name' => 'Sigma Ammar 2',
                'description' => 'Modern slim fit jeans with a comfortable stretch. Perfect for any occasion.',
                'price' => 79.99,
                'image' => '/storage/products/ammar-2.jpg',
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 15,
                    'M' => 20,
                    'L' => 10,
                    'XL' => 5,
                ],
            ],
            [
                'name' => 'Sigma Hazriq 1',
                'description' => 'Elegant silk blouse with a modern cut. Perfect for both casual and formal occasions.',
                'price' => 59.99,
                'image' => '/storage/products/hazriq-1.jpg',
                'category' => 'women',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 10,
                ],
            ],
            [
                'name' => 'Sigma Hazriq 2',
                'description' => 'Premium leather jacket with a modern design. A timeless piece for your wardrobe.',
                'price' => 199.99,
                'image' => '/storage/products/hazriq-2.jpg',
                'category' => 'men',
                'featured' => true,
                'sizes' => ['M', 'L', 'XL'],
                'stock_by_size' => [
                    'M' => 8,
                    'L' => 10,
                    'XL' => 7,
                ],
            ],
            [
                'name' => 'Sigma Naim 1',
                'description' => 'Light and comfortable summer dress with a floral pattern. Perfect for warm days.',
                'price' => 69.99,
                'image' => '/storage/products/naim-1.jpg',
                'category' => 'women',
                'featured' => false,
                'sizes' => ['S', 'M', 'L'],
                'stock_by_size' => [
                    'S' => 15,
                    'M' => 25,
                    'L' => 20,
                ],
            ],
            [
                'name' => 'Sigma Naim 2',
                'description' => 'Minimalist design watch with premium materials. A perfect accessory for any outfit.',
                'price' => 149.99,
                'image' => '/storage/products/naim-2.jpg',
                'category' => 'accessories',
                'featured' => true,
                'sizes' => ['M'],
                'stock_by_size' => [
                    'M' => 30,
                ],
            ],
            [
                'name' => 'Sigma Adam 1',
                'description' => 'Stylish and functional backpack made from sustainable materials.',
                'price' => 89.99,
                'image' => '/storage/products/adam-1.jpg',
                'category' => 'accessories',
                'featured' => true,
                'sizes' => ['M', 'L'],
                'stock_by_size' => [
                    'M' => 20,
                    'L' => 20,
                ],
            ],
            [
                'name' => 'Sigma Adam 2',
                'description' => 'Comfortable and warm hoodie with the Sigma logo. Perfect for casual wear.',
                'price' => 49.99,
                'image' => '/storage/products/adam-2.jpg',
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Sigma Din 1',
                'description' => 'Comfortable and warm hoodie with the Sigma logo. Perfect for casual wear.',
                'price' => 49.99,
                'image' => '/storage/products/din-1.jpg',
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Sigma Din 2',
                'description' => 'Comfortable and warm hoodie with the Sigma logo. Perfect for casual wear.',
                'price' => 49.99,
                'image' => '/storage/products/din-2.jpg',
                'category' => 'men',
                'featured' => true,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Sigma Mert 1',
                'description' => 'Comfortable and warm hoodie with the Sigma logo. Perfect for casual wear.',
                'price' => 49.99,
                'image' => '/storage/products/mert-1.jpg',
                'category' => 'men',
                'featured' => false,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
            [
                'name' => 'Sigma Mert 2',
                'description' => 'Comfortable and warm hoodie with the Sigma logo. Perfect for casual wear.',
                'price' => 49.99,
                'image' => '/storage/products/mert-2.jpg',
                'category' => 'men',
                'featured' => true,
                'sizes' => ['S', 'M', 'L', 'XL'],
                'stock_by_size' => [
                    'S' => 20,
                    'M' => 25,
                    'L' => 20,
                    'XL' => 15,
                ],
            ],
        ];

        foreach ($products as $productData) {
            // Create the product
            $product = Product::create([
                'name' => $productData['name'],
                'slug' => Str::slug($productData['name']),
                'description' => $productData['description'],
                'price' => $productData['price'],
                'image' => $productData['image'],
                'category' => $productData['category'],
                'featured' => $productData['featured'],
            ]);

            // Create size-specific stock records
            foreach ($productData['stock_by_size'] as $size => $stock) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'stock' => $stock,
                ]);
            }
        }
    }
} 