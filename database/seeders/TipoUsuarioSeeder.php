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
        TipoUsuario::create(['nombre'=> 'Administrador']);
        TipoUsuario::create(['nombre'=> 'Modelo']);
        TipoUsuario::create(['nombre'=> 'Modelo Satélite']);
        TipoUsuario::create(['nombre'=> 'Monitor']);
        TipoUsuario::create(['nombre'=> 'Contador']);
    }
}
