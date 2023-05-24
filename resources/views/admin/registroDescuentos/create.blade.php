@extends('adminlte::page')
@section('title', 'Dashboard')
@section('content_header')
    <h1>Registrar Descuentos</h1>
@stop
@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.registroDescuentos.store']) !!}

            
         
            <div class="form-group">
                {!! Form::label('user_id', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{$message}}</span>
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

                {{-- {!! Form::number($name, $value, [$options]) !!} --}}
                
                
                
            </div>           

            {!! Form::submit('Registrar Descuento', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@stop
