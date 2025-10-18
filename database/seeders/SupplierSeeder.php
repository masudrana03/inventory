<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            [
                'name' => 'Tech Solutions Inc.',
                'email' => 'orders@techsolutions.com',
                'phone' => '+1 (555) 123-4567',
                'address' => '123 Technology Drive, Silicon Valley, CA 94000',
                'notes' => 'Primary electronics supplier with fast shipping',
            ],
            [
                'name' => 'Global Manufacturing Co.',
                'email' => 'sales@globalmfg.com',
                'phone' => '+1 (555) 234-5678',
                'address' => '456 Industrial Blvd, Detroit, MI 48200',
                'notes' => 'Bulk manufacturing supplier for automotive parts',
            ],
            [
                'name' => 'Fashion Forward Ltd.',
                'email' => 'wholesale@fashionforward.com',
                'phone' => '+1 (555) 345-6789',
                'address' => '789 Fashion Avenue, New York, NY 10001',
                'notes' => 'Trendy clothing and accessories supplier',
            ],
            [
                'name' => 'Book Distributors LLC',
                'email' => 'orders@bookdist.com',
                'phone' => '+1 (555) 456-7890',
                'address' => '321 Library Street, Boston, MA 02101',
                'notes' => 'Educational and entertainment books supplier',
            ],
            [
                'name' => 'Home & Garden Supply',
                'email' => 'info@homegarden.com',
                'phone' => '+1 (555) 567-8901',
                'address' => '654 Garden Way, Portland, OR 97201',
                'notes' => 'Home improvement and garden supplies',
            ],
            [
                'name' => 'Sports Equipment Pro',
                'email' => 'sales@sportsequipment.com',
                'phone' => '+1 (555) 678-9012',
                'address' => '987 Athletic Drive, Denver, CO 80201',
                'notes' => 'Professional sports equipment and gear',
            ],
            [
                'name' => 'Toy World Distributors',
                'email' => 'orders@toyworld.com',
                'phone' => '+1 (555) 789-0123',
                'address' => '147 Play Street, Orlando, FL 32801',
                'notes' => 'Children toys and educational games',
            ],
            [
                'name' => 'Beauty Essentials Co.',
                'email' => 'wholesale@beautyessentials.com',
                'phone' => '+1 (555) 890-1234',
                'address' => '258 Beauty Lane, Los Angeles, CA 90210',
                'notes' => 'Health and beauty products supplier',
            ],
            [
                'name' => 'Auto Parts Direct',
                'email' => 'sales@autopartsdirect.com',
                'phone' => '+1 (555) 901-2345',
                'address' => '369 Garage Road, Chicago, IL 60601',
                'notes' => 'Automotive parts and accessories',
            ],
            [
                'name' => 'Food & Beverage Supply',
                'email' => 'orders@foodbev.com',
                'phone' => '+1 (555) 012-3456',
                'address' => '741 Kitchen Street, Austin, TX 73301',
                'notes' => 'Food and beverage wholesale supplier',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::firstOrCreate(
                ['name' => $supplier['name']],
                $supplier
            );
        }
    }
}
