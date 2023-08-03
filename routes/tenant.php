<?php

declare(strict_types=1);

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

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,

])->group(function () {


    // Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);
    // Route::get('/', function () {
    //     $user = \App\Models\User::first();
    //     return $user;
    // });



    // Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified']);
    // Route::get('abonos/{abonoParcial}', [DescontadoController::class, 'abonoParcial'])->name('admin.abonos.abonoParcial');

    // Route::get('comprobantePagoPDF/{pago}', [PagoController::class, 'comprobantePagoPDF'])->name('admin.pagos.comprobantePagoPDF');


    // // Route::post('abonos/{abonado}',[DescontadoController::class,'store'])->name('admin.abonos.store');
    // Route::post('abonos', [DescontadoController::class, 'store'])->name('admin.abonos.store');


    // Route::put('abonos/{abonado}', [DescontadoController::class, 'abono'])->name('admin.abonos.abono');
    // Route::resource('abonosResources', DescontadoController::class)->middleware(['auth', 'verified'])->names('admin.abonosResources');



    // Route::resource('registroProducidos', RegistroProducidoController::class)->middleware(['auth', 'verified'])->names('admin.registroProducidos');
    // // Route::get('registroProducidoss', [RegistroProducidoController::class,'resumen'])->name('admin.registroProducidoss.resumen');
    // Route::get('registroProducidoss', [RegistroProducidoController::class, 'reporte_dia'])->name('admin.registroProducidoss.reporte_dia');

    // Route::resource('registroAsistencias', RegistroAsistenciaController::class)->middleware(['auth', 'verified'])->names('admin.registroAsistencias');
    // Route::resource('registroDescuentos', RegistroDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.registroDescuentos');

    // Route::resource('tipoUsuarios', TipoUsuarioController::class)->middleware(['auth', 'verified'])->names('admin.tipoUsuarios');
    // Route::resource('users', UserController::class)->middleware(['auth', 'verified'])->names('admin.users');
    // Route::get('userCertificacion', [UserController::class, 'userCertificacion'])->name('admin.users.userCertificacion');
    // Route::get('userCertificacionPDF/{user}', [UserController::class, 'certificacionLaboralPDF'])->name('admin.users.certificacionLaboralPDF');
    // Route::get('userCertificacionTiempo', [UserController::class, 'certificacionTiempo'])->name('admin.users.certificacionTiempo');
    // Route::get('userCertificacionTiempoPDF/{user}', [UserController::class, 'certificacionTiempoPDF'])->name('admin.users.certificacionTiempoPDF');


    // Route::resource('roles', RoleController::class)->middleware(['auth', 'verified'])->names('admin.roles');
    // Route::resource('asignacionTurnos', AsignacionTurnoController::class)->middleware(['auth', 'verified'])->names('admin.asignacionTurnos');
    // Route::resource('tipoTurnos', TipoTurnoController::class)->middleware(['auth', 'verified'])->names('admin.tipoTurnos');
    // Route::resource('tipoRooms', TipoRoomController::class)->middleware(['auth', 'verified'])->names('admin.tipoRooms');
    // Route::resource('tipoMultas', TipoMultaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMultas');
    // Route::resource('tipoDescuentos', TipoDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.tipoDescuentos');
    // Route::resource('tipoMetas', TipoMetaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMetas');
    // Route::resource('tipoMonedaPaginas', TipoMonedaPaginaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMonedaPaginas');
    // Route::resource('paginas', PaginaController::class)->middleware(['auth', 'verified'])->names('admin.paginas');
    // Route::resource('asignacionRooms', AsignacionRoomController::class)->middleware(['auth', 'verified'])->names('admin.asignacionRooms');
    // Route::resource('asignacionMultas', AsignacionMultaController::class)->middleware(['auth', 'verified'])->names('admin.asignacionMultas');
    // Route::resource('metaModelos', MetaModeloController::class)->middleware(['auth', 'verified'])->names('admin.metaModelos');
    // Route::get('enviarPago', [PagoController::class, 'enviarPago'])->name('admin.pagos.enviarPago');

    // Route::resource('pagosss', PagoController::class)->middleware(['auth', 'verified'])->names('admin.pagos');




    // Route::resource('reportePaginas', ReportePaginaController::class)->middleware(['auth', 'verified'])->names('admin.reportePaginas');
    // Route::get('reportePaginass', [ReportePaginaController::class, 'nomina'])->name('admin.reportePaginas.nomina');
    // Route::get('reportePaginasss', [ReportePaginaController::class, 'reporteQuincena'])->name('admin.reportePaginas.reporteQuincena');
    // Route::get('pagos', [ReportePaginaController::class, 'pagos'])->name('admin.reportePaginas.pagos');
    // Route::get('verificadoMasivo', [ReportePaginaController::class, 'verificadoMasivo'])->name('admin.reportePaginas.verificadoMasivo');
    // Route::post('reportePaginas/updateStatus', [ReportePaginaController::class, 'updateStatus'])->name('admin.reportePaginas.updateStatus');
    // Route::get('', [ReportePaginaController::class, 'pagos'])->name('admin.reportePaginas.pagos');

    // Route::get('cargarExcel', [ReportePaginaController::class, 'cargarExcel'])->name('admin.reportePaginas.cargarExcel');
    // Route::resource('empresa', EmpresaController::class)->middleware(['auth', 'verified'])->names('admin.empresa');

    // Route::resource('impuestos', ImpuestoController::class)->middleware(['auth', 'verified'])->names('admin.impuestos');
    // Route::get('comprobanteImpuestoss', [ImpuestoController::class, 'comprobanteImpuesto'])->name('admin.impuestos.comprobanteImpuestoss');
    // Route::get('comprobanteImpuestoPDF/{pago}', [ImpuestoController::class, 'comprobanteImpuestoPDF'])->name('admin.impuestos.comprobanteImpuestoPDF');
    // // //RUTA TIPO CONTROLLER

    // Route::resource('tenants', TenantController::class)->middleware(['auth', 'verified'])->names('admin.tenants');
    // Route::get('users/{user}/rol', [UserController::class, 'rol'])->name('admin.users.rol');
    // Route::put('users/{user}', [UserController::class, 'updateRol'])->name('admin.users.updateRol');
    // Route::post('reportePaginas',[ReportePaginaController::class,'storeIndividual'])->name('admin.reportePaginas.storeIndividual');
    require __DIR__ . '/auth.php';

    
});






    // ])->group(function () {
    //     Route::get('/', function () {

    //         Route::get('/',[HomeController::class,'index'])->middleware(['auth','verified']);

    //         Route::get('/', function () {
    //             return view('esto es solo una prueba');
    //         })->middleware(['auth','verified'])->name('dashboard');

    //         Route::get('users/{user}/rol', [UserController::class,'rol'])->name('admin.users.rol');
    //         Route::put('users/{user}',[UserController::class,'updateRol'])->name('admin.users.updateRol');       
    //         require __DIR__.'/auth.php';
    //     });
    // });


// ])->group(function () {

//     Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified']);
//     Route::get('abonos/{abonoParcial}', [DescontadoController::class, 'abonoParcial'])->name('admin.abonos.abonoParcial');

//     Route::get('comprobantePagoPDF/{pago}', [PagoController::class, 'comprobantePagoPDF'])->name('admin.pagos.comprobantePagoPDF');


//     // Route::post('abonos/{abonado}',[DescontadoController::class,'store'])->name('admin.abonos.store');
//     Route::post('abonos', [DescontadoController::class, 'store'])->name('admin.abonos.store');


//     Route::put('abonos/{abonado}', [DescontadoController::class, 'abono'])->name('admin.abonos.abono');
//     Route::resource('abonosResources', DescontadoController::class)->middleware(['auth', 'verified'])->names('admin.abonosResources');



//     Route::resource('registroProducidos', RegistroProducidoController::class)->middleware(['auth', 'verified'])->names('admin.registroProducidos');
//     // Route::get('registroProducidoss', [RegistroProducidoController::class,'resumen'])->name('admin.registroProducidoss.resumen');
//     Route::get('registroProducidoss', [RegistroProducidoController::class, 'reporte_dia'])->name('admin.registroProducidoss.reporte_dia');

//     Route::resource('registroAsistencias', RegistroAsistenciaController::class)->middleware(['auth', 'verified'])->names('admin.registroAsistencias');
//     Route::resource('registroDescuentos', RegistroDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.registroDescuentos');

//     Route::resource('tipoUsuarios', TipoUsuarioController::class)->middleware(['auth', 'verified'])->names('admin.tipoUsuarios');
//     Route::resource('users', UserController::class)->middleware(['auth', 'verified'])->names('admin.users');
//     Route::get('userCertificacion', [UserController::class, 'userCertificacion'])->name('admin.users.userCertificacion');
//     Route::get('userCertificacionPDF/{user}', [UserController::class, 'certificacionLaboralPDF'])->name('admin.users.certificacionLaboralPDF');
//     Route::get('userCertificacionTiempo', [UserController::class, 'certificacionTiempo'])->name('admin.users.certificacionTiempo');
//     Route::get('userCertificacionTiempoPDF/{user}', [UserController::class, 'certificacionTiempoPDF'])->name('admin.users.certificacionTiempoPDF');


//     Route::resource('roles', RoleController::class)->middleware(['auth', 'verified'])->names('admin.roles');
//     Route::resource('asignacionTurnos', AsignacionTurnoController::class)->middleware(['auth', 'verified'])->names('admin.asignacionTurnos');
//     Route::resource('tipoTurnos', TipoTurnoController::class)->middleware(['auth', 'verified'])->names('admin.tipoTurnos');
//     Route::resource('tipoRooms', TipoRoomController::class)->middleware(['auth', 'verified'])->names('admin.tipoRooms');
//     Route::resource('tipoMultas', TipoMultaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMultas');
//     Route::resource('tipoDescuentos', TipoDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.tipoDescuentos');
//     Route::resource('tipoMetas', TipoMetaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMetas');
//     Route::resource('tipoMonedaPaginas', TipoMonedaPaginaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMonedaPaginas');
//     Route::resource('paginas', PaginaController::class)->middleware(['auth', 'verified'])->names('admin.paginas');
//     Route::resource('asignacionRooms', AsignacionRoomController::class)->middleware(['auth', 'verified'])->names('admin.asignacionRooms');
//     Route::resource('asignacionMultas', AsignacionMultaController::class)->middleware(['auth', 'verified'])->names('admin.asignacionMultas');
//     Route::resource('metaModelos', MetaModeloController::class)->middleware(['auth', 'verified'])->names('admin.metaModelos');
//     Route::get('enviarPago', [PagoController::class, 'enviarPago'])->name('admin.pagos.enviarPago');

//     Route::resource('pagosss', PagoController::class)->middleware(['auth', 'verified'])->names('admin.pagos');




//     Route::resource('reportePaginas', ReportePaginaController::class)->middleware(['auth', 'verified'])->names('admin.reportePaginas');
//     Route::get('reportePaginass', [ReportePaginaController::class, 'nomina'])->name('admin.reportePaginas.nomina');
//     Route::get('reportePaginasss', [ReportePaginaController::class, 'reporteQuincena'])->name('admin.reportePaginas.reporteQuincena');
//     Route::get('pagos', [ReportePaginaController::class, 'pagos'])->name('admin.reportePaginas.pagos');
//     Route::get('verificadoMasivo', [ReportePaginaController::class, 'verificadoMasivo'])->name('admin.reportePaginas.verificadoMasivo');
//     Route::post('reportePaginas/updateStatus', [ReportePaginaController::class, 'updateStatus'])->name('admin.reportePaginas.updateStatus');
//     Route::get('', [ReportePaginaController::class, 'pagos'])->name('admin.reportePaginas.pagos');

//     Route::get('cargarExcel', [ReportePaginaController::class, 'cargarExcel'])->name('admin.reportePaginas.cargarExcel');
//     Route::resource('empresa', EmpresaController::class)->middleware(['auth', 'verified'])->names('admin.empresa');

//     Route::resource('impuestos', ImpuestoController::class)->middleware(['auth', 'verified'])->names('admin.impuestos');
//     Route::get('comprobanteImpuestoss', [ImpuestoController::class, 'comprobanteImpuesto'])->name('admin.impuestos.comprobanteImpuestoss');
//     Route::get('comprobanteImpuestoPDF/{pago}', [ImpuestoController::class, 'comprobanteImpuestoPDF'])->name('admin.impuestos.comprobanteImpuestoPDF');
//     // //RUT




// });
