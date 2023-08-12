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
        $pagina = new Pagina();
        $pagina->nombre ="CHATURBATE";
        $pagina->moneda ="dolar";
        $pagina->valor =0.05;
        $pagina->save();

        $pagina1 = new Pagina();
        $pagina1->nombre ="STRIPCHAT";
        $pagina1->moneda ="dolar";
        $pagina1->valor =0.05;
        $pagina1->save();

        $pagina2 = new Pagina();
        $pagina2->nombre ="CAMSODA";
        $pagina2->moneda ="dolar";
        $pagina2->valor =1;
        $pagina2->save();

        $pagina3 = new Pagina();
        $pagina3->nombre ="BONGA";
        $pagina3->moneda ="dolar";
        $pagina3->valor =1;
        $pagina3->save();
    }
}
