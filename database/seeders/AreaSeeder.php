<?php

namespace Database\Seeders;

use App\Models\Empresa\Empresa;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('areas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');

        // ===================================================================================
        $datas = [
            ['area_id' => null,'empresa_id'=>1, 'area' => 'Gerencia'],
            ['area_id' => 1,'empresa_id'=>1, 'area' => 'Administrativa'],
            ['area_id' => 1,'empresa_id'=>1, 'area' => 'Tecnología'],
            ['area_id' => 1,'empresa_id'=>1, 'area' => 'Recursos Humanos'],
            ['area_id' => null,'empresa_id'=>2, 'area' => 'Gerencia'],
            ['area_id' => 5,'empresa_id'=>2, 'area' => 'Administrativa'],
            ['area_id' => 5,'empresa_id'=>2, 'area' => 'Tecnología'],
            ['area_id' => 5,'empresa_id'=>2, 'area' => 'Recursos Humanos'],

        ];
        // ===================================================================================

        // ===================================================================================
        foreach ($datas as $data) {
            DB::table('areas')->insert([
                'area_id' => $data['area_id'],
                'empresa_id' => $data['empresa_id'],
                'area' => $data['area'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
