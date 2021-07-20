<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
        $admin=Role::create(['name'=>'Admin']);
        $vendedor=Role::create(['name'=>'Vendedor']);
        $otro=Role::create(['name'=>'Otro']);

        Permission::create(['name'=>'Gestionar Usuarios'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Sucursales'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Suplidores'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Facturas'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Ingresos'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Egresos'])->syncRoles([$admin]);
        Permission::create(['name'=>'Gestionar Clientes'])->syncRoles([$admin, $vendedor]);
        Permission::create(['name'=>'Gestionar Cajas'])->syncRoles([$admin, $vendedor]);
        Permission::create(['name'=>'Vender'])->syncRoles([$admin, $vendedor]);
        Permission::create(['name'=>'Comprar'])->syncRoles([$admin]);
        
    }
}
