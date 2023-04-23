@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar tipo moneda paginas</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($tipoMonedaPagina, ['route' => ['admin.tipoMonedaPaginas.update', $tipoMonedaPagina], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo Moneda Pagina']) !!}
                @error('nombre')
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
            {!! Form::submit('Actualizar Tipo Moneda Pagina', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
