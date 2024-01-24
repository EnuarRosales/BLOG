<div class="row layout-top-spacing">
    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading">
                <a class="w-icon" href="{{ route('admin.registroProducidoss.reporte_dia') }}">
                    <h5 class="">Control historial metas del estudio</h5>
                </a>
            </div>
            <div class="widget-content">
                <div class="vistorsBrowser">
                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-trending-up">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </div>

                        <div class="w-browser-details">
                            <div class="w-browser-info" id="segunda_meta">
                                <h6>{{ $dataHistorialMetas[4] }} - Proyectado $ {{ $dataHistorialMetas[7] }} -
                                    Generado $ {{ $dataHistorialMetas[6] }}</h6>
                                <p class="browser-count">{{ $dataHistorialMetas[5] }}%</p>
                            </div>
                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-primary" role="progressbar"
                                        style="width: {{ $dataHistorialMetas[5] }}%" aria-valuenow="90"
                                        aria-valuemin="0" aria-valuemax="100" id="segunda_meta_progreso">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-trending-up">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </div>
                        <div class="w-browser-details">

                            <div class="w-browser-info" id="tercera_meta">
                                <h6>{{ $dataHistorialMetas[8] }} - Proyectado $ {{ $dataHistorialMetas[11] }} -
                                    Generado $ {{ $dataHistorialMetas[10] }}</h6>
                                <p class="browser-count">{{ $dataHistorialMetas[9] }}%</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar"
                                        style="width: {{ $dataHistorialMetas[9] }}%" aria-valuenow="65"
                                        aria-valuemin="0" aria-valuemax="100" id="tercera_meta_progreso">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-trending-up">
                                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                <polyline points="17 6 23 6 23 12"></polyline>
                            </svg>
                        </div>
                        <div class="w-browser-details">

                            <div class="w-browser-info" id="cuarta_meta">
                                <h6>{{ $dataHistorialMetas[12] }} - Proyectado $ {{ $dataHistorialMetas[15] }} -
                                    Generado $ {{ $dataHistorialMetas[14] }}</h6>
                                <p class="browser-count">{{ $dataHistorialMetas[13] }}%</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                        style="width: {{ $dataHistorialMetas[13] }}%" aria-valuenow="15"
                                        aria-valuemin="0" aria-valuemax="100" id="cuarta_meta_progreso">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 layout-spacing">
        <div class="widget-three">
            <div class="widget-heading">
                <a class="w-icon" href="{{ route('admin.asignacionTurnos.index') }}">
                    <h5 class=""> Control turnos <span
                            style="color: red; font-weight: bold;">{{ $dataTurnos[6] }}</span> </h5>
                </a>

            </div>
            <div class="widget-content">
                <div class="order-summary">
                    <div class="summary-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="w-summary-details">

                            <div class="w-summary-info">
                                <h6>Manaña</h6>
                                <p class="summary-count" id="cantidad_manana">Turnos: {{ $dataTurnos[1] }}</p>
                            </div>

                            <div class="w-summary-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                        style="width: {{ $dataTurnos[0] }}%" aria-valuenow="90" aria-valuemin="0"
                                        aria-valuemax="100" id="progreso_manana">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="summary-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="w-summary-details">
                            <div class="w-summary-info">
                                <h6>Tarde</h6>
                                <p class="summary-count" id="cantidad_tarde">Turnos: {{ $dataTurnos[3] }}</p>
                            </div>
                            <div class="w-summary-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                        style="width: {{ $dataTurnos[2] }}%" aria-valuenow="65" aria-valuemin="0"
                                        aria-valuemax="100" id="progreso_tarde">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="summary-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <div class="w-summary-details">
                            <div class="w-summary-info">
                                <h6>Noche</h6>
                                <p class="summary-count" id="cantidad_noche">Turnos: {{ $dataTurnos[5] }}</p>
                            </div>

                            <div class="w-summary-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                        style="width: {{ $dataTurnos[4] }}%" aria-valuenow="80" aria-valuemin="0"
                                        aria-valuemax="100" id="progreso_noche">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
