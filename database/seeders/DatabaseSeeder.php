<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;
use App\Models\TipoUsuario;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TipoUsuarioSeeder::class);
        //TipoUsuario::factory(1)->create();
        User::factory(1)->create();
        $this->call(RolSeeder::class);

    }
}
