@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar roles</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            {!! Form::model($role, ['route' => ['admin.roles.update', $role], 'method' => 'put']) !!}
            @include('admin.roles.partials.form')


            {!! Form::submit('Editar rol', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>


@stop
