<?php

namespace App\Http\Controllers\Admin;

use App\Events\descuentos_widget;
use App\Http\Controllers\Controller;
use App\Models\Descuento;
use App\Models\ModelHasPermission;
use App\Models\ModelHasRoles;
use App\Models\Rol;
use App\Models\RoleHasPermission;
use App\Models\TipoDescuento;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;


class RegistroDescuentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $registroDescuentos = Descuento::all();
        // $userLogueado = auth()->user()->id;

        // foreach ($registroDescuentos as $registroDescuento){
        //     $registroDescuento->saldo = $registroDescuento->montoDescuento - $registroDescuento->montoDescontado;
        //     $registroDescuento->save();
        // }
        // return view('admin.registroDescuentos._index',compact('registroDescuentos','userLogueado'));

        return view('admin.registroDescuentos.index');
    }

    public function datatable()
    {
        $userLogueado = auth()->user();
        // Llama al método getPermissionIds() con el objeto de usuario como argumento
        $permissionIds = User::getPermissionIds($userLogueado);
        // Comprueba si el permiso con ID 63 permiso para ver todos los registros existe en la lista de permisos
        if (in_array(63, $permissionIds)) {
            // Si existe, obtén todos los registros de Descuento
            $registroDescuentos = Descuento::all();
        } else {
            // Si el rol no existe, obtén mis registros de Descuento
            $registroDescuentos = Descuento::where('user_id', $userLogueado->id)->get();
        }
        // Obtén los permisos relacionados con los IDs de permisos obtenidos anteriormente
        $permission = Permission::select('id', 'name', 'description')->whereIn('id', $permissionIds)->get();
        foreach ($registroDescuentos as $registroDescuento) {
            $registroDescuento->saldo = $registroDescuento->montoDescuento - $registroDescuento->montoDescontado;
            $registroDescuento->save();
            $registroDescuento->formatted_created_at = date('d-m-Y', strtotime($registroDescuento->created_at));
            if ($registroDescuento->montoDescontado === null) {
                $registroDescuento->formattedMontoDescontado =  0;
            } else {
                $registroDescuento->formattedMontoDescontado = $registroDescuento->montoDescontado;
            }
            $usuario = User::find($registroDescuento->user_id);
            $registroDescuento->user_name = $usuario ? $usuario->name : 'Usuario no encontrado';
            $descuento = TipoDescuento::find($registroDescuento->tipoDescuento_id);
            $registroDescuento->descuento_name = $descuento ? $descuento->nombre : 'descuento no encontrado';
        }

        return DataTables::of($registroDescuentos)
            ->addColumn('acciones', function ($row) use ($permission) {
                $acciones = '';

                if ($permission->where('id', 59)->isNotEmpty()) { // rol de editar descuentos
                    $acciones .= '<a href="' . route('admin.registroDescuentos.edit', ['registroDescuento' => $row->id]) . '">
                                    <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-id="' . $row->id . '">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg>
                                </a>';
                }

                if ($permission->where('id', 60)->isNotEmpty()) { // rol de eliminar descuentos
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
            ->addColumn('pago', function ($row) use ($permission) {
                $pago = '';

                if ($permission->where('id', 61)->isNotEmpty()) { // rol de pago total descuentos
                    $pago .= '<button class="btn btn-success btn-sm total-button" data-id="' . $row->id . '" data-action="total">Total</button>';
                }

                if ($permission->where('id', 62)->isNotEmpty()) {
                    $pago .= '<button class="btn btn-info btn-sm parcial-button" data-id="' . $row->id . '">Parcial</button>';
                }
                return $pago;
            })
            // ->addColumn('saldo', function ($row) use ($permission) {
            //     $saldo = $row->saldo;

            //     // Aplicar la misma lógica que la condición en render
            //     $badgeClass = '';
            //     if ($saldo > 0) {
            //         $badgeClass = 'badge badge-warning mt-2';
            //     } elseif ($saldo < 0) {
            //         $badgeClass = 'badge badge-danger mt-2';
            //     } else {
            //         $badgeClass = 'badge badge-success mt-2';
            //     }

            //     // Muestra el valor con la clase CSS apropiada y el atributo data-id
            //     $saldo = '<span class="' . $badgeClass . ' saldo-value" data-id="' . $row->id . '">' . $saldo . '</span>';

            //     return $saldo;
            // })
            ->rawColumns(['acciones', 'pago', 'saldo'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id', 'desc');
        $tipoDescuentos = TipoDescuento::orderBy('id', 'desc');
        return view('admin.registroDescuentos.create', compact('users', 'tipoDescuentos'));
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
        event(new descuentos_widget);
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
    public function edit(Descuento $registroDescuento)
    {
        $users = User::orderBy('id', 'desc');
        $tipoDescuentos = TipoDescuento::orderBy('id', 'desc');
        return view('admin.registroDescuentos.edit', compact('registroDescuento', 'users', 'tipoDescuentos'));
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
        return redirect()->route('admin.registroDescuentos.index', $registroDescuento->id)->with('info', 'update'); //with mensaje de sesion

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
        return redirect()->route('admin.registroDescuentos.index')->with('info', 'delete');
    }

    public function eliminar(Request $request)
    {
        $Descuento = Descuento::find($request->input('id'));

        if ($Descuento) {
            $Descuento->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false, 'message' => 'No se encontró el registro.']);
    }
}
