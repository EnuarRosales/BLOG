@extends('template.index')

@section('styles')
    <link href="{{ asset('template/plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/assets/css/dashboard/dash_2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/noUiSlider/nouislider.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('template/plugins/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/noUiSlider/custom-nouiSlider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('template/plugins/bootstrap-range-Slider/bootstrap-slider.css') }}" rel="stylesheet"
        type="text/css">
@endsection

@section('content')
    @can('admin.home')
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="row widget-statistic">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-one_hybrid widget-followers">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </div>

                            @if (is_numeric($dataUsuarios[1]))
                                <p class="w-value" id="usuarios">
                                    {{ $dataUsuarios[1] }}/{{ number_format($dataUsuarios[2], 2) }}%
                                </p>
                                <h5 class="">Usuarios</h5>
                            @else
                                <p class="w-value"><span style="color: red; font-weight: bold;">{{ $dataUsuarios[1] }}</span>
                                </p>
                                <h5 class="">Usuarios</h5>
                            @endif

                        </div>

                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-one_hybrid widget-referral">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-link">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                            </div>
                            <p class="w-value" id="multas">{{ $multas }}</p>
                            <h5 class="">Multas</h5>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-one_hybrid widget-engagement">
                        <div class="widget-heading">
                            <div class="w-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-message-circle">
                                    <path
                                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                                    </path>
                                </svg>
                            </div>
                            <p class="w-value" id="descuentos">COP {{ $descuentos }}</p>
                            <h5 class="">Prestamos</h5>
                        </div>
                        <div class="widget-content">
                            <div class="w-chart">
                                <div id="hybrid_followers3"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
                    <div class="widget widget-card-four" style="height: 22.29rem;">
                        <div class="widget-content">
                            <div class="w-content">
                                <div class="w-info">

                                    @if ($dataMetas[0] > 0)
                                        <h6 class="value" id="meta_cantidad">{{ "$" . ' ' . $dataMetas[0] }}</h6>
                                        <p class="" id="meta_nombre">Meta: {{ $dataMetas[3] }}</p>
                                    @else
                                        <h6 class="value">$ {{ $dataMetas[0] }}</h6>
                                        <p class="">Meta: <span
                                                style="color: red; font-weight: bold;">{{ $dataMetas[3] }}</span></p>
                                    @endif

                                </div>
                                <div class="">
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0"></path>
                                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="progress">
                                {{-- BARRA DE  la  META --}}
                                <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                    style="width: {{ $dataMetas[1] }}%" aria-valuenow="57" aria-valuemin="0"
                                    aria-valuemax="100" id="progeso_meta"></div>
                            </div>

                            @if ($dataMetas[1] >= 100)
                                <div class="w-info">
                                    {{-- <h6 class="value">$ {{$dataMetas[0]}}</h6> --}}
                                    <p class=""><span style="color: green;">Felicitaciones meta alcanzada</span></p>
                                    <p class="">Valor generado: $ {{ $dataMetas[2] }} </p>
                                    <p class="">Diferencia: +$ {{ $dataMetas[2] - $dataMetas[0] }}</p>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div>
                @include('admin.index.partials.tablaAsistenciaPersonal')
            </div>

            <div>
                @include('admin.index.partials.tablaMetaResumen')
            </div>

            {{-- INICIA TABLA --}}

            {{-- TERMINA TABLA --}}
            {{-- HISTORIAL DE METAS --}}

            @include('admin.index.partials.historial_meta_turno')

            {{-- FINAL HISTORIAL DE METAS --}}



            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="mb-4">Using HTML5 input elements</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area align-center">
                            <div class="container">
                                <div id="html5"></div>
                                <br />
                                <div class="row mt-4 mb-4">
                                    <div class="col-lg-6 mb-3">
                                        <select id="input-select" class="form-control"></select>
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="number" class="form-control" min="-20" max="40"
                                            step="1" id="input-number">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="chartLine" class="col-xl-9 layout-top-spacing layout-spacing">
                    <div class="widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Estadistca de produccion quincenal</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div id="s-line" class=""></div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-top-spacing">
                    <div class="widget widget-table-one" style="padding-top: 2rem; height: 31.0rem;">
                        <div class="widget-heading">
                            <h5 class="">Transactions</h5>
                        </div>

                        <div class="widget-content">
                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-home">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Electricity Bill</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-dec">
                                        <p><span>-$16.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-down">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <polyline points="19 12 12 19 5 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>

                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">SP</span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Shaun Park</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>
                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p><span>+$66.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-up">
                                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                                <polyline points="5 12 12 5 19 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>

                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="avatar avatar-xl">
                                                <span class="avatar-title rounded-circle">AD</span>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Amy Diaz</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-inc">
                                        <p><span>+$66.44</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-up">
                                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                                <polyline points="5 12 12 5 19 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>

                            <div class="transactions-list">
                                <div class="t-item">
                                    <div class="t-company-name">
                                        <div class="t-icon">
                                            <div class="icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-home">
                                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="t-name">
                                            <h4>Netflix</h4>
                                            <p class="meta-date">4 Aug 1:00PM</p>
                                        </div>

                                    </div>
                                    <div class="t-rate rate-dec">
                                        <p><span>-$32.00</span> <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-arrow-down">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <polyline points="19 12 12 19 5 12"></polyline>
                                            </svg></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                <div id="chartColumn" class="col-xl-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4>Simple Column</h4>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div id="s-col" class=""></div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    @endsection

    @section('js')
        <script src="{{ asset('template/plugins/apex/apexcharts.min.js') }}"></script>
        <script src="{{ asset('template/assets/js/dashboard/dash_1.js') }}"></script>
        <script src="{{ asset('template/assets/js/dashboard/dash_2.js') }}"></script>


        <script>
            var chart; // Variable global para almacenar el gráfico

            function createChartMulta(data, id) {
                var chartOptions = {
                    // Configuración de tu gráfico
                    chart: {
                        id: id,
                        type: 'area',
                        height: 160,
                        sparkline: {
                            enabled: true
                        },
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    series: [{
                        name: 'Multas',
                        data: data
                    }],
                    labels: ['1', '2', '3', '4', '5', '6', '7'],
                    yaxis: {
                        min: 0
                    },
                    colors: ['#e7515a'],
                    tooltip: {
                        x: {
                            show: false,
                        }
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: .40,
                            opacityTo: .05,
                            stops: [45, 100]
                        }
                    }
                };

                chart = new ApexCharts(document.querySelector("#hybrid_followers1"), chartOptions);
                chart.render();
            }

            function createChartDescuento(data, id) {
                var chartOptions = {
                    // Configuración de tu gráfico
                    chart: {
                        id: id,
                        type: 'area',
                        height: 160,
                        sparkline: {
                            enabled: true
                        },
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    fill: {
                        opacity: 1,
                    },
                    series: [{
                        name: 'Prestamos',
                        data: data
                    }],
                    labels: ['1', '2', '3', '4', '5', '6', '7'],
                    yaxis: {
                        min: 0
                    },
                    colors: ['#8dbf42'],
                    tooltip: {
                        x: {
                            show: false,
                        }
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: .40,
                            opacityTo: .05,
                            stops: [45, 100]
                        }
                    },
                };

                chart = new ApexCharts(document.querySelector("#hybrid_followers3"), chartOptions);
                chart.render();
            }

            function createChartUsuario(data, id) {
                var chartOptions = {
                    chart: {
                        id: id,
                        type: 'area',
                        height: 160,
                        sparkline: {
                            enabled: true
                        },
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2,
                    },
                    series: [{
                        name: 'Modelos Incorporados',
                        data: data
                    }],
                    labels: ['1', '2', '3', '4', '5', '6', '7'],
                    yaxis: {
                        min: 0
                    },
                    colors: ['#1b55e2'],
                    tooltip: {
                        x: {
                            show: false,
                        }
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            type: "vertical",
                            shadeIntensity: 1,
                            inverseColors: !1,
                            opacityFrom: .40,
                            opacityTo: .05,
                            stops: [45, 100]
                        }
                    },
                }

                chart = new ApexCharts(document.querySelector("#hybrid_followers"), chartOptions);
                chart.render();
            }

            function refreshChartDataMulta() {
                // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
                $.ajax({
                    type: 'GET',
                    url: 'getdatamultas', // Reemplaza con la URL correcta
                    success: function(data) {

                        var array_multa = JSON.parse(data);
                        console.log(array_multa);

                        // Actualiza la serie del gráfico con los nuevos datos
                        ApexCharts.exec('multas', 'updateSeries', [{
                            data: array_multa
                        }], true);

                    }
                });
            }

            function refreshChartDataDescuento() {
                // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
                $.ajax({
                    type: 'GET',
                    url: 'getdatadescuentos', // Reemplaza con la URL correcta
                    success: function(data) {

                        var array_descuento = JSON.parse(data);
                        console.log(array_descuento);

                        // Actualiza la serie del gráfico con los nuevos datos
                        ApexCharts.exec('descuento', 'updateSeries', [{
                            data: array_descuento
                        }], true);

                    }
                });
            }

            function refreshChartDataUsuario() {
                // Realiza una petición AJAX para obtener los nuevos datos de la gráfica
                $.ajax({
                    type: 'GET',
                    url: 'getdatausuarios', // Reemplaza con la URL correcta
                    success: function(data) {

                        // var array_descuento = JSON.parse(data);
                        var array_usuarios = JSON.parse(data[0]);

                        console.log(array_usuarios);

                        // Actualiza la serie del gráfico con los nuevos datos
                        ApexCharts.exec('usuario', 'updateSeries', [{
                            data: array_usuarios
                        }], true);

                    }
                });
            }

            $(document).ready(function() {
                createChartMulta({{ $dataMultas }}, 'multas');
                createChartDescuento({{ $dataDescuentos }}, 'descuento');
                createChartUsuario({{ $dataUsuarios[0] }}, 'usuario');


                // Crear la gráfica inicial al cargar la página

                window.Echo.channel('multas_widget')
                    .listen('.reload-multas', (e) => {
                        // Actualiza el contenido dentro del div con la clase 'widget-referral'
                        $('#multas').load(location.href + ' #multas', function() {
                            // ApexCharts.exec('multas', 'updateSeries', [{
                            //     data: {{ $dataMultas }}
                            // }], true);
                            refreshChartDataMulta();
                        });


                    });

                window.Echo.channel('metas_widget')
                    .listen('.reload-metas', (data) => {

                        //console.log(data.estatico);
                        $('#meta_cantidad').load(location.href + ' #meta_cantidad');
                        $('#meta_nombre').load(location.href + ' #meta_nombre');
                        $('#table_resumenmeta').load(location.href + ' #table_resumenmeta');
                        $('#segunda_meta').load(location.href + ' #segunda_meta');
                        $('#segunda_meta_progreso').load(location.href + ' #segunda_meta_progreso');
                        $('#tercera_meta').load(location.href + ' #tercera_meta');
                        $('#cuarta_meta').load(location.href + ' #cuarta_meta');


                        var historialmetas = data.historialmetas;

                        console.log(historialmetas);
                        // Función para actualizar la barra de progreso
                        function actualizarBarraDeProgreso() {
                            var barraDeProgreso = document.getElementById('progeso_meta');
                            var valorProgreso = historialmetas[1] + '%';
                            //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                            barraDeProgreso.style.width = valorProgreso;

                            var barraDeProgreso2 = document.getElementById('segunda_meta_progreso');
                            var valorProgreso2 = historialmetas[5] + '%';
                            //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                            barraDeProgreso2.style.width = valorProgreso2;

                            var barraDeProgreso3 = document.getElementById('tercera_meta_progreso');
                            var valorProgreso3 = historialmetas[9] + '%';
                            //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                            barraDeProgreso3.style.width = valorProgreso3;

                            var barraDeProgreso4 = document.getElementById('cuarta_meta_progreso');
                            var valorProgreso4 = historialmetas[13] + '%';
                            //barraDeProgreso.setAttribute('aria-valuenow', progreso);
                            barraDeProgreso4.style.width = valorProgreso4;
                        }

                        // Llama a la función para actualizar la barra de progreso
                        actualizarBarraDeProgreso();


                    });



                window.Echo.channel('descuentos_widget')
                    .listen('.reload-descuentos', (e) => {

                        $('#descuentos').load(location.href + ' #descuentos');
                        refreshChartDataDescuento();
                    });


                window.Echo.channel('usuarios_widget')
                    .listen('.reload-usuarios', (e) => {

                        $('#usuarios').load(location.href + ' #usuarios');
                        refreshChartDataUsuario();
                    });

                window.Echo.channel('control_asistencia')
                    .listen('.reload-asistencia', (e) => {

                        $('#table_controlasistencia').load(location.href + ' #table_controlasistencia');

                    });
                window.Echo.channel('control_turnos')
                    .listen('.reload-turnos', (e) => {

                        console.log(e);

                        function actualizarBarraDeProgresoTurnos() 
                        {
                            
                        }

                    });
            });
        </script>
        {{-- GRAFICA PRESTAMOS --}}
        {{-- <script>
            // Engagement Rate
            var d_1options5 = {
                chart: {
                    id: 'sparkline1',
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                fill: {
                    opacity: 1,
                },
                series: [{
                    name: 'Prestamos',
                    data: {{ $dataDescuentos }}
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#8dbf42'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
            }

            // Engagement Rate
            var d_1C_7 = new ApexCharts(document.querySelector("#hybrid_followers3"), d_1options5);
            d_1C_7.render()
        </script> --}}


        {{-- GRAFICA MULTAS --}}

        {{-- <script>
            var d_1options4 = {
                chart: {
                    id: 'sparkline1',
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Multas',
                    data: {{ $dataMultas }}
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#e7515a'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
            }

            var d_1C_6 = new ApexCharts(document.querySelector("#hybrid_followers1"), d_1options4);
            d_1C_6.render()
        </script> --}}

        {{-- GRAFICA USUARIOS --}}
        {{-- <script>
            var d_1options3 = {
                chart: {
                    id: 'sparkline1',
                    type: 'area',
                    height: 160,
                    sparkline: {
                        enabled: true
                    },
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Modelos Incorporados',
                    data: {{ $dataUsuarios[0] }}
                }],
                labels: ['1', '2', '3', '4', '5', '6', '7'],
                yaxis: {
                    min: 0
                },
                colors: ['#1b55e2'],
                tooltip: {
                    x: {
                        show: false,
                    }
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        type: "vertical",
                        shadeIntensity: 1,
                        inverseColors: !1,
                        opacityFrom: .40,
                        opacityTo: .05,
                        stops: [45, 100]
                    }
                },
            }

            var d_1C_5 = new ApexCharts(document.querySelector("#hybrid_followers"), d_1options3);
            d_1C_5.render()
        </script> --}}




        {{-- Using HTML5 input elements --}}
        <script>
            var html5Slider = document.getElementById('html5');

            noUiSlider.create(html5Slider, {
                start: [10, 30],
                connect: true,
                tooltips: true,
                range: {
                    'min': -20,
                    'max': 40
                }
            });
        </script>

        {{-- Apex (Simple) --}}
        <script>
            var sline = {
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                series: [{
                    name: "Prooduccion",
                    data: {{ $dataQuincenas[0] }},




                }],
                title: {
                    text: 'Facturado por quincena',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f1f2f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: {{ $dataQuincenas[0] }},







                }
            }

            var chart = new ApexCharts(
                document.querySelector("#s-line"),
                sline
            );

            chart.render();
        </script>
        {{-- Simple Column --}}
        <script>
            var sCol = {
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false,
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                series: [{
                    name: 'Net Profit',
                    data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
                }, {
                    name: 'Revenue',
                    data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
                }],
                xaxis: {
                    categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                },
                yaxis: {
                    title: {
                        text: '$ (thousands)'
                    }
                },
                fill: {
                    opacity: 1

                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return "$ " + val + " thousands"
                        }
                    }
                }
            }

            var chart = new ApexCharts(
                document.querySelector("#s-col"),
                sCol
            );

            chart.render();
        </script>
        <script src="{{ asset('template/assets/js/scrollspyNav.js') }}"></script>
        <script src="{{ asset('template/plugins/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('template/plugins/noUiSlider/nouislider.min.js') }}"></script>
        <script src="{{ asset('template/plugins/flatpickr/custom-flatpickr.js') }}"></script>
        <script src="{{ asset('template/plugins/noUiSlider/custom-nouiSlider.js') }}"></script>
        <script src="{{ asset('template/plugins/bootstrap-range-Slider/bootstrap-rangeSlider.js') }}"></script>
    @endsection
