<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\Descontado;
use App\Models\Descuento;
use App\Models\Empresa;
use App\Models\Impuesto;
use App\Models\Pago;
use App\Models\ReportePagina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = Pago::all();
        $userLogueado = auth()->user()->id;
        return view('admin.pagos.index', compact('pagos', 'userLogueado'));
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

        $descuentos = 0;
        $impuestos = Impuesto::where('estado', 1)->first();

        $pagos = ReportePagina::with('user', 'pagina')
            ->selectRaw('SUM(netoPesos) as suma, user_id, fecha')
            ->where('verificado', 1)
            ->where('enviarPago', 0)
            ->groupBy('fecha', 'user_id')
            ->get();

        $fechas = $pagos->pluck('fecha')->unique();
        $dias = [];

        foreach ($fechas as $key => $value) {
            $diferencia = $key > 0 ? strtotime($value) - strtotime($fechas[$key - 1]) : 15 * 24 * 60 * 60;
            $dias[] = ['dias' => $diferencia / (60 * 60 * 24), 'fecha' => $value];
        }

        $colecciónDias = collect($dias);

        foreach ($pagos as $item) {

            $dias = $colecciónDias->where('fecha', $item->fecha)->values();

            $descontado = Descontado::with('descuento')
                ->where('descontado', 0)
                ->whereHas('descuento', function ($query) use ($item) {
                    $query->where('user_id', $item->user_id);
                })
                ->whereDate('created_at', '>', date('Y-m-d', strtotime("-{$dias->first()['dias']} days", strtotime($item->fecha))))
                ->whereDate('created_at', '<=', $item->fecha);


            $item->sumaDescuentos = $descontado->sum('valor');

            $descontado->update([
                'descontado' => 1,
                'fechaDescontado' => $item->fecha,
            ]);

            $multas = AsignacionMulta::with('tipoMulta')
                ->where('descontado', 0)
                ->where('generar_descuento', 1)
                ->where('user_id', $item->user_id)
                ->whereDate('updated_at', '>', date('Y-m-d', strtotime("-{$dias->first()['dias']} days", strtotime($item->fecha))))
                ->whereDate('updated_at', '<=', $item->fecha)
                ->get();



            if ($item->suma > $impuestos->mayorQue) {
                $item->impuesto = ($impuestos->porcentaje / 100) * $item->suma;
            } else {
                $item->impuesto = 0;
            }

            $item->multas = $multas->sum('tipoMulta.costo');

            $multas = AsignacionMulta::with('tipoMulta')
                ->where('descontado', 0)
                ->where('generar_descuento', 1)
                ->where('user_id', $item->user_id)
                ->update([
                    'descontado' => 1,
                    'fechaDescontado' => $item->fecha,
                ]);

            $item->pagoNeto = $item->suma - $item->sumaDescuentos - $item->multas - $item->impuesto;

            Pago::create([
                'fecha' => $item->fecha,
                'devengado' => $item->suma,
                'descuento' => $item->sumaDescuentos,
                'multaDescuento' => $item->multas,
                'pagado' => 1,
                'neto' => $item->pagoNeto,
                'user_id' => $item->user_id,
            ]);
        }

        $cambiarEstados->enviarPagoCambiarEstado();
        $cambiarEstados->aplicarImpuesto(); //!!!verificar este metodo esta restando doble el impuesto
        return redirect()->route('admin.reportePaginas.pagos')->with('info', 'enviarPagos');
    }

    public function enviarPagoCambiarEstado()
    {
        $reportePaginas = ReportePagina::where('enviarPago', 0)->get();
        foreach ($reportePaginas as $reportePagina) {
            $reportePagina->enviarPago = 1;
            $reportePagina->save();
        }
    }

    public function aplicarMultaDescuento()
    {
    }

    public function aplicarImpuesto()
    {
        $impuestos = Impuesto::where('estado', 1)->get();
        // $pagos = Pago::where('pagado', 1)->get();
        foreach ($impuestos as $impuesto) {
            if ($impuesto->estado == 1) {
                DB::table('pagos')
                    ->where('pagado', 1)
                    ->where('impuesto_id', null)
                    ->where('devengado', '>', $impuesto->mayorQue)
                    ->update([
                        'impuesto_id' => $impuesto->id,
                        'impuestoPorcentaje' => $impuesto->porcentaje,
                    ]);
            }
        }



        $pagos = Pago::where('pagado', 1)->get();

        foreach ($pagos as $pago) {
            $pago->impuestoDescuento = ($pago->devengado * (($pago->impuestoPorcentaje) / 100));
            // $pago->neto = $pago->neto - $pago->impuestoDescuento;
            $pago->save();
        }
    }



    /*
         *
         * METODO PARA IMPRIMRI EL COMPROBANTE DE PAGO.
         *
         */

    public function comprobantePagoPDF(Pago $pago)
    {
        /*
         *
         * MUESTRA LAS PAGINAS Y LA TRM ESTA PRIMER CONSULTA.
         *
         */
        $reportePaginas = ReportePagina::with('user', 'pagina')->select(
            // DB::raw('sum(netoPesos) as suma'),
            DB::raw('Cantidad'),
            DB::raw('netoPesos'),
            DB::raw('user_id'),
            DB::raw('fecha'),
            DB::raw('pagina_id'),
            DB::raw('porcentajeTotal'),
            DB::raw('pesos'),
            DB::raw('TRM'),

        )
            ->where('verificado', 1)
            ->where('enviarPago', 1)
            ->where('user_id', $pago->user_id)
            ->where('fecha', $pago->fecha)
            ->groupBy('fecha', 'user_id', 'pagina_id', 'Cantidad', 'netoPesos', 'porcentajeTotal', 'pesos', 'TRM')
            ->get();

        $multasDescuentos = AsignacionMulta::select(
            DB::raw('count(tipoMulta_id) as count'),
            DB::raw('user_id'),
            DB::raw('tipoMulta_id'),

        )
            ->where('descontado', 1)

            ->where('user_id', $pago->user_id)
            ->where('fechaDescontado', $pago->fecha)
            ->whereNull('deleted_at')
            // ->whereNull('asignacion_multas.deleted_at')  // Condición para asignacion_multas no eliminadas
            // ->whereNull('tipo_multas.deleted_at')        // Condición para tipo_multas no eliminadas

            ->groupBy('user_id', 'tipoMulta_id')
            ->get();

        if (count($multasDescuentos) == "0") {
            $multasDescuentosArray = "vacio";
        } else {
            $multasDescuentosArray = "lleno";
        }

        // return  $multasDescuentos;
        $descuentos = DB::table('descuentos')
            ->join('descontados', 'descontados.descuento_id', '=', 'descuentos.id')
            ->leftJoin('tipo_descuentos', 'tipo_descuentos.id', '=', 'descuentos.tipoDescuento_id')
            ->select('descuentos.user_id', 'descontados.valor', 'descuentos.tipoDescuento_id', 'tipo_descuentos.nombre')
            ->where('descuentos.user_id', $pago->user_id)
            ->where('descontados.descontado', 1)
            ->whereNull('descuentos.deleted_at')  // Condición para descuentos no eliminados
            ->whereNull('descontados.deleted_at') // Condición para descontados no eliminados
            ->where('descontados.fechaDescontado', $pago->fecha)
            ->get();

        if (count($descuentos) == "0") {
            $descuentosArray = "vacio";
        } else {
            $descuentosArray = "lleno";
        }

        $empresas = Empresa::all();

        foreach ($empresas as $empresa) {
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $logoEmpresa = $empresa->logo;
        }

        $codigoQR = QrCode::size(80)->generate(
            "COMPROBANTE DE PAGO" . "\n" .
                "NOMBRE: " . $pago->user->name . "\n" .
                "FECHA: " . $pago->fecha . "\n" .
                "DEVENGADO: " . "$ " . number_format($pago->devengado, 2, '.', ',') . "\n" .
                "DESCUENTO: " . "$ " . number_format($pago->descuento, 2, '.', ',') . "\n" .
                "IMPUESTO: " . "$ " . number_format($pago->impuestoDescuento, 2, '.', ',') . "\n" .
                "MULTA: " . "$ " . number_format($pago->multaDescuento, 2, '.', ',') . "\n" .
                "NETO: " . "$ " . number_format($pago->neto, 2, '.', ',') . "\n"
        );

        $date = Carbon::now()->locale('es');
        try {
            $pdf = Pdf::loadView('admin.pagos.comprobantePago', compact('reportePaginas', 'pago', 'descuentos', 'multasDescuentos', 'multasDescuentosArray', 'descuentosArray', 'date', 'nitEmpresa', 'nombreEmpresa', 'codigoQR', 'logoEmpresa'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $message = substr($errorMessage, strpos($errorMessage, '$') + 1);
            return back()->with('mensaje', "Falta Informacion sobre: " . $message);
        }
        return $pdf->stream();
    }



    //     public function comprobanteImpuestoPDF(Pago $pago) {


    //         $pagos = Pago::where('pagado', $pago->id)->get();
    //         $date = Carbon::now()->locale('es');
    //         $pdf = Pdf::loadView('admin.pagos.comprobanteImpuesto', compact('pagos'));
    //         return $pdf->stream();
    //     }
}
