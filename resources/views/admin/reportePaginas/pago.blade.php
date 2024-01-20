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
                    <a class="btn btn-primary float-right mr-4" href="{{ route('admin.reportePaginas.index') }}">Volver</a>
                    <a class="btn btn-info float-right mr-2" href="{{ route('admin.pagos.enviarPago') }}">Enviar Pagos</a>
                    {{-- <a class="btn btn-dark float-right mr-4" href="{{ route('admin.reportePaginas.index') }}">Volver</a> --}}


                </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Devengado</th>
                            <th>Devengado</th>
                            <th>Descuento</th>
                            <th>Descuento</th>
                            <th>Impuesto</th>
                            <th>Impuesto</th>
                            <th>Multas</th>
                            <th>Multas</th>
                            <th>Neto</th>
                            <th>Neto</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Devengado</th>
                            <th>Devengado</th>
                            <th>Descuento</th>
                            <th>Descuento</th>
                            <th>Impuesto</th>
                            <th>Impuesto</th>
                            <th>Multas</th>
                            <th>Multas</th>
                            <th>Neto</th>
                            <th>Neto</th>
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
        var table = $('#html5-extension').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [{
                        extend: 'excel',
                        className: 'btn',
                        exportOptions: {
                            columns: [0, 1, 3, 5, 7, 9, 11,{
                                visible: false,
                                columns: [3, 5, 7, 9, 11]
                            }, ]
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];

                            // Aplicar formato numérico a la columna oculta (columna 3 en base 0)
                            $('c[r^="D"]', sheet).each(function() {
                                var numFmtId = $('numFmt', this).attr('numFmtId');
                                if (!numFmtId) {
                                    numFmtId =
                                        2; // ID para el formato de número en Excel (puedes ajustar según tus necesidades)
                                    $('numFmt', this).attr('numFmtId', numFmtId);
                                }
                                // $(this).attr('s', '2'); // Establecer el estilo de celda como número
                            });
                        },
                    },
                    {
                        extend: 'print',
                        className: 'btn'
                    }
                ]
            },
            ajax: {
                url: "{{ route('admin.pagos.pagosDatatable') }}",
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'fecha',
                    name: 'fecha'
                },
                {
                    data: 'user_nombre',
                    name: 'user_nombre',
                },
                {
                    data: 'sum_format',
                    name: 'sum_format',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return data !== 0 ? formatCurrency(data) : '';
                        }
                        return data;
                    },
                },
                {
                    data: 'suma',
                    name: 'suma',
                    visible: false,
                },
                {
                    data: 'sumaDescuentos_format',
                    name: 'sumaDescuentos_format',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return data !== 0 ? formatCurrency(data) : '';
                        }
                        return data;
                    },
                },
                {
                    data: 'sumaDescuentos',
                    name: 'sumaDescuentos',
                    visible: false,
                },
                {
                    data: 'impuesto_format',
                    name: 'impuesto_format',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return data !== 0 ? formatCurrency(data) : '';
                        }
                        return data;
                    },
                },
                {
                    data: 'impuesto',
                    name: 'impuesto',
                    visible: false,
                },
                {
                    data: 'multas_format',
                    name: 'multas_format',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return data !== 0 ? formatCurrency(data) : '';
                        }
                        return data;
                    },
                },
                {
                    data: 'multas',
                    name: 'multas',
                    visible: false,
                },
                {
                    data: 'pagoNeto_format',
                    name: 'pagoNeto_format',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return data !== 0 ? formatCurrency(data) : '';
                        }
                        return data;
                    },
                },
                {
                    data: 'pagoNeto',
                    name: 'pagoNeto',
                    visible: false,
                },
            ],
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sInfo": "Página _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            initComplete: function() {
                var api = this.api();
                api.rows().every(function() {
                    // Obtiene el valor de la columna "ID" en la fila actual
                    var id = this.data().id;

                    // Agrega el atributo data-id a la fila
                    $(this.node()).attr('data-id', id);
                });
            },
            order: [
                [0, 'asc'] // 1 es el índice de la columna que contiene las fechas
            ],
        });

        function formatCurrency(value) {
            // Puedes personalizar esta función según tus necesidades
            var options = {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: value % 1 === 0 ? 0 :
                2, // 0 decimales si es un número entero, 2 decimales en caso contrario
            };

            return new Intl.NumberFormat('es-CO', options).format(value);
        }
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
    @elseif(session('info') == 'enviarPagos')
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Pagos enviados exitosamente',
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
