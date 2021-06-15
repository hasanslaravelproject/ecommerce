<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list shops']);
        Permission::create(['name' => 'view shops']);
        Permission::create(['name' => 'create shops']);
        Permission::create(['name' => 'update shops']);
        Permission::create(['name' => 'delete shops']);

        Permission::create(['name' => 'list brands']);
        Permission::create(['name' => 'view brands']);
        Permission::create(['name' => 'create brands']);
        Permission::create(['name' => 'update brands']);
        Permission::create(['name' => 'delete brands']);

        Permission::create(['name' => 'list categories']);
        Permission::create(['name' => 'view categories']);
        Permission::create(['name' => 'create categories']);
        Permission::create(['name' => 'update categories']);
        Permission::create(['name' => 'delete categories']);

        Permission::create(['name' => 'list orders']);
        Permission::create(['name' => 'view orders']);
        Permission::create(['name' => 'create orders']);
        Permission::create(['name' => 'update orders']);
        Permission::create(['name' => 'delete orders']);

        Permission::create(['name' => 'list productdetails']);
        Permission::create(['name' => 'view productdetails']);
        Permission::create(['name' => 'create productdetails']);
        Permission::create(['name' => 'update productdetails']);
        Permission::create(['name' => 'delete productdetails']);

        Permission::create(['name' => 'list products']);
        Permission::create(['name' => 'view products']);
        Permission::create(['name' => 'create products']);
        Permission::create(['name' => 'update products']);
        Permission::create(['name' => 'delete products']);

        Permission::create(['name' => 'list comments']);
        Permission::create(['name' => 'view comments']);
        Permission::create(['name' => 'create comments']);
        Permission::create(['name' => 'update comments']);
        Permission::create(['name' => 'delete comments']);

        Permission::create(['name' => 'list carts']);
        Permission::create(['name' => 'view carts']);
        Permission::create(['name' => 'create carts']);
        Permission::create(['name' => 'update carts']);
        Permission::create(['name' => 'delete carts']);

        Permission::create(['name' => 'list orderdetails']);
        Permission::create(['name' => 'view orderdetails']);
        Permission::create(['name' => 'create orderdetails']);
        Permission::create(['name' => 'update orderdetails']);
        Permission::create(['name' => 'delete orderdetails']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
