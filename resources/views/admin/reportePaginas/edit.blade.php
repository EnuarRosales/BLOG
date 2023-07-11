@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Reporte</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">            
            {!! Form::model($reportePagina, ['route' => ['admin.reportePaginas.update', $reportePagina],'method' => 'put',]) !!}
            <div class="form-group">
                {!! Form::label('fecha', 'Fecha') !!}
                {!! Form::date('fecha', now(), [
                    'class' => 'form-control',
                ]) !!}
                @error('fecha')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror               

                {!! Form::label('user_id', 'Modelo') !!}
                {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('user_id')
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

                {!! Form::label('Cantidad', 'Cantidad') !!}
                {!! Form::number('Cantidad', null, ['class' => 'form-control', ]) !!}
                @error('Cantidad')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror     

                {!! Form::label('TRM', 'TRM') !!}
                {!! Form::number('TRM', null, ['class' => 'form-control', ]) !!}
                @error('TRM')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror 


            </div>
            {!! Form::submit('Guardar Edicion', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}

        </div>

    </div>


@stop