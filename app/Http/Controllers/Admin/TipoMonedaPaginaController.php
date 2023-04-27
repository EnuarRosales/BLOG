<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TipoMonedaPagina;
use Illuminate\Http\Request;

class TipoMonedaPaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoMonedaPaginas = TipoMonedaPagina::orderBy('id', 'desc')->paginate();
        return view('admin.tipoMonedaPaginas.index',compact('tipoMonedaPaginas'));
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoMonedaPaginas.create');
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
            'valor' => 'required',
            
        ]);

        $tipoMonedaPagina= TipoMonedaPagina::create($request->all());
        return redirect()->route('admin.tipoMonedaPaginas.index', $tipoMonedaPagina->id)->with('info', 'store');
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
    public function edit(TipoMonedaPagina $tipoMonedaPagina)
    {
        return view('admin.tipoMonedaPaginas.edit',compact('tipoMonedaPagina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoMonedaPagina $tipoMonedaPagina)
    {
       //VALLIDACION DE FORMULARIOS
       $request->validate([
        'nombre' => 'required',
        'valor' => 'required',

        
    ]);
    //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
    $tipoMonedaPagina->update($request->all());
    return redirect()->route('admin.tipoMonedaPaginas.index', $tipoMonedaPagina->id)->with('info', 'update'); //with mensaje de sesion

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMonedaPagina $tipoMonedaPagina)
    {
        $tipoMonedaPagina->delete();
        return redirect()->route('admin.tipoMonedaPaginas.index')->with('info','delete');
    }
}
