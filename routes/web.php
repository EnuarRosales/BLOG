<?php

use App\Http\Controllers\Admin\DescontadoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RegistroDescuentoController;
use App\Http\Controllers\Admin\RegistroProducidoController;
use App\Http\Controllers\Admin\ReportePaginaController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




    // Route::get('users/{user}/rol', [UserController::class, 'rol'])->name('admin.users.rol');
    // Route::put('users/{user}', [UserController::class, 'updateRol'])->name('admin.users.updateRol');

    // RUTAS INDIVIDUALES
    // Route::post('reportePaginas', [ReportePaginaController::class, 'storeIndividual'])->name('admin.reportePaginas.storeIndividual');


    Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('registroDescuentos/datatable', [RegistroDescuentoController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.registroDescuentos.datatable');
    Route::get('registroProducidos/datatable', [RegistroProducidoController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.registroProducidos.datatable');

    // Route::get('abonos/ajax', [DescontadoController::class, 'abono'])->middleware(['auth', 'verified'])->name('admin.abonos.abono.ajax');
    Route::put('abonos/{abonado}', [DescontadoController::class, 'abono'])->middleware(['auth', 'verified'])->name('admin.abonos.abono');
    // Route::get('abonos/abonoParcial/datatable', [DescontadoController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.abonos.abonoParcial.datatable');


    // require __DIR__ . '/tenant.php';
    require __DIR__ . '/auth.php';


    // Route::redirect('web.php','/auth.php');





