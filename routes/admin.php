<?php

use App\Http\Controllers\Admin\AsignacionMultaController;
use App\Http\Controllers\Admin\AsignacionRoomController;
use App\Http\Controllers\Admin\AsignacionTurnoController;
use App\Http\Controllers\Admin\DescontadoController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PaginaController;
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

use Illuminate\Support\Facades\Route; 

Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);
Route::get('abonos/{abonoParcial}',[DescontadoController::class,'abonoParcial'])->name('admin.abonos.abonoParcial');


// Route::post('abonos/{abonado}',[DescontadoController::class,'store'])->name('admin.abonos.store');
Route::post('abonos',[DescontadoController::class,'store'])->name('admin.abonos.store');


Route::put('abonos/{abonado}',[DescontadoController::class,'abono'])->name('admin.abonos.abono');



Route::resource('registroProducidos',RegistroProducidoController::class)->middleware(['auth','verified'])->names('admin.registroProducidos');
// Route::get('registroProducidoss', [RegistroProducidoController::class,'resumen'])->name('admin.registroProducidoss.resumen');
Route::get('registroProducidoss', [RegistroProducidoController::class,'reporte_dia'])->name('admin.registroProducidoss.reporte_dia');

Route::resource('registroAsistencias',RegistroAsistenciaController::class)->middleware(['auth','verified'])->names('admin.registroAsistencias');
Route::resource('registroDescuentos',RegistroDescuentoController::class)->middleware(['auth','verified'])->names('admin.registroDescuentos');


Route::resource('tipoUsuarios', TipoUsuarioController::class)->middleware(['auth','verified'])->names('admin.tipoUsuarios');
Route::resource('users', UserController::class)->middleware(['auth','verified'])->names('admin.users');
Route::resource('roles', RoleController::class)->middleware(['auth','verified'])->names('admin.roles');
Route::resource('asignacionTurnos',AsignacionTurnoController::class)->middleware(['auth','verified'])->names('admin.asignacionTurnos');
Route::resource('tipoTurnos',TipoTurnoController::class)->middleware(['auth','verified'])->names('admin.tipoTurnos');
Route::resource('tipoRooms',TipoRoomController::class)->middleware(['auth','verified'])->names('admin.tipoRooms');
Route::resource('tipoMultas',TipoMultaController::class)->middleware(['auth','verified'])->names('admin.tipoMultas');
Route::resource('tipoDescuentos',TipoDescuentoController::class)->middleware(['auth','verified'])->names('admin.tipoDescuentos');
Route::resource('tipoMetas',TipoMetaController::class)->middleware(['auth','verified'])->names('admin.tipoMetas');
Route::resource('tipoMonedaPaginas',TipoMonedaPaginaController::class)->middleware(['auth','verified'])->names('admin.tipoMonedaPaginas');
Route::resource('paginas',PaginaController::class)->middleware(['auth','verified'])->names('admin.paginas');
Route::resource('asignacionRooms',AsignacionRoomController::class)->middleware(['auth','verified'])->names('admin.asignacionRooms');
Route::resource('asignacionMultas',AsignacionMultaController::class)->middleware(['auth','verified'])->names('admin.asignacionMultas');



Route::resource('reportePaginas', ReportePaginaController::class)->middleware(['auth','verified'])->names('admin.reportePaginas');
Route::get('reportePaginass', [ReportePaginaController::class,'nomina'])->name('admin.reportePaginas.nomina');
Route::get('reportePaginasss', [ReportePaginaController::class,'reporteQuincena'])->name('admin.reportePaginas.reporteQuincena');






// //RUTA TIPO CONTROLLER

// Route::get('tipoUsuarios', [TipoUsuarioController::class,'index'])->name('tipoUsuarios.index');
// Route::get('tipoUsuarios/create', [TipoUsuarioController::class,'create'])->name('admin.tipoUsuarios.create');
// Route::post('tipoUsuarios',[TipoUsuarioController::class,'store'])->name('admin.tipoUsuarios.store');
// Route::get('tipoUsuarios/{tipoUsuario}', [TipoUsuarioController::class,'show'])->name('admin.tipoUsuarios.show');
// Route::get('tipoUsuarios/{tipoUsuario}/edit', [TipoUsuarioController::class,'edit'])->name('admin.tipoUsuarios.edit');
// Route::put('tipoUsuarios/{tipoUsuario}',[TipoUsuarioController::class,'update'])->name('admin.tipoUsuarios.update');
// Route::delete('tipoUsuarios/{tipoUsuario}',[TipoUsuarioController::class,'destroy'])->name('admin.tipoUsuarios.destroy');
// Route::post('abonos',[DescontadoController::class,'store'])->name('admin.abonos.store');