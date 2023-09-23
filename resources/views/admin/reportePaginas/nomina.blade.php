@extends('template.index')

@section('tittle-tab')
    Reporte de paginas
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de paginas</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Listado de Reportes Paginas </h2>
@stop

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" /> --}}
@stop


@section('content')

    {{-- CONFIRMACION SI HAY ALGO MAL --}}
    @if (isset($errors) && $errors->any())
        @include('admin.reportePaginas.partials.modal-error')
    @endif

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row">

                <div class="col">
                    <a class="btn btn-dark float-right mr-4" href="{{ route('admin.reportePaginas.index') }}">Volver</a>


                </div>

            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Dolares</th>
                            <th>Meta</th>
                            <th>Porcentaje</th>
                            <th>Porcentaje Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reporteQuincenas as $reporteQuincena)
                            <tr>
                                <td>{{ $reporteQuincena->fecha }}</td>
                                <td>{{ $reporteQuincena->user->name }}</td>
                                <td>{{ number_format($reporteQuincena->suma, 2, '.', ',') }}</td>


                                <td>
                                    @foreach ($metaModeloss as $metaModelo)
                                        @if ($reporteQuincena->suma >= $metaModelo->mayorQue)
                                            @php
                                                $meta = $metaModelo->porcentaje;
                                            @endphp
                                            {{ $meta }}
                                        @break
                                    @endif
                                @endforeach

                            </td>

                            <td>{{ $reporteQuincena->user->tipoUsuario->porcentaje }}</td>

                            <td>{{ $reporteQuincena->porcentajeTotal }}</td>

                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Usuario</th>
                        <th>Dolares</th>
                        <th>Meta</th>
                        <th>Porcentaje</th>
                        <th>Porcentaje Total</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
</div>

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
<script>
    console.log('Hi!');
</script>





{{-- SWET ALERT --}}
@if (session('info') == 'delete')
    <script>
        Swal.fire(
            '¡Eliminado!',
            'El registro se elimino con exito',
            'success'
        )
    </script>
@elseif(session('info') == 'store')
    <script>
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Descuento registrado correctamente',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
@elseif(session('info') == 'valorCero')
    <script>
        Swal.fire({
            position: 'top-end',
            type: 'warning',
            title: 'No hay saldo que descontar',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
@elseif(session('info') == 'update')
    <script>
        Swal.fire({
            position: 'top-end',
            type: 'success',
            title: 'Descuento correctamente',
            showConfirmButton: false,
            timer: 2000
        })
    </script>
@endif

<script>
    $('.formulario-eliminar').submit(function(e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estas Seguro?',
            text: "¡Este registro se eliminara definitivamente!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, eliminar!',
            cancelButtonText: '¡Cancelar!',
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })

    })
</script>




{{-- DATATATABLE --}}
<script>
    $(document).ready(function() {
        $('#reportePaginas').DataTable({
            dom: 'Blfrtip',

            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

    });
</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>


@stop
