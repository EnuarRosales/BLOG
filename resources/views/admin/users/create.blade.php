@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop 

@section('content')
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.users.store']) !!}
            {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese el nombre']) !!}

                @error('name')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror


                {!! Form::label('name', 'Cedula') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese la cedula']) !!}

                @error('cedula')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Celular') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese el celular']) !!}

                @error('celular')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Direccion') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese la direccion']) !!}

                @error('direccion')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Email') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese correo']) !!}

                @error('email')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Tipo de usuario') !!}                
                {!! Form::select('tipoUsuario_id', $tipoUsuarios->pluck('nombre','id'), null,['class' => 'form-control', 'placeholder' => 'Seleccione Un Tipo de usuario'])!!}
                                                       
                 @error('tipoUsuario_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>

            {!! Form::submit('Crear Usuario', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>

    </div>
@stop
