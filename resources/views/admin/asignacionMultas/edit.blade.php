@extends('template.index')

@section('tittle-tab')
    Registro Multas-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.asignacionMultas.index') }}"> Registro Multas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Editar asignacion multa</h2>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">
                <div class="card-header">
                    @yield('content_header')
                </div> --}}

                {{-- <div class="card-body"> --}}
                    {!! Form::model($asignacionMulta, [
                        'route' => ['admin.asignacionMultas.update', $asignacionMulta],
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

                        {!! Form::label('tipoMulta_id', 'Room') !!}
                        {!! Form::select('tipoMulta_id', $tipoMultas->pluck('nombre', 'id'), null, [
                            'class' => 'form-control',
                            'placeholder' => 'Seleccione Un Tipo de Multa',
                        ]) !!}

                        @error('tipoMulta_id')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Actualizar Asignacion Multa', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>


@stop
