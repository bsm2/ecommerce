<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =Admin::create([
            'name' => 'superadmin', 
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('123456789')
        ]);
    
        $role = Role::firstOrCreate(['guard_name' => 'admin','name' => 'SuperAdmin']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);
    
        $admin->assignRole([$role->id]);
    }
}
