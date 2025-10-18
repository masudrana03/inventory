<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@email.com',
                'phone' => '+1 (555) 111-2222',
                'address' => '123 Main Street, Anytown, USA 12345',
                'notes' => 'Regular customer, prefers premium products',
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'phone' => '+1 (555) 222-3333',
                'address' => '456 Oak Avenue, Somewhere, USA 23456',
                'notes' => 'Bulk buyer, corporate account',
            ],
            [
                'name' => 'Mike Wilson',
                'email' => 'mike.wilson@email.com',
                'phone' => '+1 (555) 333-4444',
                'address' => '789 Pine Road, Elsewhere, USA 34567',
                'notes' => 'Price-sensitive customer',
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@email.com',
                'phone' => '+1 (555) 444-5555',
                'address' => '321 Elm Street, Nowhere, USA 45678',
                'notes' => 'Frequent buyer, loyal customer',
            ],
            [
                'name' => 'David Brown',
                'email' => 'david.brown@email.com',
                'phone' => '+1 (555) 555-6666',
                'address' => '654 Maple Lane, Anywhere, USA 56789',
                'notes' => 'Prefers online ordering',
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa.anderson@email.com',
                'phone' => '+1 (555) 666-7777',
                'address' => '987 Cedar Court, Somewhere, USA 67890',
                'notes' => 'Seasonal buyer, holiday shopping',
            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'robert.taylor@email.com',
                'phone' => '+1 (555) 777-8888',
                'address' => '147 Birch Boulevard, Elsewhere, USA 78901',
                'notes' => 'Business customer, bulk orders',
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez@email.com',
                'phone' => '+1 (555) 888-9999',
                'address' => '258 Spruce Street, Nowhere, USA 89012',
                'notes' => 'Quality-focused, brand loyal',
            ],
            [
                'name' => 'William Garcia',
                'email' => 'william.garcia@email.com',
                'phone' => '+1 (555) 999-0000',
                'address' => '369 Willow Way, Anywhere, USA 90123',
                'notes' => 'New customer, exploring options',
            ],
            [
                'name' => 'Amanda Rodriguez',
                'email' => 'amanda.rodriguez@email.com',
                'phone' => '+1 (555) 000-1111',
                'address' => '741 Ash Avenue, Somewhere, USA 01234',
                'notes' => 'Tech enthusiast, early adopter',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::firstOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }
    }
}
