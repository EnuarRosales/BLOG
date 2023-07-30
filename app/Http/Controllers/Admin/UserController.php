<?php

namespace App\Http\Controllers\Admin;

use App\Events\userModelEvent;
use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\Pago;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    //PARA PROTEGER LAS RUTAS ESTO PERMITE QUE NO SE ACCEDAN SE HACE DE ESTA MANERA YA QUE LA RUTA ES RESOURCE
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.edit')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $users = User::all();
            return view('admin.users.index', compact('users'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function userCertificacion()
    {
        try {
            $users = User::all();
            $date = Carbon::now()->locale('es');

            return view('admin.users.certificacionLaboral', compact('users'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function certificacionTiempo()
    {
        try {
            $users = User::all()->where('active', 1);
            $date = Carbon::now()->locale('es');
            $fechaReciente = Carbon::now();
            foreach ($users  as $user) {
                $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
                $fechaAntigua = $fechaAntigua1->locale('es');
                $cantidadAno = $fechaAntigua->diff($fechaReciente);
                $year[] = $cantidadAno->y;
                $month[] = $cantidadAno->m;
                $day[] = $cantidadAno->d;
            }

            $i=0;
            return view('admin.users.certificacionTiempo', compact('users', 'year', 'month', 'day','i'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function certificacionLaboralPDF(User $user)
    {

        $date = Carbon::now()->locale('es');
        $fechaReciente = Carbon::now();
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $gerenteEmpresa = $empresa->representative;
            $logoEmpresa = $empresa->logo;
        }

        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
        $fechaAntigua = $fechaAntigua1->locale('es');
        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);
        $cantidadMes = $fechaAntigua->diffInMonths($fechaReciente);
        $cantidadAno = $fechaAntigua->diff($fechaReciente);
        $ano = $cantidadAno->m;
        
        $codigoQR =QrCode::size(80)->generate("CERTIFICACION LABORAL"."\n". 
                                                "NOMBRE: ".$user->name."\n".
                                                "LABORANDO: "."\n".
                                                "EMPRESA: ".$empresa->name."\n".
                                                "DESDE: ".$user->fechaIngreso."\n".
                                                "HASTA: ".$fechaReciente."\n"
                                                
                                            );

        // printf('%d años, %d meses, %d días, %d horas, %d minutos', $cantidadAno->y, $cantidadAno->m, $cantidadAno->d, $cantidadAno->h, $cantidadAno->i);

        $pdf = Pdf::loadView('admin.users.certificacionLaboralPDF',compact('user', 'date', 'nombreEmpresa','nitEmpresa','gerenteEmpresa','fechaAntigua','cantidadDias','cantidadMes','cantidadAno','codigoQR','logoEmpresa'));
        return $pdf->stream();

    }

    public function certificacionTiempoPDF(User $user)
    {
        $date = Carbon::now()->locale('es');
        $fechaReciente = Carbon::now();
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $gerenteEmpresa = $empresa->representative;
        }
        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
        $fechaAntigua = $fechaAntigua1->locale('es');
        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);
        $cantidadMes = $fechaAntigua->diffInMonths($fechaReciente);
        $tiempo = $fechaAntigua->diff($fechaReciente);


        $codigoQR =QrCode::size(80)->generate("CERTIFICACION TIEMPO"."\n". 
                                                "NOMBRE: ".$user->name."\n".
                                                "TIEMPO: "."Años ".$tiempo->y." Meses ".$tiempo->m." Dias ".$tiempo->d);
              

        // printf('%d años, %d meses, %d días, %d horas, %d minutos', $cantidadAno->y, $cantidadAno->m, $cantidadAno->d, $cantidadAno->h, $cantidadAno->i);

        $pdf = Pdf::loadView('admin.users.certificacionTiempoPDF', compact('user', 'date', 'nombreEmpresa','nitEmpresa','gerenteEmpresa','fechaAntigua','cantidadDias','cantidadMes','tiempo','codigoQR'));
        return $pdf->stream();

    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $tipoUsuarios = TipoUsuario::orderBy('id', 'desc');
            $empresas = Empresa::select(['id as empresa_id', 'name'])->get();
            return view('admin.users.create', compact('tipoUsuarios', 'empresas'));
        } catch (\Exception $exception) {
            Log::error("Error UC create: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'fechaIngreso' => 'required',
                'name' => 'required',
                'cedula' => 'required',
                'celular' => 'required',
                'direccion' => 'required',
                'email' => 'required',
                // 'tipoUsuario_id' => 'required',


            ]);

            $empresa_id = $request->input('empresa_id');

            $request = $request->except('empresa_id');

            $user = User::create($request);

            if ($empresa_id) {
                $empresa = Empresa::find($empresa_id);
                $empresa->users()->attach($user->id);
            }
            DB::commit();
            if ($user->active) {
                userModelEvent::dispatch($user->id);
            }
            return redirect()->route('admin.users.index', $user->id)->with('info', 'store');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error UC store: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        try {
            $tipoUsuarios = TipoUsuario::orderBy('id', 'desc');
            $empresas = Empresa::select(['id as empresa_id', 'name'])->get();
            return view('admin.users.edit', compact('user', 'tipoUsuarios', 'empresas'));
        } catch (\Exception $exception) {
            Log::error("Error UC edit: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function rol(User $user)
    {
        try {
            $roles = Role::all();
            return view('admin.users.rol', compact('user', 'roles'));
        } catch (\Exception $exception) {
            Log::error("Error UC rol: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
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
        try {
            DB::beginTransaction();
            $request->validate([
                'fechaIngreso' => 'required',
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
            DB::commit();

            if ($user->active) {
                userModelEvent::dispatch($user->id);
            }

            return redirect()->route('admin.users.index', $user->id)->with('info', 'update'); //with mensaje de sesion

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error UC update: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function updateRol(Request $request, User $user)
    {
        // $user->update($request->all());
        try {
            DB::beginTransaction();
            $user->roles()->sync($request->roles);
            DB::commit();
            return redirect()->route('admin.users.index')->with('info', 'updateRol'); //with mensaje de sesion
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error UC updateRol: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            DB::beginTransaction();
            $user->delete();
            DB::commit();
            return redirect()->route('admin.users.index')->with('info', 'delete');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error UC destroy: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
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

        $data[] = [];

        $Colores = [
            0 => ['id' => 1, 'nombre' => 'Naranja', 'color' => '#ff8000',],
            1 => ['id' => 2, 'nombre' => 'Gris', 'color' => '#808080',],
            2 => ['id' => 3, 'nombre' => 'Plata', 'color' => '#C0C0C0',],
            3 => ['id' => 4, 'nombre' => 'Negro', 'color' => '#000000',],
            4 => ['id' => 5, 'nombre' => 'Verde', 'color' => '#008000',],
            5 => ['id' => 6, 'nombre' => 'Rosa', 'color' => '#ff0080',],
            6 => ['id' => 7, 'nombre' => 'verde azulado', 'color' => '#008080',],
            7 => ['id' => 8, 'nombre' => 'Azul', 'color' => '#0000FF',],
            8 => ['id' => 9, 'nombre' => 'Cal', 'color' => '#00FF00',],
            9 => ['id' => 10, 'nombre' => 'Púrpura', 'color' => '#800080',],
            10 => ['id' => 11, 'nombre' => 'Blanco', 'color' =>    '#FFFFFF',],
            11 => ['id' => 12, 'nombre' => 'Fucsia', 'color' => '#FF00FF',],
            12 => ['id' => 13, 'nombre' => 'Marrón', 'color' => '#800000',],
            13 => ['id' => 14, 'nombre' => 'Rojo', 'color' => '#FF0000',],
            14 => ['id' => 15, 'nombre' => 'Amarillo', 'color' => '#FFFF00',],
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



    public function comprobantePagoPDF(Pago $pago)
    {
        $pagos = Pago::all();
        $pdf = Pdf::loadView('User.comprobantePago', compact('pagos'));
        return $pdf->stream();
    }
}
