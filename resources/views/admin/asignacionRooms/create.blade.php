@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear asignacion rooms</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.asignacionRooms.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Room') !!}
                {!! Form::select('room_id', $rooms->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Room',
                ]) !!}

                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {{-- {!! Form::label('name', 'Fecha') !!}
                {!! Form::date('fecha', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una fecha']) !!}

                @error('fecha')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror --}}



            </div>

            {!! Form::submit('Asignar Room', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>


@stop
