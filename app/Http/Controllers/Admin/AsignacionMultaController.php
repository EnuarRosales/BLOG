<?php

namespace App\Http\Controllers\Admin;

use App\Events\multaEvent;
use App\Events\multas_widget;
use App\Events\ReloadTable;
use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
use App\Models\Asistencia;
use App\Models\TipoMulta;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;


class AsignacionMultaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::with('tipoUsuario')->get();

        $userLogueado = auth()->user()->id;
        $asignacionMultas = AsignacionMulta::with('tipoMulta', 'user')->orderBy('id', 'asc')->where('descontado', 0)->get();

        $rol = Role::all();
        return view('admin.asignacionMultas.index', compact('asignacionMultas', 'userLogueado'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id', 'desc');
        $tipoMultas = TipoMulta::orderBy('id', 'desc');
        return view('admin.asignacionMultas.create', compact('users', 'tipoMultas'));
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
            'user_id' => 'required',
            'tipoMulta_id' => 'required',
        ]);


        $asignacionMulta = AsignacionMulta::create($request->all());

        if ($asignacionMulta) {
            multaEvent::dispatch($asignacionMulta->id);
        }

        event(new multas_widget());


        return redirect()->route('admin.asignacionMultas.index', $asignacionMulta->id)->with('info', 'store');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(AsignacionMulta $asignacionMulta)
    {
        $users = User::orderBy('id', 'desc');
        $tipoMultas = TipoMulta::orderBy('id', 'desc');

        return view('admin.asignacionMultas.edit', compact('asignacionMulta', 'users', 'tipoMultas'));
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
            'user_id' => 'required',
            'tipoMulta_id' => 'required',
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $asignacionMulta->update($request->all());
        return redirect()->route('admin.asignacionMultas.index', $asignacionMulta->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsignacionMulta $asignacionMulta)
    {
        $asistencia = Asistencia::where('multa_id', $asignacionMulta->id)->first();
        if ($asistencia) {
            $asistencia->update(['multa_id' => null]);
        }

        $asignacionMulta->delete();
        return redirect()->route('admin.asignacionMultas.index')->with('info', 'delete');
    }



    public function datatable()
    {

        //SE PREGUNTA SI EL USUARIO LOGUEADO TIENE ESTOS DOS PERSMISOS
        // Obtén el usuario autenticado
        // $userLogueado = Auth::user();   
        $userLogueado = auth()->user();

        if ($userLogueado->hasPermissionTo('admin.registroMultas.index')) {
            if ($userLogueado->hasPermissionTo('registroMultas.personal')) {
                // El usuario no tiene el permiso "editar_posts"
                $asignacionMultas = AsignacionMulta::where('user_id', $userLogueado->id)
                    ->orderBy('id', 'desc')
                    ->where('descontado', 0)->get();
                // dd($asignacionMultas);
            } else {
                // El usuario tiene el permiso "editar_posts"
                $asignacionMultas = AsignacionMulta::where('descontado', 0)->get();
                // dd($asignacionMultas);
            }
        }



        // $userLogueado = auth()->user();
        // // Llama al método getPermissionIds() con el objeto de usuario como argumento
        // $permissionIds = User::getPermissionIds($userLogueado);
        // // Comprueba si el permiso con ID 63 permiso para ver todos los registros existe en la lista de permisos
        // if (in_array(44, $permissionIds)) {
        //     // Si existe el permiso, obtén todos los registros de AsignacionMulta donde descontado == 0
        //     $asignacionMultas = AsignacionMulta::where('descontado', 0)->get();
        // } else {
        //     // Si el permiso no existe, obtén mis registros de AsignacionMulta donde user_id == $userLogueado->id y descontado == 0
        //     $asignacionMultas = AsignacionMulta::where('user_id', $userLogueado->id)
        //         ->where('descontado', 0)
        //         ->get();
        // }


        // Obtén los permisos relacionados con los IDs de permisos obtenidos anteriormente
        // $permission = Permission::select('id', 'name', 'description')->whereIn('id', $permissionIds)->get();


        return DataTables::of($asignacionMultas)
            ->addColumn('acciones', function ($row) use ($userLogueado) {
                $acciones = '';

                if ($userLogueado->hasPermissionTo('admin.registroMultas.edit')) { // rol de editar descuentos
                    $acciones .= '<a href="' . route('admin.asignacionMultas.edit', ['asignacionMulta' => $row->id]) . '">
                                    <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-id="' . $row->id . '">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg>
                                </a>';
                }

                if ($userLogueado->hasPermissionTo('admin.registroMultas.destroy')) { // rol de eliminar descuentos
                    // $acciones .= '<button class="btn btn-danger action-button" data-id="' . $row->id . '">Eliminar</button>';
                    $acciones .= '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-id="' . $row->id . '" class="feather feather-x-circle table-cancel">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <line x1="15" y1="9" x2="9" y2="15"></line>
                                    <line x1="9" y1="9" x2="15" y2="15"></line>
                                </svg>
                            </button>';
                }
                return $acciones;
            })
            ->addColumn('usuario_name', function ($row) {
                $usuario = User::find($row->user_id);
                return $usuario->name;
            })

            ->addColumn('multa_name', function ($row) {
                $multa = TipoMulta::find($row->tipoMulta_id);
                return $multa->nombre;
            })

            ->addColumn('multa_valor', function ($row) {
                $multa = TipoMulta::find($row->tipoMulta_id);
                return $multa->costo;
            })

            ->addColumn('multa_valor_format', function ($row) {
                $multa = TipoMulta::find($row->tipoMulta_id);
                return $multa->costo;
            })

            ->addColumn('fecha', function ($row) {
                $fechaOriginal = $row->created_at;
                // Crear un objeto Carbon desde la fecha original
                $fechaCarbon = Carbon::parse($fechaOriginal)->setTimezone('America/Bogota');

                // Extraer el año, mes y día en formato deseado
                $anioMesDia = $fechaCarbon->format('Y-m-d');

                // Imprimir el resultado
                return $anioMesDia;
            })



            ->addColumn('generar_descuento', function ($row) {
                $checked = $row->generar_descuento == 1 ? 'checked' : '';
                return '<label class="switch s-icons s-outline s-outline-success mr-2" title="Descontar en esta quincena">
                            <input type="checkbox" class="toggle-switch" data-id="' . $row->id . '" data-status="' . $row->generar_descuento . '" ' . $checked . '>
                            <span class="slider round"></span>
                        </label>';
            })



            ->rawColumns(['acciones', 'generar_descuento'])
            ->make(true);
    }

    public function generarDescuentoMulta($id)
    {

        $asignacionMulta = AsignacionMulta::findOrFail($id);
        // dd($asignacionMulta);
        // Invierte el valor de generar_descuento
        $asignacionMulta->generar_descuento = $asignacionMulta->generar_descuento == 0 ? 1 : 0;

        $asignacionMulta->save();

        $estado = $asignacionMulta->generar_descuento == 1 ? 'Activado' : 'Desactivado';

        return response()->json(['message' => 'Estado actualizado con éxito', 'estado' => $estado]);
    }

    public function eliminar(Request $request)
    {
        $Multa = AsignacionMulta::find($request->input('id'));

        if ($Multa) {
            $Multa->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No se encontró el registro.']);
    }
}
