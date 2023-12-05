<?php

namespace App\Http\Controllers\Admin;

use App\Events\userModelEvent;
use App\Events\usuarios_widget;
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
use Exception;
use Illuminate\Database\QueryException;
use PhpParser\Node\Stmt\TryCatch;
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
            $userLogueado = auth()->user()->id;

            return view('admin.users.certificacionLaboral', compact('users', 'userLogueado'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }

    public function certificacionTiempo()
    {
        try {
            $userLogueado = auth()->user()->id;
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

            $i = 0;
            return view('admin.users.certificacionTiempo', compact('userLogueado', 'users', 'year', 'month', 'day', 'i'));
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

        // $codigoQR = QrCode::size(80)->generate(
        //     "CERTIFICACION LABORAL" . "\n" .
        //         "NOMBRE: " . $user->name . "\n" .
        //         "LABORANDO: " . "\n" .
        //         "EMPRESA: " . $empresa->name . "\n" .
        //         "DESDE: " . $user->fechaIngreso . "\n" .
        //         "HASTA: " . $fechaReciente . "\n"

        // );

        try {
            $codigoQR = QrCode::size(80)->generate(
                "CERTIFICACION LABORAL" . "\n" .
                    "NOMBRE: " . $user->name . "\n" .
                    "LABORANDO: " . "\n" .
                    "EMPRESA: " . $empresa->name . "\n" .
                    "DESDE: " . $user->fechaIngreso . "\n" .
                    "HASTA: " . $fechaReciente . "\n"
            );
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $message = substr($errorMessage, strpos($errorMessage, '$') + 1);
            return back()->with('mensaje', "Falta Informacion sobre: " . $message);
        }



        // printf('%d años, %d meses, %d días, %d horas, %d minutos', $cantidadAno->y, $cantidadAno->m, $cantidadAno->d, $cantidadAno->h, $cantidadAno->i);
        // dd($logoEmpresa);
        // try {
        $pdf = PDF::loadView('admin.users.laboralPDF', compact('user', 'date', 'nombreEmpresa', 'nitEmpresa', 'gerenteEmpresa', 'fechaAntigua', 'cantidadDias', 'cantidadMes', 'cantidadAno', 'codigoQR', 'logoEmpresa'));
        // } catch (\Exception $e) {
        //     return back()->with('mensaje', 'Error al generar el PDF: ' . $e->getMessage());
        // }
        return $pdf->stream();
    }

    public function certificacionTiempoPDF(User $user)
    {
        $date = Carbon::now()->locale('es');
        $fechaReciente = Carbon::now();
        $empresas = Empresa::all();
        foreach ($empresas as $empresa) {
            // dd($empresa);
            $nombreEmpresa = $empresa->name;
            $nitEmpresa = $empresa->nit;
            $gerenteEmpresa = $empresa->representative;
            $logoEmpresa = $empresa->logo;
        }
        // if (empty($nombreEmpresa)) {
        //     //  return back()->with('preuba', 'updateRol');
        //     return redirect()->back()->withErrors(['mensaje' => 'Ocurrió un error.']);


        // }
        $fechaAntigua1 = Carbon::parse($user->fechaIngreso);
        $fechaAntigua = $fechaAntigua1->locale('es');
        $cantidadDias = $fechaAntigua->diffInDays($fechaReciente);
        $cantidadMes = $fechaAntigua->diffInMonths($fechaReciente);
        $tiempo = $fechaAntigua->diff($fechaReciente);


        $codigoQR = QrCode::size(80)->generate("CERTIFICACION TIEMPO" . "\n" .
            "NOMBRE: " . $user->name . "\n" .
            "TIEMPO: " . "Años " . $tiempo->y . " Meses " . $tiempo->m . " Dias " . $tiempo->d);

        try {
            $pdf = Pdf::loadView('admin.users.certificacionTiempoPDF', compact('user', 'date', 'nombreEmpresa', 'nitEmpresa', 'gerenteEmpresa', 'fechaAntigua', 'cantidadDias', 'cantidadMes', 'tiempo', 'codigoQR', 'logoEmpresa'));
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
            $message = substr($errorMessage, strpos($errorMessage, '$') + 1);
            return back()->with('mensaje', "Falta Informacion sobre: " . $message);
        }

        return $pdf->stream();
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // return "entro";

        $tipoUsuarios = TipoUsuario::orderBy('id', 'desc');
        $empresas = Empresa::orderBy('id', 'desc');
        return view('admin.users.create', compact('tipoUsuarios', 'empresas'));
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
            'fechaIngreso' => 'required',
            'name' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'tipoUsuario_id' => 'required',
            'empresa_id' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $user = User::create($request->all());

            $nameTipoUsuario = TipoUsuario::findOrFail($user->tipoUsuario_id);
            $idRole = Role::where('name', $nameTipoUsuario->nombre)->first();

            if ($idRole) {
                $user->roles()->sync($idRole->id);
            }

            DB::commit();

            event(new usuarios_widget);
            return redirect()->route('admin.users.index', $user->id)->with('info', 'store');
        } catch (QueryException $e) {
            // Verificar si la excepción es por violación de clave única (correo electrónico duplicado)
            if ($e->errorInfo[1] == 1062) {
                // El código 1062 es específico de MySQL para violación de clave única
                return back()->withInput()->withErrors(['email' => 'El correo electrónico ya está registrado. Por favor, elija otro.']);
            }

            // Si la excepción no es por violación de clave única, puedes manejarla según tus necesidades
            DB::rollBack();
            Log::error("Error UC store: {$e->getMessage()}, File: {$e->getFile()}, Line: {$e->getLine()}");
            return back()->withInput()->withErrors(['general' => 'Hubo un problema al procesar la solicitud. Por favor, inténtelo de nuevo.']);
        }

        // try {
        //     $user = User::create($request->all());
        //     $nameTipoUsuario = TipoUsuario::where('id', $user->tipoUsuario_id)->first();
        //     $idRole = Role::where('name', $nameTipoUsuario->nombre)->first();

        //     if ($idRole) {
        //         try {
        //             DB::beginTransaction();
        //             $user->roles()->sync($idRole->id);
        //             DB::commit();
        //             // return redirect()->route('admin.users.index')->with('info', 'updateRol'); //with mensaje de sesion
        //         } catch (\Exception $exception) {
        //             DB::rollBack();
        //             Log::error("Error UC updateRol: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        //         }
        //     }
        //     event(new usuarios_widget);
        // } catch (QueryException $e) {
        //     // Verificar si la excepción es por violación de clave única (correo electrónico duplicado)
        //     if ($e->errorInfo[1] == 1062) {
        //         // El código 1062 es específico de MySQL para violación de clave única
        //         return back()->withInput()->withErrors(['email' => 'El correo electrónico ya está registrado. Por favor, elija otro.']);
        //     } else {
        //         // Si la excepción no es por violación de clave única, puedes manejarla según tus necesidades
        //         return back()->withInput()->withErrors(['general' => 'Hubo un problema al procesar la solicitud. Por favor, inténtelo de nuevo.']);
        //     }
        // }
        // return redirect()->route('admin.users.index', $user->id)->with('info', 'store');
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
        $empresas = Empresa::orderBy('id', 'desc');
        return view('admin.users.edit', compact('user', 'tipoUsuarios', 'empresas'));
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



    // public function update(Request $request, User $user)
    // {
    //     //VALiDACION FORMULARIO
    //     try {
    //         DB::beginTransaction();
    //         $request->validate([
    //             'fechaIngreso' => 'required',
    //             'name' => 'required',
    //             'cedula' => 'required',
    //             'celular' => 'required',
    //             'direccion' => 'required',
    //             'email' => 'required',
    //             // 'tipoUsuario_id' => 'required',
    //         ]);

    //         if ($request->input('empresa_id')) {
    //             $empresa = Empresa::find($request->input('empresa_id'));
    //             if (!$empresa->users()->where('user_id', $user->id)->first())
    //                 $empresa->users()->attach($user->id);
    //         }

    //         $request = $request->except('empresa_id');
    //         //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
    //         $user->update($request);
    //         DB::commit();

    //         if ($user->active) {
    //             userModelEvent::dispatch($user->id);
    //         }

    //         return redirect()->route('admin.users.index', $user->id)->with('info', 'update'); //with mensaje de sesion

    //     } catch (\Exception $exception) {
    //         DB::rollBack();
    //         Log::error("Error UC update: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
    //     }
    // }


    public function update(Request $request, User $user)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'fechaIngreso' => 'required',
            'name' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required',
            'tipoUsuario_id' => 'required',
            'empresa_id' => 'required',
        ]);


        $user->update($request->all());
        return redirect()->route('admin.users.index', $user->id)->with('info', 'update'); //with mensaje de sesion
    }








    public function updateRol(Request $request, User $user)
    {
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
        // dd($user);
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



    public function comprobantePagoPDF(Pago $pago)
    {
        $pagos = Pago::all();
        $pdf = Pdf::loadView('User.comprobantePago', compact('pagos'));
        return $pdf->stream();
    }
}
