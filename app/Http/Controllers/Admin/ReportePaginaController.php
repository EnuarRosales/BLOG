<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ReportePaginasImport;
use App\Models\MetaModelo;
use App\Models\Pagina;
use App\Models\ReportePagina;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportePaginaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $registroDatos = new ReportePaginaController;
        $registroDatos->ponerMeta();
        $registroDatos->poblarPorcentajeTotal();
        $reportePaginas = ReportePagina::all();
        return view('admin.reportePaginas.index', compact('reportePaginas'));
    }

    public function nomina()
    {

        $reportePaginas = ReportePagina::all();
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

        Excel::import(new ReportePaginasImport, $file);
        $reportePaginas = ReportePagina::all();

        foreach ($reportePaginas as $reportePagina) {
            if ($reportePagina->valorPagina == null) {
                $reportePagina->valorPagina = $reportePagina->pagina->valor;
                $reportePagina->dolares = ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
                $reportePagina->pesos = ($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
                $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
                // $reportePagina->netoPesos = (($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor)) * ($reportePagina->user->tipoUsuario->porcentaje) / 100;
                $reportePagina->save();
            }
        }
        // OJO DE ACA INICIA EL PROECSOOOOOOOOOOOOOOOOOOOOOOOOOOOO
        $asignarMeta = new ReportePaginaController;
        $asignarMeta->ponerMeta();




        return redirect()->route('admin.reportePaginas.index')->with('info', 'store');
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
        $reportePagina = ReportePagina::create($request->all());
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

        $reporteQuincenas = ReportePagina::select(
            DB::raw('sum(dolares) as suma'),
            DB::raw('user_id'),
            DB::raw('fecha'),
            DB::raw('porcentaje'),
            DB::raw('porcentajeTotal'),

        )
            ->groupBy('fecha', 'user_id', 'porcentaje', 'porcentajeTotal')
            ->get();
        // echo $reporteQuincenas;

        // $metaModelos = MetaModelo::all();
        $metaModeloss = DB::table('meta_modelos')
            ->orderBy('mayorQue', 'desc')
            ->get();
        // $metaModelos = MetaModelo::orderBy('mayorQue','desc'); 

        $meta = 0;

        $reportePaginas = ReportePagina::all();

        return view('admin.reportePaginas.nomina', compact('reporteQuincenas', 'metaModeloss', 'meta'));
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
        $users = User::orderBy('id', 'desc');
        $paginas = Pagina::orderBy('id', 'desc');
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

        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $reportePagina->update($request->all());

        $reportePagina->valorPagina = $reportePagina->pagina->valor;
        $reportePagina->dolares = ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
        $reportePagina->pesos = ($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor);
        $reportePagina->porcentaje = $reportePagina->user->tipoUsuario->porcentaje;
        $reportePagina->netoPesos = (($reportePagina->TRM) * ($reportePagina->Cantidad) * ($reportePagina->pagina->valor)) * ($reportePagina->user->tipoUsuario->porcentaje) / 100;
        $reportePagina->save();

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

        $reportePaginas = ReportePagina::all();

        foreach ($reportePaginas as $reportePagina) {
            foreach ($reporteQuincenas as $reporteQuincena) {
                foreach ($metaModeloss as $metaModelo) {
                    if ($reporteQuincena->suma >= $metaModelo->mayorQue) {
                        $meta = $metaModelo->id;
                        if ($reporteQuincena->user_id == $reportePagina->user_id && $reporteQuincena->fecha == $reportePagina->fecha) {
                            // echo $meta . "   " . $reporteQuincena->user_id . "   " . $reporteQuincena->fecha;
                            // echo "<br>";
                            $reportePagina->metaModelo_id = $meta;
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
        $reportePaginas = ReportePagina::all();
        foreach ($reportePaginas as $reportePagina) {
            if ($reportePagina->user->tipoUsuario->nombre == "MODELO") {
                $reportePagina->porcentajeTotal = $reportePagina->user->tipoUsuario->porcentaje + $reportePagina->metaModelo->porcentaje;
                $reportePagina->save();
            } else {
                $reportePagina->porcentajeTotal = $reportePagina->user->tipoUsuario->porcentaje;
                $reportePagina->save();
            }

            $reportePagina->netoPesos = (($reportePagina->pesos) * ($reportePagina->porcentajeTotal)) / 100;
            $reportePagina->save();

            // if ($reportePagina->valorPagina == null) {
            //     $reportePagina->netoPesos = (($reportePagina->pesos) * ($reportePagina->porcentajeTotal)) / 100;
            //     $reportePagina->save();
            // }
        }
    }
}
