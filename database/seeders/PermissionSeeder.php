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
            'Biddings' => [
                'bidding access'    => 'Allow user to access biddings.',
                'bidding list'      => 'Allow user to access list of bids on an item.',
                'bidding leader'    => 'Allow user to see the leading bidder on an item.',
            ],
            'Auctions' => [
                'auction access'    => 'Allow user to access aution list and details.',
                'auction create'    => 'Allow user to create auction.',
                'auction edit'      => 'Allow user to update auction details.',
                'auction delete'    => 'Allow user to delete auction.'
            ],
            'Items' => [
                'item access'   => 'Allow user to access item list and details',
                'item create'   => 'Allow user to create item.',
                'item edit'     => 'Allow user to edit item details.',
                'item delete'   => 'Allow user to delete item.'
            ],
            'Companies' => [
                'company access'    => 'Allow user to access company list and details.',
                'company create'    => 'Allow user to create company.',
                'company edit'      => 'Allow user to edit company details.',
                'company delete'    => 'Allow user to delete company.'
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
            ],
            'System' => [
                'system logs'   => 'Allow user to access system logs.'
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
