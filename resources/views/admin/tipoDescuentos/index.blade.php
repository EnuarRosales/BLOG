@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado tipo descuentos</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoDescuentos.create') }}">Agregar tipo descuento</a>
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
                @foreach ($tipoDescuentos as $tipoDescuento)
                    <tr>
                        <td>{{ $tipoDescuento->id }}</td>
                        <td>{{ $tipoDescuento->nombre }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.tipoDescuentos.edit', $tipoDescuento) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoDescuentos.destroy', $tipoDescuento) }}" method="POST">
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
 