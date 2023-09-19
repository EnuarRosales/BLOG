@extends('template.index')

@section('tittle-tab')
    Reporte de Descuentos-Descuento Parcial
@endsection

@section('page-title')
    <a href="{{ route('admin.registroDescuentos.index') }}">Reporte de Descuentos</a>

@endsection

@section('content_header')
    <h2>Descuento Parcial</h2>
@stop

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" />
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @yield('content_header')
                        </div>

                    </div>
                    @include('admin.abonos.partials.form')

                </div>
            </div>
            @if ($abonos->count())

                <div class="table-responsive mb-4 mt-4">

                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Monto a Descuentar</th>
                                <th>Monto Descontado</th>
                                <th>Saldo</th>
                                <th>Tipo Descuento</th>
                                <th>Usuario</th>
                                @can('admin.registroDescuentos.total')
                                    <th>Descontar</th>
                                @endcan
                                @can('admin.registroDescuentos.parcial')
                                    <th>Descontar</th>
                                @endcan
                                @can('admin.registroDescuentos.edit')
                                    <th>Editar</th>
                                @endcan
                                @can('admin.registroDescuentos.destroy')
                                    <th>Eliminar</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($registroDescuentos as $registroDescuento)
                                @if (auth()->user()->hasRole('Administrador'))
                                    @include('admin.registroDescuentos.partials.table')
                                @elseif (auth()->user()->hasRole('Monitor'))
                                    @include('admin.registroDescuentos.partials.table')
                                @elseif($registroDescuento->user->id == $userLogueado)
                                    @include('admin.registroDescuentos.partials.table')
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Monto a Descuentar</th>
                                <th>Monto Descontado</th>
                                <th>Saldo</th>
                                <th>Tipo Descuento</th>
                                <th>Usuario</th>
                                @can('admin.registroDescuentos.total')
                                    <th>Descontar</th>
                                @endcan
                                @can('admin.registroDescuentos.parcial')
                                    <th>Descontar</th>
                                @endcan
                                @can('admin.registroDescuentos.edit')
                                    <th>Editar</th>
                                @endcan
                                @can('admin.registroDescuentos.destroy')
                                    <th>Eliminar</th>
                                @endcan
                            </tr>
                        </tfoot>

                    </table>

                </div>
            @endif

        </div>
    </div>

    {{-- <div class="card">
        <div class="card-body">
        </div>

        @include('admin.abonos.partials.form')

        @if ($abonos->count())
            <h2 class="h3">Listado abonos realizados</h2>
            <div class="card">

                <div class="card-body">


                    <table id="roles" class="table table-striped table-bordered shadow-lg mt-4">
                        <thead>
                            <tr>
                                <th>Valor</th>
                                <th>Descripcion</th>
                                <th>Fecha</th>

                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($abonos as $abono)
                                <tr>
                                    <td>{{ $abono->valor }}</td>
                                    <td>{{ $abono->descripcion }}</td>
                                    <td>{{ $abono->created_at }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div> --}}


@stop

@section('js')

    <script src="{{ asset('template/plugins/table/datatable/datatables.js') }}"></script>
    <!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
    <script src="{{ asset('template/plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script>
        $('#html5-extension').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [{
                        extend: 'copy',
                        className: 'btn'
                    },
                    {
                        extend: 'csv',
                        className: 'btn'
                    },
                    {
                        extend: 'excel',
                        className: 'btn'
                    },
                    {
                        extend: 'print',
                        className: 'btn'
                    }
                ]
            },
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "lengthChange": true,
                "sInfo": "Página _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>
    <script src="{{ asset('assets/libs/switchery/switchery.min.js') }}"></script>
@stop
