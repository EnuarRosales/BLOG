@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Lista tipo turnos</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoTurnos.create') }}">Agregar tipo turno</a>
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
                @foreach ($turnos as $turno)
                    <tr>
                        <td>{{ $turno->id }}</td>
                        <td>{{ $turno->nombre }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.tipoTurnos.edit', $turno) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoTurnos.destroy', $turno) }}" method="POST">
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
