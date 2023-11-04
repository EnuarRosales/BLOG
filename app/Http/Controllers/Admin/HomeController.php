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

        // echo $primerMes->locale('es')->monthName . " " . "Segundada Quincena";


        return $dataDescuentosJS;
    }


    public function dataMeta()
    {
        $datoMasReciente = Meta::latest()->first(); // O Dato::latest()->get() si deseas obtener varios registros
        // Puedes hacer lo que desees con $datoMasReciente aquíecho       

        if ($datoMasReciente != null) {

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

        // dd($datoMasRecientes);
        // for ($i = 0; $i < 4; $i++) {
        //     if ($datoMasRecientes != null) {
        //         foreach ($datoMasRecientes as $datoMasReciente) {
        //             if ($datoMasRecientes != null) {
        //                 $registroProduccion = ResgistroProducido::where('meta_id', $datoMasReciente->id)
        //                     ->sum('valorProducido');
        //                 $porcentajeMeta = ($registroProduccion * 100) / $datoMasReciente->valor;
        //                 $miArray[] = $datoMasReciente->nombre; //0
        //                 $miArray[] = $porcentajeMeta;          //1
        //                 $miArray[] = $registroProduccion;      //2
        //                 $miArray[] = $datoMasReciente->valor;  //3
        //             } else {
        //                 $miArray[] = "No hay datos para mostarar"; //0
        //                 $miArray[] = " "; //1
        //                 $miArray[] = " "; //2
        //                 $miArray[] = " "; //3
        //             }
        //         }
        //     }
        // }

        // echo($datoMasRecientes->count());

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




        // dd  ($miArray);


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
        if ($usuariosModelos > 0 && $empresaCapacidadModelos >0 ){            
            $porcentajeModelos = ($usuariosModelos * 100) / $empresaCapacidadModelos;
        }
        else{

            $porcentajeModelos = 0;
            $usuariosModelos = "Configura la Empresa ";

        }

        
        return array($dataUsuariosJS, $usuariosModelos, $porcentajeModelos);
    }

    public function reporte_dia()
    {
        /* AGRUPA EL VALOR PRODUCIDO POR LA META Y FECHA; ES DECIR  NOS MUESTRA LA PRODUCCION DIARIA
        DE ACUERDO A LA META Y A LA FECHA, LO USAMOS  PARA VERIFICAR LO SIGUIENTE 
        1. FECHA 
        2. META STUDIO
        3.OBJETIVO DIARIO; OJO APROVECHANDO LA RELACION CON LA META  LO QUE SE HACE ES DIVIDR SU VALOR EN EL NUMNERO DE DIAS 
        4.PRODUCCION REPORTADA; OJO ES LA SUMA DEL VALOR PRODUCIDO 
        5.ALARMA DIFERENCIA;  DIVIDE EL VALR DE LA META EN EL NUMERO DE DIAS Y LE RESTA  VALOR PRODUCIDO   
        6.CUMPLIO; OJO VERIFICA SI LA DIFERENCIA ES POSITIVA O NEGATIVA, SI ES POSITIVA CUMPLIO = SI DE LO CONTRARIO NO
        */

        $fechas = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),

            DB::raw('fecha'),

        )
            ->groupBy('fecha', 'meta_id')
            ->get();

        // echo $fechas;

        /* AGRUPA EL VALOR PRODUCIDO POR LA META; ES DECIR NOS MUESTA  CUANTO SE HA PRODUCIDO POR CADA META
        
        LO USAMOS  PARA VERIFICAR LO SIGUIENTE 
        
        1. PARA PODER VER LA PRODUCCION TOTAL; ESTA SE MUESTRA EN TODAS LAS FILAS DONDE COINDIDA EL TIPO DE META*/

        $fechas2 = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),
            // DB::raw('fecha'),

        )
            ->groupBy('meta_id')
            ->get();

        // echo $fechas2;            

        $fechas3 = ResgistroProducido::select(
            DB::raw('COUNT(DISTINCT(DATE(fecha)))  as date_count'),
            DB::raw('meta_id'),
            // DB::raw('fecha'),           

        )
            ->groupBy('meta_id')
            ->get();

        return  array($fechas, $fechas2, $fechas3);
    }



    public function index()
    {

        $multas = AsignacionMulta::where('descontado', 0)->count();
        $descuentos = Descuento::where('saldo', '>', 0)->sum('saldo');
        $dataDescuentos = $this->dataDescuentos();
        $dataMetas = $this->dataMeta();
        $dataMultas = $this->dataMulta();
        $dataHistorialMetas = $this->dataHistorialMeta();
        $dataUsuarios = $this->dataUsuario();
        $dataResumenMeta = $this->reporte_dia();
        return view('admin.index.index', compact('multas', 'descuentos', 'dataDescuentos', 'dataMetas', 'dataMultas', 'dataHistorialMetas', 'dataUsuarios', 'dataResumenMeta'));
    }
}
