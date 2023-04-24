@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado asignacion rooms</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{route('admin.asignacionRooms.create') }}">Agregar Asignacion Room</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Room Asignado</th>
                    <th>Fecha</th>
                    <th colspan="2"</th>

                </tr>
            </thead>


            <tbody>
                @foreach ($asignacionRooms as $asignacionRoom)
                    <tr>
                        <td>{{ $asignacionRoom->id }}</td>
                        <td>{{ $asignacionRoom->user->name }}</td>
                        <td>{{ $asignacionRoom->room->nombre }}</td>
                        <td>{{ $asignacionRoom->created_at}}</td>

                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.asignacionRooms.edit', $asignacionRoom) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.asignacionRooms.destroy', $asignacionRoom) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@stop
