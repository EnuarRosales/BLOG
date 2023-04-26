@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Personal</h1>
@stop

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
        
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{route('admin.users.create') }}">Agregar Usuario</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Celular</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Tipo Usuario</th>
                    <th colspan="2"</th>

                </tr>
            </thead>


            <tbody>
                @foreach ($users as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name}}</td>
                        <td>{{ $usuario->cedula}}</td>
                        <td>{{ $usuario->celular}}</td>
                        <td>{{ $usuario->direccion}}</td>
                        <td>{{ $usuario->email}}</td>
                        <td>{{ $usuario->tipoUsuario->nombre}}</td>
                        
                        
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.users.edit', $usuario) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form action="{{ route('admin.users.destroy', $usuario) }}" method="POST">
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


