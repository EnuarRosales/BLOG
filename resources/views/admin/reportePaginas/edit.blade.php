@extends('template.index')

@section('tittle-tab')
    Reporte de paginas
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de paginas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar Reporte</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {!! Form::model($reportePagina, ['route' => ['admin.reportePaginas.update', $reportePagina],'method' => 'put',]) !!}
            <div class="form-group">
                {!! Form::label('fecha', 'Fecha') !!}
                {!! Form::date('fecha', null, [
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
