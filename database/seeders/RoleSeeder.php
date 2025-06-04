<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         // Create SuperAdmin role
         $role = Role::firstOrCreate(['name' => 'SuperAdmin']);

         // Get all permissions
         $permissions = Permission::all();
 
         // Assign all permissions to the SuperAdmin role
         $role->syncPermissions($permissions);
 
         // Assign this role to all users with user_type = 'SuperAdmin'
         $users = User::where('user_type', 'SuperAdmin')->get();
 
         foreach ($users as $user) {
             if (!$user->hasRole('SuperAdmin')) {
                 $user->assignRole($role);
             }
         }
    }
}
