@extends('template.index')

@section('tittle-tab')
    Configuracion-Impuestos-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.impuestos.index') }}"> Configuracion-Impuestos </a>

@endsection

@section('content_header')
    <h2 class="ml-3">Crear Impuesto</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">


                    {!! Form::open(['route' => 'admin.impuestos.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">

                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('mayorQue', 'MayorQue') !!}
                        {!! Form::number('mayorQue', null, ['class' => 'form-control']) !!}
                        @error('mayorQue')
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

                    {!! Form::submit('Crear Impuesto', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

        </div>
    </div>

@stop
