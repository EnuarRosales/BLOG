<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AsignacionRoom;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class AsignacionRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asignacionRooms = AsignacionRoom::orderBy('id','desc')->paginate();       
        return view('admin.asignacionRooms.index', compact('asignacionRooms'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('id','desc'); 
        $rooms = Room::orderBy('id','desc'); 
        return view('admin.asignacionRooms.create', compact('users','rooms'));
    }

    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//VALiDACION FORMULARIO 
        $request->validate([
            'user_id'=>'required',
            'room_id'=>'required',         
        ]);
 
        $asignacionRoom = AsignacionRoom::create($request->all());
        return redirect()->route('admin.asignacionRooms.index',$asignacionRoom->id)->with('info','store');
//
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
    public function edit( AsignacionRoom $asignacionRoom)
    {
        $users = User::orderBy('id','desc'); 
        $rooms = Room::orderBy('id','desc');  

        return view('admin.asignacionRooms.edit',compact('asignacionRoom','users','rooms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AsignacionRoom $asignacionRoom)
    {
        //VALiDACION FORMULARIO 
        $request->validate([
            'user_id'=>'required',
            'room_id'=>'required',         
        ]);
        //ASINACION MASIVA DE VARIABLES A LOS CAMPOS
        $asignacionRoom->update($request->all());
        return redirect()->route('admin.asignacionRooms.index', $asignacionRoom->id)->with('info','update'); //with mensaje de sesion

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AsignacionRoom $asignacionRoom)
    {
        $asignacionRoom->delete();
        return redirect()->route('admin.asignacionRooms.index')->with('info','delete');
    }
}
