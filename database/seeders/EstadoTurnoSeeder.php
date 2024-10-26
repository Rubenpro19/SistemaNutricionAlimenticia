<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EstadoTurno;

class EstadoTurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Definir estados de turno iniciales
        $estados_turnos = [
            [
                'nombre_estado' => 'No tomado',
                'descripcion' => 'Turno no tomado aún.',
            ],
            [
                'nombre_estado' => 'Terminado',
                'descripcion' => 'Turno ya finalizado.',
            ],
            [
                'nombre_estado' => 'Reservado',
                'descripcion' => 'Turno reservado por un paciente.',
            ],
            [
                'nombre_estado' => 'Cancelado',
                'descripcion' => 'Turno cancelado.',
            ],
        ];

        // Insertar los estados de los turnos en la base de datos
        foreach ($estados_turnos as $estados_turnos) {
            EstadoTurno::create($estados_turnos);
        }
    }
}
