<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    
        $permissions = [
            'home-index',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'form-list',
            'form-create',
            'form-edit',
            'form-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'log-index',
            'log-show',
            'log-edit',
            'log-update',
            'table-parse',
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }

        $user = User::create([
            'name' => 'SuperAdmin',
            'email' => 'simpleSuperAdmin@gmail.com',
            'password' =>Hash::make('custom-password'),
            'email_verified_at' => now(),
            'created_at'=>	now(),
            'updated_at'=>now(),
        ]);

        $role = Role::create(['name' => 'SuperAdmin']);

        $permissions = Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);


    }
}
