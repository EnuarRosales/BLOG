<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\TipoUsuario;
use App\Models\User;
use Database\Seeders\DatabaseSeeder;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;



class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = Tenant::all();

        return view('admin.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALiDACION FORMULARIO
        $request->validate([
            'id' => 'required|unique:tenants',

        ]);

        $tenant = Tenant::create($request->all());

        $tenant->domains()->create([
            'domain' => $request->get('id') . '.' . 'blog-studio.test',
            // 'domain' => $request->get('id') . '.' . 'blog-studio.test',
        ]);

        return redirect()->route('admin.tenants.index', $tenant->id)->with('info', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant)
    {
        return view('admin.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tenant $tenant)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            // 'id' => 'required|unique:tenants,id,', $tenant->id,
            'domain' => $request->get('id') . '.' . 'blog-studio.test',
        ]);


        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tenant->update($request->all());

        $tenant->update([
            'id' => $request->get('id'),
        ]);

        $tenant->domains()->update([
            'domain' => $request->get('id') . '.' . 'siaewc.com',
        ]);

        return redirect()->route('admin.tenants.index', $tenant->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tenant  $tenant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('admin.tenants.index')->with('info', 'delete');
    }

    public function agrgarUsuarioDominio(Request $request, Tenant $tenant)
    {
        // tenancy()->initialize($tenant->id);
        // $seeder = new DatabaseSeeder();
        // $seeder->run();
        // tenancy()->end();
        // return redirect()->route('admin.tenants.index')->with('info', 'delete');
        $tenantId = $tenant->id;

        // Configurar la base de datos del inquilino
        config(['database.connections.tenant.database' => 'tenant_database_' . $tenantId]);

        try {
            // Ejecutar las migraciones solo si hay migraciones pendientes
            tenancy()->initialize($tenantId);

            Artisan::call('migrate', [
                '--path' => 'database/migrations',
                '--database' => 'tenant',
            ]);

            $seeder = new DatabaseSeeder();
            $seeder->run();

            tenancy()->end();

            return redirect()->route('admin.tenants.index')->with('info', 'delete');
        } catch (QueryException $e) {
            // Capturar la excepción y verificar si es específicamente sobre el rol existente
            if (strpos($e->getMessage(), 'A role `Administrador` already exists') !== false) {
                // El rol ya existe, puedes manejarlo según tus necesidades
                // Por ejemplo, puedes omitir este error y continuar con otras migraciones
                return redirect()->route('admin.tenants.index')->with('info', 'other_migrations');
            }

            // Si es una excepción diferente, puedes manejarla o lanzarla nuevamente
            throw $e;
        }
    }



    public function habilitarBDInquilino(Tenant $tenant)
    {
        $tenants = DB::table('tenants')
            ->where('id', $tenant->id)
            ->get();
        tenancy()->initialize($tenants);
    }


    public function desahabilitarBDInquilino()
    {
        tenancy()->end();
    }
}
