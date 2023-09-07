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
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    public function index()
    {

        $chart_options = [

            'chart_title' => 'Transactions by user',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\User',

            'relationship_name' => 'tipoUsuario', // represents function user() on Transaction model
            'group_by_field' => 'users.tipoUsuario_id.nombre', // users.name



            'filter_field' => 'tipoUsuario_id',
            'filter_days' => 3, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];



        $chart = new LaravelChart($chart_options);
        // return view('admin.index', compact('chart'));
        try {

            $userModelos = DB::table('users')->get(); //id
            // MULTAS

            $count_multas_user = AsignacionMulta::select(['id'])
                ->count();

            // Pasar el arreglo de menú a la vista
            $menu = config('adminlte.menu');

            //dd($menu);
            return view('admin.index', compact('count_multas_user', 'userModelos', 'chart', 'menu'));
        } catch (\Exception $exception) {
            Log::error("Error UC index: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
        }
    }
}
