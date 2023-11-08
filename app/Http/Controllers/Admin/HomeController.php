<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\AsignacionTurno;
use App\Models\Asistencia;
use App\Models\AsistenciaTiempoConfig;
use App\Models\Descuento;
use App\Models\Empresa;
use App\Models\Meta;
use App\Models\Pago;
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

        //FALLA
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

        $dataDescuentosJS = '[' . $segundaQuincenaPrimerMes . ', ' . $segundaQuincenaSegundoMes . ', ' . $primeraQuincenaSegundoMes . ',  ' . $segundaQuincenaTercerMes . ', ' . $primeraQuincenaTercerMes . ',  ' . $segundaQuincenaCuartoMes . ', ' . $primeraQuincenaCuartoMes . ']';
        return $dataDescuentosJS;
    }


    public function dataMeta()
    {
        $datoMasReciente = Meta::latest()->first();
         // O Dato::latest()->get() si deseas obtener varios registros
        if ($datoMasReciente != null) {

    
        // if($datoMasReciente != null){

        // }
        $valorMeta = $datoMasReciente->valor;
            $idMeta = $datoMasReciente->id;
            $nombreMeta = $datoMasReciente->nombre;
            $registroProduccion = ResgistroProducido::where('meta_id', $idMeta)
                ->sum('valorProducido');
            $porcentajeMeta = ($registroProduccion * 100) / $valorMeta;
            return array($valorMeta, $porcentajeMeta, $registroProduccion, $nombreMeta);
        } else {
            $nombreMeta = "Programa una meta";
            // return array($nombreMeta);
            return array("0", " ", " ", $nombreMeta);
        }
    }

    public function dataHistorialMeta()
    {
        $datoMasRecientes = Meta::latest()->take(4)->get();
        $miArray = array(); // Inicializar un array vacío       
        if ($datoMasRecientes->count() > 0) {
            foreach ($datoMasRecientes as $datoMasReciente) {
                $registroProduccion = ResgistroProducido::where('meta_id', $datoMasReciente->id)
                    ->sum('valorProducido');
                $porcentajeMeta = ($registroProduccion * 100) / $datoMasReciente->valor;
                $miArray[] = $datoMasReciente->nombre; //0
                $miArray[] = $porcentajeMeta;          //1
                $miArray[] = $registroProduccion;      //2
                $miArray[] = $datoMasReciente->valor;  //3
            }
        }


        if ($datoMasRecientes->count() < 4) {
            $datos = 4 - $datoMasRecientes->count();

            for ($i = 0; $i < $datos; $i++) {
                $miArray[] = "No hay datos para mostarar"; //0
                $miArray[] = 0; //1
                $miArray[] = 0; //2
                $miArray[] = 0; //3

            }
        }

        return $miArray;
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

        $dataMultasJS = '[' . $segundaQuincenaPrimerMes . ', ' . $segundaQuincenaSegundoMes . ', ' . $primeraQuincenaSegundoMes . ', ' . $segundaQuincenaTercerMes . ', ' . $primeraQuincenaTercerMes . ', ' . $segundaQuincenaCuartoMes . ', ' . $primeraQuincenaCuartoMes . ']';
        return $dataMultasJS;
    }

    public function dataMultas (){
        $dataMultas = $this->dataMulta();

        return response()->json($dataMultas);

    }

    public function dataUsuario()
    {
        $fechaActual = Carbon::now();
        $cuartoMes = $fechaActual->copy();
        $tercerMes = $fechaActual->copy()->subMonths(1);
        $segundoMes = $fechaActual->copy()->subMonths(2);
        $primerMes = $fechaActual->copy()->subMonths(3);

        $primeraQuincenaCuartoMes = User::whereYear('fechaIngreso', $cuartoMes)
            ->whereMonth('fechaIngreso', $cuartoMes)
            ->whereDay('fechaIngreso', '<=', 15)
            ->count();

        $segundaQuincenaCuartoMes = User::whereYear('fechaIngreso', $cuartoMes)
            ->whereMonth('fechaIngreso', $cuartoMes)
            ->whereDay('fechaIngreso', '>', 15)
            ->count();

        $primeraQuincenaTercerMes = User::whereYear('fechaIngreso', $tercerMes)
            ->whereMonth('fechaIngreso', $tercerMes)
            ->whereDay('fechaIngreso', '<=', 15)
            ->count();

        $segundaQuincenaTercerMes = User::whereYear('fechaIngreso', $tercerMes)
            ->whereMonth('fechaIngreso', $tercerMes)
            ->whereDay('fechaIngreso', '>', 15)
            ->count();

        $primeraQuincenaSegundoMes = User::whereYear('fechaIngreso', $segundoMes)
            ->whereMonth('fechaIngreso', $segundoMes)
            ->whereDay('fechaIngreso', '<=', 15)
            ->count();

        $segundaQuincenaSegundoMes = User::whereYear('fechaIngreso', $segundoMes)
            ->whereMonth('fechaIngreso', $segundoMes)
            ->whereDay('fechaIngreso', '>', 15)
            ->count();

        $segundaQuincenaPrimerMes = User::whereYear('fechaIngreso', $primerMes)
            ->whereMonth('fechaIngreso', $primerMes)
            ->whereDay('fechaIngreso', '>', 15)
            ->count();

        $dataUsuariosJS = '[' . $segundaQuincenaPrimerMes . ', ' . $segundaQuincenaSegundoMes . ', ' . $primeraQuincenaSegundoMes . ',  ' . $segundaQuincenaTercerMes . ', ' . $primeraQuincenaTercerMes . ', ' . $segundaQuincenaCuartoMes . ', ' . $primeraQuincenaCuartoMes . ']';

        // LOGICA PARA ALIMENTAR LAS VARIABLES DE LA GRAFICA
        $usuariosModelos = User::where('active', 1)
            ->whereHas('tipoUsuario', function ($query) {
                $query->where('nombre', 'Modelo');
            })
            ->count();

        $empresaCapacidadModelos = Empresa::value('capacity_models');

        if ($empresaCapacidadModelos === null) {
            $empresaCapacidadModelos = 0;
        };
        if ($usuariosModelos > 0 && $empresaCapacidadModelos > 0) {
            $porcentajeModelos = ($usuariosModelos * 100) / $empresaCapacidadModelos;
        } else {

            $porcentajeModelos = 0;
            $usuariosModelos = "Configura Empresa ";
        }


        return array($dataUsuariosJS, $usuariosModelos, $porcentajeModelos);
    }

    public function reporte_dia()
    {
        $datoMasReciente = Meta::latest()->first(); // O Dato::latest()->get() si deseas obtener varios registros
        // Puedes hacer lo que desees con $datoMasReciente aquíecho  
        if ($datoMasReciente != null) {
            $idMeta = $datoMasReciente->id;

            $fechas = ResgistroProducido::where('meta_id', $idMeta)->select(
                DB::raw('sum(valorProducido) as suma'),
                DB::raw('meta_id'),
                DB::raw('fecha'),

            )
                ->groupBy('fecha', 'meta_id')
                ->get();


            $fechas2 = ResgistroProducido::select(
                DB::raw('sum(valorProducido) as suma'),
                DB::raw('meta_id'),
                // DB::raw('fecha'),

            )
                ->groupBy('meta_id')
                ->get();

            $fechas3 = ResgistroProducido::select(
                DB::raw('COUNT(DISTINCT(DATE(fecha)))  as date_count'),
                DB::raw('meta_id'),
                // DB::raw('fecha'),           

            )
                ->groupBy('meta_id')
                ->get();
            return  array($fechas, $fechas2, $fechas3);
        }

        // $noHayMetas = 1;
        return 0;
    }

    public function dataTurno()
    {

        $capacidadRooms = Empresa::value('number_rooms');
        $error = " ";
        if ($capacidadRooms === null) {
            $capacidadRooms = 0;
            $error = "Favor configura la empresa";
        };

        if ($capacidadRooms > 0) {
            $turnosManana = AsignacionTurno::whereHas('turno', function ($query) {
                $query->where('nombre', 'Mañana');
            })->count();
            $mananaPorcentaje = ($turnosManana * 100) / $capacidadRooms;

            $turnosTarde = AsignacionTurno::whereHas('turno', function ($query) {
                $query->where('nombre', 'Tarde');
            })->count();
            $tardeProcentaje = ($turnosTarde * 100) / $capacidadRooms;

            $turnosNoche = AsignacionTurno::whereHas('turno', function ($query) {
                $query->where('nombre', 'Noche');
            })->count();
            $nochePorcentaje = ($turnosNoche * 100) / $capacidadRooms;
        } else {
            $mananaPorcentaje = 0;
            $turnosManana = 0;
            $tardeProcentaje = 0;
            $turnosTarde = 0;
            $nochePorcentaje = 0;
            $turnosNoche = 0;
        }

        return  array($mananaPorcentaje, $turnosManana, $tardeProcentaje, $turnosTarde, $nochePorcentaje, $turnosNoche, $error);
    }

    public function dataAsistencia()
    {
        // Obtén la fecha actual
        $fechaActual = Carbon::now()->toDateString();
        // Realiza la consulta para obtener los registros del día actual
        $registrosAsistencia = Asistencia::whereDate('fecha', $fechaActual)->get();
        return $registrosAsistencia;
    }

    public function dataQuincenas()
    {


        $pagosAgrupados = Pago::orderBy('fecha', 'desc')
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->fecha)->format('Y-m-d'); // Agrupar por día
            });

        if ($pagosAgrupados != null) {

            $totalPagosPorFecha = [];
            $fechasArray = [];
            foreach ($pagosAgrupados as $fecha => $pagos) {
                $fechasArray[] = $fecha;
                $totalPagosPorFecha[$fecha] = $pagos->sum('devengado');

                // echo $pagos->sum('devengado');
            }
            $totalPagos = array_values($totalPagosPorFecha);
            $fechas = array_keys($totalPagosPorFecha);

            $fechasString = json_encode($fechas);
            $totalPagosString = json_encode($totalPagos);
            

            $fechasEscapadas = htmlspecialchars($fechasString, ENT_QUOTES, 'UTF-8');
            $totalPagosEscapados = htmlspecialchars($totalPagosString, ENT_QUOTES, 'UTF-8');
        }
        else{
            $fechasArray[] = 0;
            $totalPagosEscapados[]=0;
        }


        // dd($fechasArray);

        return array($totalPagosEscapados, $fechasArray);
    }

    public function index()
    {
        $configAsistencia = AsistenciaTiempoConfig::find(1);
        $configAsistencia = AsistenciaTiempoConfig::find(1);

        $multas = AsignacionMulta::where('descontado', 0)->count();
        $descuentos = Descuento::where('saldo', '>', 0)->sum('saldo');
        $dataDescuentos = $this->dataDescuentos();
        $dataMetas = $this->dataMeta();
        $dataMultas = $this->dataMulta();
        $dataHistorialMetas = $this->dataHistorialMeta();
        $dataUsuarios = $this->dataUsuario();
        $dataResumenMeta = $this->reporte_dia();
        $dataTurnos = $this->dataTurno();
        $dataAsistencias = $this->dataAsistencia();
        $dataQuincenas = $this->dataQuincenas();

         //dd($dataQuincenas);


        return view('admin.index.index', compact('multas', 'descuentos', 'dataDescuentos', 'dataMetas', 'dataMultas', 'dataHistorialMetas', 'dataUsuarios', 'dataResumenMeta', 'dataTurnos', 'dataAsistencias', 'configAsistencia', 'dataQuincenas'));
    }
}
