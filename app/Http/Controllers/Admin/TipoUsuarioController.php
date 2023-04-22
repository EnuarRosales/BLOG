<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use Illuminate\Http\Request;


class TipoUsuarioController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $tipoUsuarios = TipoUsuario::orderBy('id','desc')->paginate();         
        return view('admin.tipoUsuarios.index', compact('tipoUsuarios'));  
        
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoUsuarios.create');
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

        $tipoUsuario = TipoUsuario::create($request->all());
        return redirect()->route('admin.tipoUsuarios.index',$tipoUsuario->id)->with('info','Tipo usuario creado correctamente');

        
    }


   


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TipoUsuario $tipoUsuario)
    {
        return view('admin.tipoUsuarios.index',compact('tipoUsuario'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoUsuario $tipoUsuario)
    {    
        return view('admin.tipoUsuarios.edit', compact('tipoUsuario'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoUsuario $tipoUsuario)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre'=>'required'
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tipoUsuario->update($request->all());             
        
        return redirect()->route('admin.tipoUsuarios.index',$tipoUsuario->id)->with('info','la categoria se actualizo con exito');//with mensaje de sesion
       
    }


//     public function update( Request $request, Curso $curso){
//         //VALIDACION DE FORMULARIOS
//         $request->validate([
//            'name' => 'required',
//            'descripcion' => 'required',
//            'categoria'=> 'required',
//        ]);    
//        //ASIGNACION MASIVA   
//        $curso->update($request->all());
//        return redirect()->route('cursos.show', $curso->id);       
      
//    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoUsuario $tipoUsuario)
    {
        $tipoUsuario->delete();
        return redirect()->route('admin.tipoUsuarios.index')->with('info','Tipo usuario eliminado correctamente');      
    }
}
