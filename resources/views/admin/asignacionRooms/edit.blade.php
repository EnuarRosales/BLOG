@extends('template.index')

@section('tittle-tab')
    Personal-Asignacion Rooms-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Asignacion Rooms</a>
@endsection

@section('content_header')
    <h1>Editar asignacion rooms</h1>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            @if (session('info'))
                <div class="alert alert-success">
                    <strong>{{ session('info') }}</strong>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    {!! Form::model($asignacionRoom, [
                        'route' => ['admin.asignacionRooms.update', $asignacionRoom],
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

                        {!! Form::label('name', 'Room') !!}
                        {!! Form::select('room_id', $rooms->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Seleccione Un Room',
                        ]) !!}

                        @error('room_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Actualizar Asignacion Room', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>


@stop
