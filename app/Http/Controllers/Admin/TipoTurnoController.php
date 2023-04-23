<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Turno;
use Illuminate\Http\Request;
 
class TipoTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turnos = Turno::orderBy('id','desc')->paginate(); 
        return view('admin.tipoTurnos.index',compact('turnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoTurnos.create');
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
        'nombre'=>'required',         
    ]); 
    $turno= Turno::create($request->all());
    return redirect()->route('admin.tipoTurnos.index',$turno->id)->with('info','Tipo turno creado correctamente');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turno $turno)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Turno $tipoTurno)
    {
        return view('admin.tipoTurnos.edit',compact('tipoTurno'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Turno $tipoTurno)
    {
         //VALLIDACION DE FORMULARIOS
         $request->validate([ 
            'nombre'=>'required'
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tipoTurno->update($request->all());           
        return redirect()->route('admin.tipoTurnos.index',$tipoTurno->id)->with('info','Tipo turno se actualizo con exito');//with mensaje de sesion
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turno $tipoTurno)
    {
        $tipoTurno->delete();
        return redirect()->route('admin.tipoTurnos.index')->with('info','Tipo turno eliminado correctamente');
    }
    
}
