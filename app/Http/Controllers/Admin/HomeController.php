<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\Descuento;
use App\Models\Empresa;
use App\Models\Meta;
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

        $cuartoMes = $fechaActual->copy();
        $tercerMes = $fechaActual->copy()->subMonths(1);
        $segundoMes = $fechaActual->copy()->subMonths(2);
        $primerMes = $fechaActual->copy()->subMonths(3);

        $primeraQuincenaCuartoMes = Descuento::whereYear('created_at', $cuartoMes)
            ->whereMonth('created_at', $cuartoMes)
            ->whereDay('created_at', '<=', 15)
            ->sum('montoDescuento');

        $segundaQuincenaCuartoMes = Descuento::whereYear('created_at', $cuartoMes)
            ->whereMonth('created_at', $cuartoMes)
            ->whereDay('created_at', '>', 15)
            ->sum('montoDescuento');

        $primeraQuincenaTercerMes = Descuento::whereYear('created_at', $tercerMes)
            ->whereMonth('created_at', $tercerMes)
            ->whereDay('created_at', '<=', 15)
            ->sum('montoDescuento');

        $segundaQuincenaTercerMes = Descuento::whereYear('created_at', $tercerMes)
            ->whereMonth('created_at', $tercerMes)
            ->whereDay('created_at', '>', 15)
            ->sum('montoDescuento');

        $primeraQuincenaSegundoMes = Descuento::whereYear('created_at', $segundoMes)
            ->whereMonth('created_at', $segundoMes)
            ->whereDay('created_at', '<=', 15)
            ->sum('montoDescuento');

        $segundaQuincenaSegundoMes = Descuento::whereYear('created_at', $segundoMes)
            ->whereMonth('created_at', $segundoMes)
            ->whereDay('created_at', '>', 15)
            ->sum('montoDescuento');

        $segundaQuincenaPrimerMes = Descuento::whereYear('created_at', $primerMes)
            ->whereMonth('created_at', $primerMes)
            ->whereDay('created_at', '>', 15)
            ->sum('montoDescuento');

        $dataDescuentosJS = '[' . $segundaQuincenaPrimerMes . ', ' . $primeraQuincenaSegundoMes . ', ' . $segundaQuincenaSegundoMes . ', ' . $primeraQuincenaTercerMes . ', ' . $segundaQuincenaTercerMes . ', ' . $primeraQuincenaCuartoMes . ', ' . $segundaQuincenaCuartoMes . ']';
        return $dataDescuentosJS;
    }


    public function dataMeta()
    {
        $datoMasReciente = Meta::latest()->first(); // O Dato::latest()->get() si deseas obtener varios registros
        // Puedes hacer lo que desees con $datoMasReciente aquíecho
        $valorMeta = $datoMasReciente->valor;
        $idMeta = $datoMasReciente->id;
        $registroProduccion = ResgistroProducido::where('meta_id', $idMeta)
            ->sum('valorProducido');
        $porcentajeMeta = ($registroProduccion * 100) / $valorMeta;        
        return array($valorMeta, $porcentajeMeta, $registroProduccion);
    }

    public function dataMulta()
    {
        $fechaActual = Carbon::now();

        $cuartoMes = $fechaActual->copy();
        $tercerMes = $fechaActual->copy()->subMonths(1);
        $segundoMes = $fechaActual->copy()->subMonths(2);
        $primerMes = $fechaActual->copy()->subMonths(3);

        $primeraQuincenaCuartoMes = AsignacionMulta::whereYear('created_at', $cuartoMes)
            ->whereMonth('created_at', $cuartoMes)
            ->whereDay('created_at', '<=', 15)
            ->count();

        $segundaQuincenaCuartoMes = AsignacionMulta::whereYear('created_at', $cuartoMes)
            ->whereMonth('created_at', $cuartoMes)
            ->whereDay('created_at', '>', 15)
            ->count();

        $primeraQuincenaTercerMes = AsignacionMulta::whereYear('created_at', $tercerMes)
            ->whereMonth('created_at', $tercerMes)
            ->whereDay('created_at', '<=', 15)
            ->count();

        $segundaQuincenaTercerMes = AsignacionMulta::whereYear('created_at', $tercerMes)
            ->whereMonth('created_at', $tercerMes)
            ->whereDay('created_at', '>', 15)
            ->count();

        $primeraQuincenaSegundoMes = AsignacionMulta::whereYear('created_at', $segundoMes)
            ->whereMonth('created_at', $segundoMes)
            ->whereDay('created_at', '<=', 15)
            ->count();

        $segundaQuincenaSegundoMes = AsignacionMulta::whereYear('created_at', $segundoMes)
            ->whereMonth('created_at', $segundoMes)
            ->whereDay('created_at', '>', 15)
            ->count();

        $segundaQuincenaPrimerMes = AsignacionMulta::whereYear('created_at', $primerMes)
            ->whereMonth('created_at', $primerMes)
            ->whereDay('created_at', '>', 15)
            ->count();

        $dataMultasJS = '[' . $segundaQuincenaPrimerMes . ', ' . $primeraQuincenaSegundoMes . ', ' . $segundaQuincenaSegundoMes . ', ' . $primeraQuincenaTercerMes . ', ' . $segundaQuincenaTercerMes . ', ' . $primeraQuincenaCuartoMes . ', ' . $segundaQuincenaCuartoMes . ']';
        return $dataMultasJS;
    }

    public function dataHistorialMeta()
    {
        $datoMasRecientes = Meta::latest()->take(4)->get();
        $miArray = array(); // Inicializar un array vacío           

        foreach ($datoMasRecientes as $datoMasReciente) {
            $registroProduccion = ResgistroProducido::where('meta_id', $datoMasReciente->id)
                ->sum('valorProducido');
            $porcentajeMeta = ($registroProduccion * 100) / $datoMasReciente->valor;

            $miArray[] = $datoMasReciente->nombre;
            $miArray[] = $porcentajeMeta;
        }
        return $miArray;
    }


    public function index()
    {
        $usuariosModelos = User::where('active', 1)
            ->whereHas('tipoUsuario', function ($query) {
                $query->where('nombre', 'Modelo');
            })
            ->count();
        $multas = AsignacionMulta::where('descontado', 0)->count();
        $descuentos = Descuento::where('saldo', '>', 0)->sum('saldo');
        $dataDescuentos = $this->dataDescuentos();
        $dataMetas = $this->dataMeta();
        $dataMultas = $this->dataMulta();
        $dataHistorialMetas = $this->dataHistorialMeta();
        return view('admin.index', compact('usuariosModelos', 'multas', 'descuentos', 'dataDescuentos', 'dataMetas', 'dataMultas', 'dataHistorialMetas'));
    }
}
