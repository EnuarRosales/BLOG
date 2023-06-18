@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registrar Producido</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.registroProducidos.store']) !!}
            <div class="form-group">
                {{-- {!! Form::label('user_id', 'Usuario') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror --}}


                {!! Form::label('fecha', 'Fecha') !!}
                {!! Form::date('fecha', now(), [
                    'class' => 'form-control',                    
                ] )   !!}
                @error('fecha')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                {!! Form::label('valorProducido', 'Valor Producido') !!}
                {!! Form::number('valorProducido',null, [
                    'class' => 'form-control',                    
                ]) !!}
                @error('valorProducido')
                    <br>
                    <span class="text-danger">{{$message}}</span>
                    <br>
                @enderror 


                {!! Form::label('pagina_id', 'Pagina') !!}
                {!! Form::select('pagina_id', $paginas->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Una Pagina',
                ]) !!}
                @error('pagina_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

                

                {!! Form::label('meta_id', 'Meta') !!}
                {!! Form::select('meta_id', $metas->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Una Meta',
                ]) !!}
                @error('meta_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror

            </div>
            {!! Form::submit('Registrar Producido', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>


@stop