@extends('template.index')

@section('tittle-tab')
    Configuracion-Paginas-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.paginas.index') }}"> Configuracion-Paginas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Crear paginas</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            {!! Form::open(['route' => 'admin.paginas.store']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un nombre']) !!}

                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                <div class="form-group">
                    {!! Form::label('moneda', 'Moneda') !!}

                    {!! Form::select('moneda', ['dolar' => 'dolar', 'euro' => 'euro'], 2, [
                        'id' => 'moneda',
                        'class' => 'form-control',
                    ]) !!}

                    @error('moneda')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror

                    {!! Form::label('name', 'valor') !!}
                    {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                    {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un valor']) !!}
                    @error('valor')
                        <br>
                        <span class="text-danger">{{ $message }}</span>
                        <br>
                    @enderror


                </div>

                {!! Form::submit('Crear Pagina', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>


        </div>
    </div>
@stop
