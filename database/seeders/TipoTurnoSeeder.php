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
        $turnoManana = Turno::where('nombre', 'Mañana')->first();
        if (!$turnoManana) {
            $manana = new Turno();
            $manana->nombre = "Mañana";
            $manana->horaIngreso = "07:00:00";
            $manana->horaTermino = "14:00:00";
            $manana->save();
        }

        $turnoTarde = Turno::where('nombre', 'Tarde')->first();
        if (!$turnoTarde) {
            $tarde = new Turno();
            $tarde->nombre = "Tarde";
            $tarde->horaIngreso = "14:00:00";
            $tarde->horaTermino = "21:00:00";
            $tarde->save();
        }

        $turnoNoche = Turno::where('nombre', 'Noche')->first();
        if (!$turnoNoche) {
            $noche = new Turno();
            $noche->nombre = "Noche";
            $noche->horaIngreso = "21:00:00";
            $noche->horaTermino = "07:00:00";
            $noche->save();
        }
    }
}
