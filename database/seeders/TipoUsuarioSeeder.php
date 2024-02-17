<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoUsuario::firstOrCreate(['nombre'=> 'Administrador']);
        TipoUsuario::firstOrCreate(['nombre'=> 'Modelo']);
        TipoUsuario::firstOrCreate(['nombre'=> 'Modelo Satélite']);
        TipoUsuario::firstOrCreate(['nombre'=> 'Monitor']);
        TipoUsuario::firstOrCreate(['nombre'=> 'Contador']);
    }
}
