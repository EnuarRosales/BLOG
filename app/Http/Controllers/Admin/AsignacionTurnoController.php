<?php

namespace App\Http\Controllers\Admin;

use App\Events\control_turnos;
use App\Http\Controllers\Controller;
use App\Models\AsignacionTurno;
use App\Models\Turno;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignacionTurnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

 
        // $asignacionTurnos = AsignacionTurno::all();
        // $asignacionTurnos = AsignacionTurno::with('turno','user.tipoUsuario')->get();
        // return view('admin.asignacionTurnos.index', compact('asignacionTurnos'));


        // Obtén el usua rio autenticado
        $user = Auth::user();
        //Obtén el ID del usuario autenticado
        $userId = Auth::id();
        // dd($user->id);
        // Verifica si el usuario tiene el permiso "editar_posts"
        if ($user->hasPermissionTo('admin.asignacionTurnos.index')) {
            if ($user->hasPermissionTo('asignacionTurnos.personal')) {
                // El usuario no tiene el permiso "editar_posts"
                $asignacionTurnos = AsignacionTurno::where('user_id', $user->id)
                    ->orderBy('id', 'desc')
                    ->get();
                return view('admin.asignacionTurnos.index', compact('asignacionTurnos'));
            }
            // El usuario tiene el permiso "editar_posts"
            $asignacionTurnos = AsignacionTurno::with('turno', 'user.tipoUsuario')->get();

            return view('admin.asignacionTurnos.index', compact('asignacionTurnos'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $asignacionTurnos = AsignacionTurno::pluck('created_at','id')->toArray();
        $users = User::where('active', 1)
        ->orderBy('id', 'desc');
        $turnos = Turno::orderBy('id', 'desc');
        return view('admin.asignacionTurnos.create', compact('users', 'turnos'));
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
            'turno_id' => 'required',
        ]);

        $asignacionTurno = AsignacionTurno::create($request->all());
        event(new control_turnos());

        return redirect()->route('admin.asignacionTurnos.index', $asignacionTurno->id)->with('info', 'store');
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
    public function edit(AsignacionTurno $asignacionTurno)
    {
        $users = User::where('active', 1)
        ->orderBy('id', 'desc');

        $turnos = Turno::orderBy('id', 'desc');

        return view('admin.asignacionTurnos.edit', compact('asignacionTurno', 'users', 'turnos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsignacionTurno $asignacionTurno)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'user_id' => 'required',
            'turno_id' => 'required',
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $asignacionTurno->update($request->all());
        return redirect()->route('admin.asignacionTurnos.index', $asignacionTurno->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsignacionTurno $asignacionTurno)

    {
        $asignacionTurno->delete();
        return redirect()->route('admin.asignacionTurnos.index')->with('info', 'delete');
    }
}
