<div class="row layout-top-spacing">
    <div class="col-xl-9 col-lg-9 col-md-9 col-sm-9 col-9 layout-spacing">
        <div class="widget widget-table-three">
            <div class="widget-heading">
                <a class="w-icon" href="{{ route('admin.registroAsistencias.index') }}">
                <h5 class="">Control de asistencia</h5> </a>
            </div>
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table" id="table_controlasistencia">

                        @if (empty($dataAsistencias))
                            <p class="row justify-content-center">No hay datos para mostrar...</p>
                        @else
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Turno</th>
                                    <th>Multa</th>
                                    <th>Control</th>
                                </tr>
                            </thead>
                        @endif

                        <tbody>

                            @if (empty($dataAsistencias))
                                <p> </p>
                            @else
                                @foreach ($dataAsistencias as $dataAsistencia)
                                    <tr>
                                        <td>{{ $dataAsistencia['name'] }}</td>
                                        <td>{{ $dataAsistencia['fecha'] }}</td>
                                        <td>
                                            {{ date('g:i a', strtotime($dataAsistencia['mi_hora'])) }}
                                        </td>

                                        <td>{{ $dataAsistencia['nombre'] }}</td>

                                        {{-- <td>#</td> --}}

                                        <td>
                                            @if ($dataAsistencia['multa_id'] == null)
                                                <span class="badge badge-success"> No </span>
                                            @else
                                                <span class="badge badge-danger">Si</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if ($dataAsistencia['control'] == 'A Tiempo')
                                                <span class="badge badge-success"> {{ $dataAsistencia['control'] }}
                                                </span>
                                            @elseif ($dataAsistencia['control'] == 'No tiene turno asignado')
                                                <span class="badge badge-info"> {{ $dataAsistencia['control'] }} </span>
                                            @elseif ($dataAsistencia['control'] == 'Retardado')
                                                <span class="badge badge-danger"> {{ $dataAsistencia['control'] }}
                                                </span>
                                            @else
                                                <span class="badge badge-warning"> {{ $dataAsistencia['control'] }}
                                                </span>
                                            @endif

                                        </td>

                                    </tr>
                                @endforeach



                            @endif




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 layout-spacing">
        <div class="widget widget-table-one" style=" height: 22.0rem;">
            <div class="widget-heading">
                <h5 class="">Control de Inasistencias</h5>
            </div>
            <div style="max-height: 400px; overflow-y: auto;">
                <div class="widget-content">
                    @foreach ($totalPagosPorFecha as $index => $dataQuincena)
                        <div class="transactions-list">
                            <div class="t-item">
                                <div class="t-company-name">
                                    <div class="t-icon">
                                        <div class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="t-name">
                                        <h4>{{ $index }}</h4>
                                        <p class="meta-date">Quincena</p>
                                    </div>
                                </div>
                                <div class="t-name">
                                    <h4> $ {{ $dataQuincena }} </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-three">
                <div class="widget-heading">
                    <h5 class="">Cntrol de asistencia <span style="color: red; font-weight: bold;"> Programa una meta
                        </span></h5>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Multa</th>
                                    <th>Control</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
