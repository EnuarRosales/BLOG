<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate();        
        return view('admin.users.index',compact('users'));     
               
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoUsuarios = TipoUsuario::orderBy('id','desc');        
        return view('admin.users.create', compact('tipoUsuarios'));
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
            'name'=>'required',
            'cedula'=>'required',
            'celular'=>'required',
            'direccion'=>'required',    
            'email'=>'required',
            'tipoUsuario_id'=>'required',  
             
            
        ]);
 
        $user = User::create($request->all());
        return redirect()->route('admin.users.index',$user->id)->with('info','store');
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
    public function edit(User $user)
    {
        
        $tipoUsuarios = TipoUsuario::orderBy('id','desc'); 
        return view('admin.users.edit',compact('user','tipoUsuarios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'name'=>'required',
            'cedula'=>'required',
            'celular'=>'required',
            'direccion'=>'required',    
            'email'=>'required',
            'tipoUsuario_id'=>'required',        
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $user->update($request->all());
        return redirect()->route('admin.users.index', $user->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('info','delete');
    }


    //METODOS ROSALES PARA LAS FUNCIONADLIDADES
    public function calcularPorcentajePersonal(){

        $user = DB::table('user')->count();
        return "el resultado es ". $user;


    }
}
