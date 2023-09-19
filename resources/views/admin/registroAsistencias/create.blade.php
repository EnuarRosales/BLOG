@extends('template.index')

@section('tittle-tab')
    Reporte de Asistenicias-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de Asistenicias</a>

@endsection

@section('content_header')
    <h2>Registrar Asistencia</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="card">
                <div class="card-header">
                    @yield('content_header')
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.registroAsistencias.store']) !!}
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

                        {!! Form::label('mi_hora', 'Hora') !!}
                        {!! Form::time('mi_hora', now(), [
                            'class' => 'form-control',
                        ]) !!}
                        @error('mi_hora')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror





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
                        {{-- {!! Form::label('fecha', 'Fecha') !!}
                {!! Form::select('fecha', $turnos->pluck('nombre', 'id'), null, [
                    'class' => 'form-control',
                    'placeholder' => 'Seleccione Un Usuario',
                ]) !!}
                @error('turno_id')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror --}}
                    </div>
                    {!! Form::submit('Registrar asistencia', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>


@stop
