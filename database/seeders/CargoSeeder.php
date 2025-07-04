<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('cargos')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // ===================================================================================
        $datas = [
            ['area_id' => 1, 'cargo' => 'Gerente'],
            ['area_id' => 2, 'cargo' => 'Secretario(a)'],
            ['area_id' => 3, 'cargo' => 'Desarrollador'],
            ['area_id' => 4, 'cargo' => 'Jefe RH'],
            ['area_id' => 5, 'cargo' => 'Gerente'],
            ['area_id' => 6, 'cargo' => 'Secretario(a)'],
            ['area_id' => 7, 'cargo' => 'DBA'],
            ['area_id' => 8, 'cargo' => 'Asistente'],

        ];
        // ===================================================================================

        // ===================================================================================
        foreach ($datas as $data) {
            DB::table('cargos')->insert([
                'area_id' => $data['area_id'],
                'cargo' => $data['cargo'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
