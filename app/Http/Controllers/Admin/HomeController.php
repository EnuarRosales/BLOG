<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\Descuento;
use App\Models\Empresa;
use App\Models\ResgistroProducido;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function dataDescuentos()
    {
        $fechaActual = Carbon::now();
        $terceraQuincena = $fechaActual->copy();
        $segundaQuincena = $fechaActual->copy()->subDays(15);
        $primeraQuincena = $fechaActual->copy()->subDays(30);
        $descuentosTerceraQuincena = Descuento::whereBetween('created_at', [$terceraQuincena, $fechaActual])->sum('montoDescuento');
        $descuentosSegundaQuincena = Descuento::whereBetween('created_at', [$segundaQuincena, $terceraQuincena])->sum('montoDescuento');
        $descuentosPrimeraQuincena = Descuento::whereBetween('created_at', [$primeraQuincena, $segundaQuincena])->sum('montoDescuento');

        $valoresParaJS = '[' . $descuentosTerceraQuincena . ', ' . $descuentosSegundaQuincena . ', ' . $descuentosPrimeraQuincena . ']';

        return $valoresParaJS;
    }




        public function index()
        {
            $usuariosModelos = User::where('active', 1)
                ->whereHas('tipoUsuario', function ($query) {
                    $query->where('nombre', 'Modelo');
                })
                ->count();            
            $multas = AsignacionMulta::where('descontado',0)->count();
            $descuentos = Descuento::where('saldo', '>', 0)->sum('saldo');  
            $dataDescuento = $this->dataDescuentos();
            return view('admin.index', compact('usuariosModelos','multas','descuentos','dataDescuento'));
        }

    

    









}
