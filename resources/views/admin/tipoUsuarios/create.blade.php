@extends('template.index')

@section('tittle-tab')
    Configuracion-TipoUsuario
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoUsuarios.index') }}"> Configuracion-TipoUsuario </a>
@endsection

@section('content_header')
    <h2 class="ml-3">Crear tipo usuario</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            {{-- <div class="card">
                <div class="card-body"> --}}
                    {!! Form::open(['route' => 'admin.tipoUsuarios.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo usuario']) !!}

                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('porcentaje', 'Porcentaje') !!}
                        {!! Form::number('porcentaje', null, ['class' => 'form-control']) !!}
                        @error('porcentaje')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror





                    </div>

                    {!! Form::submit('Crear Categoria', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                {{-- </div>

            </div> --}}
        </div>
    </div>

@stop

























{{-- @extends('layouts.plantilla')
@section('title', 'create')
@section('content')
    <h1>en esta parte podras crear un Tipo Usuario</h1>

    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'tipoUsuarios.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
{{-- {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo usuario']) !!}

                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>

                {!! Form::submit('Crear Categoria', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
            --}}

{{-- </div>


    </div> --}}

{{-- FORMULARIO CON LARAVEL COLECTI --}}


{{-- <form action="{{ route('tipoUsuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label">NOMBRE</label>
            <br>
            <input type="text" name="nombre" value="{{ old('nombre') }}">
            </label>
        </div>
        @error('nombre')
            <br>
            <small>{{ $message }}</small>
            <br>
        @enderror
        <br>

        <button type="submit"> Enviar formulario</button>
    </form> --}}

{{-- @endsection --}}
