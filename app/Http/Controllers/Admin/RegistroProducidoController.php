<?php

namespace App\Http\Controllers\Admin;

use App\Events\metas_widget;
use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Pagina;
use App\Models\ResgistroProducido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class RegistroProducidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.registroProducidos.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id', 'desc');
        $metas = Meta::orderBy('id', 'desc');
        $paginas = Pagina::orderBy('id', 'desc');
        // $turnos = Turno::orderBy('id','desc');
        return view('admin.registroProducidos.create', compact('users', 'metas', 'paginas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userLogueado = auth()->user()->id;
        //VALiDACION FORMULARIO
        $request->validate([
            // 'user_id' => 'required',
            'fecha' => 'required',
            'valorProducido' => 'required|numeric',
            'meta_id' => 'required',
            'pagina_id' => 'required'
        ]);

        $registroProducido = ResgistroProducido::create($request->all());
        $registroProducido->user_id = $userLogueado;
        $registroProducido->save();

        event(new metas_widget);


        return redirect()->route('admin.registroProducidos.index', $registroProducido->id)->with('info', 'store');
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
    public function edit(ResgistroProducido $registroProducido)
    {
        $users = User::orderBy('id', 'desc');
        $metas = Meta::orderBy('id', 'desc');
        $paginas = Pagina::orderBy('id', 'desc');
        return view('admin.registroProducidos.edit', compact('registroProducido', 'users', 'metas', 'paginas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ResgistroProducido $registroProducido)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'valorProducido' => 'required',
            'meta_id' => 'required',
            'pagina_id' => 'required'
        ]);

        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $registroProducido->update($request->all());
        return redirect()->route('admin.registroProducidos.index', $registroProducido->id)->with('info', 'update'); //with mensaje de sesion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ResgistroProducido $registroProducido)
    {
        $registroProducido->delete();
        return redirect()->route('admin.registroProducidos.index')->with('info', 'delete');
    }

    public function eliminar(Request $request)
    {
        $Descuento = ResgistroProducido::find($request->input('id'));

        if ($Descuento) {
            $Descuento->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No se encontró el registro.']);
    }

    public function resumen()
    {
        $registroProducidos = ResgistroProducido::all();


        foreach ($registroProducidos as $registroProducido) {
            if ($registroProducido->valorProducido > $registroProducido->meta->valor) {
                $registroProducido->cumplio = "Si";
                $registroProducido->save();
            } else {

                $registroProducido->cumplio = "No";
                $registroProducido->save();
            }
        }

        $registroProducidoss = ResgistroProducido::whereDay('fecha', '03')
            ->select('valorProducido', 'fecha')
            ->get()
            ->sum('valorProducido');
        $total =  $registroProducidoss->sum('valorProducido');

        // echo $registroProducidoss;
        return view('admin.registroProducidos.resumen', compact('registroProducidoss', 'metas'));
    }

    public function resumen_ajax(Request $request)
    {
        $fechaInicial = $request->input('fechaInicial');
        $fechaFinal = $request->input('fechaFinal');
        $datosFiltrados = ResgistroProducido::whereBetween('fecha', [$fechaInicial, $fechaFinal])->get();
        return response()->json(['success' => true, 'data' => $datosFiltrados]);
    }


    public function reporte_dia(Request $request)
    {

        /* AGRUPA EL VALOR PRODUCIDO POR LA META Y FECHA; ES DECIR  NOS MUESTRA LA PRODUCCION DIARIA
        DE ACUERDO A LA META Y A LA FECHA, LO USAMOS  PARA VERIFICAR LO SIGUIENTE
        1. FECHA
        2. META STUDIO
        3.OBJETIVO DIARIO; OJO APROVECHANDO LA RELACION CON LA META  LO QUE SE HACE ES DIVIDR SU VALOR EN EL NUMNERO DE DIAS
        4.PRODUCCION REPORTADA; OJO ES LA SUMA DEL VALOR PRODUCIDO
        5.ALARMA DIFERENCIA;  DIVIDE EL VALR DE LA META EN EL NUMERO DE DIAS Y LE RESTA  VALOR PRODUCIDO
        6.CUMPLIO; OJO VERIFICA SI LA DIFERENCIA ES POSITIVA O NEGATIVA, SI ES POSITIVA CUMPLIO = SI DE LO CONTRARIO NO
        */

        $fechas = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),

            DB::raw('fecha'),

        )
            ->groupBy('fecha', 'meta_id')
            ->get();

        // echo $fechas;

        /* AGRUPA EL VALOR PRODUCIDO POR LA META; ES DECIR NOS MUESTA  CUANTO SE HA PRODUCIDO POR CADA META

        LO USAMOS  PARA VERIFICAR LO SIGUIENTE

        1. PARA PODER VER LA PRODUCCION TOTAL; ESTA SE MUESTRA EN TODAS LAS FILAS DONDE COINDIDA EL TIPO DE META*/

        $fechas2 = ResgistroProducido::select(
            DB::raw('sum(valorProducido) as suma'),
            DB::raw('meta_id'),
            // DB::raw('fecha'),

        )
            ->groupBy('meta_id')
            ->get();

        // echo $fechas2;

        $fechas3 = ResgistroProducido::select(
            DB::raw('COUNT(DISTINCT(DATE(fecha)))  as date_count'),
            DB::raw('meta_id'),
            // DB::raw('fecha'),

        )
            ->groupBy('meta_id')
            ->get();

        $metas = Meta::orderBy('id', 'desc')->get();

        return view('admin.registroProducidos.resumen', compact('fechas', 'fechas2', 'fechas3', 'metas'));
    }

    public function datatable(Request $request)
    {
        $userLogueado = auth()->user();
        // Llama al método getPermissionIds() con el objeto de usuario como argumento
        $permissionIds = User::getPermissionIds($userLogueado);
        $registroProducidos = ResgistroProducido::with(['meta', 'pagina', 'user'])->get();
        $permission = Permission::select('id', 'name', 'description')->whereIn('id', $permissionIds)->get();
        return DataTables::of($registroProducidos)
        ->addColumn('meta_nombre', function ($row) {
            return $row->meta->nombre; // Reemplaza 'nombre' con el nombre real de la columna
        })
        ->addColumn('pagina_nombre', function ($row) {
            return $row->pagina->nombre; // Reemplaza 'nombre' con el nombre real de la columna
        })
        ->addColumn('user_nombre', function ($row) {
            return $row->user->name; // Reemplaza 'nombre' con el nombre real de la columna
        })
        ->addColumn('valorProducidoFormat', function ($row) {
            // dd($row);
            return $row->valorProducido;
        })
        // ->addColumn('acciones', function ($row) {
        //     $acciones = '';
        //     return $acciones;
        // })
        ->addColumn('acciones', function ($row) use ($permission) {
            $acciones = '';

            if ($permission->where('id', 55)->isNotEmpty()) { // rol de editar descuentos
                $acciones .= '<a href="' . route('admin.registroProducidos.edit', ['registroProducido' => $row->id]) . '">
                                <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-id="' . $row->id . '">
                                    <path d="M12 20h9"></path>
                                    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                </svg>
                            </a>';
            }

            if ($permission->where('id', 56)->isNotEmpty()) { // rol de eliminar descuentos
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

            ->rawColumns(['acciones'])
            ->make(true);
    }
}
