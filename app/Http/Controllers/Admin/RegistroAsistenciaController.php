<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asistencia;
use App\Models\Descuento;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistroAsistenciaController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asistencias = Asistencia::all();  
        
        foreach($asistencias as $asistencia){

        }
        
        
        return view('admin.registroAsistencias.index',compact('asistencias'));
    }  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id','desc'); 
        // $turnos = Turno::orderBy('id','desc'); 
        return view('admin.registroAsistencias.create', compact('users'));
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
            'fecha'=>'required', 
            // 'my_hora'=>'required',
                              
        ]);

        
 
        $registroAsistencia = Asistencia::create($request->all());
        return redirect()->route('admin.registroAsistencias.index',$registroAsistencia->id)->with('info','store');

        
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
    public function edit(Asistencia $registroAsistencia)
    {
        $users = User::orderBy('id','desc');        
        return view('admin.registroAsistencias.edit',compact('registroAsistencia','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $registroAsistencia)
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'user_id'=>'required',
            'fecha'=>'required',         
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $registroAsistencia->update($request->all());
        return redirect()->route('admin.registroAsistencias.index', $registroAsistencia->id)->with('info', 'update'); //with mensaje de sesion

    }

    








    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $registroAsistencia)
    {
        $registroAsistencia->delete();
        return redirect()->route('admin.registroAsistencias.index')->with('info','delete');
    }
}
