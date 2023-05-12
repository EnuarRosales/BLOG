<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionTurno;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request; 

class AsignacionTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignacionTurnos = AsignacionTurno::orderBy('id','desc')->paginate();       
        return view('admin.asignacionTurnos.index', compact('asignacionTurnos'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $asignacionTurnos = AsignacionTurno::pluck('created_at','id')->toArray();
        $users = User::orderBy('id','desc'); 
        $turnos = Turno::orderBy('id','desc'); 
        return view('admin.asignacionTurnos.create', compact('users','turnos'));
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
            'user_id'=>'required',
            'turno_id'=>'required',         
        ]);
 
        $asignacionTurno = AsignacionTurno::create($request->all());
        return redirect()->route('admin.asignacionTurnos.index',$asignacionTurno->id)->with('info','store');

        
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
    public function edit(AsignacionTurno $asignacionTurno)
    {     
        $users = User::orderBy('id','desc'); 
        $turnos = Turno::orderBy('id','desc');  

        return view('admin.asignacionTurnos.edit',compact('asignacionTurno','users','turnos'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsignacionTurno $asignacionTurno)
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'user_id'=>'required',
            'turno_id'=>'required',         
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $asignacionTurno->update($request->all());
        return redirect()->route('admin.asignacionTurnos.index', $asignacionTurno->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsignacionTurno $asignacionTurno)

    {
        $asignacionTurno->delete();
        return redirect()->route('admin.asignacionTurnos.index')->with('info','delete');
    }
}
