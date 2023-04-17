@extends('layouts.plantilla')
@section('title', 'create')
@section('content')
    <h1>en esta parte podras crear un Tipo Usuario</h1>
    <form action="{{ route('tipoUsuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">NOMBRE</label>
            <br>
            <input type="text" name="nombre" value="{{ old('nombre') }}">
            </label>
        </div>
        @error('nombre')
            <br>
            <small>{{ $message }}</small>
            <br>
        @enderror
        <br>

        <button type="submit"> Enviar formulario</button>
    </form>

@endsection
