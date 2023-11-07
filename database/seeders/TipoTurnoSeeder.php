<?php

namespace Database\Seeders;

use App\Models\Turno;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoTurnoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manana = new Turno();
        $manana->nombre = "Mañana";
        $manana->horaIngreso = "07:00:00";
        $manana->horaTermino = "14:00:00";
        $manana->save();

        $tarde = new Turno();
        $tarde->nombre = "Tarde";
        $tarde->horaIngreso = "14:00:00";
        $tarde->horaTermino = "21:00:00";
        $tarde->save();

        $noche = new Turno();
        $noche->nombre = "Noche";
        $noche->horaIngreso = "21:00:00";
        $noche->horaTermino = "07:00:00";
        $noche->save();
    }
}
