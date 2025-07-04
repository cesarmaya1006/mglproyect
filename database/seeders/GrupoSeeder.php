<?php

namespace Database\Seeders;

use App\Models\Empresa\Empresa;
use App\Models\Empresa\Grupo;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GrupoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('grupos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('empresas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $grupo1 = Grupo::create([
            'tipo_documento_id' => 6,
            'identificacion' => '888888888',
            'grupo' => 'Grupo Prueba 1',
            'email' => 'grupo1@gmail.com',
            'telefono' => '3216548787',
            'direccion' => 'Calle 2 # 1-121',
            'logo' => 'empresa3.png',
        ]);
        DB::table('grupo_user')->insert(['user_id' => 5, 'grupo_id' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),]);
        $empresa1 = Empresa::create([
            'grupo_id' => 1,
            'tipo_documento_id' => 6,
            'identificacion' => '888888888',
            'empresa' => 'Empresa Grupo 1',
            'email' => 'grupo1@gmail.com',
            'telefono' => '3216548787',
            'direccion' => 'Calle 2 # 1-121',
            'logo' => 'empresa3.png',
        ]);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $empresa2 = Empresa::create([
            'tipo_documento_id' => 6,
            'identificacion' => '999999999',
            'empresa' => 'Empresa Prueba 1',
            'email' => 'empresa1@gmail.com',
            'telefono' => '3216548787',
            'direccion' => 'Calle 1 # 1-122',
            'logo' => 'empresa1.png',
        ]);
        DB::table('empresa_user')->insert(['user_id' => 4, 'empresa_id' => 1, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'),]);
    }
}
