<div class="row layout-top-spacing">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
        <div class="widget widget-table-three">
            <div class="widget-heading">
                <h5 class="">Control de asistencia</h5>
            </div>
            <div class="widget-content">
                <div class="table-responsive">
                    <table class="table" id="table_controlasistencia">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                {{-- <th>Turno</th> --}}
                                <th>Multa</th>
                                <th>Control</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataAsistencias as $dataAsistencia)
                                <tr>
                                    <td>{{ $dataAsistencia->user->name }}</td>
                                    <td>{{ $dataAsistencia->fecha }}</td>
                                    <td>
                                        {{ date('g:i a', strtotime($dataAsistencia->mi_hora)) }}
                                    </td>

                                    {{-- <td>#</td> --}}

                                    <td>
                                        @if ($dataAsistencia->multa_id == null)
                                            <span class="badge badge-success"> No </span>
                                        @else
                                            <span class="badge badge-danger">Si</span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($dataAsistencia->control == "A Tiempo")
                                            <span class="badge badge-success"> {{ $dataAsistencia->control }} </span>
                                        @elseif ($dataAsistencia->control == "No tiene turno asignado")
                                            <span class="badge badge-info"> {{ $dataAsistencia->control }} </span>
                                        @elseif ($dataAsistencia->control == "Retardado")
                                            <span class="badge badge-danger"> {{ $dataAsistencia->control }} </span>
                                        @else
                                            <span class="badge badge-warning"> {{ $dataAsistencia->control }} </span>
                                        @endif

                                        {{-- <span
                                            class="{{ $dataAsistencia->control === 'A Tiempo' ? 'badge badge-success' : ($dataAsistencia->control === $configAsistencia->nombre ? 'badge badge-warning' : ($dataAsistencia->control === 'No tiene turno asignado' ? 'badge badge-info' : 'badge badge-danger')) }}">
                                            {{ $dataAsistencia->control }}
                                        </span> --}}
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
