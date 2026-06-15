<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // ROLES
        $adminRole = Role::firstOrCreate(['name'=>'admin']);
        $userRole = Role::firstOrCreate(['name'=>'user']);

        // POST
        $permissionIndexClient = Permission::create(['name'=>'view client']);
        $permissionCreateClient = Permission::create(['name'=>'create client']);
        $permissionEditClient = Permission::create(['name'=>'edit client']);
        $permissionDeleteClient = Permission::create(['name'=>'delete client']);


        // PERMISOS PARA USUARIOS
        $permissionIndexUser = Permission::create(['name'=>'view users']);
        $permissionCreateUser = Permission::create(['name'=>'create users']);
        $permissionEditUser = Permission::create(['name'=>'edit users']);
        $permissionDeleteUser = Permission::create(['name'=>'delete users']);
        $permissionAssignRoles = Permission::create(['name'=>'assign roles']);
        $permissionAssignPermissions = Permission::create(['name'=>'assign permissions']);
        
        // ROL PERMISOS
        $adminRole->givePermissionTo(Permission::all());

        // ROL EDITOR
        $userRole->givePermissionTo([
            $permissionIndexClient,
            $permissionEditClient,
            $permissionIndexClient,
        ]);

        
    }
}
