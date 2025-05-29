<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // ===================================================================================
        $rol1 = Role::create(['name' => 'Super Administrador']);
        $rol2 = Role::create(['name' => 'Administrador']);
        $rol3 = Role::create(['name' => 'Administrador Empresa']);
        $rol4 = Role::create(['name' => 'Empleado']);

        Permission::create(['name' => 'dashboard'])->syncRoles([$rol1, $rol2, $rol3, $rol4]);
    }
}
