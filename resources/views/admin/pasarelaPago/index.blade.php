@extends('template.index')

@section('tittle-tab')
    Pagos
@endsection

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pasarella de pagos</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                {{-- <x-jet-welcome /> --}}
                <div>
                    <p class="mb-2"> Monto a Pagar</p>
                    <div class="alert alert-outline-primary mb-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg> ... </svg></button>
                        <strong>Primary!</strong> 140.000 COT
                    </div> 
                    <div>
                        <p class="mb-4">Seleccione un metodo de pago</p>
                        <ul class="space-y-4">
                            <ul>
                                {{-- Pay U --}}

                                <button>
                                    <img src="https://www.klipartz.com/es/sticker-png-rmtov" alt="">
                                </button>
                            </ul>
                            <ul>
                                Nequi
                            </ul>

                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">   

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" />
@stop



@section('js')

@stop
