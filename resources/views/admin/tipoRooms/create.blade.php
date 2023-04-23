@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear tipo room</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {!! Form::open(['route'=>'admin.tipoRooms.store'])!!}
        {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

        <div class="form-group">
            {!! Form::label('nombre', 'Nombre') !!}
            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
            {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo room']) !!}
            @error('nombre')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
            @enderror

        </div>
        
            {!! Form::submit('Crear Room', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}      

    </div>

</div>
    




@stop



