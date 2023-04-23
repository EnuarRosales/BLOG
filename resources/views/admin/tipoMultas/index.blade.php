@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista tipo multas</h1>
@stop

@section('content')

@if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoMultas.create') }}">Agregar tipo multa</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Costo</th>
                    <th colspan="2"</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($tipoMultas as $tipoMulta)
                    <tr>
                        <td>{{ $tipoMulta->id }}</td>
                        <td>{{ $tipoMulta->nombre }}</td>
                        <td>{{ $tipoMulta->costo }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.tipoMultas.edit', $tipoMulta) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoMultas.destroy', $tipoMulta) }}" method="POST">
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
