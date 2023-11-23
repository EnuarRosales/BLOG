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
use App\Models\Pagina;
use App\Models\Pago;
use App\Models\ReportePagina;
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

    public function dataPaginas()
    {
        $fechaActual = Carbon::now();

        $cuartoMes = $fechaActual->copy();
        $tercerMes = $fechaActual->copy()->subMonths(1);
        $segundoMes = $fechaActual->copy()->subMonths(2);
        $primerMes = $fechaActual->copy()->subMonths(3);

        $primeraQuincenaCuartoMes = ReportePagina::selectRaw('pagina_id, DATE(fecha) as fecha, SUM(netoPesos) as totalNetaPesos')
            ->whereYear('created_at', $cuartoMes)
            ->whereMonth('created_at', $cuartoMes)
            ->whereDay('created_at', '<=', 15)
            ->groupBy('pagina_id', 'fecha')
            ->get();

        $dataAgrupadaPorFecha = [];

        foreach ($primeraQuincenaCuartoMes as $item) {
            $fecha = $item->fecha;

            if (!isset($dataAgrupadaPorFecha[$fecha])) {
                $dataAgrupadaPorFecha[$fecha] = [];
            }

            $dataAgrupadaPorFecha[$fecha][] = [
                'pagina_id' => $item->pagina_id,
                'totalNetaPesos' => $item->totalNetaPesos,
                // Otros datos que quieras asociar con esta fecha
            ];
        }

        // Supongamos que tienes un array $dataAgrupadaPorFecha con los datos agrupados por fecha y pagina_id

        // Obtener todas las páginas únicas disponibles en los datos agrupados
        $paginasUnicas = collect($dataAgrupadaPorFecha)
            ->flatMap(function ($items) {
                return collect($items)->pluck('pagina_id');
            })
            ->unique()
            ->values();

        // Crear un array para almacenar las series
        $seriesPorPagina = [];

        // Iterar sobre cada página única y sus datos asociados por fecha
        foreach ($paginasUnicas as $pagina) {
            $paginax = Pagina::where('id', $pagina)->first();
            $serie = [
                'name' => $paginax->nombre, // Nombre de la serie (puedes ajustarlo según tus necesidades)
                'data' => []
            ];

            foreach ($dataAgrupadaPorFecha as $fecha => $items) {
                $totalNetaPesosPorPagina = collect($items)
                    ->where('pagina_id', $pagina)
                    ->pluck('totalNetaPesos')
                    ->first() ?? 0; // Valor predeterminado si no hay datos para esta página en esta fecha

                $serie['data'][] = $totalNetaPesosPorPagina;
            }

            // Agregar la serie al array de series
            $seriesPorPagina[] = $serie;
        }

        // $seriesPorPagina ahora contiene las series separadas por pagina_id y sus respectivos datos asociados a cada fecha


        // dd($seriesPorPagina);

     //   $nombresPaginas = [];
      //  $totalNetaPesos = [];
        $fechaQuincenas = [];

        // Iterar sobre los resultados para obtener la sumatoria por página
        foreach ($primeraQuincenaCuartoMes as $pagina) {
            $idPagina = $pagina->pagina_id;
            $fechaQuincena = $pagina->fecha;
            $page = Pagina::where('id', $idPagina)->first();
            $nombrePagina = $page->nombre;
            $totalNetaPesosPagina = $pagina->totalNetaPesos;

            // Almacenar los valores en los arreglos respectivos
            $nombresPaginas[] = $nombrePagina;
            $totalNetaPesos[] = $totalNetaPesosPagina;
            $fechaQuincenas[] = $fechaQuincena;

            $fechaQuincenas = array_unique($fechaQuincenas);
            $fechaQuincenas = array_values(array_unique($fechaQuincenas));
        }

        return [
            'seriesPorPagina' => $seriesPorPagina ,
            'fechaQuincenas' => $fechaQuincenas,

            // 'nombresPaginas' => $nombresPaginas,
        ];

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

    public function dataMultas()
    {
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


        $pagosAgrupados = ReportePagina::orderBy('fecha', 'desc')
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->fecha)->format('Y-m-d');
            });

        if ($pagosAgrupados != null) {

            $totalPagosPorFecha = [];
            $fechasArray = [];
            foreach ($pagosAgrupados as $fecha => $pagos) {
                $fechasArray[] = $fecha;
                $totalPagosPorFecha[$fecha] = $pagos->sum('dolares');

                // echo $pagos->sum('devengado');
            }


            $fechasArrayString = json_encode($fechasArray);
            $totalPagosString = json_encode(array_values($totalPagosPorFecha));


            // $fechasEscapadas = htmlspecialchars_decode($fechasString, ENT_QUOTES);
            // $fechasEscapadas = str_replace('"', " ", $fechasEscapadas);
            $totalPagosEscapados = htmlspecialchars($totalPagosString, ENT_QUOTES, 'UTF-8');

            //dd($fechasEscapadas);
        } else {
            $fechasArray[] = 0;
            $totalPagosEscapados[] = 0;
        }


        // dd($fechasArray);

        return response()->json([
            'fechas' => $fechasArrayString,
            'totalPagos' => $totalPagosString,
        ]);
    }

    public function dataQuincenas2()
    {
        $pagosAgrupados = ReportePagina::orderBy('fecha', 'desc')
            ->get()
            ->groupBy(function ($date) {
                return \Carbon\Carbon::parse($date->fecha)->format('Y-m-d');
            });

        if ($pagosAgrupados != null) {

            $totalPagosPorFecha = [];
            $fechasArray = [];
            foreach ($pagosAgrupados as $fecha => $pagos) {
                $fechasArray[] = $fecha;
                $totalPagosPorFecha[$fecha] = $pagos->sum('dolares');
            }
        } else {
            $fechasArray[] = 0;
            $totalPagosEscapados[] = 0;
        }
        // echo $fechasArrayString."hola";

        // dd($totalPagosString);

        // dd($fechasArray);

        return [$fechasArray, $totalPagosPorFecha];
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
        // $dataQuincenas = $this->dataQuincenas2();
        list($fechasArray, $totalPagosPorFecha) = $this->dataQuincenas2();
        $datapaginas = $this->dataPaginas();

        //$this->dataPaginas();
        // dd($datapaginas);


        return view('admin.index.index', compact('multas', 'descuentos', 'dataDescuentos', 'dataMetas', 'dataMultas', 'dataHistorialMetas', 'dataUsuarios', 'dataResumenMeta', 'dataTurnos', 'dataAsistencias', 'configAsistencia', 'fechasArray', 'totalPagosPorFecha', 'datapaginas'));
    }
}
