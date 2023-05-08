@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Crear Rol</h1>
@stop

@section('content')
@section('content')
    <div class="card">
        <div class="card-body">

            {!! Form::open(['route' => 'admin.roles.store']) !!}
{{-- reutilizacdiond de codigo gracias al partial ya que se va a usar en varias partes --}}
            @include('admin.roles.partials.form') 
                    

            {!! Form::submit('Crear Usuario', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}

        </div>

    </div>
@stop
