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
            <p class="w-value" id="descuentos">COP {{ ($descuentos== intval($descuentos)) ? number_format($descuentos, 0, ',', '.') : number_format($descuentos, 2, ',', '.') }}</p>
            <h5 class="">Prestamos</h5>
        </div>
        <div class="widget-content">
            <div class="w-chart">
                <div id="hybrid_followers3"></div>
            </div>
        </div>
    </div>
</div>
