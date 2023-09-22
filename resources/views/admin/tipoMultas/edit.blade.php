@extends('template.index')

@section('tittle-tab')
    Configuracion-tipoMultas-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoMultas.index') }}"> Configuracion-tipoMultas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar tipo multas</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif

                    {!! Form::model($tipoMulta, ['route' => ['admin.tipoMultas.update', $tipoMulta], 'method' => 'put']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo multa']) !!}
                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('name', 'Costo') !!}
                        {!! Form::text('costo', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un costo']) !!}
                        @error('costo')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Actualizar Tipo Multa', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

        </div>
    </div>

@stop
