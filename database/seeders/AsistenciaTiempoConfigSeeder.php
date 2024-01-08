<?php

namespace Database\Seeders;

use App\Models\AsistenciaTiempoConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenciaTiempoConfigSeeder extends Seeder
{
    public function run()
    {
        $asistenciaTiempoConfigExistente = AsistenciaTiempoConfig::where('nombre', 'Sobre el Tiempo')->first();

        if (!$asistenciaTiempoConfigExistente) {
            $asistenciaTiempoConfig = new AsistenciaTiempoConfig();
            $asistenciaTiempoConfig->nombre = 'Sobre el Tiempo';
            $asistenciaTiempoConfig->clase = 'btn btn-warning';
            $asistenciaTiempoConfig->tiempo = 900;
            $asistenciaTiempoConfig->save();
        }
    }
}
