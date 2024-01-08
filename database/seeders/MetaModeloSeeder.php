<?php

namespace Database\Seeders;

use App\Models\MetaModelo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetaModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
{
    $metaModeloExistente = MetaModelo::first();

    if (!$metaModeloExistente) {
        $metaModelo = new MetaModelo();
        $metaModelo->porcentaje = 0;
        $metaModelo->mayorQue = 0;
        $metaModelo->save();
    }
}

}
