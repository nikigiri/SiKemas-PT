<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\PermissionRegistrar;

class DefaultUserRole extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permissions
        $manageAllKwt  = Permission::create(['name' => 'manage all kwt']);
        $manageUsers   = Permission::create(['name' => 'manage users']);
        $addProduct    = Permission::create(['name' => 'add product']);
        $editProduct   = Permission::create(['name' => 'edit product']);
        $deleteProduct = Permission::create(['name' => 'delete product']);
        $viewDashboard = Permission::create(['name' => 'view dashboard']);

        // Buat Roles
        $roleSuperAdmin = Role::create(['name' => 'superadmin']);
        $roleAdmin      = Role::create(['name' => 'admin']);
        $roleUser       = Role::create(['name' => 'user']);

        // Superadmin — semua akses
        $roleSuperAdmin->givePermissionTo([
            $manageAllKwt,
            $manageUsers,
            $addProduct,
            $editProduct,
            $deleteProduct,
            $viewDashboard,
        ]);

        // Admin per KWT — hanya manage user
        $roleAdmin->givePermissionTo([
            $manageUsers,
            $viewDashboard,
        ]);

        // User KWT
        $roleUser->givePermissionTo([
            $addProduct,
            $editProduct,
            $deleteProduct,
        ]);

        // Buat default Super Admin
        $superAdmin = User::factory()->create([
            'name'         => 'Super Admin',
            'nama_usaha'   => 'Si Kemas',
            'email'        => 'superadmin@sikemas.com',
            'no_tlp'       => '08000000000',
            'alamat_usaha' => 'Bandung',
            'kwt_id'       => null,
            'status'       => 'approved',
            'password'     => bcrypt('password'),
        ]);
        $superAdmin->assignRole($roleSuperAdmin);

        // Buat default Admin per KWT (KWT Melati)
        $adminUser = User::factory()->create([
            'name'         => 'Admin KWT Melati',
            'nama_usaha'   => 'KWT Melati',
            'email'        => 'admin@sikemas.com',
            'no_tlp'       => '083812345678',
            'alamat_usaha' => 'Bandung',
            'kwt_id'       => 1,
            'status'       => 'approved',
            'password'     => bcrypt('password'),
        ]);
        $adminUser->assignRole($roleAdmin);

        // Buat default User untuk testing
        $testUser = User::factory()->create([
            'name'         => 'Salmaida Wilangga',
            'nama_usaha'   => 'Acai Tea Bandung',
            'email'        => 'acaitea@gmail.com',
            'no_tlp'       => '083820052006',
            'alamat_usaha' => 'Bandung',
            'kwt_id'       => 1,
            'status'       => 'approved',
            'password'     => bcrypt('password'),
        ]);
        $testUser->assignRole($roleUser);
    }
}