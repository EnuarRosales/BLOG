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

 
    @can('admin.home')
        <div class="col-12">
            <div class="row">
                <div class="col">
                    <x-adminlte-small-box title={{$user}} text="{{$porcentajeUser}}%   Modelos"
                        icon="fa fa-user-plus fa-lg" theme="primary" url="{{ route('admin.users.index') }}"
                        url-text="Ver los Usuarios" />
                </div>
                
                <div class="col">
                    {{-- Updatable --}}
                    
                    <x-adminlte-small-box title={{$asignacionMultas}} text="Multas" icon="fas fa-medal text-dark"
                        theme="danger" url="#" url-text="ver las multas" id="sbUpdatable" />
                </div>
                <div class="col">
                    <x-adminlte-small-box title="{{$asignacionMultas . ' ' . $porcentajeUser }} %" text="otro valor"
                        icon="fas fa-user-plus text-teal" theme="primary" url="#" url-text="View all users" />
                </div>





                {{-- <div class="col">
                <x-adminlte-small-box title="Loading" text="Loading data..." icon="fas fa-chart-bar" theme="info"
                    url="#" url-text="More info" loading />
            </div> --}}
            </div>

            <div class="row">
                <div class="col-8">
                    <x-adminlte-info-box title="Meta" text="75/100" icon="fas fa-lg fa-tasks text-orange" theme="warning"
                        
                    
                    icon-theme="dark" progress=99 progress-theme="dark"
                        description="98% of the tasks have been completed" />
                        
                </div>

                
                <div class="col-4">
                    <x-adminlte-info-box title="Meta" text="75/100" icon="fas fa-lg fa-tasks text-orange" theme="warning"
                        icon-theme="dark" progress=100 progress-theme="dark"
                        description="75% of the tasks have been completed" />
                </div>
            </div>

            <div class="row">
                <div class="col-4">
                    <h2>Modelos</h2>
                    <table id="users" class="table table-striped table-bordered shadow-lg mt-4">
                        <thead>
                            <tr>
                                {{-- <th>ID</th> --}}
                                <th>Nombre</th>
                                {{-- <th>Cedula</th> --}}
                                <th>Celular</th>
                                {{-- <th>Direccion</th> --}}
                                {{-- <th>Email</th> --}}
                                {{-- <th>Tipo Usuario</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userModelos as $userModelo)
                                <tr>
                                    {{-- <td>{{ $userModelo->id }}</td> --}}
                                    <td>{{ $userModelo->name }}</td>
                                    {{-- <td>{{ $userModelo->cedula }}</td> --}}
                                    <td>{{ $userModelo->celular }}</td>
                                    {{-- <td>{{ $userModelo->direccion }}</td> --}}
                                    {{-- <td>{{ $userModelo->email }}</td> --}}
                                    {{-- <td>{{ $userModelo->tipoUsuario->nombre }}</td> --}}


                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                
                    <div class="col-4">
                        <table id="users" class="table table-striped table-bordered shadow-lg mt-4">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Nombre</th>
                                    {{-- <th>Cedula</th> --}}
                                    <th>Celular</th>
                                    {{-- <th>Direccion</th> --}}
                                    {{-- <th>Email</th> --}}
                                    {{-- <th>Tipo Usuario</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userModelos as $userModelo)
                                    <tr>
                                        {{-- <td>{{ $userModelo->id }}</td> --}}
                                        <td>{{ $userModelo->name }}</td>
                                        {{-- <td>{{ $userModelo->cedula }}</td> --}}
                                        <td>{{ $userModelo->celular }}</td>
                                        {{-- <td>{{ $userModelo->direccion }}</td> --}}
                                        {{-- <td>{{ $userModelo->email }}</td> --}}
                                        {{-- <td>{{ $userModelo->tipoUsuario->nombre }}</td> --}}


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="col-4">
                        <table id="users" class="table table-striped table-bordered shadow-lg mt-4">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Nombre</th>
                                    {{-- <th>Cedula</th> --}}
                                    <th>Celular</th>
                                    {{-- <th>Direccion</th> --}}
                                    {{-- <th>Email</th> --}}
                                    {{-- <th>Tipo Usuario</th> --}}

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userModelos as $userModelo)
                                    <tr>
                                        {{-- <td>{{ $userModelo->id }}</td> --}}
                                        <td>{{ $userModelo->name }}</td>
                                        {{-- <td>{{ $userModelo->cedula }}</td> --}}
                                        <td>{{ $userModelo->celular }}</td>
                                        {{-- <td>{{ $userModelo->direccion }}</td> --}}
                                        {{-- <td>{{ $userModelo->email }}</td> --}}
                                        {{-- <td>{{ $userModelo->tipoUsuario->nombre }}</td> --}}


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                


            </div>
        </div>




        </div>
    @endcan

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>


    <script>
        let myInfoBox = new _AdminLTE_InfoBox("myInfoBox");
    </script>
@stop
