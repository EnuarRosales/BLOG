@extends('template.index')

@section('tittle-tab')
    Personal-Usuarios-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Usuarios</a>
@endsection

@section('content_header')
    <h2>Editar Tipo Usuario</h2>
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
                    {!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
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
                    {!! Form::submit('Actualizar Categoria', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
