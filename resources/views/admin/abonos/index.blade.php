@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar roles</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body">
        {{-- <a class="btn btn-primary" href="{{ route('admin.roles.create') }}">Agregar Rol</a> --}}
    </div>


{{-- FORMULARIO PARA CREAR NUEVO ABONO PARCIAL  --}}

    <div class="card">
        <div class="card-body">
            {!! Form::open($abonoParcial, ['route' => 'admin.abonos.abonoParcial',$abonoParcial]) !!}

            <div class="form-group">

                {!! Form::label('valor', 'Monto Valor') !!}
                {!! Form::number('valor',null, [
                    'class' => 'form-control',                    
                ]) !!}
                @error('valor')
                    <br>
                    <span class="text-danger">{{$message}}</span>
                    <br>
                @enderror 

                {!! Form::label('descripcion', 'Descripcion') !!}                
                {!! Form::text('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Favor ingrese un nombre']) !!}
                @error('descripcion')
                    <br>
                    <span class="text-danger">{{ $message }}</span>
                    <br>
                @enderror 
                
               

            {!! Form::submit('Crear Abono', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>





    {{-- TABLA --}}

    <table id="roles" class="table table-striped table-bordered shadow-lg mt-4">
        <thead>
            <tr>
                <th>Valor</th>
                <th>Descripcion</th>
                <th>Fecha</th>
                {{-- <th>Nombre</th>                     --}}
                {{-- @can('admin.users.edit') --}}
                {{-- <th>Editar</th>
                <th>Eliminar</th> --}}
                {{-- @endcan --}}

            </tr>
        </thead>


        <tbody>
            @foreach ($abonos as $abono)
                <tr>
                    <td>{{$abono->valor}}</td>
                    <td>{{$abono->descripcion}}</td>
                    <td>{{$abono->created_at}}</td>
                                                            
                    {{-- @endcan --}}

                </tr>
            @endforeach
        </tbody>
    </table>




</div>


@stop
