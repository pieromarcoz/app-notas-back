<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'create notes']);
        Permission::create(['name' => 'edit notes']);
        Permission::create(['name' => 'delete notes']);
        Permission::create(['name' => 'view notes']);
        Permission::create(['name' => 'manage users']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'assign roles']);

        Permission::create(['name' => 'create own notes']);
        Permission::create(['name' => 'edit own notes']);
        Permission::create(['name' => 'delete own notes']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $estandarRole = Role::create(['name' => 'estandar']);
        $estandarRole->givePermissionTo([
            'create notes',
            'view notes',
            'edit own notes',
            'delete own notes'
        ]);

        $viewerRole = Role::create(['name' => 'viewer']);
        $viewerRole->givePermissionTo('view notes');

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $estandar = User::create([
            'name' => 'Estandar User',
            'email' => 'estandar@example.com',
            'password' => Hash::make('password'),
        ]);
        $estandar->assignRole('estandar');

        $viewer = User::create([
            'name' => 'Viewer User',
            'email' => 'viewer@example.com',
            'password' => Hash::make('password'),
        ]);
        $viewer->assignRole('viewer');
    }
}
