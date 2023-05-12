@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar asistencia</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($registroAsistencia, ['route' => ['admin.registroAsistencias.update', $registroAsistencia],'method' => 'put',]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Usuario',]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br> 
                @enderror

                {!! Form::label('created_at', 'Fecha') !!}
                {{-- {!!Form::date('registroAsistencia',\Carbon\Carbon::now())!!} --}}
                {!! Form::date('created_at', $registroAsistencia->pluck('created_at', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Usuario']) !!}

                @error('created_at')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror                 

                {{-- {!! Form::label('created_at', 'Fecha') !!}
                {!! Form::select($registroAsistencia->created_at, null, ['class' => 'form-control','placeholder' => 'Seleccione Un Usuario']) !!}
                @error('created_at')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror  --}}

            </div>
            {!! Form::submit('Actualizar Asistencia', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
