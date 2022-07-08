<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\City;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $city=City::create(['city_name' => 'superadmin']);
        
        $user = User::create([
            'name' => 'SuperAdmin', 
            'username' => 'superadmin',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'city_id' => '1', 

        ]);
    
        $role = Role::create(['name' => 'superadmin']);
     
        $permissions = Permission::pluck('id','id')->all();
        
        $role->syncPermissions($permissions);
     
        $user->assignRole([$role->id]);
    }
}