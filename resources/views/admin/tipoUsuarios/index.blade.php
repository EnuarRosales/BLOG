@extends('adminlte::page')

@section('title', 'Studio WC')

@section('content_header')
    <h1>Lista tipo usuarios</h1>
@stop


@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
        
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoUsuarios.create') }}">Agregar TipoUsuario</a>
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
                @foreach ($tipoUsuarios as $tipoUsuario)
                    <tr>
                        <td>{{ $tipoUsuario->id }}</td>
                        <td>{{ $tipoUsuario->nombre }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.tipoUsuarios.edit', $tipoUsuario) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.tipoUsuarios.destroy', $tipoUsuario) }}" method="POST">
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






{{-- <p>Welcome to this beautiful admin panel.</p>

    <div class="container">

        @if (session('info'))
            <div class="alert alert-success">
                <strong>{{ session('info') }}</strong>
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <a class="btn btn-primary" href="{{ route('tipoUsuarios.create') }}">Agregar TipoUsuario</a>
            </div>
            <div class="card-body ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($tipoUsuarios as $tipoUsuario)
                            <tr>
                                <td>{{ $tipoUsuario->id }}</td>
                                <td>{{ $tipoUsuario->nombre }}</td>
                                <td width="10px"><a href="{{ route('tipoUsuarios.edit', $tipoUsuario) }}"
                                        class="btn btn-secondary btn-sm"><i class="fas fa-angle-double-right"></i>
                                        Editar</a> </td>

                                <td width="10px">
                                    <form action="{{ route('tipoUsuarios.destroy', $tipoUsuario) }}" method="POST">
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
        </div>
        <div>
            <div>
                <div> --}}


















{{-- @extends('layouts.plantilla')
@section('title', 'index')
@section('content')
    <h1>"Tipo Ususarios"</h1> --}}
{{-- <a href="{{ route('cursos.create') }}">Crear Curso</a>    --}}

{{-- AGREGAR TIPO USUARIO --}}

{{-- <div class="container">
        <div class="row" style="width: 1190px;padding-bottom: 170px;">
            <div class="col-md-12">
                @if (session('info'))
                    <div class="alert alert-success">
                        <strong>{{ session('info') }}</strong>
                    </div>
                @endif
                
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('tipoUsuarios.create') }}">Agregar TipoUsuario</a>
                        </div>
                        <div class="card-body ">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($tipoUsuarios as $tipoUsuario)
                                        <tr>
                                            <td>{{ $tipoUsuario->id }}</td>
                                            <td>{{ $tipoUsuario->nombre }}</td>
                                            <td width="10px"><a href="{{ route('tipoUsuarios.edit', $tipoUsuario) }}"
                                                    class="btn btn-secondary btn-sm"><i
                                                        class="fas fa-angle-double-right"></i>
                                                    Editar</a> </td>

                                            <td width="10px">
                                                <form action="{{ route('tipoUsuarios.destroy', $tipoUsuario) }}"
                                                    method="POST">
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
                    </div>
                    <div>
                        <div>
                            <div> --}}


{{-- <ul>
        @foreach ($cursos as $curso)
            <li>
                <a href="{{ route('cursos.show', $curso->id) }}">{{ $curso->name }}</a>
            </li>
        @endforeach
    </ul>
    {{ $cursos->links() }} --}}

{{-- @endsection --}}
