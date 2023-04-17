@extends('layouts.plantilla')
@section('title','show'. $curso->name)
@section('content')
    <h1>Bienvenido al curso {{$curso->name}}  </h1> 
    <a href="{{route('cursos.index')}}">Volver a  Cursos</a>
    <br>
    <a href="{{route('cursos.edit',$curso)}}">Editar Curso</a>
    <p><strong>Descripcion: </strong>{{$curso->descripcion}}</p>   
    <p>{{$curso->categoria}}</p>

    <form action="{{route('cursos.destroy',$curso)}}" method="POST">
        @csrf
        @method('delete')
        <button type="submit">Eliminar</button>
    </form>
@endsection


