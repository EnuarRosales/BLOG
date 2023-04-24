@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar asignacion rooms</h1>
@stop

@section('content')

@if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($asignacionRoom, ['route' => ['admin.asignacionRooms.update', $asignacionRoom],'method' => 'put',]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Usuario',]) !!}

                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br> 
                @enderror

                {!! Form::label('name', 'Room') !!}
                {!! Form::select('room_id', $rooms->pluck('nombre', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Room',]) !!}

                @error('room_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>
            {!! Form::submit('Actualizar Asignacion Room', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
    

@stop