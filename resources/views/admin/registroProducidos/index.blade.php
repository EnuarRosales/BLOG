@extends('template.index')

@section('tittle-tab')
    Reporte de Producidos
@endsection

@section('page-title')
    <a href="{{ route('admin.registroProducidos.index') }}">Reporte de Producidos</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Listado de Producidos </h2>
@stop

@section('styles')
    {{-- token para guardar registros --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" />

    {{-- estilo para centrar registros --}}
    <style>
        .centered {
            text-align: center;
        }
    </style>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            <div class="row">

                <div class="col">

                    <div style="display: flex;">
                        <label class="mt-2 ml-3 mr-1">Registros :</label>
                        <select id="records-per-page" class="form-control custom-width-20">
                            <!-- Agregamos la clase form-control-sm -->
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="mq-960">


                        @can('admin.registroProduccion.create')
                            <a class="btn btn-primary float-right mr-3"
                                href="{{ route('admin.registroProducidos.create') }}">Agregar
                                Producido</a>
                        @endcan
                        @can('admin.registroProduccion.resumen')
                            <a class="btn btn-info float-right"
                                href="{{ route('admin.registroProducidoss.reporte_dia') }}">Resumen</a>
                        @endcan
                    </div>
                </div>
            </div>

            {{-- </div>
            </div> --}}

            <div class="table-responsive mb-4 mt-4">

                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th class="">ID</th>
                            <th class="">Fecha</th>
                            <th class="">Valor</th>
                            <th class="">Valor</th>
                            <th class="">Meta</th>
                            <th class="">Pagina</th>
                            <th class="">Usuario que registra</th>
                            <th class="">Acciones</th>
                            {{-- @can('admin.registroProduccion.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroProduccion.destroy')
                                <th>Eliminar</th>
                            @endcan --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="">ID</th>
                            <th class="">Fecha</th>
                            <th class="">Valor</th>
                            <th class="">Valor</th>
                            <th class="">Meta</th>
                            <th class="">Pagina</th>
                            <th class="">Usuario que registra</th>
                            <th class="">Acciones</th>
                            {{-- @can('admin.registroProduccion.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroProduccion.destroy')
                                <th>Eliminar</th>
                            @endcan --}}
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/exceljs/4.1.1/exceljs.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>


    <script>
        var table = $('#html5-extension').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    //  formato numero
                    {
                        extend: 'excel',
                        className: 'btn',
                        exportOptions: {
                            columns: [0, 1, 3, {
                                visible: false,
                                columns: [3]
                            }, 4, 5, 6]
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];

                            // Aplicar formato numérico a la columna oculta (columna 3 en base 0)
                            $('c[r^="D"]', sheet).each(function() {
                                var numFmtId = $('numFmt', this).attr('numFmtId');
                                if (!numFmtId) {
                                    numFmtId =
                                        3; // ID para el formato de número en Excel (puedes ajustar según tus necesidades)
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
                url: "{{ route('admin.registroProducidos.datatable') }}",
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'fecha',
                    name: 'fecha',
                },
                {
                    data: 'valorProducidoFormat',
                    name: 'valorProducidoFormat',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return formatCurrency(data);
                        }
                        return data;
                    },
                },

                {
                    data: 'valorProducido',
                    name: 'valorProducido',
                    visible: false,
                },
                {
                    data: 'meta_nombre',
                    name: 'meta_nombre'
                },
                {
                    data: 'pagina_nombre',
                    name: 'pagina_nombre'
                },
                {
                    data: 'user_nombre',
                    name: 'user_nombre'
                },
                {
                    data: 'acciones',
                    name: 'acciones',
                },

            ],
            language: {
                "decimal": ",",
                "emptyTable": "No hay datos disponibles en la tabla",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
                "infoEmpty": "Mostrando 0 a 0 de 0 registros",
                "infoFiltered": "(filtrado de _MAX_ registros en total)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mostrar _MENU_ registros por página",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscar:",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
                    "previous": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                },
                "aria": {
                    "sortAscending": ": activar para ordenar la columna ascendente",
                    "sortDescending": ": activar para ordenar la columna descendente"
                },
            },
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
                [1, 'desc'] // 1 es el índice de la columna que contiene las fechas
            ],
            pageLength: 7, // Establece la cantidad de registros por página por defecto
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

        // Detectar cambios en el select
        $('#records-per-page').change(function() {
            var newLength = $(this).val();
            table.page.len(newLength).draw();
        });

        // Button eliminar
        $('#html5-extension').on('click', '.feather-x-circle', function() {
            var button = $(this); // El botón que se hizo clic
            var row = button.closest('tr'); // La fila que contiene el botón
            var table = $('#html5-extension').DataTable();
            var currentPage = table.page(); // Guardar la página actual

            Swal.fire({
                title: '¿Estás seguro?',
                text: '¡Este registro se eliminará definitivamente!',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, eliminar!',
                cancelButtonText: '¡Cancelar!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: `{{ route('admin.registroProducido.eliminar') }}`,
                        type: 'POST',
                        data: {
                            id: row.data(
                                'id'
                            ), // Puedes usar data-* para almacenar el ID de la fila
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            if (response.success) {

                                Swal.fire(
                                    '¡Eliminado!',
                                    'El registro se elimino con exito',
                                    'success'
                                );

                                setTimeout(function() {
                                    Swal.close();
                                }, 2000);
                                setTimeout(function() {
                                    // Elimina la fila sin recargar la tabla
                                    var rowIndex = table.row(row).index();
                                    table.row(rowIndex).remove().draw();
                                    table.page(currentPage).draw('page');
                                }, 2000);
                            }
                        }
                    });
                }
            });
        });
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
                title: 'Producido registrado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'storeExcel')
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Datos cargados con exito',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') && strpos(session('info'), 'error,modelo') === 0)
        @php
            $parts = explode(',', session('info'));
            $errorMessage = $parts[2];
        @endphp
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Errores en las filas: <br> {{ $errorMessage }} <br> Los modelos no existen en la base de datos.',
                // html: true, // Habilita HTML en el mensaje
                showConfirmButton: true, // Mostrar el botón "Aceptar"
                allowOutsideClick: false, // Evitar que se cierre al hacer clic fuera
                confirmButtonText: 'Aceptar', // Texto personalizado para el botón
            })
        </script>
    @elseif(session('info') && strpos(session('info'), 'error,pagina') === 0)
        @php
            $parts = explode(',', session('info'));
            $errorMessage = $parts[2];
        @endphp
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: 'Errores en las filas: <br> {{ $errorMessage }} <br> Las paginas no existen en la base de datos.',
                // html: true, // Habilita HTML en el mensaje
                showConfirmButton: true, // Mostrar el botón "Aceptar"
                allowOutsideClick: false, // Evitar que se cierre al hacer clic fuera
                confirmButtonText: 'Aceptar', // Texto personalizado para el botón
            })
        </script>
    @elseif(session('info') == 'verificadoMasivo')
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Datos verificados con exito',
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
                title: 'Producido Actualizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif



@stop
