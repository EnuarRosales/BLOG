<?php

namespace Database\Seeders;

use App\Models\Impuesto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImpuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $impuesto= new Impuesto();
        $impuesto->nombre="Retencion Fuente";
        $impuesto->porcentaje=4;
        $impuesto->estado=1;
        $impuesto->mayorQue=100000;
        $impuesto->save();
        
    }
}
