<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Create Role
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleViewer = Role::create(['name' => 'viewer']);

        //permission list
        $permissions = [

            [
                'group_name' => 'dashboard',
                'permissions' => [
                    'dashboard.view',
                    'dashboard.edit',
                ]
            ],
            [
                'group_name' => 'siteinfo',
                'permissions' => [
                    'siteinfo.edit',
                ]
            ],
            [
                'group_name' => 'product',
                'permissions' => [
                    // product Permissions
                    'product.create',
                    'product.view',
                    'product.edit',
                    'product.delete',
                ]
            ],
            [
                'group_name' => 'order details',
                'permissions' => [
                    // product Permissions
                    
                    'order.view',
                    'order.edit',
                    'order.delete',
                ]
            ],
            [
                'group_name' => 'admin',
                'permissions' => [
                    // admin Permissions
                    'admin.create',
                    'admin.view',
                    'admin.edit',
                    'admin.delete',
                ]
            ],
            [
                'group_name' => 'role',
                'permissions' => [
                    // role Permissions
                    'role.create',
                    'role.view',
                    'role.edit',
                    'role.delete',
                ]
            ],
            [
                'group_name' => 'profile',
                'permissions' => [
                    // profile Permissions
                    'profile.view',
                    'profile.edit',
                ]
            ],
            [
                'group_name' => 'offer content',
                'permissions' => [
                    // offer Permissions
                    'offer.view',
                    'offer.create',
                    'offer.edit',
                ]
            ],
            [
                'group_name' => 'reviews',
                'permissions' => [
                    // review Permissions
                    'review.view',
                    'review.delete',
                ]
            ],
        ];

        //assign permission

        for ($i = 0; $i < count($permissions); $i++) {
            $permissionGroup = $permissions[$i]['group_name'];
            for ($j = 0; $j < count($permissions[$i]['permissions']); $j++) {
                // Create Permission
                $permission = Permission::create(['name' => $permissions[$i]['permissions'][$j], 'group_name' => $permissionGroup]);
                $roleSuperAdmin->givePermissionTo($permission);
                $permission->assignRole($roleSuperAdmin);
            }
        }


    }
}
