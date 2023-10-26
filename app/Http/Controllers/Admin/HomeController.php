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
        $usuariosModelos = User::where('active', 1)
            ->whereHas('tipoUsuario', function ($query) {
                $query->where('nombre', 'Modelo');
            })
            ->count();
            
        $multas = AsignacionMulta::where('descontado',0)->count();

        

        return view('admin.index', compact('usuariosModelos','multas'));
    }
}
