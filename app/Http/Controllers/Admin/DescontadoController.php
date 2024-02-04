<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Descontado;
use App\Models\Descuento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class DescontadoController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // parametro para tomar texto de error
        $error = 0;
        $descuentos = 0;
        //validacion de errores
        if ($request->valor === null) {
            return response()->json(['success' => false, 'error' => 'El campo valor no puede estar vacio', 'descuentos' => $descuentos]);
        } elseif ($request->descripcion === null) {
            return response()->json(['success' => false, 'error' => 'El campo descripcion no puede estar vacio', 'descuentos' => $descuentos]);
        }

        //obtenemos los descuentos
        $descuentos = Descuento::find($request->descuento_id);
        // dd($descuentos);
        if ($descuentos->saldo < $request->valor) {
            $descuentos->montoDescontado = 0;
            return response()->json(['success' => false, 'error' => 'El valor del abono no puede ser mayor a la deuda: $' . $descuentos->saldo, 'descuentos' => $descuentos]);
        }
        // dd($descuentos);
        //ser guarda un descuento nuevo con todos los campos obtenidos request
        $registroDescuento = Descontado::create($request->all());
        // $diferenciaSaldo = $descuentos->montoDescuento - $descuentos->montoDescontado;
        $abonos = Descontado::where('descuento_id', '=', $request->descuento_id)
            ->select('valor')
            ->get()
            ->sum('valor');
        $descuentos->montoDescontado = $abonos;
        $descuentos->saldo = $descuentos->montoDescuento - $abonos;
        $descuentos->save();

        //retornamos Json
        return response()->json(['success' => true, 'error' => $error, 'descuentos' => $descuentos]);
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
    public function edit(Request $request, Descuento $abonoParcial)
    {
        $abonos = DB::table('descontados')
            ->where('descuento_id', '=', $abonoParcial->id)
            ->get();

        return view('admin.abonos.index', compact('abonos'));
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

    //ESTE METODO NOS PERMITE REALIZAR UN ABONO TOTAL ES DECIR DESCUENTA  TODO LO QUE SE ESTE DEBIENDO
    //ES DE TIPO PUT Y NECESITA UN OBJETO DE TIPO Descuento para poder funcionar,  EL CUAL SE ENVIA DESDE LA RUTA registroDescuentos.index
    //CON LA INFORMACION RECIBIDA DESDE LA VISTA  QUE EN ESTE CASO ES UN OBJETO DE TIPO Descuento hacemos lo siguiente
    /*1. verificamos si el saldo es mayor  a 0, si se cumple esta condicion crearme un registro en la tabla Descontado que  es lo mismo a abono
       donde se toma informacion valiosa que nos envia la vista como lo es el saldo y el id del credito

       */

    //funcion para registrar abonos
    public function abono(Request $request, Descuento $abonado)
    {
        if ($abonado->saldo > 0) {
            $abono = Descontado::create([
                'valor' => $abonado->saldo,
                'descripcion' => 'pago total',
                'descuento_id' => $abonado->id,
            ]);
            $abono->save();
        } else {
            // No hay que descontar
            return response()->json(['success' => false]);
        }

        // Realiza el cálculo del monto descontado
        $abonos = Descontado::where('descuento_id', '=', $abonado->id)
            ->select('valor')
            ->get()
            ->sum('valor');
        $abonado->montoDescontado = $abonos;
        $abonado->saldo = 0;
        $abonado->save();

        // Si todo está correcto, devuelve true
        return response()->json(['success' => true, 'abonado' => $abonado]);
    }

    public function datatable(Request $request)
    {
        $descuento_id = $request->rowId;
        $descontado = Descontado::where('descuento_id', $descuento_id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($descontado as  $item) {
            $item->formatted_created_at = date('d-m-Y', strtotime($item->created_at));
        }
        return DataTables::of($descontado)
            ->addColumn('acciones', function ($row) {
                $acciones = '';

                return $acciones;
            })

            ->rawColumns(['acciones', 'pago', 'saldo'])
            ->make(true);
    }




    //ESTE METODO  SE MANDA A LLAMAR EN EL INDEX DE REGISTRO DESCUENTO Y LO QUE HACE ES LO SIGUIENTE
    //1. ES DE TIPO GET  RECIBE UN OBETO DEL TIPO DESCUENTO
    /*2. LLAMA A LA BASE DE DATOS DE DATOS  DESCONTADOS QUE EN ESTE CASO ES LO MISMO QUE DECIR ABONOS
    Y FILTRA EL descuento_id DONDE SEA IGUAL AL $abonoParcial->id ESTA ULTIMA VARIBLE ES EL REGISTRO QUE TRAEMOS EN
    REQUEST */
    //3. RETORNA UNA VISTA Y ENVIA LA VARIABLE ANTES CONSUTADA CON EL FIN QUE TRAIGA SOLO LOS ABONOS QUE SE LE HA REALZADO A MENCIOANADO CREDITO

}
