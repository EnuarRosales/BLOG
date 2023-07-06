<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Descontado;
use App\Models\Descuento;
use App\Models\Pago;
use App\Models\ReportePagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function enviarPago()
    {
        /*
         *  DOC METODO enviarPago()
         * EN LA PRIMERA PARTA INSTANCIA DE LA CALSE PAGOCONTROLLER CON EL FIN DE IMPLEMENTAR UN METODO
         */
        $cambiarEstados = new PagoController;

        /*
         *  
         * EN LA SEGUNDA PARTE ES UNA COSNSULTA DONDE SUMA, AGRUPA, DONDE, LUEGO MUESTRA POR DOS PARAMETROS  
         * 
         */
        $pagos = ReportePagina::select(
            DB::raw('sum(netoPesos) as suma'),
            DB::raw('user_id'),
            DB::raw('fecha'),
        )
            ->where('verificado', 1)
            ->where('enviarPago', 0)
            ->groupBy('fecha', 'user_id')
            ->get();

        /*
         *  
         * EN LA TERCERO PARTE ES UNA COSNSULTA A DOS TABLAS EN DONDE TRAEMOS INFORMACION QUE NOS INTERESA LA CUAL 
         * MAS ADELANTE SE USA  EN LOS CICLOS  
         * 
         */


        $descuentos = DB::table('descuentos')
            ->join('descontados', 'descontados.descuento_id', '=', 'descuentos.id')
            ->select(
                DB::raw('sum(valor) as suma'),
                DB::raw('user_id'),
                DB::raw('descuento_id'),

            )
            ->where('descontado', 0)

            ->groupBy('user_id', 'descuento_id')
            ->get();

            /*
         *  
         * EN LA CUARTA PARTE CON LA AYUDA DE IN CICLO ITERAMOS LOS DATOS, LUEGO SE INSERTAN EN LA TABLA,
         * ASI MISMO UN SEGUNDO CICLO ITERA LOS DATOS DE LAS CONSULTAS ANTERIORES Y ACTUALZA SUS DATOS 
         * DE ACUERDO A  DOS CONDICIONES 
         * 
         */

        foreach ($pagos as $pago) {

            DB::table('pagos')->insert([
                'fecha' => $pago->fecha,
                'devengado' => $pago->suma,
                'descuento' => 0,
                'pagado' => 1,
                'neto' => $pago->suma,
                'user_id' => $pago->user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($descuentos as $descuento) {
                if ($pago->user_id == $descuento->user_id) {
                    DB::table('pagos')
                        ->where('user_id', $pago->user_id)
                        ->where('fecha', $pago->fecha)
                        ->update([
                            'descuento' => $descuento->suma,
                            'neto' => $pago->suma - $descuento->suma,
                        ]);

                    DB::table('descontados')
                        ->where('descuento_id', $descuento->descuento_id)
                        ->update([
                            'descontado' => 1,
                            'fechaDescontado' => $pago->fecha,
                        ]);
                }
            }
        }

        $cambiarEstados->enviarPagoCambiarEstado();
        return redirect()->route('admin.reportePaginas.pagos')->with('info', 'delete');
    }

    public function enviarPagoCambiarEstado()
    {
        $reportePaginas = ReportePagina::where('enviarPago', 0)->get();
        foreach ($reportePaginas as $reportePagina) {
            $reportePagina->enviarPago = 1;
            $reportePagina->save();
        }
    }
}
