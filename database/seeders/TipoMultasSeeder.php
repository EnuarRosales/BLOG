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
        $data = [
            [
                'nombre' => 'Llega Tarde',
                'costo' => 10000,
            ],
            // Puedes agregar más registros aquí si es necesario
        ];

        foreach ($data as $item) {
            $tipoMulta = TipoMulta::where('nombre', $item['nombre'])->first();

            if (!$tipoMulta) {
                TipoMulta::create($item);
            }
        }
    }
}
