<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionMulta;
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
            // MODELS
            // TODO En el where de la empresa, cuando se pase a multiempresa se coloca un where in con un select anterior donde se selecciones todas las empresas a las que pertenece el dueño, o en el cast poner que los dueños tengan un array de ids
            /*$count_users_models = User::select('id')
                ->join('user_empresa', 'user_empresa.user_id', '=', 'users.id')
                ->whereIn('tipoUsuario_id', [2, 3])
                ->where('active', true)
                ->where('user_empresa.empresa_id', Auth::user()->empresa_id)
                ->count();

            $capacity_model_empresa = Empresa::select(['capacity_models'])->where('id', Auth::user()->empresa_id)->first();

            $porcentaje_model_actives = 0;

            if($capacity_model_empresa)
                $porcentaje_model_actives = ($count_users_models * 100) / ($capacity_model_empresa->capacity_models!=0?$capacity_model_empresa->capacity_models:1);

            $porcentaje_model_actives = $porcentaje_model_actives!=0?number_format($porcentaje_model_actives, 2):$porcentaje_model_actives;
            */
            $userModelos = DB::table('users')->get(); //id
            // MULTAS

            $count_multas_user = AsignacionMulta::select(['id'])
                                ->count();

            return view('admin.index', compact('count_multas_user', 'userModelos'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }
}
