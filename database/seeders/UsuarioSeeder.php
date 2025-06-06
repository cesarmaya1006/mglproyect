<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empleados')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('tranv_empresas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $roles = Role::get();
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario1 = User::create([
            'name' => 'Cesar Maya',
            'email' => 'cesarmaya1006@gmail.com',
            'password' => bcrypt('123456789'),
            'licencia' => 1
        ])->syncRoles('Super Administrador','Administrador','Administrador Empresa','Empleado');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Daniel Lopez',
            'email' => 'dlopez@mgl.com',
            'password' => bcrypt('123456789'),
            'licencia' => 1
        ])->syncRoles(['Administrador','Administrador Empresa','Empleado']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Alejandro Gomez',
            'email' => 'agomez@mgl.com',
            'password' => bcrypt('123456789'),
            'licencia' => 1
        ])->syncRoles(['Administrador','Administrador Empresa','Empleado']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Monica Moya',
            'email' => 'mony@gmail.com',
            'password' => bcrypt('999999999')
        ])->syncRoles(['Administrador Empresa']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Pepe Moya',
            'email' => 'pepe@gmail.com',
            'password' => bcrypt('888888888')
        ])->syncRoles(['Administrador Empresa']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    }
}
