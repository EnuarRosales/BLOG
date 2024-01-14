@extends('template.index')

@section('tittle-tab')
    Reporte de paginas
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de paginas</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Lista reporte paginas</h2>
@stop


@section('content')
    {{-- CONFIRMACION SI HAY ALGO MAL --}}
    @if (isset($errors) && $errors->any())
        @include('admin.reportePaginas.partials.modal-error')
    @endif

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            {{-- <div class="card">

                <div class="card-body"> --}}
            <div class="row">
                <div class="col ">
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

                        <a id="verificadoMasivoBtn" class="btn btn-info float-right mr-3"
                            href="{{ route('admin.reportePaginas.verificadoMasivo') }}">Verificado Masivo</a>


                        <a class="btn btn-primary float-right"
                            href="{{ route('admin.reportePaginas.reporteQuincena') }}">Porcentajes</a>

                        <a class="btn btn-primary float-right" href="{{ route('admin.reportePaginas.pagos') }}">Pagos</a>



                        <button class="btn btn-primary dropdown-toggle float-right" type="button" id="dropdownMenuButton"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cargar datos
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                            <a data-toggle="modal" data-target="#exampleModal" class="dropdown-item"
                                href="{{ route('admin.reportePaginas.cargarExcel') }}">
                                Cargar Excel
                            </a>
                            <a class="dropdown-item" href="{{ route('admin.reportePaginas.create') }}">Cargar individual</a>

                        </div>
                        @include('admin.reportePaginas.partials.import-excel')

                    </div>
                </div>

                {{-- </div> --}}
                <div class="table-responsive mb-4 mt-4">

                    <table id="html5-extension" class="table table-hover non-hover" style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Modelo</th>
                                <th>Pagina</th>
                                <th>Cantidad Tokens</th>
                                <th>Valor Pagina</th>
                                <th>Dolares</th>
                                <th>Dolares</th>
                                <th>TRM</th>
                                <th>TRM</th>
                                <th>Pesos</th>
                                <th>Pesos</th>
                                <th>Porcentaje</th>
                                <th>Meta Porcentaje</th>
                                <th>Modicar Porcentaje</th>
                                <th>Porcentaje Total</th>
                                <th>Total Pesos</th>
                                <th>Total Pesos</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Modelo</th>
                                <th>Pagina</th>
                                <th>Cantidad Tokens</th>
                                <th>Valor Pagina</th>
                                <th>Dolares</th>
                                <th>Dolares</th>
                                <th>TRM</th>
                                <th>TRM</th>
                                <th>Pesos</th>
                                <th>Pesos</th>
                                <th>Porcentaje</th>
                                <th>Meta Porcentaje</th>
                                <th>Modicar Porcentaje</th>
                                <th>Porcentaje Total</th>
                                <th>Total Pesos</th>
                                <th>Total Pesos</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
                {{-- </div> --}}
            </div>
        </div>

    @stop

    @section('styles')

        <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" />
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
                                columns: [0, 1, 2, 3, 4, 5, 7, 9, 11, {
                                    visible: false,
                                    columns: [7, 9, 11, 16]
                                }, 12, 13, 14, 16, 17]
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
                    url: "{{ route('admin.reportePagina.datatable') }}",
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
                        data: 'usuario_name',
                        name: 'usuario_name',
                    },
                    {
                        data: 'pagina_name',
                        name: 'pagina_name',
                    },
                    {
                        data: 'Cantidad',
                        name: 'Cantidad',
                    },
                    {
                        data: 'valorPagina',
                        name: 'valorPagina',
                    },
                    {
                        data: 'dolares_format',
                        name: 'dolares_format',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return formatCurrency(data);
                            }
                            return data;
                        },
                    },
                    {
                        data: 'dolares',
                        name: 'dolares',
                        visible: false,
                    },
                    {
                        data: 'TRM_format',
                        name: 'TRM_format',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return formatCurrency(data);
                            }
                            return data;
                        },

                    },
                    {
                        data: 'TRM',
                        name: 'TRM',
                        visible: false,
                    },
                    {
                        data: 'pesos_format',
                        name: 'pesos_format',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return formatCurrency(data);
                            }
                            return data;
                        },
                    },
                    {
                        data: 'pesos',
                        name: 'pesos',
                        visible: false,
                    },
                    {
                        data: 'porcentaje',
                        name: 'porcentaje',
                        render: function(data, type, row) {
                            return type === 'display' ? data + '%' : data;
                        }
                    },
                    {
                        data: 'metaModelo',
                        name: 'metaModelo',
                        render: function(data, type, row) {
                            return type === 'display' ? data + '%' : data;
                        }
                    },
                    {
                        data: 'porcentaje_ad',
                        name: 'porcentaje_ad',
                        render: function(data, type, row) {
                            return type === 'display' ? data + '%' : data;
                        }
                    },
                    {
                        data: 'porcentajeTotal',
                        name: 'porcentajeTotal',
                        render: function(data, type, row) {
                            return type === 'display' ? data + '%' : data;
                        }
                    },
                    {
                        data: 'netoPesos_format',
                        name: 'netoPesos_format',
                        render: function(data, type, row) {
                            if (type === 'display' || type === 'filter') {
                                return formatCurrency(data);
                            }
                            return data;
                        },
                    },
                    {
                        data: 'netoPesos',
                        name: 'netoPesos',
                        visible: false,
                    },
                    {
                        data: 'verificado',
                        name: 'verificado',
                    },
                    {
                        data: 'acciones',
                        name: 'acciones'
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
                // order: [
                //     [5, 'desc'] // 1 es el índice de la columna que contiene las fechas
                // ],
            });

            // Escucha el evento de cambio en los interruptores de clase 'toggle-switch'
            $(document).on('change', '.toggle-switch', function() {
                // Obtiene el valor actual del atributo data-status
                var currentStatus = $(this).data('status');

                // Cambia el valor del atributo data-status a su inverso (0 a 1 o 1 a 0)
                $(this).data('status', currentStatus == 0 ? 1 : 0);

                // Agrega o quita la clase 'excluido' según el nuevo valor de data-status
                if ($(this).data('status') == 1) {
                    $(this).closest('tr').addClass('excluido');
                } else {
                    $(this).closest('tr').removeClass('excluido');
                }
            });

            // Evento click en el botón "Verificado Masivo"
            $('#verificadoMasivoBtn').on('click', function(e) {
                e.preventDefault();

                // Obtener todos los datos en el DataTable donde 'verificado' no está checkeado y no tiene la clase 'excluido'
                var unverifiedData = [];
                table.rows().every(function(index, element) {
                    var data = this.data();
                    var $rowNode = $(this.node());

                    if (data.verificado !== 1 && !$rowNode.hasClass('excluido')) {
                        unverifiedData.push(data);
                    }
                });

                // Crear un array con los IDs de los elementos no checkeados
                var unverifiedIds = unverifiedData.map(function(item) {
                    return item.id;
                });

                // Realizar la petición AJAX
                $.ajax({
                    url: "{{ route('admin.reportePaginas.verificadoMasivo') }}",
                    type: 'GET',
                    data: {
                        ids: unverifiedIds
                    },
                    success: function(response) {
                        // Recargar la página
                        window.location.reload();
                    },
                    error: function(error) {
                        // Manejar errores
                        console.error(error);
                    }
                });
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
                            url: `{{ route('admin.reportePagina.eliminar') }}`,
                            type: 'GET',
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

            function formatCurrency(value) {
                // Puedes personalizar esta función según tus necesidades
                var options = {
                    style: 'currency',
                    currency: 'COP',
                    minimumFractionDigits: 2,
                };

                return new Intl.NumberFormat('es-CO', options).format(value);
            }

            // Detectar cambios en el select
            $('#records-per-page').change(function() {
                var newLength = $(this).val();
                table.page.len(newLength).draw();
            });
        </script>
        <script src="{{ asset('assets/libs/switchery/switchery.min.js') }}"></script>

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
                    title: 'Descuento Actualizado correctamente',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        @endif


    @stop
