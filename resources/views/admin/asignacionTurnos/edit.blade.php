@extends('template.index')

@section('tittle-tab')
    Personal-Asignacion Turno-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Asignacion Turno</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Editar asignacion turno</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif
            {{-- <div class="card">
                <div class="card-body"> --}}
                    {!! Form::model($asignacionTurno, [
                        'route' => ['admin.asignacionTurnos.update', $asignacionTurno],
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

                        {!! Form::label('turno_id', 'Turno') !!}
                        {!! Form::select('turno_id', $turnos->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Seleccione Un Usuario',
                        ]) !!}

                        @error('turno_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Actualizar Asignacion Turno', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                {{-- </div>
            </div> --}}
        </div>
    </div>
@stop
