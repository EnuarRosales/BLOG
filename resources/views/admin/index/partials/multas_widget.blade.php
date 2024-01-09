<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
    <div class="widget widget-one_hybrid widget-referral">
        <div class="widget-heading">

            <a class="w-icon" href="{{ route('admin.asignacionMultas.index') }}"> <svg xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-meh">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="8" y1="15" x2="16" y2="15"></line>
                    <line x1="9" y1="9" x2="9.01" y2="9"></line>
                    <line x1="15" y1="9" x2="15.01" y2="9"></line>
                </svg> </a>

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
