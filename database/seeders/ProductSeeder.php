<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        
        $products = [
            // Electronics
            [
                'name' => 'iPhone 15 Pro',
                'sku' => 'IPH15PRO-128',
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'purchase_price' => 899.99,
                'selling_price' => 1099.99,
                'stock_quantity' => 25,
                'low_stock_threshold' => 5,
                'unit_type' => 'pcs',
                'description' => 'Latest iPhone with advanced camera system and A17 Pro chip',
            ],
            [
                'name' => 'Samsung Galaxy S24',
                'sku' => 'SAMS24-256',
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'purchase_price' => 699.99,
                'selling_price' => 899.99,
                'stock_quantity' => 15,
                'low_stock_threshold' => 3,
                'unit_type' => 'pcs',
                'description' => 'Premium Android smartphone with AI features',
            ],
            [
                'name' => 'MacBook Air M3',
                'sku' => 'MBA-M3-512',
                'category_id' => $categories->where('name', 'Electronics')->first()->id,
                'purchase_price' => 999.99,
                'selling_price' => 1299.99,
                'stock_quantity' => 8,
                'low_stock_threshold' => 2,
                'unit_type' => 'pcs',
                'description' => 'Ultra-thin laptop with M3 chip and all-day battery',
            ],
            
            // Clothing
            [
                'name' => 'Nike Air Max 270',
                'sku' => 'NIKE-AM270-10',
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'purchase_price' => 89.99,
                'selling_price' => 129.99,
                'stock_quantity' => 50,
                'low_stock_threshold' => 10,
                'unit_type' => 'pairs',
                'description' => 'Comfortable running shoes with Air Max technology',
            ],
            [
                'name' => 'Levi\'s 501 Jeans',
                'sku' => 'LEVI-501-32',
                'category_id' => $categories->where('name', 'Clothing')->first()->id,
                'purchase_price' => 39.99,
                'selling_price' => 69.99,
                'stock_quantity' => 75,
                'low_stock_threshold' => 15,
                'unit_type' => 'pcs',
                'description' => 'Classic straight-fit denim jeans',
            ],
            
            // Books
            [
                'name' => 'The Great Gatsby',
                'sku' => 'BOOK-GG-001',
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'purchase_price' => 8.99,
                'selling_price' => 14.99,
                'stock_quantity' => 100,
                'low_stock_threshold' => 20,
                'unit_type' => 'pcs',
                'description' => 'Classic American novel by F. Scott Fitzgerald',
            ],
            [
                'name' => 'Python Programming Guide',
                'sku' => 'BOOK-PYTHON-001',
                'category_id' => $categories->where('name', 'Books')->first()->id,
                'purchase_price' => 24.99,
                'selling_price' => 39.99,
                'stock_quantity' => 30,
                'low_stock_threshold' => 5,
                'unit_type' => 'pcs',
                'description' => 'Comprehensive guide to Python programming',
            ],
            
            // Home & Garden
            [
                'name' => 'Garden Hose 50ft',
                'sku' => 'GARDEN-HOSE-50',
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'purchase_price' => 19.99,
                'selling_price' => 34.99,
                'stock_quantity' => 40,
                'low_stock_threshold' => 8,
                'unit_type' => 'pcs',
                'description' => 'Heavy-duty garden hose with brass fittings',
            ],
            [
                'name' => 'LED Light Bulbs (Pack of 4)',
                'sku' => 'LED-BULBS-4PK',
                'category_id' => $categories->where('name', 'Home & Garden')->first()->id,
                'purchase_price' => 12.99,
                'selling_price' => 19.99,
                'stock_quantity' => 60,
                'low_stock_threshold' => 12,
                'unit_type' => 'pack',
                'description' => 'Energy-efficient LED bulbs, 60W equivalent',
            ],
            
            // Sports
            [
                'name' => 'Basketball',
                'sku' => 'SPORT-BBALL-001',
                'category_id' => $categories->where('name', 'Sports')->first()->id,
                'purchase_price' => 15.99,
                'selling_price' => 24.99,
                'stock_quantity' => 35,
                'low_stock_threshold' => 7,
                'unit_type' => 'pcs',
                'description' => 'Official size basketball for indoor/outdoor use',
            ],
            [
                'name' => 'Yoga Mat',
                'sku' => 'SPORT-YOGA-MAT',
                'category_id' => $categories->where('name', 'Sports')->first()->id,
                'purchase_price' => 18.99,
                'selling_price' => 29.99,
                'stock_quantity' => 25,
                'low_stock_threshold' => 5,
                'unit_type' => 'pcs',
                'description' => 'Non-slip yoga mat with carrying strap',
            ],
            
            // Toys
            [
                'name' => 'LEGO Classic Set',
                'sku' => 'TOY-LEGO-CLASSIC',
                'category_id' => $categories->where('name', 'Toys')->first()->id,
                'purchase_price' => 24.99,
                'selling_price' => 39.99,
                'stock_quantity' => 45,
                'low_stock_threshold' => 9,
                'unit_type' => 'set',
                'description' => 'Creative building blocks for all ages',
            ],
            [
                'name' => 'Remote Control Car',
                'sku' => 'TOY-RC-CAR-001',
                'category_id' => $categories->where('name', 'Toys')->first()->id,
                'purchase_price' => 29.99,
                'selling_price' => 49.99,
                'stock_quantity' => 20,
                'low_stock_threshold' => 4,
                'unit_type' => 'pcs',
                'description' => 'Fast remote control car with LED lights',
            ],
            
            // Health & Beauty
            [
                'name' => 'Vitamin C Serum',
                'sku' => 'BEAUTY-VITC-SERUM',
                'category_id' => $categories->where('name', 'Health & Beauty')->first()->id,
                'purchase_price' => 12.99,
                'selling_price' => 19.99,
                'stock_quantity' => 55,
                'low_stock_threshold' => 11,
                'unit_type' => 'bottle',
                'description' => 'Anti-aging vitamin C facial serum',
            ],
            [
                'name' => 'Protein Powder',
                'sku' => 'HEALTH-PROTEIN-1LB',
                'category_id' => $categories->where('name', 'Health & Beauty')->first()->id,
                'purchase_price' => 19.99,
                'selling_price' => 29.99,
                'stock_quantity' => 30,
                'low_stock_threshold' => 6,
                'unit_type' => 'container',
                'description' => 'Whey protein powder for muscle building',
            ],
            
            // Automotive
            [
                'name' => 'Car Phone Mount',
                'sku' => 'AUTO-MOUNT-001',
                'category_id' => $categories->where('name', 'Automotive')->first()->id,
                'purchase_price' => 8.99,
                'selling_price' => 14.99,
                'stock_quantity' => 65,
                'low_stock_threshold' => 13,
                'unit_type' => 'pcs',
                'description' => 'Magnetic phone mount for car dashboard',
            ],
            [
                'name' => 'Car Air Freshener',
                'sku' => 'AUTO-AIR-FRESH',
                'category_id' => $categories->where('name', 'Automotive')->first()->id,
                'purchase_price' => 3.99,
                'selling_price' => 6.99,
                'stock_quantity' => 80,
                'low_stock_threshold' => 16,
                'unit_type' => 'pcs',
                'description' => 'Long-lasting car air freshener',
            ],
            
            // Food & Beverages
            [
                'name' => 'Organic Coffee Beans',
                'sku' => 'FOOD-COFFEE-1LB',
                'category_id' => $categories->where('name', 'Food & Beverages')->first()->id,
                'purchase_price' => 9.99,
                'selling_price' => 16.99,
                'stock_quantity' => 40,
                'low_stock_threshold' => 8,
                'unit_type' => 'bag',
                'description' => 'Premium organic coffee beans, medium roast',
            ],
            [
                'name' => 'Energy Drink (Pack of 12)',
                'sku' => 'FOOD-ENERGY-12PK',
                'category_id' => $categories->where('name', 'Food & Beverages')->first()->id,
                'purchase_price' => 14.99,
                'selling_price' => 24.99,
                'stock_quantity' => 25,
                'low_stock_threshold' => 5,
                'unit_type' => 'pack',
                'description' => 'Sugar-free energy drink with natural caffeine',
            ],
            
            // Office Supplies
            [
                'name' => 'Wireless Mouse',
                'sku' => 'OFFICE-MOUSE-WIRELESS',
                'category_id' => $categories->where('name', 'Office Supplies')->first()->id,
                'purchase_price' => 12.99,
                'selling_price' => 19.99,
                'stock_quantity' => 50,
                'low_stock_threshold' => 10,
                'unit_type' => 'pcs',
                'description' => 'Ergonomic wireless mouse with USB receiver',
            ],
            [
                'name' => 'Notebook Set (5 Pack)',
                'sku' => 'OFFICE-NOTEBOOK-5PK',
                'category_id' => $categories->where('name', 'Office Supplies')->first()->id,
                'purchase_price' => 7.99,
                'selling_price' => 12.99,
                'stock_quantity' => 70,
                'low_stock_threshold' => 14,
                'unit_type' => 'pack',
                'description' => 'Spiral-bound notebooks, college ruled',
            ],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
