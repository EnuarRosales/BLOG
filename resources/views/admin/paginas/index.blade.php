@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado paginas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.paginas.create') }}">Agregar Pagina</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo Moneda</th>
                    <th colspan="2"</th>

                </tr>
            </thead>


            <tbody>
                @foreach ($paginas as $pagina)
                    <tr>
                        <td>{{ $pagina->id }}</td>
                        <td>{{ $pagina->nombre}}</td>                       
                        <td>{{ $pagina->tipoMonedaPagina->nombre}}</td>

                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" href="#">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="#" method="POST">
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
