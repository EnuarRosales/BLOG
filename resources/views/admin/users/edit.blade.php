@extends('template.index')

@section('tittle-tab')
    Personal-Usuarios-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Usuarios</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Editar Usuario</h2>
@stop

@section('styles')
    <link rel="stylesheet" href="/css/app_custom.css" />
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif
            {{-- <div class="card">
                <div class="card-body"> --}}
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

                        {!! Form::label('cedula', 'Cedula') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese cedula']) !!}

                        @error('cedula')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('celular', 'Celular') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('celular', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese celular']) !!}

                        @error('celular')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('direccion', 'Direccion') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese direccion']) !!}

                        @error('direccion')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('email', 'Correo') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese correo electronico']) !!}

                        @error('email')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('tipoUsuario_id', 'Tipo Usuario') !!}
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


                        <div class="n-chk mt-3">
                            <label class="new-control new-radio new-radio-text radio-primary">
                                <input type="radio" class="new-control-input" name="active" id="active_yes"
                                    value="1" {{ old('active', $user->active) ? 'checked' : '' }}>
                                <span class="new-control-indicator"></span><span class="new-radio-content">Activo</span>
                            </label>

                            <label class="new-control new-radio new-radio-text radio-danger">
                                <input type="radio" class="new-control-input" name="active" id="active_no" value="0"
                                    {{ old('active', $user->active) ? '' : 'checked' }}>
                                <span class="new-control-indicator"></span><span class="new-radio-content">Inactivo</span>
                            </label>
                        </div>

                        {{-- <div class="mt-2">
                            <div class="form-check form-check-inline radio radio-success custom-radio">
                                <input type="radio" name="active" id="active_yes" value="1"
                                    {{ old('active', $user->active) ? 'checked' : '' }}>
                                <label for="active_yes" class="form-check-label ml-2">
                                    Active
                                </label>
                            </div>
                            <div class="form-check form-check-inline radio radio-danger custom-radio">
                                <input type="radio" name="active" id="active_no" value="0"
                                    {{ old('active', $user->active) ? '' : 'checked' }}>
                                <label for="active_no" class="form-check-label ml-2">
                                    Inactivo
                                </label>
                            </div>
                        </div> --}}

                    </div>
                    {!! Form::submit('Actualizar Usuario', ['class' => 'btn btn-primary']) !!}

                    @can('admin.users.asignarRol')
                    <a class="btn btn-info" href="{{ route('admin.users.rol', $user) }}">Asignar Rol</a>
                    @endcan

                    {!! Form::close() !!}
                {{-- </div>
            </div> --}}
        </div>
    </div>
@stop
