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
                    <livewire:admin.dashboard-models-graphics />
                </div>

                <div class="col">
                    <livewire:admin.dashboard-multas-graphics />
                    {{-- @livewire('admin.dashboard-multas-graphics') --}}
                </div>
                <div class="col">
                    <x-adminlte-small-box title="{{ $count_multas_user . ' ' . $count_multas_user }} %" text="otro valor"
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

            <div>
                <h1>{{ $chart->options['chart_title'] }}</h1>
                {!! $chart->renderHtml() !!}
            </div>
            
            <div class="row">
                <div class="col-4">
                    <h2>Turnos</h2>
                    <livewire:admin.dashboard-asignacion-turnos-table />
                </div>
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
            </div>
        </div>
        </div>

    @endcan
@stop
@vite('resources/js/app.js')
@section('js')
    <script type="module">
        Echo.channel(`userModelUpdateCreate`)
            .listen('userModelEvent', (e) => {
                //console.log(e);
                Livewire.emit('renderModels');
            });

        Echo.channel(`multaUpdateCreate`)
            .listen('multaEvent', (e) => {
                //console.log(e);
                Livewire.emit('renderMultas');
            });
    </script>
    <script>
        let myInfoBox = new _AdminLTE_InfoBox("myInfoBox");
    </script>



    {!! $chart->renderChartJsLibrary() !!}
    {!! $chart->renderJs() !!}





@stop
