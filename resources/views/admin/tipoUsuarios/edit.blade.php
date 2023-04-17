@extends('layouts.plantilla')
@section('title', 'TipoUsuarios Edit')
@section('content')

    <h1>en esta parte podras editar un curso</h1>
    <form action="{{ route('tipoUsuarios.update', $tipoUsuario)}}" method="POST">
        @csrf
        @method('put')

        <label>
            Nombre:
            <br>
            <input type="text" name="nombre" value="{{ old('nombre', $tipoUsuario->nombre) }}">
        </label>

        @error('nombre')
            <br>
            <small>*{{ $message }}</small>
        @enderror

        <br>
        <button type="submit"> Actualizar formulario</button>
    </form>

@endsection
