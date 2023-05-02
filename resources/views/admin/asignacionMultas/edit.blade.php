@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar asignacion multa</h1>
@stop

@section('content')

{{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif --}}
    <div class="card">
        <div class="card-body">
            {!! Form::model($asignacionMulta, ['route' => ['admin.asignacionMultas.update', $asignacionMulta],'method' => 'put',]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Usuario',]) !!}

                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br> 
                @enderror

                {!! Form::label('tipoMulta_id', 'Room') !!}
                {!! Form::select('tipoMulta_id', $tipoMultas->pluck('nombre', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Tipo de Multa',]) !!}

                @error('tipoMulta_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>
            {!! Form::submit('Actualizar Asignacion Multa', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    

@stop