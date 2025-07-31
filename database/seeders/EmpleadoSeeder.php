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
        $empleados = [
            ['nombres' => 'Almendra Cecilia','apellidos' => 'Maya Moya','email' => 'almendra@gmail.com','password' => '123456789','licencia' => 1,'cargo_id' => 1,'tipo_documento_id' => 1,'identificacion' => '555555555','telefono' => '3216549898','direccion' => 'casa 1A','vinculacion' => '2024-02-02','foto' => '1751586942gato3.png','lider' => 1,],
            ['nombres' => 'DIANA', 'apellidos' => 'MONTOYA','email' => 'empleado1@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 2,'identificacion' => '1000018727','foto' => '1000018727.jpg','lider' => 1,],
            ['nombres' => 'MAYRA CAMILA', 'apellidos' => 'ZAMBRANO','email' => 'empleado2@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 4,'identificacion' => '1000018726','foto' => '1000018726.jpg','lider' => 0,],
            ['nombres' => 'JUAN DAVID', 'apellidos' => 'LARIOS','email' => 'empleado3@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1000457519','foto' => '1000457519.jpg','lider' => 0,],
            ['nombres' => 'LAURA MARCELA', 'apellidos' => 'VELANDIA','email' => 'empleado4mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1000805504','foto' => '1000805504.jpg','lider' => 0,],
            ['nombres' => 'JUAN PABLO', 'apellidos' => 'MORA ','email' => 'empleado5@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1001083801','foto' => '1001083801.jpg','lider' => 1,],
            ['nombres' => 'MARGARITA ', 'apellidos' => 'AVALOS','email' => 'empleado6@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1003505505','foto' => '1003505505.jpg','lider' => 0,],
            ['nombres' => 'ANDRES FELIPE', 'apellidos' => 'MARTINEZ','email' => 'empleado7@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010025432','foto' => '1010025432.jpg','lider' => 0,],
            ['nombres' => 'Richard Enrique', 'apellidos' => 'Barrera','email' => 'empleado8@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010119873','foto' => '1010119873.jpg','lider' => 0,],
            ['nombres' => 'SANDRA MILENA', 'apellidos' => 'CAIPA','email' => 'empleado9@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010170925','foto' => '1010170925.jpg','lider' => 0,],
            ['nombres' => 'MARIA CAMILA ', 'apellidos' => 'NIETO ','email' => 'empleado10@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010191684','foto' => '1010191684.jpg','lider' => 0,],
            ['nombres' => 'JIMMY JEFFRY', 'apellidos' => 'OSORIO','email' => 'empleado11@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010195594','foto' => '1010195594.jpg','lider' => 0,],
            ['nombres' => 'OSCAR ALEXANDER', 'apellidos' => 'CAMELO','email' => 'empleado12@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010211067','foto' => '1010211067.jpg','lider' => 0,],
            ['nombres' => 'JOSE ANDRES', 'apellidos' => 'SUAVITA','email' => 'empleado13@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010217262','foto' => '1010217262.jpg','lider' => 0,],
            ['nombres' => 'BYRON', 'apellidos' => 'VARON','email' => 'empleado14@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010219797','foto' => '1010219797.jpeg','lider' => 0,],
            ['nombres' => 'ALLISON DANIELA', 'apellidos' => 'MEDELLIN','email' => 'empleado15@mgl.com','password' => '123456789','licencia' => 1,'cargo_id' => 3,'identificacion' => '1010224591','foto' => '1010224591.jpg','lider' => 0,],

        ];
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
        foreach ($empleados as $empleado) {
            $usuario1 = User::create([
            'name' => ucfirst(strtolower(strtok($empleado['nombres'], " "))) . ' ' . ucfirst(strtolower(strtok($empleado['apellidos'], " "))),
            'email' => $empleado['email'],
            'password' => bcrypt('123456789'),
            'licencia' => 1,
            'foto' => $empleado['foto'],
        ])->syncRoles(['Empleado']);
            $empleado1 = Empleado::create([
            'id' => $usuario1->id,
            'cargo_id' => $empleado['cargo_id'],
            'tipo_documento_id' => 1,
            'identificacion' => $empleado['identificacion'],
            'nombres' => ucwords(strtolower($empleado['nombres'])),
            'apellidos' => ucwords(strtolower($empleado['apellidos'])),
            'telefono' => strval(rand(3216548787, 3506548787)),
            'direccion' => 'casa ' . rand(20 ,60),
            'vinculacion' => date('Y-m-d',strtotime('2025-02-02'."+ ". rand(10,180) ." days")) ,
            'foto' => $empleado['foto'],
            'lider' => $empleado['lider'],
        ]);
        }
        // -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- -- --
    }
}
