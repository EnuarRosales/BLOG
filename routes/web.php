<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RegistroDescuentoController;
use App\Http\Controllers\Admin\ReportePaginaController;
use App\Http\Controllers\Admin\UserController;

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

Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('users/{user}/rol', [UserController::class,'rol'])->name('admin.users.rol');
Route::put('users/{user}',[UserController::class,'updateRol'])->name('admin.users.updateRol');

//RUTAS INDIVIDUALES
Route::post('reportePaginas',[ReportePaginaController::class,'storeIndividual'])->name('admin.reportePaginas.storeIndividual');




 
