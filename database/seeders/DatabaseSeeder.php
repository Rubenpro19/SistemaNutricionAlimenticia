<?php

namespace Database\Seeders;

use App\Models\EstadoTurno;
use App\Models\User;
use App\Models\Usuario;
use App\Models\Rol;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]); */

        //Ejecución de los Seeders
        $this->call(
            [
                RolSeeder::class,
                EstadoTurnoSeeder::class,
                UsuarioSeeder::class,
            ]
        );

    }
}
