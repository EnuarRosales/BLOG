<?php

// declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;


use App\Http\Controllers\Admin\AsignacionMultaController;
use App\Http\Controllers\Admin\AsignacionRoomController;
use App\Http\Controllers\Admin\AsignacionTurnoController;
use App\Http\Controllers\Admin\DescontadoController;
use App\Http\Controllers\Admin\EmpresaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ImpuestoController;
use App\Http\Controllers\Admin\MetaModeloController;
use App\Http\Controllers\Admin\PaginaController;
use App\Http\Controllers\Admin\PagoController;
use App\Http\Controllers\Admin\RegistroAsistenciaController;
use App\Http\Controllers\Admin\RegistroDescuentoController;
use App\Http\Controllers\Admin\RegistroProducidoController;
use App\Http\Controllers\Admin\ReportePaginaController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TipoDescuentoController;
use App\Http\Controllers\Admin\TipoMetaController;
use App\Http\Controllers\Admin\TipoMonedaPaginaController;
use App\Http\Controllers\Admin\TipoMultaController;
use App\Http\Controllers\Admin\TipoRoomController;
use App\Http\Controllers\Admin\TipoTurnoController;
use App\Http\Controllers\Admin\TipoUsuarioController;
use App\Http\Controllers\Admin\UserController;









/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

// Route::middleware([
//     'web',
//     InitializeTenancyByDomain::class,
//     PreventAccessFromCentralDomains::class,

// ])->group(function () {


//     // Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);
//     // Route::get('/', function () {
//     //     $user = \App\Models\User::first();
//     //     return $user;
//     // });



    
// });






