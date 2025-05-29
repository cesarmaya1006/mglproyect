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
            'password' => bcrypt('123456789')
        ])->syncRoles('Super Administrador');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Daniel Lopez',
            'email' => 'dlopez@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles(['Administrador']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario2 = User::create([
            'name' => 'Alejandro Gomez',
            'email' => 'agomez@mgl.com',
            'password' => bcrypt('123456789')
        ])->syncRoles(['Administrador']);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    }
}
