@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Descuento</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success"> 
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            {!! Form::model($registroDescuento, ['route' => ['admin.registroDescuentos.update', $registroDescuento],'method' => 'put',]) !!}
            <div class="form-group">
                {!! Form::label('name', 'Nombre') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null,['class' => 'form-control','placeholder' => 'Seleccione Un Usuario',]) !!}
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
                    <span class="text-danger">{{$message}}</span>
                    <br>
                @enderror  

                {!! Form::label('montoDescuento', 'Monto Descuento') !!}
                {!! Form::number('montoDescuento',null, [
                    'class' => 'form-control',                    
                ]) !!}
                @error('montoDescuento')
                    <br>
                    <span class="text-danger">{{$message}}</span>
                    <br>
                @enderror 

                
                

                {{-- {!! Form::label('created_at', 'Fecha') !!}
                {!! Form::select($registroAsistencia->created_at, null, ['class' => 'form-control','placeholder' => 'Seleccione Un Usuario']) !!}
                @error('created_at')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror  --}}

            </div>
            {!! Form::submit('Actualizar Descuento', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop