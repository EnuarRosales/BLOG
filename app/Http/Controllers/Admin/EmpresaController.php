<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresas = Empresa::all();
        return view('admin.empresa.index', compact('empresas'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.empresa.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $request['user_id'] = Auth::user()->id;
            $empresa = Empresa::create($request->all());

            DB::commit();

            return redirect()->route('admin.empresa.index')->with('info', 'store');

        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error EmpCr: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            return back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        return view('admin.empresa.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        if(!$request->file('logo')) {
            $empresa->update($request->all());
        } else {
            $request_data = $request->all();

            $name_logo = uniqid($empresa->id . '-').'.'.$request->file('logo')->getClientOriginalExtension();

            Storage::disk('public-logo')->put($name_logo, File::get($request->file('logo')));

            $url_logo = Storage::disk('public-logo')->url($name_logo);

            $request_data['logo'] = $url_logo;

            $empresa->update($request_data);
        }

        return redirect()->route('admin.empresa.index')->with('info', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa)
    {
        try {

            $empresa->delete();
            return redirect()->route('admin.empresa.index')->with('info', 'delete');
        } catch (\Exception $exception) {

        }
    }
}
