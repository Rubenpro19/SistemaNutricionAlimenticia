<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Usuario;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Usuario::class;
    
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name(), // Genera un nombre aleatorio
            'email' => $this->faker->unique()->safeEmail(), // Genera un email único y seguro
            'password' => bcrypt('password'), // Usa una contraseña segura (puedes cambiar esto)
            'rol_id' => $this->faker->numberBetween(1, 3), // Asigna un rol aleatorio (asumiendo que tienes 3 roles)
        ];
    }
}
