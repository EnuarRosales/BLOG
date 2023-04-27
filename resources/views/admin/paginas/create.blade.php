@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear paginas</h1>
@stop

@section('content')


    <div class="card">
        <div class="card-body">
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

                {!! Form::label('name', 'Tipo Moneda') !!}
                {!! Form::select('tipoMoneda_id', $tipoMonedapaginas->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Tipo moneda',
                ]) !!}

                @error('tipoMoneda_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror


            </div>

            {!! Form::submit('Crear Pagina', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>













@stop
