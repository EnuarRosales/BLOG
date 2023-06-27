<?php

namespace Database\Factories;

use App\Models\TipoUsuario;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TipoUsuario>
 */
class TipoUsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $tipoUsuario =TipoUsuario::class;

    public function definition()
    {
        return [

            'nombre' => $this->faker->randomElement(['MODELO','MONITOR','DUEÑO']), 
            'porcentaje' => $this->faker->randomElement([60,100,80]),          
            
            //
        ];
    }
}
