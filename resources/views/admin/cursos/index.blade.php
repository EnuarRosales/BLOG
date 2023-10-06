@extends('layouts.plantilla')
@section('title', 'index')
@section('content')
<h1>"Bienvenido al curso principal"</h1>
    <a href="{{ route('cursos.create') }}">Crear Curso</a>
    <a href="{{ route('asignacionMultas.show', 'asignacionMulta') }}">Asignacion Multa</a>
    <a href="{{ route('tipoUsuarios.index') }}">Tipo Usuario</a>

    <div class="container">
        <div class="row" style="width: 1190px;padding-bottom: 170px;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="btn btn-primary" href="{{route('cursos.create')}}">Agregar Curso</a>
                    </div>
                    <div class="card-body ">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Descripcion</th>
                                    <th>Categoria</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cursos as $curso)
                                    <tr>            
                                        <td>{{ $curso->id }}</td>
                                        <td>{{ $curso->name }}</td>
                                        <td>{{ $curso->descripcion }}</td>
                                        <td>{{ $curso->categoria }}</td>
                                        <td width="10px"><a href="{{route('cursos.edit',$curso)}}" class="btn btn-secondary btn-sm"><i class="fas fa-angle-double-right"></i> Editar</a> </td>
                                        
                                        <td width="10px"> 
                                            <form action="{{route('cursos.destroy',$curso)}}" method="POST">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-dark btn-sm" >Eliminar</button>
                                            </form>
                                        </td>                                                             
                                    </tr>
                                @endforeach            
                            </tbody>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            <div>
        <div>
    <div>
@endsection






    {{-- <h1>"Bienvenido al curso principal"</h1>
    <a href="{{ route('cursos.create') }}">Crear Curso</a>
    <a href="{{ route('asignacionMultas.show', 'asignacionMulta') }}">Asignacion Multa</a>
    <a href="{{ route('tipoUsuarios.index') }}">Tipo Usuario</a>
    <div class="card">
        <div class="card-body ">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Descripcion</th>
                        <th>Categoria</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>

                            <td>{{ $curso->id }}</td>
                            <td>{{ $curso->name }}</td>
                            <td>{{ $curso->descripcion }}</td>
                            <td>{{ $curso->categoria }}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>
        </div>
    </div>

    <ul>
        @foreach ($cursos as $curso)
            <li>
                <a href="{{ route('cursos.show', $curso->id) }}">{{ $curso->name }}</a>
            </li>
        @endforeach
    </ul>

    {{ $cursos->links() }} --}}

    {{-- new --}}

    
