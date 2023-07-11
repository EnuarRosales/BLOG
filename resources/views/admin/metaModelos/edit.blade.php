@extends('adminlte::page')

@section('title', 'MetaModelo')

@section('content_header')
    <h1>Editar Meta Modelo</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::model($metaModelo, ['route' => ['admin.metaModelos.update', $metaModelo],'method' => 'put',]) !!}
            <div class="form-group">
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

            {!! Form::submit('Actualzar Meta Modelo', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>

    </div>

@stop
