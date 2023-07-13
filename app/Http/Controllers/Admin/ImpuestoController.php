<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Impuesto;
use Illuminate\Http\Request;

class ImpuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $impuestos = Impuesto::all();
        return view('admin.impuestos.index', compact('impuestos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.impuestos.create');
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
        'porcentaje'=>'required',
        'mayorQue'=>'required',
        
       
              
    ]); 
    $impuesto= Impuesto::create($request->all());
    return redirect()->route('admin.impuestos.index',$impuesto->id)->with('info','store');
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
    public function edit(Impuesto $impuesto)
    {
        return view('admin.impuestos.edit',compact('impuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Impuesto $impuesto)
    {
        //VALLIDACION DE FORMULARIOS
       
       $request->validate([
        'nombre'=>'required',
        'porcentaje'=>'required',
        'mayorQue'=>'required',
        
       
              
    ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $impuesto->update($request->all());           
        return redirect()->route('admin.impuestos.index',$impuesto->id)->with('info','update');//with mensaje de sesion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Impuesto $impuesto)
    {
        $impuesto->delete();
        return redirect()->route('admin.impuestos.index')->with('info','delete');
    }
}
