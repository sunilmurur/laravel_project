<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ========================
        // Structured Permissions
        // ========================
        $permissions = [

            'category' => [
                'view' => 'category_view',
                'create' => 'category_create',
                'edit' => 'category_edit',
                'delete' => 'category_delete',
            ],

            'subcategory' => [
                'view' => 'subcategory_view',
                'create' => 'subcategory_create',
                'edit' => 'subcategory_edit',
                'delete' => 'subcategory_delete',
            ],
            'pooja' => [
                'view' => 'pooja_view',
                'create' => 'pooja_create',
                'edit' => 'pooja_edit',
                'delete' => 'pooja_delete',
            ],
            'customer' => [
                'view' => 'customer_view',
                'create' => 'customer_create',
                'edit' => 'customer_edit',
                'delete' => 'customer_delete',
            ],
             'valaya' => [
                'view' => 'valaya_view',
                'create' => 'valaya_create',
                'edit' => 'valaya_edit',
                'delete' => 'valaya_delete',
            ],
             'purcahse category' => [
                'view' => 'purchase_category_view',
                'create' => 'purchase_category_create',
                'edit' => 'purchase_category_edit',
                'delete' => 'purchase_category_delete',
            ],
            'purcahse subcategory' => [
                'view' => 'purchase_subcategory_view',
                'create' => 'purchase_subcategory_create',
                'edit' => 'purchase_subcategory_edit',
                'delete' => 'purchase_subcategory_delete',
            ],
            'purcahse' => [
                'view' => 'purchase_add_view',
                'create' => 'purchase_add_create',
                'edit' => 'purchase_add_edit',
                'delete' => 'purchase_add_delete',
            ],
            'sales' => [
                'view' => 'sales_view',
                'create' => 'sales_create',
                'edit' => 'sales_edit',
                'delete' => 'sales_delete',
            ],
             'donation' => [
                'view' => 'donation_view',
                'create' => 'donation_create',
                'edit' => 'donation_edit',
                'delete' => 'donation_delete',
            ],

            'report' => [
                'jama' => 'report_jama',
                'karchu' => 'report_karchu',
                'ako_jama' => 'report_ako_jama',
                'ako_karchu' => 'report_ako_karchu',
            ],
             'sevapooja' => [
                'view' => 'sevapooja_view',
                'create' => 'sevapooja_create',
                'edit' => 'sevapooja_edit',
            ],
             'roles' => [
                'view' => 'role_view',
                'create' => 'role_create',
                'edit' => 'role_edit',
            ],
              'permission' => [
                'view' => 'permission_view',
                'create' => 'permission_create',
                'edit' => 'permission_edit',
                'change_password' => 'permission_changepassword',
            ],
        ];

        // ========================
        // Create Permissions
        // ========================
        foreach ($permissions as $module => $actions) {
            foreach ($actions as $action => $permissionName) {
                Permission::firstOrCreate(['name' => $permissionName]);
            }
        }

        // ========================
        // Roles
        // ========================
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $staff = Role::firstOrCreate(['name' => 'staff']);
        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin'
        ]);

        // ========================
        // Flatten Permissions
        // ========================
        $allPermissions = collect($permissions)
            ->flatten()
            ->values()
            ->toArray();

        // Super Admin → all permission
        $superAdmin->syncPermissions($allPermissions);

        // Staff → limited
        $staff->syncPermissions([
            'category_view',
            'category_create',
            'subcategory_view',
            
        ]);

        
    }
}