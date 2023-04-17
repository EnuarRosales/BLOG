@extends('layouts.plantilla')
@section('title', 'create')
@section('content')
    <h1>en esta parte podras crear un curso</h1>   
    <form action="{{ route('cursos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">NOMBRE</label>            
            <br>
            <input type="text" name="name" value="{{ old('name') }}">
            </label>
        </div>

        @error('name')
            <br>
            <small>{{ $message }}</small>
            <br>
        @enderror

        <br>

        <label>
            Descripcion:<br>
            <textarea name="descripcion" rows="5">{{ old('descripcion') }}</textarea>
        </label>
        @error('descripcion')
            <br>
            <small>{{ $message }}</small>
            <br>
        @enderror

        <br>
        <label>
            Categoria:
            <br>
            <input type="text" name="categoria" value="{{ old('categoria') }}" </label>

            @error('categoria')
                <br>
                <small>{{ $message }}</small>
                <br>
            @enderror

            <br>
            <button type="submit"> Enviar formulario</button>
    </form>
@endsection


