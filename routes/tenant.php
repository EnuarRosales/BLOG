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
use App\Http\Controllers\Admin\PasarellaPagoController;
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

use App\Http\Controllers\PostController;
use App\Http\Livewire\Admin\Posts\Index;
use App\Http\Livewire\Admin\Posts\Create;


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
    InitializeTenancyByDomain::class, //REALIZA CAMBIO A LA BASE DE DATOS CUANDO ARRANQUEMOS EL SISTEMA
    PreventAccessFromCentralDomains::class, // ESTE AYUDA QUE SI ESTAMOS DESDE UN SUBDOMINIO NO NOS CONECTEMOS A LA BASE DE DATOS PRINCIPAL

])->group(function () {

    Route::get('pasarelaPago', [PasarellaPagoController::class, 'index'])->middleware(['auth', 'verified'])->name('admin.pasarelaPago');

    Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
    Route::get('/getdatamultas', [HomeController::class, 'dataMultas'])->middleware(['auth', 'verified'])->name('getdatamultas');
    Route::get('/getdatadescuentos', [HomeController::class, 'dataDescuentos'])->middleware(['auth', 'verified'])->name('getdatadescuentos');
    Route::get('/getdatausuarios', [HomeController::class, 'dataUsuario'])->middleware(['auth', 'verified'])->name('getdatausuarios');
    Route::get('/getdataquincenas', [HomeController::class, 'dataQuincenas'])->middleware(['auth', 'verified'])->name('getdataquincenas');
    // Route::get('/', function () {

    //     return "estes una pruebaaaaa";
    // });

    //ROUTES --DescontadoController-- Corresponden a las rutas que administran la tablas de lo que se desucuenta a lo descontado
    // Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified']);
    // Route::get('/dashboard', function () { return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');

    // Route::get('abonos/{abonoParcial}', [DescontadoController::class, 'abonoParcial'])->middleware(['auth', 'verified'])->name('admin.abonos.abonoParcial');
    Route::get('abonos/abonoParcial/datatable', [DescontadoController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.abonos.abonoParcial.datatable');
    Route::post('abonos', [DescontadoController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.abonos.store');
    Route::put('abonos/{abonado}', [DescontadoController::class, 'abono'])->middleware(['auth', 'verified'])->name('admin.abonos.abono');
    Route::resource('abonosResources', DescontadoController::class)->middleware(['auth', 'verified'])->names('admin.abonosResources');

    //ROUTES --PagoController-- Corresponden a las rutas que administran las tablas de los pagos
    Route::get('comprobantePagoPDF/{pago}', [PagoController::class, 'comprobantePagoPDF'])->middleware(['auth', 'verified'])->name('admin.pagos.comprobantePagoPDF');
    Route::get('enviarPago', [PagoController::class, 'enviarPago'])->middleware(['auth', 'verified'])->name('admin.pagos.enviarPago');
    Route::resource('pagosss', PagoController::class)->middleware(['auth', 'verified'])->names('admin.pagos');

    //ROUTES --RegistroProducidoController-- Corresponden a las rutas que administran las tablas de registro producido
    Route::resource('registroProducidos', RegistroProducidoController::class)->middleware(['auth', 'verified'])->names('admin.registroProducidos');
    Route::post('registroProducidos/eliminar', [RegistroProducidoController::class, 'eliminar'])->middleware(['auth', 'verified'])->name('admin.registroProducido.eliminar');
    Route::get('registroProducidos/datatable', [RegistroProducidoController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.registroProducidos.datatable');
    Route::get('registroProducidoss', [RegistroProducidoController::class, 'resumen'])->middleware(['auth', 'verified'])->name('admin.registroProducidoss.resumen');
    // Route::get('registroProducidos_ajax', [RegistroProducidoController::class, 'resumen_ajax'])->middleware(['auth', 'verified'])->name('admin.registroProducidos.resumen_ajax');
    Route::get('registroProducidoss', [RegistroProducidoController::class, 'reporte_dia'])->middleware(['auth', 'verified'])->name('admin.registroProducidoss.reporte_dia');

    //ROUTES --RegistroAsistenciaController-- Corresponden a las rutas que administran las tablas de registro asistencia
    Route::resource('registroAsistencias', RegistroAsistenciaController::class)->middleware(['auth', 'verified'])->names('admin.registroAsistencias');
    Route::get('historial/registrarAsistencia/historial', [RegistroAsistenciaController::class, 'historial'])->middleware(['auth', 'verified'])->name('admin.registrarAsistencia.historial');
    Route::put('registroAsistencia/configAsistencia', [RegistroAsistenciaController::class, 'updateTime'])->middleware(['auth', 'verified'])->name('admin.registroAsistencia.configAsistencia');


    Route::resource('registroDescuentos', RegistroDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.registroDescuentos');
    Route::post('admin/registroDescuentos/eliminar', [RegistroDescuentoController::class, 'eliminar'])->name('admin.registroDescuentos.eliminar');
    Route::get('registroDescuentos/datatable', [RegistroDescuentoController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.registroDescuentos.datatable');
    Route::resource('tipoUsuarios', TipoUsuarioController::class)->middleware(['auth', 'verified'])->names('admin.tipoUsuarios');
    Route::resource('users', UserController::class)->middleware(['auth', 'verified'])->names('admin.users');
    Route::get('userCertificacion', [UserController::class, 'userCertificacion'])->middleware(['auth', 'verified'])->name('admin.users.userCertificacion');
    Route::get('userCertificacionPDF/{user}', [UserController::class, 'certificacionLaboralPDF'])->middleware(['auth', 'verified'])->name('admin.users.certificacionLaboralPDF');
    Route::get('userCertificacionTiempo', [UserController::class, 'certificacionTiempo'])->middleware(['auth', 'verified'])->name('admin.users.certificacionTiempo');
    Route::get('userCertificacionTiempoPDF/{user}', [UserController::class, 'certificacionTiempoPDF'])->middleware(['auth', 'verified'])->name('admin.users.certificacionTiempoPDF');

    // Route::get('users/{user}/rol', [UserController::class,'rol'])->name('admin.users.rol');
    // Route::put('users/{user}',[UserController::class,'updateRol'])->name('admin.users.updateRol');

    Route::get('users/{user}/rol', [UserController::class, 'rol'])->middleware(['auth', 'verified'])->name('admin.users.rol');
    Route::put('usersRol/{user}', [UserController::class, 'updateRol'])->middleware(['auth', 'verified'])->name('admin.users.updateRol');

    Route::resource('roles', RoleController::class)->middleware(['auth', 'verified'])->names('admin.roles');
    Route::resource('asignacionTurnos', AsignacionTurnoController::class)->middleware(['auth', 'verified'])->names('admin.asignacionTurnos');
    Route::resource('tipoTurnos', TipoTurnoController::class)->middleware(['auth', 'verified'])->names('admin.tipoTurnos');
    Route::resource('tipoRooms', TipoRoomController::class)->middleware(['auth', 'verified'])->names('admin.tipoRooms');
    Route::resource('tipoMultas', TipoMultaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMultas');
    Route::resource('tipoDescuentos', TipoDescuentoController::class)->middleware(['auth', 'verified'])->names('admin.tipoDescuentos');
    Route::resource('tipoMetas', TipoMetaController::class)->middleware(['auth', 'verified'])->names('admin.tipoMetas');
    // Route::resource('tipoMonedaPaginas',TipoMonedaPaginaController::class)->middleware(['auth','verified'])->names('admin.tipoMonedaPaginas');
    Route::resource('paginas', PaginaController::class)->middleware(['auth', 'verified'])->names('admin.paginas');
    Route::resource('asignacionRooms', AsignacionRoomController::class)->middleware(['auth', 'verified'])->names('admin.asignacionRooms');
    Route::resource('asignacionMultas', AsignacionMultaController::class)->middleware(['auth', 'verified'])->names('admin.asignacionMultas');
    Route::get('asignacionMulta/datatable', [AsignacionMultaController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.asignacionMulta.datatable');
    Route::get('generarDescuentoMulta/{id}',  [AsignacionMultaController::class, 'generarDescuentoMulta'])->middleware(['auth', 'verified'])->name('admin.generar.descuento');
    Route::get('asignacionMulta/eliminar', [AsignacionMultaController::class, 'eliminar'])->middleware(['auth', 'verified'])->name('admin.asignacionMulta.eliminar');
    Route::resource('metaModelos', MetaModeloController::class)->middleware(['auth', 'verified'])->names('admin.metaModelos');




    Route::resource('reportePaginas', ReportePaginaController::class)->middleware(['auth', 'verified'])->names('admin.reportePaginas');
    Route::get('reportePaginass', [ReportePaginaController::class, 'nomina'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.nomina');
    Route::get('reportePaginasss', [ReportePaginaController::class, 'reporteQuincena'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.reporteQuincena');
    Route::get('pagos', [ReportePaginaController::class, 'pagos'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.pagos');
    Route::get('pagos/pagosDatatable', [ReportePaginaController::class, 'pagosDatatable'])->middleware(['auth', 'verified'])->name('admin.pagos.pagosDatatable');
    Route::get('verificadoMasivo', [ReportePaginaController::class, 'verificadoMasivo'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.verificadoMasivo');
    Route::post('reportePaginas/updateStatus', [ReportePaginaController::class, 'updateStatus'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.updateStatus');
    Route::get('reportePagina/datatable', [reportePaginaController::class, 'datatable'])->middleware(['auth', 'verified'])->name('admin.reportePagina.datatable');
    Route::get('reportePagina/porcentajes/datatable', [reportePaginaController::class, 'porcentaje_datatable'])->middleware(['auth', 'verified'])->name('admin.reportePagina.porcentaje.datatable');
    Route::get('reportePagina/eliminar', [reportePaginaController::class, 'eliminar'])->middleware(['auth', 'verified'])->name('admin.reportePagina.eliminar');
    // Route::get('', [ReportePaginaController::class,'pagos'])->name('admin.reportePaginas.pagos');
    //RUTAS INDIVIDUALES
    Route::post('reportePaginass', [ReportePaginaController::class, 'storeIndividual'])->name('admin.reportePaginas.storeIndividual');


    Route::get('cargarExcel', [ReportePaginaController::class, 'cargarExcel'])->middleware(['auth', 'verified'])->name('admin.reportePaginas.cargarExcel');

    Route::resource('empresa', EmpresaController::class)->middleware(['auth', 'verified'])->middleware(['auth', 'verified'])->names('admin.empresa');

    Route::resource('impuestos', ImpuestoController::class)->middleware(['auth', 'verified'])->names('admin.impuestos');
    Route::get('comprobanteImpuestoss', [ImpuestoController::class, 'comprobanteImpuesto'])->middleware(['auth', 'verified'])->name('admin.impuestos.comprobanteImpuestoss');
    Route::get('comprobanteImpuestoPDF/{pago}', [ImpuestoController::class, 'comprobanteImpuestoPDF'])->middleware(['auth', 'verified'])->name('admin.impuestos.comprobanteImpuestoPDF');

    Route::resource('posts', PostController::class)->middleware(['auth', 'verified'])->names('posts');

    // Route::get('posts', Index::class)->middleware(['auth', 'verified'])->name('admin.posts.index');
    // Route::get('posts/create', Create::class)->middleware(['auth', 'verified'])->name('admin.posts.create');

    Route::get('/table', function () {
        event(new App\Events\ReloadTable());
        dd('Evento publico enviado satisfactoriamente');
    });

    Route::get('/private-table', function () {
        event(new App\Events\PrivateEvent(auth()->user()));
        dd('Evento privado enviado satisfactoriamente');
    });

    require __DIR__ . '/auth.php';
});
