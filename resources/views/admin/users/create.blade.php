@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app_custom.css" />
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.users.store']) !!}
            {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}
            <div class="form-group">


                {!! Form::label('fechaIngreso', 'Fecha Ingreso') !!}
                {!! Form::date('fechaIngreso', now(), [
                    'class' => 'form-control',
                ]) !!}
                @error('fechaIngreso')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese el nombre']) !!}

                @error('name')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('cedula', 'Cedula') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese la cedula']) !!}

                @error('cedula')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('celular', 'Celular') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese el celular']) !!}

                @error('celular')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('direccion', 'Direccion') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese la direccion']) !!}

                @error('direccion')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('email', 'Email') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese correo']) !!}

                @error('email')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('tipoUsuario_id', 'Tipo de usuario') !!}
                {!! Form::select('tipoUsuario_id', $tipoUsuarios->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Tipo de usuario',
                ]) !!}

                @error('tipoUsuario_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('empresa_id', 'Empresa') !!}
                {!! Form::select('empresa_id', $empresas->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione una empresa',
                ]) !!}
                @error('empresa_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror


                {{-- {!! Form::label('user_id', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{$message}}</span>
                    <br>
                @enderror --}}



                <div class="mt-2">
                    <div class="form-check form-check-inline radio radio-success custom-radio">
                        {{-- {!! Form::radio('active', 1, true, ['class'=>'form-check-input']) !!}
                        {!! Form::label('inlineRadio1', 'Activo', ['class' => 'form-check-label ml-2']) !!} --}}
                        <input type="radio" name="active" id="active_yes" value="1"
                            {{ old('active', true) ? 'checked' : '' }}>
                        <label for="active_yes" class="form-check-label ml-2">
                            Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline radio radio-danger custom-radio">
                        {{-- {!! Form::radio('active', 0, null, ['class'=>'form-check-input']) !!}
                        {!! Form::label('inlineRadio2', 'Inactivo', ['class' => 'form-check-label ml-2']) !!} --}}
                        <input type="radio" name="active" id="active_no" value="0"
                            {{ old('active', true) ? '' : 'checked' }}>
                        <label for="active_no" class="form-check-label ml-2">
                            Inactivo
                        </label>
                    </div>
                </div>
            </div>

            {!! Form::submit('Crear Usuario', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>

    </div>
@stop
