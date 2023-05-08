<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        
        $user = DB::table('users')->where('tipoUsuario_id', '=', 2)->count();
        $asignacionMultas = DB::table('asignacion_multas')->count();   
        $porcentajeUser = $user*100/15;
        return view('admin.index',compact('porcentajeUser','user','asignacionMultas'));
    }     


}
