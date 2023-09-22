@extends('template.index')

@section('tittle-tab')
    Personal-Asignacion Rooms-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.users.index') }}">Personal-Asignacion Rooms</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Crear asignacion rooms</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">
                <div class="card-body"> --}}
                    {!! Form::open(['route' => 'admin.asignacionRooms.store']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Usuario') !!}
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

                        @error('user_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {{-- {!! Form::label('name', 'Fecha') !!}
                {!! Form::date('fecha', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una fecha']) !!}

                @error('fecha')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror --}}



                    </div>

                    {!! Form::submit('Asignar Room', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}

                {{-- </div>

            </div> --}}
        </div>
    </div>


@stop
