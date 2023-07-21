<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Impuesto;
use App\Models\Pago;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impuestos = Impuesto::all();
        return view('admin.impuestos.index', compact('impuestos'));
    }

    public function comprobanteImpuesto()
    {
        // $pagos = DB::table('pagos')
        // ->leftJoin('impuestos', 'impuestos.id', '=', 'pagos.impuesto_id')
        // ->select('pagos.user_id','pagos.impuestoPorcentaje','pagos.impuestoDescuento','pagos.fecha', 'impuestos.nombre')
        // // ->where('pagos.user_id', $pago->user_id)
        // ->where('pagos.pagado', 1)
        // ->get();




        $impuestos = Impuesto::all();
        $pagos = Pago::all()->where('pagado', 1);
        return view('admin.impuestos.comprobanteImpuesto', compact('pagos','impuestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.impuestos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'nombre' => 'required',
            'porcentaje' => 'required',
            'mayorQue' => 'required',



        ]);
        $impuesto = Impuesto::create($request->all());
        return redirect()->route('admin.impuestos.index', $impuesto->id)->with('info', 'store');
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
    public function edit(Impuesto $impuesto)
    {
        return view('admin.impuestos.edit', compact('impuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        //VALLIDACION DE FORMULARIOS

        $request->validate([
            'nombre' => 'required',
            'porcentaje' => 'required',
            'mayorQue' => 'required',



        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $impuesto->update($request->all());
        return redirect()->route('admin.impuestos.index', $impuesto->id)->with('info', 'update'); //with mensaje de sesion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impuesto $impuesto)
    {
        $impuesto->delete();
        return redirect()->route('admin.impuestos.index')->with('info', 'delete');
    }



    public function comprobanteImpuestoPDF(Pago $pago)
    {

        // $pagos = DB::table('pagos')
        //     ->leftJoin('impuestos', 'impuestos.id', '=', 'pagos.impuesto_id')
        //     ->select('pagos.user_id', 'pagos.impuestoPorcentaje', 'pagos.impuestoDescuento', 'impuestos.nombre')
        //     // ->where('pagos.user_id', $pago->user_id)
        //     ->where('pagos.pagado', 1)
        //     ->get();

        // return $pagos;



        // $pagos = Pago::where('user_id', $pago->id)->get();
        $date = Carbon::now()->locale('es');
        $pdf = Pdf::loadView('admin.impuestos.comprobanteImpuestoPDF', compact('pago', 'date'));
        return $pdf->stream();
    }
}
