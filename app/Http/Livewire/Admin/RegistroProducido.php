<?php

namespace App\Http\Livewire\Admin;

use App\Models\ResgistroProducido;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class RegistroProducido extends Component
{

    public $fechas;
    public $fechas2;
    public $fechas3;

    public function mount($fechas, $fechas2, $fechas3)
    {
        $this->fechas = $fechas;
        $this->fechas2 = $fechas2;
        $this->fechas3 = $fechas3;
        // $fechas4 = RegistroProducido::reporte_dia();
        // $a = $this->reporte_dia();

        // foreach ($fechas as $fecha){
        //     if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0){
        //         ($fecha->meta->valor) / ($fecha->meta->dias);

        //     }
        // }

        $this->fechas = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),

            DB::raw('fecha'),

        )
            ->groupBy('fecha', 'meta_id')
            ->get();

            $this->fechas2 = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),
            // DB::raw('fecha'),

        )
            ->groupBy('meta_id')
            ->get();

            $this->fechas3 = ResgistroProducido::select(
            DB::raw('COUNT(DISTINCT(DATE(fecha)))  as date_count'),
            DB::raw('meta_id'),

        )
            ->groupBy('meta_id')
            ->get();
    }



    public function reporte_dia()
    {

        $this->fechas = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),

            DB::raw('fecha'),

        )
            ->groupBy('fecha', 'meta_id')
            ->get();

            $this->fechas2 = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),
            // DB::raw('fecha'),

        )
            ->groupBy('meta_id')
            ->get();

            $this->fechas3 = ResgistroProducido::select(
            DB::raw('COUNT(DISTINCT(DATE(fecha)))  as date_count'),
            DB::raw('meta_id'),

        )
            ->groupBy('meta_id')
            ->get();
        // return view('admin.registroProducidos.resumen', compact('fechas', 'fechas2', 'fechas3'));
    }

   



    public function render()
    {
        return view('livewire.admin.registro-producido');
    }
}
