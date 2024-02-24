<?php

namespace App\Http\Controllers\Admin;

use App\Events\control_asistencia;
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
use Illuminate\Support\Facades\DB;

class RegistroAsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hoy =  Carbon::now()->toDateString();
        $userLogueado = auth()->user()->id;

        // Consulta las asistencias para el día actual
        $asistencias = Asistencia::with('user', 'user.asignacionTurnos', 'user.asignacionTurnos.turno')
            ->get()
            ->sortByDesc('updated_at');

        $asistenciasHoy = Asistencia::with('user', 'user.asignacionTurnos', 'user.asignacionTurnos.turno')
            ->whereDate('fecha', $hoy)
            ->get()
            ->sortByDesc('updated_at');

        $configAsistencia = AsistenciaTiempoConfig::find(1);

        foreach ($asistencias as $asistencia) {
            $user = $asistencia->user; // Accedes a la relación user
            $asignacionTurno = $user->asignacionTurnos; // Accedes a la relación asignacionTurno dentro de la relación user
        }
        return view('admin.registroAsistencias.index', compact('asistencias', 'userLogueado', 'configAsistencia', 'asistenciasHoy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::with('asignacionTurnos', 'asignacionTurnos.turno')
        ->where('active', 1)
        ->orderBy('id', 'desc')->get();
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

        try {
            if ($request->has('multa')) {
                $multa = TipoMulta::find(1);
                $asignacionMulta = new AsignacionMulta;
                $asignacionMulta->user_id = $request->user_id;
                $asignacionMulta->tipoMulta_id = $multa->id;
                $asignacionMulta->save();
            }

            $registroAsistencia = new Asistencia;
            $registroAsistencia->fecha = $request->fecha;
            $registroAsistencia->mi_hora = $request->mi_hora;
            $registroAsistencia->user_id = $request->user_id;
            $registroAsistencia->control = $request->control;

            // Asignar multa_id solo si se creó la asignación de multa correctamente
            if (isset($asignacionMulta)) {
                $registroAsistencia->multa_id = $asignacionMulta->id;
            }

            $registroAsistencia->save();
            event(new control_asistencia);

            DB::commit(); // Confirma la transacción si todo se completó con éxito
        } catch (\Exception $e) {
            DB::rollBack(); // Deshace la transacción en caso de error
            // Manejar el error o lanzar una excepción si es necesario
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
        $users = User::with('asignacionTurnos', 'asignacionTurnos.turno')
        ->where('active', 1)
        ->orderBy('id', 'desc')->get();
        
        $asistencia = AsistenciaTiempoConfig::all();
        return view('admin.registroAsistencias.edit', compact('registroAsistencia', 'users', 'asistencia'));
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
        // dd($request->all());


        if ($request->has('multa')) {
            if ($request->multa === 'on' && $request->multa_id === null) {
                $multa = TipoMulta::find(1);
                $asignacionMulta = new AsignacionMulta;
                $asignacionMulta->user_id = $request->user_id;
                $asignacionMulta->tipoMulta_id = $multa->id;
                $asignacionMulta->save();

                $request->merge(['multa_id' => $asignacionMulta->id]);
                $registroAsistencia->update($request->except('multa'));
            } else {
                $registroAsistencia->update($request->except('multa'));
            }
        } else {  
            $multa = AsignacionMulta::find($request->multa_id);
            if ($multa) {
                $multa->delete();
            }
            $request->merge(['multa_id' => null]);
            $registroAsistencia->update($request->except('multa'));
        }


        return redirect()->route('admin.registroAsistencias.index', $registroAsistencia->id)->with('info', 'update'); //with mensaje de sesion
    }

    public function updateTime(Request $request)
    {
        $configAsistencia = AsistenciaTiempoConfig::find($request->id);
        $configAsistencia->nombre = $request->nombre;
        $configAsistencia->tiempo = $request->minutos * 60;
        if ($configAsistencia->update()) {
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asistencia $registroAsistencia)
    {
        $multa = AsignacionMulta::find($registroAsistencia->multa_id);
        if ($multa) {
            $multa->delete();
        }
        $registroAsistencia->delete();
        return redirect()->route('admin.registroAsistencias.index')->with('info', 'delete');
    }

    public function historial(Request $request)
    {
        $hoy =  Carbon::now()->toDateString();
        $userLogueado = auth()->user()->id;

        // Consulta las asistencias para el día actual
        $asistencias = Asistencia::with('user', 'user.asignacionTurnos', 'user.asignacionTurnos.turno')
            ->get()
            ->sortByDesc('updated_at');

        $asistenciasHoy = Asistencia::with('user', 'user.asignacionTurnos', 'user.asignacionTurnos.turno')
            ->whereDate('fecha', $hoy)
            ->get()
            ->sortByDesc('updated_at');

        $configAsistencia = AsistenciaTiempoConfig::find(1);

        foreach ($asistencias as $asistencia) {
            $user = $asistencia->user; // Accedes a la relación user
            $asignacionTurno = $user->asignacionTurnos; // Accedes a la relación asignacionTurno dentro de la relación user
        }
        return view('admin.registroAsistencias.historial', compact('asistencias', 'userLogueado', 'configAsistencia', 'asistenciasHoy'));
    }
}
