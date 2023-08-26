@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear tipo turno</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.tipoTurnos.store']) !!}
            {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo turno']) !!}

                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('horaIngreso', 'Hora Ingreso') !!}
                {!! Form::time('horaIngreso', null, [
                    'class' => 'form-control',
                ]) !!}
                @error('horaIngreso')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('horaTermino', 'Hora Termino') !!}
                {!! Form::time('horaTermino', date('g:i a'), [
                    'class' => 'form-control',
                ]) !!}              

                @error('horaTermino')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror
            </div>

            {!! Form::submit('Crear Turno', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>


@stop
