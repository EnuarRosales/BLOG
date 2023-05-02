@extends('adminlte::page')

@section('title', 'Studio WC')

@section('content_header')
    <h1>Sitema Administracion Studio</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    ACA IRIAN LAS GRAFICAS
    <h1> modelos en la base de datos: {{$user}}</h1>
    <h1> porcentaje: {{$porcentajeUser}}%</h1>
    <h1> multas conteo: {{$asignacionMultas}}</h1>   

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop