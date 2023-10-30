<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\AsignacionTurno;
use App\Models\Asistencia;
use App\Models\AsistenciaTiempoConfig;
use App\Models\Descuento;
use App\Models\TipoMulta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RegistroAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userLogueado = auth()->user()->id;
        // Consulta las asistencias para el día actual
        $asistencias = Asistencia::with('user', 'user.asignacionTurnos', 'user.asignacionTurnos.turno')
            ->get();

        foreach ($asistencias as $asistencia) {
            $user = $asistencia->user; // Accedes a la relación user
            $asignacionTurno = $user->asignacionTurnos; // Accedes a la relación asignacionTurno dentro de la relación user
        }
        return view('admin.registroAsistencias.index', compact('asistencias', 'userLogueado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::with('asignacionTurnos', 'asignacionTurnos.turno')->orderBy('id', 'desc')->get();
        $asistencia = AsistenciaTiempoConfig::all();
        return view('admin.registroAsistencias.create', compact('users', 'asistencia'));
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
            'user_id' => 'required',
            'fecha' => 'required',
            // 'my_hora'=>'required',

        ]);

        if ($request->has('multa')) {
            $multa = TipoMulta::find(1);
            $asignacionMulta = new AsignacionMulta;
            $asignacionMulta->user_id = $request->user_id;
            $asignacionMulta->tipoMulta_id = $multa->id;
        }

        $registroAsistencia = new Asistencia;
        $registroAsistencia->fecha = $request->fecha;
        $registroAsistencia->mi_hora = $request->mi_hora;
        $registroAsistencia->user_id = $request->user_id;
        $registroAsistencia->control = $request->control;
        if ($registroAsistencia->save() && $request->has('multa')) {
            $asignacionMulta->save();
        }

        return redirect()->route('admin.registroAsistencias.index', $registroAsistencia->id)->with('info', 'store');
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
    public function edit(Asistencia $registroAsistencia)
    {
        $users = User::orderBy('id', 'desc');
        return view('admin.registroAsistencias.edit', compact('registroAsistencia', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asistencia $registroAsistencia)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'user_id' => 'required',
            'fecha' => 'required',
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $registroAsistencia->update($request->all());
        return redirect()->route('admin.registroAsistencias.index', $registroAsistencia->id)->with('info', 'update'); //with mensaje de sesion

    }










    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $registroAsistencia)
    {
        $registroAsistencia->delete();
        return redirect()->route('admin.registroAsistencias.index')->with('info', 'delete');
    }
}
