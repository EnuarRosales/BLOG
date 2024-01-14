<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ReportePaginasImport;
use App\Models\AsignacionMulta;
use App\Models\Impuesto;
use App\Models\MetaModelo;
use App\Models\Pagina;
use App\Models\ReportePagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Carbon;

use function PHPUnit\Framework\returnSelf;

class ReportePaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.reportePaginas.index');
    }



    public function cargarExcel()
    {

        return view('admin.reportePaginas.partials.import-excel');
    }


    public function nomina()
    {
        // $reportePaginas = ReportePagina::all();
        $reportePaginas = ReportePagina::with('user', 'pagina', 'metaModelo')->where('verificado', 0)->get();
        return view('admin.reportePaginas.nomina', compact('reportePaginas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id', 'desc');
        $paginas = Pagina::orderBy('id', 'desc');
        // $turnos = Turno::orderBy('id','desc');
        return view('admin.reportePaginas.create', compact('users', 'paginas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $file = $request->file('import_file');
        //VALIDACION DE EXTENCION
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls',
        ]);


        $data = Excel::toArray(new ReportePaginasImport, $file);
        $errorRowsModel = []; // Inicializamos un arreglo para rastrear las filas con errores
        $errorRowsPage = []; // Inicializamos un arreglo para rastrear las filas con errores
        // dd($data);

        foreach ($data as  $rows) {
            foreach ($rows as $index => $row) {
                $modelo = User::where('cedula', $row['modelo'])->first();
                if (empty($modelo)) {
                    $errorRowsModel[] = ($index + 2); // Registramos el índice de fila del error
                }
                $pagina = Pagina::where('nombre', $row['pagina'])->first();
                if (empty($pagina)) {
                    $errorRowsPage[] = ($index + 2); // Registramos el índice de fila del error
                    // $errorRowsModel[] = 'Error en la fila ' . ($index + 2) . ': el modelo con cédula ' . $row['modelo'] . ' no existe en la base de datos.';
                }
            }
        }

        if (!empty($errorRowsModel)) {
            if (count($errorRowsModel) > 27) {
                $errorRowsModel = array_slice($errorRowsModel, 0, 27); // Limita el arreglo a los primeros 30 elementos
            }
            $mensaje = "error,modelo," . implode(" - ", $errorRowsModel);
            return redirect()->route('admin.reportePaginas.index')->with('info', $mensaje);
        }

        if (!empty($errorRowsPage)) {
            if (count($errorRowsPage) > 27) {
                $errorRowsPage = array_slice($errorRowsPage, 0, 27); // Limita el arreglo a los primeros 30 elementos
            }
            $mensaje = "error,pagina," . implode(" - ", $errorRowsPage);
            return redirect()->route('admin.reportePaginas.index')->with('info', $mensaje);
        }



        $modelo = Excel::import(new ReportePaginasImport, $file);
        $hoy = Carbon::today('America/Bogota');
        $reportePaginas = ReportePagina::where('verificado', 0)
            ->where('fecha', '=', $request->fecha) //ENUAR AGREGUE ESTA LINEA
            ->whereDate('created_at', $hoy)->get();

        foreach ($reportePaginas as $reportePagina) {
            if ($reportePagina->valorPagina == null) {
                $user = ReportePagina::where('user_id', $reportePagina->user_id)
                    ->where('verificado', 0)->first();
                $reportePagina->operacion = $user->operacion;
                $reportePagina->porcentaje_add = $user->porcentaje_add;
                $reportePagina->valorPagina = $reportePagina->pagina->valor;
                $reportePagina->dolares = ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
                $reportePagina->pesos = ($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
                $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
                $reportePagina->save();
            }
        }
        // OJO DE ACA INICIA EL PROECSOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        $asignarMeta = new ReportePaginaController;
        $asignarMeta->ponerMeta();
        $asignarMeta->actualizarPorcentaje();
        return redirect()->route('admin.reportePaginas.index')->with('info', 'storeExcel');
    }

    public function storeIndividual(Request $request)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'fecha' => 'required',
            'user_id' => 'required',
            'pagina_id' => 'required',
            'Cantidad' => 'required',
            'TRM' => 'required',
        ]);

        $reporteUser = ReportePagina::where('user_id', $request->user_id)
            ->where('verificado', 0)
            ->where('fecha', '=', $request->fecha) //ENUAR AGREGUE ESTE CONDICION
            ->whereNotNull('porcentaje_add')
            ->first();

        $reportePagina = ReportePagina::create([
            'fecha' => $request->fecha,
            'user_id' => $request->user_id,
            "pagina_id" => $request->pagina_id,
            "Cantidad" => $request->Cantidad,
            "TRM" => $request->TRM,
            "operacion" => $reporteUser->operacion ?? null,
            "porcentaje_add" => $reporteUser->porcentaje_add ?? null,
        ]);

        if ($reportePagina->valorPagina == null) {
            $reportePagina->valorPagina = $reportePagina->pagina->valor;
            $reportePagina->dolares = ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
            $reportePagina->pesos = ($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
            $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
            $reportePagina->netoPesos = (($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor)) * ($reportePagina->user->tipoUsuario->porcentaje) / 100;
            $reportePagina->save();
        }
        return redirect()->route('admin.reportePaginas.index', $reportePagina->id)->with('info', 'store');
    }


    public function reporteQuincena()
    {
        return view('admin.reportePaginas.nomina');
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
    public function edit(ReportePagina $reportePagina)
    {
        $users = User::orderBy('id', 'desc')->get();
        $paginas = Pagina::orderBy('id', 'desc')->get();
        return view('admin.reportePaginas.edit', compact('reportePagina', 'users', 'paginas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReportePagina $reportePagina)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'fecha' => 'required',
            'user_id' => 'required',
            'pagina_id' => 'required',
            'Cantidad' => 'required',
            'TRM' => 'required',
        ]);
        if ($request->porcentaje_add != $reportePagina->porcentaje_add || $request->operacion != $reportePagina->operacion) {
            $reporteUser = ReportePagina::where('user_id', $request->user_id)
                ->where('fecha', '=', $request->fecha) //ENUAR AGREGUE ESTA LINEA
                ->where('verificado', 0)->get();

            foreach ($reporteUser as $item) {
                $item->operacion = $request->operacion;
                $item->porcentaje_add = $request->porcentaje_add;
                $item->update();
            }
        }

        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $reportePagina->update($request->all());
        if ($reportePagina->valorPagina == null) {
            $reportePagina->valorPagina = $reportePagina->pagina->valor;
            $reportePagina->dolares = ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
            $reportePagina->pesos = ($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
            $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
            $reportePagina->netoPesos = (($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor)) * ($reportePagina->user->tipoUsuario->porcentaje) / 100;
            $reportePagina->save();
        }

        return redirect()->route('admin.reportePaginas.index', $reportePagina->id)->with('info', 'update'); //with mensaje de sesion
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReportePagina $reportePagina)
    {
        $reportePagina->delete();
        return redirect()->route('admin.reportePaginas.index')->with('info', 'delete');
    }

    /*
     * function ponerMeta()
     * 1. ESTA FUNCION INICIALEMNTE REALIZA UNA CONSULTA A LA BASE DE DATOS EN DONDE AGRUPA LOS DOLARES Y LOS SUMA
     * ADICIONALMENTE AGRUPA POR USUR Y FECHA      *
     * 2. LUEGO REALIZA UNA SEGUNA CONSULTA A LA BASE DE DATOS DONDE ORDENA LA TABLA meta_modelos DE MANERA DESCENDENTE
     * 3.MEDIANTE CICLOS Y CONDICIONES ASIGNA VALOR A LA TABLA $reportePagina->metaModelo_id
     *
     */
    public function ponerMeta()
    {
        // with('user', 'pagina', 'metaModelo')
        $reporteQuincenas = ReportePagina::select(
            DB::raw('sum(dolares) as suma'),
            DB::raw('user_id'),
            DB::raw('fecha'),

        )
            ->groupBy('fecha', 'user_id')
            ->get();
        $metaModeloss = DB::table('meta_modelos')
            ->orderBy('mayorQue', 'desc')
            ->get();

        $meta = 0;

        // $reportePaginas = ReportePagina::with('user', 'pagina')->get();
        $reportePaginas = ReportePagina::all();

        foreach ($reportePaginas as $reportePagina) {
            foreach ($reporteQuincenas as $reporteQuincena) {
                foreach ($metaModeloss as $metaModelo) {
                    if ($reporteQuincena->suma >= $metaModelo->mayorQue) {
                        $meta = $metaModelo->porcentaje;
                        // $meta = $metaModelo->porcentaje;
                        if ($reporteQuincena->user_id == $reportePagina->user_id && $reporteQuincena->fecha == $reportePagina->fecha && $reportePagina->enviarPago == 0) {

                            $reportePagina->metaModelo = $meta;
                            $reportePagina->save();
                        }
                        break;
                    }
                }
            }
        }
    }

    public function poblarPorcentajeTotal()
    {
        // $reportePaginas = ReportePagina::with('user', 'reportePaginas')->get();
        $reportePaginas = ReportePagina::all();
        foreach ($reportePaginas as $reportePagina) {
            if ($reportePagina->user->tipoUsuario->nombre == "Modelo") {
                $reportePagina->porcentajeTotal = $reportePagina->user->tipoUsuario->porcentaje + $reportePagina->metaModelo; //+ $reportePagina->metaModelo->porcentaje
                $reportePagina->save();
            } else {
                $reportePagina->porcentajeTotal = $reportePagina->user->tipoUsuario->porcentaje;
                $reportePagina->save();
            }

            $reportePagina->netoPesos = (($reportePagina->pesos) * ($reportePagina->porcentajeTotal)) / 100;
            $reportePagina->save();
        }
    }

    public function actualizarPorcentaje()
    {
        // $reportePaginas = ReportePagina::with('user', 'reportePagina')->where('verificado', 0)->get();
        $reportePaginas = ReportePagina::where('verificado', 0)->get();
        foreach ($reportePaginas as $reportePagina) {
            if ($reportePagina->verificado == 0) {
                $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
                $reportePagina->save();
            }
        }
    }

    public function verificadoMasivo(Request $request)
    {
        $reportePaginas = ReportePagina::whereIn('id', $request->ids)
            ->where('verificado', 0)
            ->get();
        foreach ($reportePaginas as $reportePagina) {
            $reportePagina->verificado = 1;
            $reportePagina->save();
        }
        return redirect()->route('admin.reportePaginas.index')->with('info', 'verificadoMasivo');
    }


    public function pagos()
    {
        $pagos = ReportePagina::with('user', 'pagina')->select(
            DB::raw('sum(netoPesos) as suma'),
            DB::raw('user_id'),
            DB::raw('fecha'),
        )
            ->where('verificado', 1)
            ->where('enviarPago', 0)
            ->groupBy('fecha', 'user_id')
            ->get();

        $descuentos = DB::table('descuentos')
            ->join('descontados', 'descontados.descuento_id', '=', 'descuentos.id')
            ->select(
                DB::raw('sum(valor) as suma'),
                DB::raw('user_id'),
            )
            ->where('descontado', 0)
            ->whereNull('descuentos.deleted_at')  // Condición para descuentos no eliminados
            ->whereNull('descontados.deleted_at') // Condición para descontados no eliminados
            ->groupBy('user_id')
            ->get();

        if (count($descuentos) == "0") {
            $array = "vacio";
        } else {
            $array = "lleno";
        }

        $variableImpuesto = 0;
        $impuestos = Impuesto::where('estado', 1)->get();
        $multas = AsignacionMulta::where('descontado', 0)->get();

        $multas = DB::table('asignacion_multas')
            ->join('tipo_multas', 'tipo_multas.id', '=', 'asignacion_multas.tipoMulta_id')
            ->select(
                DB::raw('sum(tipo_multas.costo) as suma'),
                DB::raw('user_id'),
            )
            ->where('asignacion_multas.descontado', 0)
            ->whereNull('asignacion_multas.deleted_at')  // Condición para asignacion_multas no eliminadas
            ->whereNull('tipo_multas.deleted_at')        // Condición para tipo_multas no eliminadas
            ->groupBy('user_id')
            ->get();

        return view('admin.reportePaginas.pago', compact('pagos', 'descuentos', 'array', 'impuestos', 'variableImpuesto', 'multas'));
    }

    public function updateStatus(Request $request)
    {
        try {
            if ($request->ajax()) {
                $reporte_pagina = ReportePagina::find($request->input('id'));
                if ($reporte_pagina) {
                    $reporte_pagina->update(['verificado' => (int)$request->input('active')]);
                }
                return response()->json("Updated", 200);
            }
        } catch (\Exception $exception) {
            // \Log::error("Error updateStatus VU: {$exception->getMessage()} File: {$exception->getFile()} Line: {$exception->getLine()}");
            return response()->json(null, 500);
        }
    }

    public function datatable()
    {
        $userLogueado = auth()->user();
        $permissionIds = User::getPermissionIds($userLogueado);
        $permission = Permission::select('id', 'name', 'description')->whereIn('id', $permissionIds)->get();

        // Obtén los reportes que necesitan actualización
        $reportePaginas = ReportePagina::with('user.tipoUsuario', 'metaModelo')
            ->where('verificado', 0)
            ->orWhere('enviarPago', 0)
            ->get();

        $metaModelos = MetaModelo::orderByDesc('mayorQue')->get();

        // Itera sobre los reportes y actualiza la información según las condiciones
        foreach ($reportePaginas as $reportePagina) {
            // Actualizar porcentaje en caso de no estar verificado
            if ($reportePagina->verificado == 0) {
                $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
                $reportePagina->save();
            }

            // Actualizar metaModelo en caso de no haber enviado pago
            if ($reportePagina->enviarPago == 0) {
                $reporteQuincena = ReportePagina::select(
                    DB::raw('sum(dolares) as suma'),
                    'user_id',
                    'fecha'
                )
                    ->where('user_id', $reportePagina->user_id)
                    ->where('fecha', $reportePagina->fecha)
                    ->groupBy('user_id', 'fecha')
                    ->first();

                if ($reporteQuincena) {
                    $metaModelo = $metaModelos
                        ->where('mayorQue', '<=', $reporteQuincena->suma)
                        ->first();

                    if ($metaModelo) {
                        $reportePagina->metaModelo = $metaModelo->porcentaje;
                        $reportePagina->save();
                    }
                }
            }

            // Calcular y actualizar porcentajeTotal y netoPesos
            $tipoUsuario = $reportePagina->user->tipoUsuario;
            $metaPorcentaje = $reportePagina->metaModelo ?? 0.0;
            // verificacion para suma y resta de porcentaje modificado
            if ($reportePagina->operacion && $reportePagina->porcentaje_add) {
                $operacion = ($reportePagina->operacion === '+') ? 1 : -1;
                $porcentajeTotal = $tipoUsuario->porcentaje + ($tipoUsuario->nombre == "Modelo" ? $metaPorcentaje : 0) + $operacion * $reportePagina->porcentaje_add;
            } else {
                $porcentajeTotal = $tipoUsuario->nombre == "Modelo" ? ($tipoUsuario->porcentaje + $metaPorcentaje) : $tipoUsuario->porcentaje;
            }

            $reportePagina->porcentajeTotal = $porcentajeTotal;
            $reportePagina->netoPesos = ($reportePagina->pesos * $porcentajeTotal) / 100;

            $reportePagina->save();
        }

        $reportePaginas = ReportePagina::with('user', 'pagina')->where('verificado', 0)->get();

        return DataTables::of($reportePaginas)
            ->addColumn('acciones', function ($row) use ($permission) {
                $acciones = '';

                if ($permission->where('id', 55)->isNotEmpty()) { // rol de editar descuentos
                    $acciones .= '<a href="' . route('admin.reportePaginas.edit', ['reportePagina' => $row->id]) . '">
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
            ->addColumn('usuario_name', function ($row) {
                $usuario = User::find($row->user_id);
                return $usuario->name;
            })
            ->addColumn('pagina_name', function ($row) {
                $usuario = Pagina::find($row->pagina_id);
                return $usuario->nombre;
            })
            ->addColumn('netoPesos_format', function ($row) {
                $neto = ($row->netoPesos);
                return $neto;
            })
            ->addColumn('pesos_format', function ($row) {
                $pesos = ($row->pesos);
                return $pesos;
            })
            ->addColumn('TRM_format', function ($row) {
                $TRM = ($row->TRM);
                return $TRM;
            })
            ->addColumn('dolares_format', function ($row) {
                $dolares = ($row->dolares);
                return $dolares;
            })
            ->addColumn('verificado', function ($row) {
                $checked = $row->verificado == 1 ? 'checked' : '';
                return '<label class="switch s-icons s-outline s-outline-success mr-2" title="Validar Info">
                            <input type="checkbox" class="toggle-switch" data-id="' . $row->id . '" data-status="' . $row->verificado . '" ' . $checked . '>
                            <span class="slider round"></span>
                        </label>';
            })
            ->addColumn('porcentaje_ad', function ($row) {
                $porcentaje = $row->operacion;
                $porcentaje .= $row->porcentaje_add;
                return $porcentaje;
            })
            ->rawColumns(['acciones', 'verificado'])
            ->make(true);
    }

    public function eliminar(Request $request)
    {
        $reportePaginas = ReportePagina::find($request->input('id'));

        if ($reportePaginas) {
            $reportePaginas->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No se encontró el registro.']);
    }

    public function porcentaje_datatable()
    {
        $userLogueado = auth()->user();
        $permissionIds = User::getPermissionIds($userLogueado);
        // $permission = Permission::select('id', 'name', 'description')->whereIn('id', $permissionIds)->get();

        // Obtén los reportes que necesitan actualización
        $reporteQuincenas = ReportePagina::with('user', 'pagina')->select(
            DB::raw('sum(dolares) as suma'),
            DB::raw('user_id'),
            DB::raw('fecha'),
            DB::raw('porcentaje'),
            DB::raw('operacion'),
            DB::raw('porcentaje_add'),
            DB::raw('porcentajeTotal'),
            DB::raw('metaModelo'),
        )
            ->where('verificado', 0)
            ->groupBy('fecha', 'user_id', 'porcentaje', 'porcentajeTotal', 'operacion', 'porcentaje_add', 'metaModelo')
            ->get();

        // $reporteQuincenas= ReportePagina::all();
        return DataTables::of($reporteQuincenas)
            ->addColumn('usuario_name', function ($row) {
                $usuario = User::find($row->user_id);
                return $usuario->name;
            })
            ->addColumn('suma', function ($row) {
                $suma = ($row->suma);
                return $suma;
            })
            ->addColumn('suma_format', function ($row) {
                $suma = ($row->suma);
                return $suma;
            })
            ->addColumn('fecha', function ($row) {
                $fecha = ($row->fecha);
                return $fecha;
            })
            ->addColumn('porcentaje', function ($row) {
                $porcentaje = ($row->porcentaje);
                return $porcentaje;
            })
            ->addColumn('porcentaje_ad', function ($row) {
                $porcentaje = $row->operacion;
                $porcentaje .= $row->porcentaje_add;
                return $porcentaje;
            })
            ->addColumn('porcentajeTotal', function ($row) {
                $porcentajeTotal = ($row->porcentajeTotal);
                return $porcentajeTotal;
            })
            ->rawColumns(['suma', 'usuario_name'])
            ->make(true);
    }
}
