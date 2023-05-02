@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar Multa</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.asignacionMultas.store']) !!}

            <div class="form-group">
                {!! Form::label('user_id', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}

                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('tipoMulta_id', 'Tipo Multa') !!}
                {!! Form::select('tipoMulta_id', $tipoMultas->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Tipo de Multa',
                ]) !!}

                @error('tipoMulta_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror



            </div>

            {!! Form::submit('Asignar Multa', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>


@stop
