@extends('template.index')

@section('tittle-tab')
    Configuracion-TipoRooms-Crear

@endsection

@section('page-title')
    <a href="{{ route('admin.tipoUsuarios.index') }}"> Configuracion-TipoRooms
    </a>
@endsection

@section('content_header')
    <h2 class="ml-3">Crear tipo room</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

                    {!! Form::open(['route' => 'admin.tipoRooms.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo room']) !!}
                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>

                    {!! Form::submit('Crear Room', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

        </div>
    </div>





@stop
