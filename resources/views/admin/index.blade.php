@extends('adminlte::page')

@section('title', 'Studio WC')

@section('content_header')
    <h1>Sitema Administracion Studio</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
    {{-- ACA IRIAN LAS GRAFICAS
    <h1> modelos en la base de datos:{{ $user }}</h1>
    <h1> porcentaje: {{ $porcentajeUser }}</h1>
    <h1> multas conteo: {{ $asignacionMultas }}</h1> --}}


    <div class="container text-center">
        <div class="row">
            <div class="col">
                <x-adminlte-small-box title={{$user}} text="Modelos activos" icon="fa fa-user-plus fa-lg"
                    theme="primary" url="{{ route('admin.users.index') }}" url-text="Ver los Usuarios" />


            </div>
            <div class="col">
                {{-- Updatable --}}
                <x-adminlte-small-box title={{$asignacionMultas}} text="Multas" icon="fas fa-medal text-dark" theme="danger"
                    url="#" url-text="ver las multas" id="sbUpdatable" />
            </div>
            <div class="col">
                <x-adminlte-small-box title="{{$asignacionMultas.' ____'.$porcentajeUser}} %" text="otro valor" icon="fas fa-user-plus text-teal"
                    theme="primary" url="#" url-text="View all users" />
            </div>


            
            {{-- <div class="col">
                <x-adminlte-small-box title="Loading" text="Loading data..." icon="fas fa-chart-bar" theme="info"
                    url="#" url-text="More info" loading />
            </div> --}}
        </div>

        <div class="row">
            <div class="col-8">col-8</div>
            <div class="col-4">col-4</div>
          </div>
        </div>


    @stop

    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
        <script>
            console.log('Hi!');
        </script>
    @stop
