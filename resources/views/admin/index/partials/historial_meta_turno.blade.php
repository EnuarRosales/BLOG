<div class="row layout-top-spacing">
    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
        <div class="widget-four">
            <div class="widget-heading">
                <h5 class="">Control historial metas del estudio</h5>
            </div>
            <div class="widget-content">
                <div class="vistorsBrowser">
                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="4"></circle>
                                <line x1="21.17" y1="8" x2="12" y2="8"></line>
                                <line x1="3.95" y1="6.06" x2="8.54" y2="14"></line>
                                <line x1="10.88" y1="21.94" x2="15.46" y2="14"></line>
                            </svg>
                        </div>

                        <div class="w-browser-details">
                            <div class="w-browser-info" id="segunda_meta">
                                <h6>{{ $dataHistorialMetas[4] }} - Proyectado $ {{ $dataHistorialMetas[7] }} -
                                    Generado $ {{ number_format($dataHistorialMetas[6], 2) }}</h6>
                                <p class="browser-count">{{ number_format($dataHistorialMetas[5], 1) }}%</p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon>
                            </svg>
                        </div>
                        <div class="w-browser-details">

                            <div class="w-browser-info" id="tercera_meta">
                                <h6>{{ $dataHistorialMetas[8] }} - Proyectado $ {{ $dataHistorialMetas[11] }} -
                                    Generado $ {{ number_format($dataHistorialMetas[10], 2) }}</h6>
                                <p class="browser-count">{{ number_format($dataHistorialMetas[9], 1) }}%</p>
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
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M82.949,1559c3.826,30.183,27.577,54.084,57.577,57.91v-57.91H82">
                                </path>
                            </svg>
                        </div>
                        <div class="w-browser-details">

                            <div class="w-browser-info" id="cuarta_meta">
                                <h6>{{ $dataHistorialMetas[12] }} - Proyectado $ {{ $dataHistorialMetas[15] }} -
                                    Generado $ {{ number_format($dataHistorialMetas[14], 2) }}</h6>
                                <p class="browser-count">{{ number_format($dataHistorialMetas[13], 1) }}%</p>
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
                <h5 class=""> Control turnos <span
                        style="color: red; font-weight: bold;">{{ $dataTurnos[6] }}</span> </h5>
            </div>
            <div class="widget-content">

                <div class="order-summary">

                    <div class="summary-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-shopping-bag">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>
                        </div>
                        <div class="w-summary-details">

                            <div class="w-summary-info">
                                <h6>Manaña</h6>
                                <p class="summary-count">Modelos: {{ $dataTurnos[1] }}</p>
                            </div>

                            <div class="w-summary-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-secondary" role="progressbar"
                                        style="width: {{ $dataTurnos[0] }}%" aria-valuenow="90"
                                        aria-valuemin="0" aria-valuemax="100" id="progreso_manana">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="summary-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                                <path
                                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                </path>
                                <line x1="7" y1="7" x2="7" y2="7"></line>
                            </svg>
                        </div>
                        <div class="w-summary-details">

                            <div class="w-summary-info">
                                <h6>Tarde</h6>
                                <p class="summary-count">Modelos: {{ $dataTurnos[3] }}</p>
                            </div>

                            <div class="w-summary-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-success" role="progressbar"
                                        style="width: {{ $dataTurnos[2] }}%" aria-valuenow="65"
                                        aria-valuemin="0" aria-valuemax="100" id="progreso_tarde">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="summary-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-credit-card">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2">
                                </rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                        </div>
                        <div class="w-summary-details">

                            <div class="w-summary-info">
                                <h6>Noche</h6>
                                <p class="summary-count">Modelos: {{ $dataTurnos[5] }}</p>
                            </div>

                            <div class="w-summary-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-warning" role="progressbar"
                                        style="width: {{ $dataTurnos[4] }}%" aria-valuenow="80"
                                        aria-valuemin="0" aria-valuemax="100" id="progreso_noche">
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