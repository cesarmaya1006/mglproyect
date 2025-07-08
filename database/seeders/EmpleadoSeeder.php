<?php

namespace Database\Seeders;

use App\Models\Empresa\Empleado;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        $usuario1 = User::create([
            'name' => 'Almendra Moya',
            'email' => 'almendra@gmail.com',
            'password' => bcrypt('123456789'),
            'foto' => '1751586942gato3.png'
        ])->syncRoles(['Empleado']);
        $empleado1 = Empleado::create([
            'id' => $usuario1->id,
            'cargo_id' => 4,
            'tipo_documento_id' => 1,
            'identificacion' => '555555555',
            'nombres' => 'Almendra Cecilia',
            'apellidos' => 'Maya Moya',
            'telefono' => '3216549898',
            'direccion' => 'casa 1A',
            'vinculacion' => '2025-02-02',
            'foto' => '1751586942gato3.png',
            'lider' => 1,
        ]);
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    }
}
