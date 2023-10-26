@extends('template.index')

@section('tittle-tab')
    Configuracion-TipoMetas-Crear
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoMetas.index') }}"> Configuracion-TipoMetas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Crear tipo metas</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">
                <div class="card-body"> --}}
                    {!! Form::open(['route' => 'admin.tipoMetas.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese una meta']) !!}

                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror


                        {!! Form::label('valor', 'Valor') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('valor', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un valor']) !!}

                        @error('valor')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                        {!! Form::label('dias', 'Numero de dias') !!}
                        {!! Form::number('dias', null, [
                            'class' => 'form-control',
                        ]) !!}
                        @error('dias')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>

                    {!! Form::submit('Crear Tipo Meta', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                {{-- </div>

            </div> --}}
        </div>
    </div>

@stop
