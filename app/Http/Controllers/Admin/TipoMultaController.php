<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoMulta;
use Illuminate\Http\Request;

class TipoMultaController extends Controller 
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoMultas = TipoMulta::orderBy('id', 'desc')->paginate();
        return view('admin.tipoMultas.index', compact('tipoMultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoMultas.create');
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
            'costo' => 'required',
        ]);

        $tipoMulta= TipoMulta::create($request->all());
        return redirect()->route('admin.tipoMultas.index', $tipoMulta->id)->with('info', 'Tipo multa creado correctamente');
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
    public function edit(TipoMulta $tipoMulta)
    {
        return view('admin.tipoMultas.edit',compact('tipoMulta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMulta $tipoMulta)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre' => 'required',
            'costo' => 'required'
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tipoMulta->update($request->all());
        return redirect()->route('admin.tipoMultas.index', $tipoMulta->id)->with('info', 'Tipo multa se actualizo con exito'); //with mensaje de sesion

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMulta $tipoMulta)
    {
        $tipoMulta->delete();
        return redirect()->route('admin.tipoMultas.index')->with('info','Tipo multa eliminado correctamente');
    }
}
