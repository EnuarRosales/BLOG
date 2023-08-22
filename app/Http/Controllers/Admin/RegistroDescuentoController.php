<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Descuento;
use App\Models\TipoDescuento;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistroDescuentoController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registroDescuentos = Descuento::all(); 
        $userLogueado = auth()->user()->id;
               
        foreach ($registroDescuentos as $registroDescuento){
            $registroDescuento->saldo = $registroDescuento->montoDescuento - $registroDescuento->montoDescontado;
            $registroDescuento->save();           
        }        
        return view('admin.registroDescuentos.index',compact('registroDescuentos','userLogueado')); 
    }

    /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id','desc'); 
        $tipoDescuentos = TipoDescuento::orderBy('id','desc');  
        return view('admin.registroDescuentos.create',compact('users','tipoDescuentos'));
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
            'montoDescuento' => 'required',
            'tipoDescuento_id' => 'required',
            'user_id' => 'required',

            
        ]);

        $registroDescuento = Descuento::create($request->all());
        return redirect()->route('admin.registroDescuentos.index', $registroDescuento->id)->with('info', 'store');
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
    public function edit( Descuento $registroDescuento)
    { 
        $users = User::orderBy('id','desc'); 
        $tipoDescuentos = TipoDescuento::orderBy('id','desc');  
        return view('admin.registroDescuentos.edit',compact('registroDescuento','users','tipoDescuentos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Descuento  $registroDescuento)
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'montoDescuento' => 'required',
            'tipoDescuento_id' => 'required',
            'user_id' => 'required',            
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $registroDescuento->update($request->all());
        return redirect()->route('admin.registroDescuentos.index', $registroDescuento->id)->with('info','update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Descuento $registroDescuento)
    {
        $registroDescuento->delete();
        return redirect()->route('admin.registroDescuentos.index')->with('info','delete');
    }
}
