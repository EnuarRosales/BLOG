<?php

use App\Http\Controllers\AsignacionMultaController;
use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TipoUsuarioController;
 
//RUTA CURSOS
Route::get('/', HomeController::class);
Route::get('cursos', [CursoController::class,'index'])->name('cursos.index');
Route::get('cursos/create', [CursoController::class,'create'])->name('cursos.create');
Route::post('cursos',[CursoController::class,'store'])->name('cursos.store');
Route::get('cursos/{curso}', [CursoController::class,'show'])->name('cursos.show');
Route::get('cursos/{curso}/edit', [CursoController::class,'edit'])->name('cursos.edit');
Route::put('cursos/{curso}',[CursoController::class,'update'])->name('cursos.update');
Route::delete('cursos/{curso}',[CursoController::class,'destroy'])->name('cursos.destroy');

//RUTA ASIGNACION MULTAS
Route::get('/', HomeController::class);
Route::get('asignacionMultas', [AsignacionMultaController::class,'index'])->name('asignacionMultas.index');
Route::get('asignacionMultas/create', [AsignacionMultaController::class,'create'])->name('asignacionMultas.create');
Route::post('asignacionMultas',[AsignacionMultaController::class,'store'])->name('asignacionMultas.store');
Route::get('asignacionMultas/{asignacionMulta}', [AsignacionMultaController::class,'show'])->name('asignacionMultas.show');
Route::get('asignacionMultas/{asignacionMulta}/edit', [AsignacionMultaController::class,'edit'])->name('asignacionMultas.edit');
Route::put('asignacionMultas/{asignacionMulta}',[AsignacionMultaController::class,'update'])->name('asignacionMultas.update');
Route::delete('asignacionMultas/{asignacionMulta}',[AsignacionMultaController::class,'destroy'])->name('asignacionMultas.destroy');

//RUTA TIPO CONTROLLER
//Route::get('/', HomeController::class);
// Route::get('tipoUsuarios', [TipoUsuarioController::class,'index'])->name('tipoUsuarios.index');
// Route::get('tipoUsuarios/create', [TipoUsuarioController::class,'create'])->name('tipoUsuarios.create');
// Route::post('tipoUsuarios',[TipoUsuarioController::class,'store'])->name('tipoUsuarios.store');
// Route::get('tipoUsuarios/{tipoUsuario}', [TipoUsuarioController::class,'show'])->name('tipoUsuarios.show');
// Route::get('tipoUsuarios/{tipoUsuario}/edit', [TipoUsuarioController::class,'edit'])->name('tipoUsuarios.edit');
// Route::put('tipoUsuarios/{tipoUsuario}',[TipoUsuarioController::class,'update'])->name('tipoUsuarios.update');
// Route::delete('tipoUsuarios/{tipoUsuario}',[TipoUsuarioController::class,'destroy'])->name('tipoUsuarios.destroy');






/* AGRUPAR RUTAS CUANDO TENGAMOS  UN MISMO CRONTROLADOR EN COMUN SOLO PARA LARAVEL 9 O SUPERIORs
Route::controller(CursoController::class)->group(function(){    
    Route::get('cursos','index');
    Route::get('cursos/create','create');
    Route::get('cursos/{curso}', 'show');
});
*/