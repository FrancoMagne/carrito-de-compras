<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'admin']);
        $role_seller = Role::create(['name' => 'vendedor']);
        $role_customer = Role::create(['name' => 'cliente']);
        
        // Permisos de Administrador
        Permission::create(['name' => 'usuarios'])->assignRole($role_admin);
        Permission::create(['name' => 'categorias'])->assignRole($role_admin);
        
        // Permisos de Vendedor
        Permission::create(['name' => 'articulos'])->assignRole($role_seller);
        Permission::create(['name' => 'ventas'])->assignRole($role_seller);
        Permission::create(['name' => 'clientes'])->assignRole($role_seller);
        Permission::create(['name' => 'paypal'])->assignRole($role_seller);
        
        // Permisos de Cliente
        Permission::create(['name' => 'compras'])->assignRole($role_customer);
        //Permission::create(['name' => 'deshabilitar_cuenta'])->syncRoles([$role_seller, $role_customer]);
    }
}
