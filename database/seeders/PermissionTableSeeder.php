<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-read',
            'role-create',
            'role-edit',
            'role-delete',
            'category-read',
            'category-create',
            'category-edit',
            'category-delete',
            'product-read',
            'product-create',
            'product-edit',
            'product-delete'
        ];
    
        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'admin','name' => $permission]);
        }
    }
}
