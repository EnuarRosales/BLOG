@extends('template.index')

@section('tittle-tab')
    Reporte de Asistenicias-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de Asistenicias</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar asistencia</h2>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">
                <div class="card-header">
                    @yield('content_header')
                </div>
                <div class="card-body"> --}}
                    {!! Form::model($registroAsistencia, [
                        'route' => ['admin.registroAsistencias.update', $registroAsistencia],
                        'method' => 'put',
                    ]) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::select('user_id', $users->pluck('name', 'id'), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Seleccione Un Usuario',
                        ]) !!}
                        @error('user_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror



                        {!! Form::label('fecha', 'Fecha') !!}
                        {!! Form::date('fecha', null, [
                            'class' => 'form-control',
                        ]) !!}
                        @error('fecha')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {{-- {!! Form::label('created_at', 'Fecha') !!}
                {!! Form::select($registroAsistencia->created_at, null, ['class' => 'form-control','placeholder' => 'Seleccione Un Usuario']) !!}
                @error('created_at')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror  --}}

                        {!! Form::label('mi_hora', 'Hora') !!}
                        {!! Form::time('mi_hora', null, [
                            'class' => 'form-control',
                        ]) !!}
                        @error('mi_hora')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror








                    </div>
                    {!! Form::submit('Actualizar Asistencia', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                {{-- </div>
            </div> --}}
        </div>
    </div>
@stop
