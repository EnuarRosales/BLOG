@extends('template.index')

@section('tittle-tab')
    Configuracion-Paginas-Edit
@endsection

@section('page-title')
    <a href="{{ route('admin.paginas.index') }}"> Configuracion-Paginas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar paginas</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

                    {!! Form::model($pagina, ['route' => ['admin.paginas.update', $pagina], 'method' => 'put']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una pagina']) !!}
                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('moneda', 'Moneda') !!}
                        {!! Form::select('moneda', ['dolar' => 'dolar', 'euro' => 'euro'], null, [
                            'id' => 'moneda',
                            'class' => 'form-control',
                        ]) !!}

                        @error('moneda')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('name', 'Valor') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un valor']) !!}
                        @error('valor')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Actualizar Pagina', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

        </div>
    </div>
@stop
