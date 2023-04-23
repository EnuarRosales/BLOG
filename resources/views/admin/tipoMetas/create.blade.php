@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear tipo metas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tipoMetas.store']) !!}
            {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una meta']) !!}

                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror


                {!! Form::label('name', 'Valor') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un valor']) !!}

                @error('valor')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>

            {!! Form::submit('Crear Tipo Meta', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>

    </div>

@stop
