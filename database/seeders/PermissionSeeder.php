<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions_arr = [
            'Items' => [
                'item access'   => 'Allow user to access item list and details',
                'item create'   => 'Allow user to create item.',
                'item edit'     => 'Allow user to edit item details.',
                'item delete'   => 'Allow user to delete item.'
            ],
            'Users' => [
                'user access'   => 'Allow user to access user list and details',
                'user create'   => 'Allow user to create user.',
                'user edit'     => 'Allow user to edit user details.',
                'user delete'   => 'Allow user to delete user.'
            ],
            'Roles' => [
                'role access'   => 'Allow user to access role list and details',
                'role create'   => 'Allow user to create role.',
                'role edit'     => 'Allow user to edit role details.',
                'role delete'   => 'Allow user to delete role.'
            ]
        ];

        foreach($permissions_arr as $module => $permissions) {
            foreach($permissions as $permission => $description) {
                Permission::create([
                    'name' => $permission,
                    'module' => $module,
                    'description' => $description,
                ]);
            }
        }
    }
}
