<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $roles = Role::orderBy('id', 'desc')->paginate();
        $roles = Role::whereNotIn('name', ['SuperAdmin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    // ESTO METODO EXCLUYE LOS PERMISOS QUE NO QUEREMOS QUE SE VEAN EN LA LISTA DE PERMISOS, CUANDO ASIGNAMOS PERMISOS A LOS ROLES
    public function ocultarPermisosSuperAdministrador()
    {
        $excludePermissions = ['admin.tenants.index', 'admin.tenants.create', 'admin.tenants.edit', 'admin.tenants.destroy', 'admin.tenants.seeders'];
        $permissions = Permission::whereNotIn('name', $excludePermissions)->get();
        return $permissions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->ocultarPermisosSuperAdministrador();
        return view('admin.roles.create', compact('permissions'));
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
            'name' => 'required',

        ]);
        $role = Role::create($request->all()); //se crea un nuevo rol
        $role->permissions()->sync($request->permissions); // asignamos distintos permisos a ese rol
        return redirect()->route('admin.roles.index', $role->id)->with('info', 'store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $rol)
    {
        return view('admin.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $this->ocultarPermisosSuperAdministrador();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        //VALiDACION FORMULARIO

        $request->validate([
            'name' => 'required',

        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        return redirect()->route('admin.roles.index', $role->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index')->with('info', 'delete');
    }
}
