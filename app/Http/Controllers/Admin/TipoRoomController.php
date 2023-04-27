<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class TipoRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoRooms = Room::orderBy('id', 'desc')->paginate();
        return view('admin.tipoRooms.index', compact('tipoRooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tipoRooms.create');
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
            'nombre' => 'required',
        ]); 

        $tipoRoom = Room::create($request->all());
        return redirect()->route('admin.tipoRooms.index', $tipoRoom->id)->with('info', 'store');
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
    public function edit(Room $tipoRoom)
    {
        return view('admin.tipoRooms.edit', compact('tipoRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $tipoRoom)
    {
        //VALLIDACION DE FORMULARIOS
        $request->validate([
            'nombre' => 'required'
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $tipoRoom->update($request->all());
        return redirect()->route('admin.tipoRooms.index', $tipoRoom->id)->with('info', 'update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $tipoRoom)
    {
        $tipoRoom->delete();
        return redirect()->route('admin.tipoRooms.index')->with('info','delete');
    }
}
