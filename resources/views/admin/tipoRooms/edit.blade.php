@extends('template.index')

@section('tittle-tab')
    Configuracion-TipoRooms-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoRooms.index') }}"> Configuracion-TipoRooms</a>
@endsection

@section('content_header')
    <h2>Editar tipo room</h2>
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
                    {!! Form::model($tipoRoom, ['route' => ['admin.tipoRooms.update', $tipoRoom], 'method' => 'put']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo room']) !!}
                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>
                    {!! Form::submit('Actualizar Tipo Room', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@stop
