<?php

namespace Database\Seeders;

use App\Models\TipoMulta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoMultasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definir los datos que deseas insertar en la base de datos
        $data = [
            [
                'nombre' => 'Llega Tarde',
                'costo' => 10000,
            ],
            // Puedes agregar más registros aquí si es necesario
        ];

        // Insertar los datos en la base de datos utilizando Eloquent
        foreach ($data as $item) {
            TipoMulta::create($item);
        }
    }
}
