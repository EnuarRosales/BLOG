<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Meta;
use App\Models\Pagina;
use App\Models\ResgistroProducido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        

        foreach ($registroProducidos as $registroProducido) {
            if ($registroProducido->valorProducido > $registroProducido->meta->valor) {
                $registroProducido->cumplio = "Si";
                $registroProducido->save();
            } else {

                $registroProducido->cumplio = "No";
                $registroProducido->save();
            }

            $registroProducidoss = ResgistroProducido::whereDay('fecha', '03')
            ->select('valorProducido')
            ->get()
            ->sum('valorProducido');
            echo $registroProducidoss;


                
        }

            return view('admin.registroProducidos.index', compact('registroProducidos'));
   
       
   
   
   
   
   
   
   
        }


    public function filtrarFecha()
    {
        $registroProducidos = ResgistroProducido::whereDay('fecha', 3);
        echo  $registroProducidos;
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
        //VALiDACION FORMULARIO 
        $request->validate([
            'user_id' => 'required',
            'fecha' => 'required',
            'valorProducido' => 'required',
            'meta_id' => 'required',
            'pagina_id' => 'required'
        ]);

        $registroProducido = ResgistroProducido::create($request->all());
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
            'user_id' => 'required',
            'fecha' => 'required',
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
}
