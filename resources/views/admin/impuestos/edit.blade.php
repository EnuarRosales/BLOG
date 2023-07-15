@extends('adminlte::page')

@section('title', 'Impuesto')

@section('content_header')
    <h1>Editar Impuesto</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::model($impuesto, ['route' => ['admin.impuestos.update', $impuesto], 'method' => 'put']) !!}
            <div class="form-group">

                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('mayorQue', 'MayorQue') !!}
                {!! Form::number('mayorQue', null, ['class' => 'form-control']) !!}
                @error('mayorQue')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('porcentaje', 'Porcentaje') !!}
                {!! Form::number('porcentaje', null, ['class' => 'form-control']) !!}
                @error('porcentaje')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>

            {!! Form::submit('Actualzar Impuesto', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>

    </div>

@stop
