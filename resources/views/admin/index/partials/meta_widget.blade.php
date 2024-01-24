<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">
    <div class="widget widget-card-four" style="height: 22.29rem;">
        <div class="widget-content">
            <div class="w-content">
                <div class="w-info">

                    @if ($dataMetas[0] > 0)
                        <h6 class="value" id="meta_cantidad">$
                            {{ $dataMetas[0] == intval($dataMetas[0]) ? number_format($dataMetas[0], 0, ',', '.') : number_format($dataMetas[0], 2, ',', '.') }}
                        </h6>
                        <p class="" id="meta_nombre">Meta: {{ $dataMetas[3] }}</p>
                    @else
                        <h6 class="value" id="meta_cantidad">$ {{ $dataMetas[0] }}</h6>
                        <p class="" id="meta_nombre">Meta: <span
                                style="color: red; font-weight: bold;">{{ $dataMetas[3] }}</span></p>
                    @endif

                </div>
                <a class="w-icon" href="{{ route('admin.registroProducidos.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-target">
                        <circle cx="12" cy="12" r="10"></circle>
                        <circle cx="12" cy="12" r="6"></circle>
                        <circle cx="12" cy="12" r="2"></circle>
                    </svg>
                </a>
            </div>
            <div class="progress">
                {{-- BARRA DE  la  META --}}
                <div class="progress-bar bg-gradient-secondary" role="progressbar" style="width: {{ $dataMetas[1] }}%"
                    aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" id="progeso_meta"></div>
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
