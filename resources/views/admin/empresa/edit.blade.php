@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <h1>Empresa</h1>
@stop

@section('content')
    @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    <div class="card">
            <div class="card-body">
                {!! Form::model($empresa, ['route' => ['admin.empresa.update', $empresa], 'method' => 'put', 'files' => true]) !!}
                <div class="row">
                    <div class="col-md-6">
                        <h4>Información</h4>
                        <div class="form-group">
                            {!! Form::label('name', 'Nombre') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
                            @error('name')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('nit', 'Nit') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::text('nit', null, ['class' => 'form-control', 'placeholder' => 'Nit']) !!}
                            @error('nit')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('address', 'Dirección') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => 'Nit']) !!}
                            @error('address')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('representative', 'Representante') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::text('representative', null, ['class' => 'form-control', 'placeholder' => 'Representante']) !!}
                            @error('representative')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('representative_identification_card', 'Identificación del representate') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::text('representative_identification_card', null, ['class' => 'form-control', 'placeholder' => 'Identificación del representate']) !!}
                            @error('representative_identification_card')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('number_rooms', 'Numero de Rooms') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::number('number_rooms', null, ['class' => 'form-control', 'placeholder' => 'Numero de Rooms']) !!}
                            @error('number_rooms')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                        <div class="form-group">
                            {!! Form::label('capacity_models', 'Capacidad de modelos') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            {!! Form::number('capacity_models', null, ['class' => 'form-control', 'placeholder' => 'Capacidad de modelos']) !!}
                            @error('capacity_models')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Imágenes</h4>
                        <div class="form-group file-select">
                            {!! Form::label('logo', 'Logo') !!}
                            {{-- ojo que en la linea siguiente va el nombre de la columa =( --}}
                            <br>
                            {!! Form::file('logo', ['class' => 'form-control', 'accept'=> "image/*"]) !!}
                            @error('logo')
                            <br>
                            <span class="text-danger">{{ $message }}</span>
                            <br>
                            @enderror
                            <img id="preview" src="{{asset($empresa->logo)}}" alt="" class="mt-3" style=" background-color: #0a0a0a; max-height: 200px; max-width: 100%;"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-sm btn-success">Actualizar</button>
            </div>
        {!! Form::close() !!}
    </div>
@stop
@section('js')
    <script>
        logo.onchange = evt => {
            const preview = document.getElementById('preview');
            console.log(preview);
            preview.style.display = 'block';
            const [file] = logo.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }
    </script>
@stop
