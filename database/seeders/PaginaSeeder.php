<?php

namespace Database\Seeders;

use App\Models\Pagina;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaginaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paginas = [
            [
                'nombre' => 'CHATURBATE',
                'moneda' => 'dolar',
                'valor' => 0.05,
            ],
            [
                'nombre' => 'STRIPCHAT',
                'moneda' => 'dolar',
                'valor' => 0.05,
            ],
            [
                'nombre' => 'CAMSODA',
                'moneda' => 'dolar',
                'valor' => 1,
            ],
            [
                'nombre' => 'BONGA',
                'moneda' => 'dolar',
                'valor' => 1,
            ],
        ];

        foreach ($paginas as $paginaData) {
            $pagina = Pagina::where('nombre', $paginaData['nombre'])->first();

            if (!$pagina) {
                Pagina::create($paginaData);
            }
        }
    }
}
