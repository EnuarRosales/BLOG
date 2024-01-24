@extends('template.index')

@section('tittle-tab')
    Pagos
@endsection

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pasarela de pagos</h1>
@stop

@section('styles')

    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" /> --}}



    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('https://fonts.googleapis.com/css?family=Nunito:400,600,700') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/plugins.css') }}" />

    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/css/forms/switches.css') }}" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('plugins/pricing-table/css/component.css') }}" /> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/pricing-table/css/component.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/scrollspyNav.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/font-icons/fontawesome/css/regular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/font-icons/fontawesome/css/fontawesome.css') }}">



    {{-- <style>
        .prueba {
            color: red;
        }
    </style> --}}


@stop


<!-- Use SVG code directly -->
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity">
    <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
</svg>

<!-- OR -->

<!-- Use it inside <i> tag  -->
<i data-feather="activity"></i>




@section('content')
    <p>Planes ajustados al tamano de tu estudio</p>
    <div class="row">
        <div class="col-lg-12">
            <section class="pricing-section bg-7 mt-10">
                <div class="pricing pricing--norbu">
                    <div class="pricing__item">
                        <h3 class="pricing__title prueba">30 Modelos</h3>
                        <p class="pricing__sentence">Para estudios que están iniciando </p>
                        <div class="pricing__price"><span class="pricing__currency">$</span>35<span class="pricing__period">
                                USD/ mes</span></div>
                        <ul class="pricing__feature-list text-center">


                        <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Sin costos de instalación </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg>Sin cláusulas de permanencia </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Configuración del sistema adaptable para cada
                                estudio </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Adaptable y configurable para los diferentes roles
                                dentro del estudio </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de dashboard </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de usuarios </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asignación de turnos </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asignación de rooms </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de metas estudios </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Modulo de metas modelos </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de certificaciones laboral, tiempo,
                                impuesto y pago </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de multas</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asistencias</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de producción</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de descuentos</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de nomina</li>
                        </ul>
                        <button class="pricing__action mx-auto mb-4">Comprar</button>
                    </div>
                    <div class="pricing__item pricing__item--featured">
                        <h3 class="pricing__title">50 Modelos</h3>
                        <p class="pricing__sentence">Para estudios experimentados que desean superar sus limites</p>
                        <div class="pricing__price"><span class="pricing__currency">$</span>55<span
                                class="pricing__period">USD/ mes</span></div>
                        <ul class="pricing__feature-list text-center">
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Sin costos de instalación </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Sin cláusulas de permanencia </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Configuración del sistema adaptable para cada
                                estudio </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Adaptable y configurable para los diferentes roles
                                dentro del estudio </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de dashboard </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de usuarios </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asignación de turnos </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asignación de rooms </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de metas estudios </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Modulo de metas modelos </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de certificaciones laboral, tiempo,
                                impuesto y pago </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de multas</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asistencias</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de producción</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de descuentos</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de nomina</li>
                        </ul>
                        <button class="pricing__action mx-auto mb-4">Comprar</button>
                    </div>
                    <div class="pricing__item">
                        <h3 class="pricing__title">100 Modelos</h3>
                        <p class="pricing__sentence">Para estudios exitosos que han superado sus limites</p>
                        <div class="pricing__price"><span class="pricing__currency">$</span>75<span
                                class="pricing__period">USD/ mes</span></div>
                        <ul class="pricing__feature-list text-center">
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Sin costos de instalación </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Sin cláusulas de permanencia </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Configuración del sistema adaptable para cada
                                estudio </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Adaptable y configurable para los diferentes roles
                                dentro del estudio </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de dashboard </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de usuarios </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asignación de turnos </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asignación de rooms </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de metas estudios </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Modulo de metas modelos </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de certificaciones laboral, tiempo,
                                impuesto y pago </li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de multas</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de asistencias</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de producción</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de descuentos</li>
                            <li class="pricing__feature"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Módulo de nomina</li>
                        </ul>
                        <button class="pricing__action mx-auto mb-4">Comprar</button>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div class="card component-card_2">
        <img src="assets/img/400x300.jpg" class="card-img-top" alt="widget-card-2">
        <div class="card-body">
            <a href="#" class="btn btn-primary">Explore More</a>

            <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
                <input name="merchantId" type="hidden" value="{{ config('services.payU.merchant_id') }}">
                <input name="accountId" type="hidden" value="{{ config('services.payU.account_id') }}">
                <input name="description" type="hidden" value="Pago suscripcion siaewc">
                <input name="referenceCode" type="hidden" value="{{ $payU['referenceCode'] }}">
                <input name="amount" type="hidden" value="140000">
                <input name="tax" type="hidden" value="0">
                <input name="taxReturnBase" type="hidden" value="0">
                <input name="currency" type="hidden" value="{{ config('services.payU.currency') }}">
                <input name="signature" type="hidden" value="{{ $payU['signature'] }}">
                <input name="test" type="hidden" value="1">
                <input name="buyerEmail" type="hidden" value="{{ auth()->user()->email }}">
                <input name="responseUrl" type="hidden" value="http://www.test.com/response">
                <input name="confirmationUrl" type="hidden" value="http://www.test.com/confirmation">
                <input name="Submit" type="submit" value="Enviar">
            </form>







        </div>
    </div>



@endsection

@section('js')

    <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/custom.jss') }}"></script>





    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>

    <!-- with js code  -->
    <script type="text/javascript">
        feather.replace();
    </script>





@stop
