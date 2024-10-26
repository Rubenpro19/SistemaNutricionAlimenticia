<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Definir los roles iniciales
        $rol = [
            [
                'nombre_rol' => 'Administrador',
                'descripcion' => 'Puede realizar todas las acciones del sistema.',
            ],
            [
                'nombre_rol' => 'Nutricionista',
                'descripcion' => 'Asigna citas y guarda los datos de los pacientes en cada atención.',
            ],
            [
                'nombre_rol' => 'Paciente',
                'descripcion' => 'Puede ver su historial de atenciones y agendarse citas.',
            ],
        ];

        // Insertar los roles en la base de datos
        foreach ($rol as $rol) {
            Rol::create($rol);
        }
    }
}
