@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado rooms</h1>
@stop

@section('content')

@if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoRooms.create') }}">Agregar tipo room</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th colspan="2"</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($tipoRooms as $tipoRoom)
                    <tr>
                        <td>{{ $tipoRoom->id }}</td>
                        <td>{{ $tipoRoom->nombre }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.tipoRooms.edit', $tipoRoom) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoRooms.destroy', $tipoRoom) }}" method="POST">
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

