<?php

namespace App\Http\Controllers;

use App\Models\Curso; 
use Illuminate\Http\Request;


class CursoController extends Controller
{
    public function index(){
        $cursos  = Curso::orderBy('id','desc')->paginate();       
        return view('admin.cursos.index', compact('cursos'));    
    }

    public function create(){
        return view('admin.cursos.create');
    }

    public function store(Request $request){

        //VALIDACION DE FORMULARIOS
        $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'categoria'=> 'required',
        ]);

        //ASIGNACION MASIVA CON ESTO  TOMAMOS LA INFORMACION Y LA CARGAMOS A CADA VARIABLE
        //LO QUE NOS PERMITE AHOORAR LAS LINEA DE CODIGO QUE ESTAN MAS ABAJO 
        $curso = Curso::create($request->all());
        return redirect()->route('cursos.show', $curso->id);

        /*
        $curso = new Curso();

        $curso->name = $request->name;
        $curso->descripcion = $request->descripcion;
        $curso->categoria = $request->categoria;
        $curso->save();
        return redirect()->route('cursos.show', $curso->id); */

    }

    //OJO QUE ACA ESTA RETORNANDO UNA VARIABLE PARA MOSTRAR EN LA VISTA 
    public function show(Curso $curso){      
        return view('admin.cursos.show',compact('curso'));
    }


    public function edit(Curso $curso){        
        return view('admin.cursos.edit', compact('curso'));
        }

    public function update( Request $request, Curso $curso){
         //VALIDACION DE FORMULARIOS
         $request->validate([
            'name' => 'required',
            'descripcion' => 'required',
            'categoria'=> 'required',
        ]);    
        //ASIGNACION MASIVA   
        $curso->update($request->all());
        return redirect()->route('cursos.show', $curso->id);       
       
    }

    public function destroy(Curso $curso){
        $curso->delete();
        return redirect()->route('cursos.index');
    }

}
