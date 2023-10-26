@extends('template.index')

@section('tittle-tab')
    Reporte de Descuentos-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.registroDescuentos.index') }}">Reporte de Descuentos</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Registrar Descuentos</h2>
@stop
@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">


            {!! Form::open(['route' => 'admin.registroDescuentos.store']) !!}



            <div class="form-group">
                {!! Form::label('user_id', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('tipoDescuento_id', 'Tipo de Descuento') !!}
                {!! Form::select('tipoDescuento_id', $tipoDescuentos->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('tipoDescuento_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('montoDescuento', 'Monto Descuento') !!}
                {!! Form::number('montoDescuento', null, [
                    'class' => 'form-control',
                ]) !!}
                @error('montoDescuento')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {{-- {!! Form::number($name, $value, [$options]) !!} --}}



            </div>

            {!! Form::submit('Registrar Descuento', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>
    </div>
@stop
