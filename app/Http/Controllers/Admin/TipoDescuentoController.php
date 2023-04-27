<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoDescuento;
use Illuminate\Http\Request;
 
class TipoDescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoDescuentos = TipoDescuento::orderBy('id', 'desc')->paginate();
        return view('admin.tipoDescuentos.index',compact('tipoDescuentos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoDescuentos.create');
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
            
        ]);

        $tipoDescuento= TipoDescuento::create($request->all());
        return redirect()->route('admin.tipoDescuentos.index', $tipoDescuento->id)->with('info', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoDescuento $tipoDescuento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoDescuento $tipoDescuento)
    {
        return view('admin.tipoDescuentos.edit',compact('tipoDescuento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoDescuento $tipoDescuento)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre' => 'required',
            
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tipoDescuento->update($request->all());
        return redirect()->route('admin.tipoDescuentos.index', $tipoDescuento->id)->with('info', 'update'); //with mensaje de sesion

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoDescuento $tipoDescuento)
    {
        $tipoDescuento->delete();
        return redirect()->route('admin.tipoDescuentos.index')->with('info','delete');
    }
}
