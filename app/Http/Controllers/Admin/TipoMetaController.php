<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use Illuminate\Http\Request;

class TipoMetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function index()
    {
        $tipoMetas = Meta::orderBy('id', 'desc')->paginate();
        return view('admin.tipoMetas.index',compact('tipoMetas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoMetas.create');
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
            'dias' => 'required',
            'valor' => 'required',           
            
        ]);

        $tipoMeta= Meta::create($request->all());
        return redirect()->route('admin.tipoMetas.index', $tipoMeta->id)->with('info', 'store');
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
    public function edit(Meta $tipoMeta)
    {
        return view('admin.tipoMetas.edit',compact('tipoMeta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meta $tipoMeta)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre' => 'required',
            'dias' => 'required',
            'valor' => 'required',  
            
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tipoMeta->update($request->all());
        return redirect()->route('admin.tipoMetas.index', $tipoMeta->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meta $tipoMeta)
    {
        $tipoMeta->delete();
        return redirect()->route('admin.tipoMetas.index')->with('info','delete');
    }
}
