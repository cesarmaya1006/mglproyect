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
        Permission::create(['name' => 'permisos_menus_empresas.index'])->syncRoles([$rol1, $rol2]);


        Permission::create(['name' => 'areas.index'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'areas.create'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'areas.edit'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'areas.store'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'areas.update'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'areas.destroy'])->syncRoles([$rol1, $rol2,$rol3]);


        Permission::create(['name' => 'empresa.index'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empresa.create'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empresa.edit'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empresa.store'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empresa.update'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empresa.destroy'])->syncRoles([$rol1, $rol2,$rol3]);


        Permission::create(['name' => 'cargos.index'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.create'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.edit'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.store'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.update'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.destroy'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.getCargos'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.getCargosTodos'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'cargos.getAreas'])->syncRoles([$rol1, $rol2,$rol3]);


        Permission::create(['name' => 'empleados.index'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empleados.create'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empleados.edit'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empleados.store'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empleados.update'])->syncRoles([$rol1, $rol2,$rol3]);
        Permission::create(['name' => 'empleados.destroy'])->syncRoles([$rol1, $rol2,$rol3]);








    }
}
