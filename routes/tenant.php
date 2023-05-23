<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

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

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {

        Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth','verified'])->name('dashboard');

        Route::get('users/{user}/rol', [UserController::class,'rol'])->name('admin.users.rol');
        Route::put('users/{user}',[UserController::class,'updateRol'])->name('admin.users.updateRol');

        // return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');

        require __DIR__.'/auth.php';
    });
});
