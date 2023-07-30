<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

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
            'domain'=>$request->get('id'). '.'. 'blog-studio.test',
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
        return view('admin.tenants.edit',compact('tenant'));
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
            'id' => 'required|unique:tenants,id,',$tenant->id,            
        ]);


        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tenant->update($request->all());

        $tenant->update([
            'id'=>$request->get('id'),
        ]);

        $tenant->domains()->update([
            'domain'=>$request->get('id'). '.'. 'blog-studio.test',
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
        return redirect()->route('admin.tenants.index')->with('info','delete');
    }
}
