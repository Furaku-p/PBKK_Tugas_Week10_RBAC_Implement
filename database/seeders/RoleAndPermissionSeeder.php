<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'view-dashboard',
            'view-mahasiswa',
            'delete-mahasiswa',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $staf = Role::firstOrCreate(['name' => 'Staf', 'guard_name' => 'web']);

        $admin->syncPermissions($permissions);
        $staf->syncPermissions(['view-dashboard', 'view-mahasiswa']);

        $adminUser = User::updateOrCreate(
            ['email' => 'admin@its.ac.id'],
            ['name' => 'Administrator', 'password' => Hash::make('Admin123!')]
        );
        $adminUser->syncRoles([$admin]);

        $stafUser = User::updateOrCreate(
            ['email' => 'staf@its.ac.id'],
            ['name' => 'Staf Akademik', 'password' => Hash::make('Staf123!')]
        );
        $stafUser->syncRoles([$staf]);
    }
}
