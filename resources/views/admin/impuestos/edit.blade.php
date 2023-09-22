@extends('template.index')

@section('tittle-tab')
    Configuracion-Impuestos-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.impuestos.index') }}"> Configuracion-Impuestos </a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar Impuesto</h2>
@endsection

@section('styles')
    <link rel="stylesheet" href="/css/app_custom.css" />
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

                    {!! Form::model($impuesto, ['route' => ['admin.impuestos.update', $impuesto], 'method' => 'put']) !!}
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

                    {!! Form::submit('Actualzar Impuesto', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

        </div>
    </div>

@endsection
