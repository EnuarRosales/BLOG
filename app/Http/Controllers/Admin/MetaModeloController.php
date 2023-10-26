<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MetaModelo;
use Illuminate\Http\Request;

class MetaModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $metaModelos = MetaModelo::all();
        return view('admin.metaModelos.index', compact('metaModelos'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.metaModelos.create');
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
        'mayorQue'=>'required',
        'porcentaje'=>'required',
       
              
    ]); 
    $metaModelo= MetaModelo::create($request->all());
    return redirect()->route('admin.metaModelos.index',$metaModelo->id)->with('info','store');
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
    public function edit(MetaModelo $metaModelo)
    {
        return view('admin.metaModelos.edit',compact('metaModelo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MetaModelo $metaModelo)
    {
         //VALLIDACION DE FORMULARIOS
         $request->validate([
            'mayorQue'=>'required',
            'porcentaje'=>'required',             
            
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $metaModelo->update($request->all());           
        return redirect()->route('admin.metaModelos.index',$metaModelo->id)->with('info','update');//with mensaje de sesion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MetaModelo $metaModelo)
    {

        $metaModelo->delete();
        return redirect()->route('admin.metaModelos.index')->with('info','delete');
        
    }
}
