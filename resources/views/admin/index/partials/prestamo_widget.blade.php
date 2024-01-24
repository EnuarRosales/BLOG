<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
    <div class="widget widget-one_hybrid widget-engagement">
        <div class="widget-heading">
            <a class="w-icon" href="{{ route('admin.registroDescuentos.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-dollar-sign">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                </svg>
            </a>
            <p class="w-value" id="descuentos">COP
                {{ $descuentos == intval($descuentos) ? number_format($descuentos, 0, ',', '.') : number_format($descuentos, 2, ',', '.') }}
            </p>
            <h5 class="">Prestamos</h5>
        </div>
        <div class="widget-content">
            <div class="w-chart">
                <div id="hybrid_followers3"></div>
            </div>
        </div>
    </div>
</div>
