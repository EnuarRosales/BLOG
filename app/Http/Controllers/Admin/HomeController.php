<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\ResgistroProducido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        try {
            /*$fechas2 = ResgistroProducido::select(
           DB::raw('sum(valorProducido) as suma'),
           DB::raw('meta_id'),
           // DB::raw('fecha'),
       )
           ->groupBy('meta_id')
           ->get();*/
            // TODO En el where de la empresa, cuando se pase a multiempresa se coloca un where in con un select anterior donde se selecciones todas las empresas a las que pertenece el dueño, o en el cast poner que los dueños tengan un array de ids
            $count_users_models = User::select('id')
                ->join('user_empresa', 'user_empresa.user_id', '=', 'users.id')
                ->where('tipoUsuario_id', 2)
                ->where('active', true)
                ->where('user_empresa.empresa_id', Auth::user()->empresa_id)
                ->count();

            $capacity_model_empresa = Empresa::select(['capacity_models'])->where('id', Auth::user()->empresa_id)->first();

            $porcentaje_model_actives = 0;

            if($capacity_model_empresa)
                $porcentaje_model_actives = ($count_users_models * 100) / ($capacity_model_empresa->capacity_models!=0?$capacity_model_empresa->capacity_models:1);

            $user = DB::table('users')->where('tipoUsuario_id', '=', 3)->count();
            $userModelos = DB::table('users')->where('tipoUsuario_id', '=', 3)->get(); //id

            // $producido = ResgistroProducido::all();
            // echo $producido;
            $asignacionMultas = DB::table('asignacion_multas')->count();
            $porcentajeUser = $user * 100 / 15;

            return view('admin.index', compact('porcentajeUser', 'user', 'asignacionMultas', 'userModelos', 'porcentaje_model_actives', 'count_users_models'));
        } catch (\Exception $exception) {
            Log::error($exception);
        }
    }






}
