@extends('template.index')

@section('tittle-tab')
    Personal-Asignacion Turno-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Asignacion Turno</a>
@endsection

@section('content_header')
    <h2>Asignar Turno</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.asignacionTurnos.store']) !!}

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

                    {!! Form::submit('Asignar Turno', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>


@stop
