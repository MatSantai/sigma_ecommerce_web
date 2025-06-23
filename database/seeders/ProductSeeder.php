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
                'name' => 'Classic Sigma Tee',
                'description' => 'Premium cotton t-shirt featuring the iconic Sigma logo. Crafted from 100% organic cotton for ultimate comfort and breathability. Perfect for everyday wear with a modern, minimalist design.',
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
                'name' => 'Slim Fit Denim Jeans',
                'description' => 'Modern slim fit jeans with premium stretch denim. Features a comfortable elastic waistband and reinforced stitching for durability. Perfect for both casual and semi-formal occasions.',
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
                'name' => 'Elegant Silk Blouse',
                'description' => 'Sophisticated silk blouse with a contemporary cut and flowing design. Made from 100% pure silk with a subtle sheen. Features a flattering silhouette perfect for professional and evening wear.',
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
                'name' => 'Premium Leather Jacket',
                'description' => 'Handcrafted leather jacket with premium full-grain leather. Features a modern biker design with quilted detailing and multiple pockets. A timeless piece that adds instant edge to any outfit.',
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
                'name' => 'Floral Summer Dress',
                'description' => 'Lightweight summer dress with a beautiful floral pattern. Made from breathable cotton blend with an adjustable waist and flowy silhouette. Perfect for warm days and garden parties.',
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
                'name' => 'Minimalist Watch',
                'description' => 'Sleek minimalist watch with a premium stainless steel case and genuine leather strap. Features a clean dial design with precise Japanese movement. A sophisticated accessory for any occasion.',
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
                'name' => 'Sustainable Backpack',
                'description' => 'Eco-friendly backpack crafted from recycled materials and sustainable fabrics. Features multiple compartments, laptop sleeve, and water-resistant exterior. Perfect for work, travel, or daily use.',
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
                'name' => 'Cozy Pullover Hoodie',
                'description' => 'Ultra-soft pullover hoodie made from premium cotton blend. Features a comfortable fit, kangaroo pocket, and embroidered Sigma logo. Perfect for layering during cooler weather.',
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
                'name' => 'Athletic Performance Tee',
                'description' => 'High-performance athletic t-shirt with moisture-wicking technology. Made from breathable, quick-dry fabric with a comfortable fit. Ideal for workouts, sports, or active lifestyle.',
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
                'name' => 'Urban Street Hoodie',
                'description' => 'Street-style hoodie with a modern urban aesthetic. Features a relaxed fit, drawstring hood, and side pockets. Made from premium cotton blend for maximum comfort and style.',
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
                'name' => 'Casual Crew Neck Sweatshirt',
                'description' => 'Comfortable crew neck sweatshirt perfect for casual wear. Made from soft cotton blend with a relaxed fit and ribbed cuffs. Features a subtle Sigma logo for understated style.',
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
                'name' => 'Premium Zip-Up Hoodie',
                'description' => 'High-quality zip-up hoodie with premium materials and construction. Features a full-zip front, adjustable hood, and side pockets. Perfect for layering and everyday comfort.',
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