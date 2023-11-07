@extends('template.index')

@section('tittle-tab')
    Configuracion-TipoTurno-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoTurnos.index') }}"> Configuracion-tipoTurnos</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar tipo turno</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif

            {!! Form::model($tipoTurno, ['route' => ['admin.tipoTurnos.update', $tipoTurno], 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                {!! Form::text('nombre', null, ['class' => 'form-control', 'readonly', 'placeholder' => 'Favor ingrese un tipo turno']) !!}
                @error('nombre')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror                

                {!! Form::label('horaIngreso', 'Hora Ingreso') !!}
                {!! Form::time('horaIngreso', null, [
                    'class' => 'form-control',
                ]) !!}
                @error('horaIngreso')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('horaTermino', 'Hora Termino') !!}
                {!! Form::time('horaTermino', null, [
                    'class' => 'form-control',
                ]) !!}
                @error('horaTermino')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>
            {!! Form::submit('Actualizar Tipo Turno', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
    </div>

@stop
