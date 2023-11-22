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
            <div id="usuarios">
                @if (is_numeric($dataUsuarios[1]))
                    <p class="w-value">
                        {{ $dataUsuarios[1] }}/{{ number_format($dataUsuarios[2], 2) }}%
                    </p>
                    <h5 class="">Usuarios</h5>
                @else
                    <p class="w-value"><span
                            style="color: red; font-weight: bold;">{{ $dataUsuarios[1] }}</span>
                    </p>
                    <h5 class="">Usuarios</h5>
                @endif
            </div>
        </div>

        <div class="widget-content">
            <div class="w-chart">
                <div id="hybrid_followers"></div>
            </div>
        </div>
    </div>
</div>
