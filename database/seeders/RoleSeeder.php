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
        $admin=Role::create(['name'=>'admin']);
        $worker=Role::create(['name'=>'worker']);
        $other=Role::create(['name'=>'other']);

        Permission::create(['name'=>'manage.users'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.products'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.places'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.providers'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.invoices'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.incomes'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.outcomes'])->syncRoles([$admin]);
        Permission::create(['name'=>'manage.clients'])->syncRoles([$admin, $worker]);
        Permission::create(['name'=>'sale'])->syncRoles([$admin, $worker]);
        Permission::create(['name'=>'buy'])->syncRoles([$admin, $worker]);
        
    }
}
