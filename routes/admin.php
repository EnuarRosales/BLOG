<?php

use App\Http\Controllers\Admin\AsignacionTurnoController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TipoUsuarioController;
use App\Http\Controllers\Admin\UserController;
use App\Models\TipoUsuario;
use Illuminate\Support\Facades\Route;

Route::get('',[HomeController::class,'index']);

Route::resource('tipoUsuarios', TipoUsuarioController::class)->names('admin.tipoUsuarios'); 
Route::resource('users', UserController::class)->names('admin.users'); 
Route::resource('asignacionTurnos',AsignacionTurnoController::class)->names('admin.asignacionTurnos');

//RUTA TIPO CONTROLLER

// Route::get('tipoUsuarios', [TipoUsuarioController::class,'index'])->name('tipoUsuarios.index');
// Route::get('tipoUsuarios/create', [TipoUsuarioController::class,'create'])->name('admin.tipoUsuarios.create');
// Route::post('tipoUsuarios',[TipoUsuarioController::class,'store'])->name('admin.tipoUsuarios.store');
// Route::get('tipoUsuarios/{tipoUsuario}', [TipoUsuarioController::class,'show'])->name('admin.tipoUsuarios.show');
// Route::get('tipoUsuarios/{tipoUsuario}/edit', [TipoUsuarioController::class,'edit'])->name('admin.tipoUsuarios.edit');
// Route::put('tipoUsuarios/{tipoUsuario}',[TipoUsuarioController::class,'update'])->name('admin.tipoUsuarios.update');
// Route::delete('tipoUsuarios/{tipoUsuario}',[TipoUsuarioController::class,'destroy'])->name('admin.tipoUsuarios.destroy');
