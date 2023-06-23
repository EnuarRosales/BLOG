<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\ReportePaginasImport;
use App\Models\Pagina;
use App\Models\ReportePagina;
use App\Models\User;
use Illuminate\Http\Request;
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

        $reportePaginas = ReportePagina::all();
        return view('admin.reportePaginas.index', compact('reportePaginas'));
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
        return view('admin.reportePaginas.create', compact('users','paginas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $file = $request->file('import_file');

        //VALIDACION DE EXTENCION
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls'
        ]);

        // Excel::import(new ReportePaginasImport, $file);
        // return redirect()->route('admin.reportePaginas.index')->with('info', 'store');

 

        try {
            $file = $request->file('import_file');
            Excel::import(new ReportePaginasImport, $file);
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $fallas = $e->failures();
            foreach ($fallas as $falla) {
                $falla->row(); // fila en la que ocurrió el error
                $falla->attribute(); // el número de columna o la "llave" de la columna
                $falla->errors(); // Errores de las validaciones de laravel
                $falla->values(); // Valores de la fila en la que ocurrió el error.
            }
        }

        Excel::import(new ReportePaginasImport, $file);
        return redirect()->route('admin.reportePaginas.index')->with('info', 'store');
    }

    public function storeIndividual(Request $request) 
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'fecha'=>'required',
            'user_id'=>'required',   
            'pagina_id'=>'required',
            'Cantidad'=>'required',  

        ]);
 
        $reportePagina = ReportePagina::create($request->all());
        return redirect()->route('admin.reportePaginas.index',$reportePagina->id)->with('info','store');

        
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
}
