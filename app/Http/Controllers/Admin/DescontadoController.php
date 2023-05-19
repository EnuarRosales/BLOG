<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Descontado;
use App\Models\Descuento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DescontadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



    public function abono(Request $request, Descuento $abonado)
    {                     
        // $abonado->montoDescontado = $abonado->saldo;                
        // $abonado->save();    
        
        $abono = Descontado::create([
            'valor' => $abonado->montoDescontado,
            'valor' => $abonado->saldo,              
            'descripcion' => 'pago total',
            'descuento_id' => $abonado->id,
        ]);
        $abono->save();
        

        $abonos = DB::table('descontados')
                    ->where('descuento_id', '=', $abonado->id)
                    ->select('valor')                    
                    ->get()
                    ->sum('valor');
        $abonado->montoDescontado = $abonos;                
        $abonado->save();


        




     
        echo $abonos;                 
        
        return redirect()->route('admin.registroDescuentos.index', $abonado->id)->with('info', 'store');
               
    }










}
