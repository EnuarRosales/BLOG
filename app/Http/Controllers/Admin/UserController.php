<?php

namespace App\Http\Controllers\Admin;

use App\Events\updateUserModel;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{


    //PARA PROTEGER LAS RUTAS ESTO PERMITE QUE NO SE ACCEDAN SE HACE DE ESTA MANERA YA QUE LA RUTA ES RESOURCE
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit','update');

    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $userLogueado = auth()->user();
        // // dd($userLogueado);
        // echo $userLogueado;

        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoUsuarios = TipoUsuario::orderBy('id', 'desc');
        return view('admin.users.create', compact('tipoUsuarios'));
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
            'name' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'tipoUsuario_id' => 'required',


        ]);

        $user = User::create($request->all());
        return redirect()->route('admin.users.index', $user->id)->with('info', 'store');
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
    public function edit(User $user)
    {

        $tipoUsuarios = TipoUsuario::orderBy('id', 'desc');
        $empresas = Empresa::select(['id as empresa_id', 'name'])->get();
        return view('admin.users.edit', compact('user', 'tipoUsuarios', 'empresas'));
    }

    public function rol(User $user)
    {
        $roles = Role::all();
        return view('admin.users.rol', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //VALiDACION FORMULARIO

        $request->validate([
            'name' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'tipoUsuario_id' => 'required',
        ]);

        if ($request->input('empresa_id')) {
            $empresa = Empresa::find($request->input('empresa_id'));
            if (!$empresa->users()->where('user_id', $user->id)->first())
                $empresa->users()->attach($user->id);
        }

        $request = $request->except('empresa_id');
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $user->update($request);
        updateUserModel::dispatch($user->id);
        return redirect()->route('admin.users.index', $user->id)->with('info', 'update'); //with mensaje de sesion

    }

    public function updateRol(Request $request, User $user)    {
        // $user->update($request->all());
        $user->roles()->sync($request->roles);
        return redirect()->route('admin.users.index')->with('info', 'updateRol'); //with mensaje de sesion
    }










    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('info', 'delete');
    }


    //METODOS ROSALES PARA LAS FUNCIONADLIDADES
    public function calcularPorcentajePersonal()
    {

        $user = DB::table('user')->count();
        return "el resultado es " . $user;
    }

    public function CertificacionLaboral($User_id)
    {
        $userLogueado = auth()->user();

        $data[]= [];

        $Colores = [
            0 =>['id'=> 1 , 'nombre' => 'Naranja', 'color' => '#ff8000', ],
            1 =>['id'=> 2 , 'nombre' => 'Gris', 'color' => '#808080', ],
            2 =>['id'=> 3 , 'nombre' => 'Plata', 'color' => '#C0C0C0',],
            3 =>['id'=> 4 , 'nombre' => 'Negro', 'color' => '#000000',],
            4 =>['id'=> 5 , 'nombre' => 'Verde', 'color' => '#008000',],
            5 =>['id'=> 6 , 'nombre' => 'Rosa', 'color' => '#ff0080',],
            6 =>['id'=> 7 , 'nombre' => 'verde azulado', 'color' => '#008080',],
            7 =>['id'=> 8 , 'nombre' => 'Azul', 'color' => '#0000FF',],
            8 =>['id' => 9 , 'nombre' => 'Cal', 'color' => '#00FF00',],
            9 =>['id' => 10 , 'nombre' => 'Púrpura', 'color' => '#800080',],
            10 =>['id' => 11 , 'nombre' => 'Blanco', 'color' =>	'#FFFFFF',],
            11 =>['id' => 12 , 'nombre' => 'Fucsia', 'color' => '#FF00FF',],
            12 =>['id' => 13 , 'nombre' => 'Marrón', 'color' => '#800000',],
            13 =>['id' => 14 , 'nombre' => 'Rojo', 'color' => '#FF0000',],
            14 =>['id' => 15 , 'nombre' => 'Amarillo', 'color'=>'#FFFF00',],
        ];

        $nombre = "Enuar Emilio Rosales";

        // return view('User.CertificacionLaboral');

        $view =  \View::make('User.CertificacionLaboral', compact('userLogueado'))->render();

        $pdf = \App::make('dompdf.wrapper'); //no cambia
        //No cambia y carga los datos
        $pdf->loadHTML($view);
        set_time_limit(300);

        return $pdf->stream('PDF');
    }
}
