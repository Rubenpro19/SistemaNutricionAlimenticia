<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Rol;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Rol::class;

    public function definition(): array
    {
        return [
            'nombre_rol' => $this->faker->unique()->jobTitle, // Genera un título de trabajo único
            'descripcion' => $this->faker->sentence, // Genera una descripción aleatoria
        ];
    }
}
