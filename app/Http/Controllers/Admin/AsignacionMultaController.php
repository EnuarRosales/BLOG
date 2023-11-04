<?php

namespace App\Http\Controllers\Admin;

use App\Events\multaEvent;
use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\Asistencia;
use App\Models\TipoMulta;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AsignacionMultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLogueado = auth()->user()->id;
        $asignacionMultas = AsignacionMulta::orderBy('id','asc')->where('descontado', 0)->paginate();

    $rol = Role::all();

    // return $rol;

        // foreach($asignacionMultas as $asignacionMulta){
        //     if (auth()->user()->hasRole('Administrador')){

        //     }

        // }



    //  return $userLogueado = auth()->user();


        return view('admin.asignacionMultas.index', compact('asignacionMultas','userLogueado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id','desc');
        $tipoMultas = TipoMulta::orderBy('id','desc');
        return view('admin.asignacionMultas.create', compact('users','tipoMultas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'tipoMulta_id'=>'required',
        ]);


        $asignacionMulta = AsignacionMulta::create($request->all());

        if ($asignacionMulta) {
            multaEvent::dispatch($asignacionMulta->id);
        }

        return redirect()->route('admin.asignacionMultas.index',$asignacionMulta->id)->with('info','store');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AsignacionMulta $asignacionMulta)
    {
        $users = User::orderBy('id','desc');
        $tipoMultas = TipoMulta::orderBy('id','desc');

        return view('admin.asignacionMultas.edit',compact('asignacionMulta','users','tipoMultas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsignacionMulta $asignacionMulta)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'user_id'=>'required',
            'tipoMulta_id'=>'required',
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $asignacionMulta->update($request->all());
        return redirect()->route('admin.asignacionMultas.index', $asignacionMulta->id)->with('info','update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsignacionMulta $asignacionMulta)
    {
        $asistencia = Asistencia::where('multa_id',$asignacionMulta->id)->first();
        $asistencia->update(['multa_id' => null]);
        $asignacionMulta->delete();
        return redirect()->route('admin.asignacionMultas.index')->with('info','delete');
    }
}
