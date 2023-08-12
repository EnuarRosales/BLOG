@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Usuario</h1>
@stop

@section('css')
    <link rel="stylesheet" href="/css/app_custom.css" />
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}
            <div class="form-group">


                {!! Form::label('fechaIngreso', 'Fecha Ingreso') !!}
                {!! Form::date('fechaIngreso', null, [
                    'class' => 'form-control',
                ]) !!}
                @error('fechaIngreso')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese nombres y apellidos']) !!}

                @error('name')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Cedula') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese cedula']) !!}

                @error('cedula')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Celular') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese celular']) !!}

                @error('celular')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Direccion') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese direccion']) !!}

                @error('direccion')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Correo') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese correo electronico']) !!}

                @error('email')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Tipo Usuario') !!}
                {!! Form::select('tipoUsuario_id', $tipoUsuarios->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Tipo de usuario',
                ]) !!}

                @error('tipoUsuario_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('name', 'Empresa') !!}
                {!! Form::select('empresa_id', $empresas->pluck('name', 'empresa_id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione una empresa',
                ]) !!}

                @error('empresa_id')
                <br>
                <span class="text-danger">{{ $message }}</span>
                <br>
                @enderror

                <div class="mt-2">
                    <div class="form-check form-check-inline radio radio-success custom-radio">
                        <input type="radio" name="active"
                               id="active_yes" value="1"
                            {{old('active',$user->active)?'checked':''}}>
                        <label for="active_yes" class="form-check-label ml-2">
                            Active
                        </label>
                    </div>
                    <div class="form-check form-check-inline radio radio-danger custom-radio">
                        <input type="radio" name="active"
                               id="active_no" value="0"
                            {{old('active',$user->active)?'':'checked'}}>
                        <label for="active_no" class="form-check-label ml-2">
                            Inactivo
                        </label>
                    </div> 
                </div>

            </div>
            {!! Form::submit('Actualizar Usuario', ['class' => 'btn btn-primary']) !!}
            <a class="btn btn-secondary btn " href="{{ route('admin.users.rol', $user) }}">Asignar Rol</a>
            {!! Form::close() !!}
        </div>
    </div>
@stop
