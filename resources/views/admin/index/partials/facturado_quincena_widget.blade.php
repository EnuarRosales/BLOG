<div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12 layout-top-spacing">
    <div class="widget widget-table-one" style="padding-top: 2rem; height: 31.0rem;">
        <div class="widget-heading">
            <h5 class="">Facturado por periodo en dolares</h5>
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
                                    <p class="meta-date">Periodo</p>
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
