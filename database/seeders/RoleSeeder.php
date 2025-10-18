<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'view_any_category',
            'view_category',
            'create_category',
            'update_category',
            'delete_category',
            'view_any_supplier',
            'view_supplier',
            'create_supplier',
            'update_supplier',
            'delete_supplier',
            'view_any_customer',
            'view_customer',
            'create_customer',
            'update_customer',
            'delete_customer',
            'view_any_product',
            'view_product',
            'create_product',
            'update_product',
            'delete_product',
            'view_any_purchase',
            'view_purchase',
            'create_purchase',
            'update_purchase',
            'delete_purchase',
            'view_any_sale',
            'view_sale',
            'create_sale',
            'update_sale',
            'delete_sale',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $managerRole->givePermissionTo([
            'view_any_category', 'view_category', 'create_category', 'update_category',
            'view_any_supplier', 'view_supplier', 'create_supplier', 'update_supplier',
            'view_any_customer', 'view_customer', 'create_customer', 'update_customer',
            'view_any_product', 'view_product', 'create_product', 'update_product',
            'view_any_purchase', 'view_purchase', 'create_purchase', 'update_purchase',
            'view_any_sale', 'view_sale', 'create_sale', 'update_sale',
        ]);

        $staffRole = Role::firstOrCreate(['name' => 'staff']);
        $staffRole->givePermissionTo([
            'view_any_category', 'view_category',
            'view_any_supplier', 'view_supplier',
            'view_any_customer', 'view_customer',
            'view_any_product', 'view_product',
            'view_any_purchase', 'view_purchase', 'create_purchase',
            'view_any_sale', 'view_sale', 'create_sale',
        ]);
    }
}
