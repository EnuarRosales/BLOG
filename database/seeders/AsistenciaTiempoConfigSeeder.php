<?php

namespace Database\Seeders;

use App\Models\AsistenciaTiempoConfig;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsistenciaTiempoConfigSeeder extends Seeder
{
    public function run()
    {
        $AsistenciaTiempoConfig = new AsistenciaTiempoConfig();
        $AsistenciaTiempoConfig->nombre = 'Sobre el Tiempo';
        $AsistenciaTiempoConfig->clase = 'btn btn-warning';
        $AsistenciaTiempoConfig->tiempo = 900;
        $AsistenciaTiempoConfig->save();
    }
}
