@extends('template.index')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignar Rol</h1>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-body">

                    {!! Form::model($user, ['route' => ['admin.users.updateRol', $user], 'method' => 'put']) !!}
                    {{-- <p class="h5">Nombre</p> --}}
                    {{-- <p class="form-control">{{ $user->name }}</p> --}}


                    {!! Form::label('name', 'Nombre') !!}
                    {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese nombres y apellidos']) !!}

                    @error('name')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror




                    @foreach ($roles as $role)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                {{ $role->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
                {!! Form::submit('Asignar Rol', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}


            </div>
        </div>
    </div>
@stop
