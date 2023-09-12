@extends('template.index')

@section('tittle-tab')
    Configuracion-TipoDescuentos-Editar
@endsection

@section('page-title')
    <a href="{{ route('admin.tipoDescuentos.index') }}"> Configuracion-TipoDescuentos</a>
@endsection

@section('content_header')
    <h2>Crear tipo descuentos</h2>
@stop

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            <div class="card">
                <div class="card-body">
                    {!! Form::open(['route' => 'admin.tipoDescuentos.store']) !!}
                    {{-- @csrf{!! Form::model($tipoUsuario, ['route' => ['admin.tipoUsuarios.update', $tipoUsuario], 'method' => 'put']) !!} --}}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un tipo descuento']) !!}

                        @error('nombre')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                        @enderror

                    </div>

                    {!! Form::submit('Crear Tipo Descuento', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>


@stop
