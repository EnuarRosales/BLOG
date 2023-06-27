<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Pagina;
use App\Models\ResgistroProducido;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class RegistroProducidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registroProducidos = ResgistroProducido::all();
        $userLogueado = auth()->user()->id;
        return view('admin.registroProducidos.index', compact('registroProducidos', 'userLogueado'));
    }


    // public function filtrarFecha()
    // {
    //     $registroProducidos = ResgistroProducido::whereDay('fecha', 3);
    //     echo  $registroProducidos;
    // }

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
            'valorProducido' => 'required',
            'meta_id' => 'required',
            'pagina_id' => 'required'
        ]);

        $registroProducido = ResgistroProducido::create($request->all());
        $registroProducido->user_id = $userLogueado;
        $registroProducido->save();

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
        return view('admin.registroProducidos.resumen', compact('registroProducidoss'));
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

        return view('admin.registroProducidos.resumen', compact('fechas', 'fechas2', 'fechas3'));
    }
}
