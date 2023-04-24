@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar Turno</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.asignacionTurnos.store']) !!}

            <div class="form-group">
                {!! Form::label('user_id', 'Usuario') !!}                
                {!! Form::select('user_id', $users->pluck('name','id'), null,['class' => 'form-control', 'placeholder' => 'Seleccione Un Usuario'])!!}
                                                        
                 @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('turno_id', 'Turno') !!}                
                {!! Form::select('turno_id', $turnos->pluck('nombre','id'), null,['class' => 'form-control', 'placeholder' => 'Seleccione Un Usuario'])!!}
                                                       
                 @error('turno_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

               

            </div>

            {!! Form::submit('Asignar Turno', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>



@stop
