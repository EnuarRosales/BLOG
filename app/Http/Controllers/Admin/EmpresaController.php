<?php

namespace App\Http\Controllers\Admin;

use App\Events\ReloadTable;
use App\Events\usuarios_widget;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmpresaRequest;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:admin.empresas')->only('index');
        $this->middleware('can:admin.empresas')->only('edit', 'update');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $empresas = Empresa::all();

        if (count($empresas) == "0") {
            $descuentosArray = "vacio";
        } else {
            $descuentosArray = "lleno";
        }
        return view('admin.empresa.index', compact('empresas', 'descuentosArray'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.empresa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreEmpresaRequest $request
     * @return RedirectResponse
     */
    public function store(StoreEmpresaRequest $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $request_data = $request->all();

            // Manejar el logo
            if ($request->hasFile('logo')) {
                $url_logo = $this->handleLogo($request->file('logo'));
                $request_data['logo'] = $url_logo;
            }

            // Crear la empresa
            $empresa = Empresa::create($request_data);

            DB::commit();
            return redirect()->route('admin.empresa.index')->with('info', 'store');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error EmpCr store: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            return back();
        }
    }

    /**
     * Maneja el proceso del logo y devuelve la URL.
     *
     * @param \Illuminate\Http\UploadedFile $logo
     * @return string
     */
    private function handleLogo(UploadedFile $logo): string
    {
        $name_logo = uniqid() . '.' . $logo->getClientOriginalExtension();
        Storage::disk('public-logo')->put($name_logo, File::get($logo));
        $url_logo = str_replace('http://', 'https://', url(Storage::disk('public-logo')->url($name_logo)));
        return $url_logo;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|RedirectResponse
     */
    public function edit(Empresa $empresa)
    {
        try {

            return view('admin.empresa.edit', compact('empresa'));
        } catch (\Exception $exception) {
            Log::error("Error EmpCr edit: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            return back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    // public function update(StoreEmpresaRequest $request, Empresa $empresa)
    // {
    //     try {

    //         DB::beginTransaction();

    //         if (!$request->file('logo')) {
    //             $empresa->update($request->all());
    //         } else {
    //             $request_data = $request->all();

    //             $name_logo = uniqid($empresa->id . '-') . '.' . $request->file('logo')->getClientOriginalExtension();

    //             Storage::disk('public-logo')->put($name_logo, File::get($request->file('logo')));

    //             $url_logo = str_replace('http://', 'https://', url(Storage::disk('public-logo')->url($name_logo)));

    //             $request_data['logo'] = $url_logo;

    //             $empresa->update($request_data);
    //         }
    //         DB::commit();
    //         return redirect()->route('admin.empresa.index')->with('info', 'update');
    //     } catch (\Exception $exception) {
    //         DB::rollBack();
    //         Log::error("Error EmpCr update: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
    //         return back();
    //     }
    // }

    public function update(StoreEmpresaRequest $request, Empresa $empresa)
    {
        try {
            DB::beginTransaction();

            $request_data = $request->all();

            // Manejar el logo
            if ($request->hasFile('logo')) {
                $url_logo = $this->handleLogo($request->file('logo'));
                $request_data['logo'] = $url_logo;
            }

            $empresa->update($request_data);

            DB::commit();
            return redirect()->route('admin.empresa.index')->with('info', 'update');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error EmpCr update: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            return back();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Empresa $empresa)
    {
        try {
            DB::beginTransaction();
            $empresa->delete();
            DB::commit();
            return redirect()->route('admin.empresa.index')->with('info', 'delete');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error("Error EmpCr destroy: {$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}");
            return back();
        }
    }
}
