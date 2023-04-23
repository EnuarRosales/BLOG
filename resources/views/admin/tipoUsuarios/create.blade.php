@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar tipo usuario</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.tipoUsuarios.store'])!!}
        {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo usuario']) !!}

            @error('nombre')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
            @enderror

        </div>
        
            {!! Form::submit('Crear Categoria', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}      

    </div>

</div>

@stop

























{{-- @extends('layouts.plantilla')
@section('title', 'create')
@section('content')
    <h1>en esta parte podras crear un Tipo Usuario</h1>

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'tipoUsuarios.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {{-- {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo usuario']) !!}

                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>
            
                {!! Form::submit('Crear Categoria', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            --}}

        {{-- </div>


    </div> --}} 

    {{-- FORMULARIO CON LARAVEL COLECTI --}}


    {{-- <form action="{{ route('tipoUsuarios.store') }}" method="POST">
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
    </form> --}}

{{-- @endsection --}}
