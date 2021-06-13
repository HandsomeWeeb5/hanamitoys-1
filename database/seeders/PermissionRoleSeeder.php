<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        // Permission::create(['name' => 'view_categories']);
        // Permission::create(['name' => 'add_categories']);
        // Permission::create(['name' => 'edit_categories']);
        // Permission::create(['name' => 'delete_categories']);

        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'admin']);
        $customer = Role::create(['name' => 'customer']);
        // $admin->givePermissionTo('view_categories');
        // $admin->givePermissionTo('add_categories');
        // $admin->givePermissionTo('edit_categories');
        // $admin->givePermissionTo('delete_categories');

        // create users
        $userAdmin = \App\Models\User::factory()->create([
            'name' => 'Muhammad Fajar',
            'email' => 'admin@example.com',
        ]);
        $userAdmin->assignRole($admin);

        $userCustomer = \App\Models\User::factory()->create([
            'name' => 'Example Customer User',
            'email' => 'customer@example.com',
        ]);
        $userCustomer->assignRole($customer);
    }
}
