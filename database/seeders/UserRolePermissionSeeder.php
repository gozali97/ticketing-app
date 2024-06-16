<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@dev.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@dev.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
        $kasir = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@dev.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        $role_superadmin = Role::create(['name' => 'Superadmin']);
        $role_admin = Role::create(['name' => 'Admin']);
        $role_kasir = Role::create(['name' => 'Kasir']);

        $permission = Permission::create(['name' => 'access dashboard']);
        $permission = Permission::create(['name' => 'access event']);
        $permission = Permission::create(['name' => 'access ticket']);
        $permission = Permission::create(['name' => 'access transaksi']);
        $permission = Permission::create(['name' => 'access permission']);
        $permission = Permission::create(['name' => 'access role']);
        $permission = Permission::create(['name' => 'access user']);


        $role_superadmin->givePermissionTo('access dashboard');
        $role_superadmin->givePermissionTo('access event');
        $role_superadmin->givePermissionTo('access ticket');
        $role_superadmin->givePermissionTo('access transaksi');
        $role_superadmin->givePermissionTo('access permission');
        $role_superadmin->givePermissionTo('access role');
        $role_superadmin->givePermissionTo('access user');



        $role_admin->givePermissionTo('access dashboard');
        $role_admin->givePermissionTo('access event');
        $role_admin->givePermissionTo('access ticket');
        $role_admin->givePermissionTo('access transaksi');


        $role_kasir->givePermissionTo('access dashboard');
        $role_kasir->givePermissionTo('access transaksi');

        $superadmin->assignRole('Superadmin');
        $admin->assignRole('Admin');
        $kasir->assignRole('Kasir');
    }
}
