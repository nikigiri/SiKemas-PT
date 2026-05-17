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
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Buat Permissions
        $manageUsers    = Permission::create(['name' => 'manage users']);
        $addProduct     = Permission::create(['name' => 'add product']);
        $editProduct    = Permission::create(['name' => 'edit product']);
        $deleteProduct  = Permission::create(['name' => 'delete product']);
        $viewDashboard  = Permission::create(['name' => 'view dashboard']);

        // Buat Roles
        $roleAdmin = Role::create(['name' => 'admin']);
        $roleUser  = Role::create(['name' => 'user']);

        // Assign permissions ke admin pakai object langsung
        $roleAdmin->givePermissionTo([
            $manageUsers,
            $addProduct,
            $editProduct,
            $deleteProduct,
            $viewDashboard
        ]);

        // Assign permissions ke user
        $roleUser->givePermissionTo([
            $addProduct,
            $editProduct,
            $deleteProduct,
        ]);

        // Buat default Admin
        $adminUser = User::factory()->create([
            'name'          => 'Admin',
            'nama_usaha'    => 'siAdminKemas',
            'email'         => 'adminKemas@gmail.com',
            'no_tlp'        => '083812345678',
            'alamat_usaha'  => 'Bandung',
            'password'      => bcrypt('password')
        ]);
        $adminUser->assignRole($roleAdmin);

        // Buat default User untuk testing
        $testUser = User::factory()->create([
            'name'          => 'Salmaida Wilangga',
            'nama_usaha'    => 'Acai Tea Bandung',
            'email'         => 'acaitea@gmail.com',
            'no_tlp'        => '083820052006',
            'alamat_usaha'  => 'Bandung',
            'password'      => bcrypt('password')
        ]);
        $testUser->assignRole($roleUser);
    }
}