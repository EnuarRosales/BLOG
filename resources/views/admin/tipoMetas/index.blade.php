@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado tipo metas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoMetas.create') }}">Agregar tipo meta</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th colspan="2"</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($tipoMetas as $tipoMeta)
                    <tr>
                        <td>{{ $tipoMeta->id }}</td>
                        <td>{{ $tipoMeta->nombre }}</td>
                        <td>{{ $tipoMeta->valor}}</td>
                        
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.tipoMetas.edit', $tipoMeta) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoMetas.destroy', $tipoMeta) }}" method="POST">
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
