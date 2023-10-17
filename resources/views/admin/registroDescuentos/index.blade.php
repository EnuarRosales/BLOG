@extends('template.index')

@section('tittle-tab')
    Reporte de Descuentos
@endsection

@section('page-title')
    <a href="{{ route('admin.registroDescuentos.index') }}">Reporte de Descuentos</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Listado de Descuentos </h2>
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
                        @can('admin.registroDescuentos.create')
                            <a class="btn btn-primary float-right mr-4"
                                href="{{ route('admin.registroDescuentos.create') }}">Agregar
                                Descuento</a>
                        @endcan
                    </div>
                </div>
            </div>




            <div class="table-responsive mb-4 mt-4">

                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th style="text-align: center;">ID</th>
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Monto a Descuentar</th>
                            <th style="text-align: center;">Monto Descontado</th>
                            <th style="text-align: center;">Saldo</th>
                            <th style="text-align: center;">Tipo Descuento</th>
                            <th style="text-align: center;">Usuario</th>
                            <th style="text-align: center;">Pago</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th style="text-align: center;">ID</th>
                            <th style="text-align: center;">Fecha</th>
                            <th style="text-align: center;">Monto a Descuentar</th>
                            <th style="text-align: center;">Monto Descontado</th>
                            <th style="text-align: center;">Saldo</th>
                            <th style="text-align: center;">Tipo Descuento</th>
                            <th style="text-align: center;">Usuario</th>
                            <th style="text-align: center;">Pago</th>
                            <th style="text-align: center;">Acciones</th>
                        </tr>
                    </tfoot>

                </table>


            </div>
        </div>
    </div>

    {{-- modal para abono parcial --}}
    <div class="modal fade" id="abonoModal" tabindex="-1" role="dialog" aria-labelledby="abonoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="abonoModalLabel">Pago Parcial</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-content">
                        <div class="form-group">
                            <label for="descuento_id">ID Descuento</label>
                            <input class="form-control" readonly="" name="descuento_id" type="number" value=""
                                id="descuento_id">
                            <label for="valor">Valor</label>
                            <input class="form-control" placeholder="Favor ingrese un valor" name="valor" type="number"
                                id="valor">
                            <label for="descripcion">Descripcion</label>
                            <input class="form-control" placeholder="Favor ingrese una descripcion" name="descripcion"
                                type="text" id="descripcion">

                        </div>
                        <div>
                            <button type="button" class="btn btn-success abono-button">Realizar Abono</button>
                        </div>


                        <div class="col" style="margin-top: 30px;">
                            <div style="display: flex;">
                                <br>
                                <label class="mt-2 ml-3 mr-1">Registros :</label>
                                <select id="records-per-page-modal" class="form-control custom-width-20">
                                    <!-- Agregamos la clase form-control-sm -->
                                    <option value="7">7</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive mb-4 mt-4">

                            <table id="decuentoDatatableModal" class="table table-hover non-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">Valor</th>
                                        <th style="text-align: center;">Descripcion</th>
                                        <th style="text-align: center;">Fecha</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    <!-- Aquí se llenará la tabla con datos aleatorios -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th style="text-align: center;">Valor</th>
                                        <th style="text-align: center;">Descripcion</th>
                                        <th style="text-align: center;">Fecha</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="cerrarModalButton">Cerrar</button>
                </div>
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
                            columns: [0, 1, 2, 3, 4, 5, 6], // Incluye las columnas necesarias
                            modifier: {
                                body: function(data, rowIdx, colIdx, node) {
                                    if (colIdx === 2 || colIdx === 3 || colIdx === 4) {
                                        // Reemplaza los valores nulos por 0
                                        data = data ? data : 0;
                                        // Convierte los valores a números
                                        data = parseFloat(data);

                                        // Formatea los valores negativos
                                        if (data < 0) {
                                            return '(' + Math.abs(data) + ')';
                                        } else {
                                            return data.toFixed(0); // Redondea a cero decimales
                                        }
                                    }
                                    return data;
                                }
                            }
                        },
                        customize: function(xlsx) {
                            var sheet = xlsx.xl.worksheets['sheet1.xml'];
                            // Personaliza el archivo Excel aquí si es necesario
                        },
                    },
                    {
                        extend: 'print',
                        className: 'btn'
                    }
                ]
            },
            ajax: {
                url: "{{ route('admin.registroDescuentos.datatable') }}",
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'formatted_created_at',
                    name: 'formatted_created_at',
                },
                {
                    data: 'montoDescuento',
                    name: 'montoDescuento',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Formatea el número con separadores de miles y sin decimales
                            return '$' + new Intl.NumberFormat('en-US', {
                                style: 'decimal',
                                maximumFractionDigits: 0
                            }).format(data);
                        }
                        return data;
                    }
                },
                {
                    data: 'formattedMontoDescontado',
                    name: 'formattedMontoDescontado',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Formatea el número con separadores de miles y sin decimales
                            return '$' + new Intl.NumberFormat('en-US', {
                                style: 'decimal',
                                maximumFractionDigits: 0
                            }).format(data);
                        }
                        return data;
                    }
                },
                {
                    data: 'saldo',
                    name: 'saldo',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            // Formatea el número con separadores de miles y sin decimales
                            var formattedData = '$' + new Intl.NumberFormat('en-US', {
                                style: 'decimal',
                                maximumFractionDigits: 0
                            }).format(data);

                            // Aplica la lógica para determinar la clase CSS apropiada
                            var badgeClass = '';
                            if (data > 0) {
                                badgeClass = 'badge badge-warning mt-2';
                            } else if (data < 0) {
                                badgeClass = 'badge badge-danger mt-2';
                            } else {
                                badgeClass = 'badge badge-success mt-2';
                            }

                            // Crea un elemento HTML con la clase CSS apropiada y el atributo data-id
                            return '<span class="' + badgeClass + ' saldo-value" data-id="' + row.id +
                                '">' + formattedData + '</span>';
                        }
                        return data;
                    }
                },
                {
                    data: 'descuento_name',
                    name: 'descuento_name'
                },
                {
                    data: 'user_name',
                    name: 'user_name'
                },
                {
                    data: 'pago',
                    name: 'pago'
                },
                {
                    data: 'acciones',
                    name: 'acciones'
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

        var table2 = $('#decuentoDatatableModal').DataTable({});

        $(document).ready(function() {
            $('#html5-extension').on('click', '.total-button', function() {
                // Obtiene el ID del botón "Total" haciendo referencia al atributo "data-id"
                var rowId = $(this).data('id');
                //url para el ajax
                var url = "{{ route('admin.abonos.abono', ['abonado' => ':abonado']) }}";
                url = url.replace(':abonado', rowId); //remplazando el valor id
                //ajax
                $.ajax({
                    url: url,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    success: function(response) {
                        if (response.success) {
                            // Obtiene el valor de montoDescontado del JSON
                            var nuevoMontoDescontado = response.abonado.montoDescontado;
                            // Obtiene el valor de saldo del JSON
                            var saldo = response.abonado.saldo;
                            // Obtiene la tabla de DataTables
                            var table = $('#html5-extension').DataTable();
                            // Identifica la fila que deseas actualizar
                            var filaId = response.abonado.id;
                            // Busca la fila en la tabla por su atributo data-id
                            var fila = table.row('[data-id="' + filaId + '"]');

                            if (fila.any()) {
                                // Obtiene el número de página actual
                                var currentPage = table.page();
                                // Obtiene la celda en la columna "Monto Descontado" (índice 3)
                                var cellMontoDescontado = table.cell(fila, 3);
                                // Obtiene la celda en la columna "Saldo" (índice 4)
                                var cellSaldo = table.cell(fila, 4);
                                // Actualiza el valor de la celda de Monto Descontado con el nuevo monto descontado
                                cellMontoDescontado.data(nuevoMontoDescontado);
                                // Actualiza el valor de la celda de Saldo con el nuevo saldo y el atributo "data-id"
                                cellSaldo.data(
                                    '<span class="badge badge-success mt-2 saldo-value" data-id="' +
                                    rowId + '">$' + saldo + '</span');
                                // Vuelve a dibujar la fila
                                // El valor "false" evita que DataTables vuelva a la primera página
                                fila.invalidate().draw(false);

                                // Restaura el número de página
                                // El valor "false" evita que DataTables vuelva a la primera página
                                table.page(currentPage).draw(false);
                            } else {
                                console.log('La fila no se encontró en DataTables.');
                            }
                        }
                    }
                });
                // Luego, puedes realizar una solicitud AJAX u otras acciones según el ID del botón
            });

            $('#html5-extension').on('click', '.parcial-button', function() {
                // Obtiene el ID del botón "Total" haciendo referencia al atributo "data-id"
                var rowId = $(this).data('id');

                // Abre el modal
                $('#abonoModal').modal('show');
                $('#descuento_id').val(rowId);
                // Limpia la tabla


                table2 = $('#decuentoDatatableModal').DataTable({
                    destroy: true,
                    dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
                    buttons: {
                        buttons: [{
                                extend: 'excel',
                                className: 'btn',
                                // text: 'Exportar a Excel',
                                // title: 'Mi archivo Excel',
                                exportOptions: { // Incluye las columnas necesarias
                                    columns: [0, 1, 2],
                                    format: {
                                        body: function(data, rowIdx, colIdx, node) {
                                            // Asegurarse de que data sea una cadena de texto antes de intentar reemplazar
                                            if (colIdx === 0 && typeof data === 'string') {
                                                return data.replace('$', '') *
                                                    1; // Elimina el signo de dólar y convierte a número
                                            } else {
                                                return data; // Mantén el formato original para otras columnas
                                            }
                                        }
                                    }
                                },
                                customize: function(xlsx) {
                                    var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                    // Personaliza el archivo Excel aquí si es necesario
                                },
                            },
                            {
                                extend: 'print',
                                className: 'btn'
                            }
                        ]
                    },
                    ajax: {
                        url: "{{ route('admin.abonos.abonoParcial.datatable') }}",
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            rowId: rowId
                        }
                    },
                    columns: [{
                            data: 'valor',
                            name: 'valor',
                            // className: 'centered',
                            render: function(data, type, row) {
                                if (type === 'display' || type === 'filter') {
                                    return '$' +
                                        data; // Agrega el símbolo "$" antes del número
                                }
                                return data;
                            }
                        },
                        {
                            data: 'descripcion',
                            name: 'descripcion'
                        },
                        {
                            data: 'formatted_created_at',
                            name: 'formatted_created_at',
                        },
                    ],
                    order: [
                        [2,
                            'desc'
                        ] // Ordena la tercera columna (formatted_created_at) de forma descendente
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
                    // Define las opciones de cantidad de registros por página
                    lengthMenu: [7, 10, 20, 50],
                    pageLength: 7, // Establece la cantidad de registros por página por defecto
                });
            });

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
                            url: `{{ route('admin.registroDescuentos.eliminar') }}`,
                            type: 'POST',
                            data: {
                                id: row.data(
                                    'id'
                                ), // Puedes usar data-* para almacenar el ID de la fila
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {

                                    // Swal.fire({
                                    //     title: '¡Eliminado!',
                                    //     text: 'El registro se eliminó con éxito',
                                    //     icon: 'success',
                                    //     // timer: 3000, // Establece el tiempo en milisegundos (2 segundos en este ejemplo)
                                    //     // showConfirmButton: true, // Oculta el botón de confirmación
                                    // });
                                    // setTimeout(function() {
                                    //     location
                                    // .reload(); // Recarga la página después de 2 segundos
                                    // }, 5000); // 2000 milisegundos (2 segundos)
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








        });

        // Agrega un controlador de eventos al botón para cerrar el modal.
        document.getElementById('cerrarModalButton').addEventListener('click', function() {
            // Cierra el modal usando el método .hide()
            $('#abonoModal').modal('hide');
        });

        // Captura el clic en el botón "Realizar Abono"
        $('.abono-button').on('click', function() {
            // Obtiene el valor de descuento_id del campo de entrada
            var descuentoId = $('#descuento_id').val();
            var valor = $('#valor').val();
            var descripcion = $('#descripcion').val();

            // Realiza una solicitud AJAX
            $.ajax({
                url: '{{ route('admin.abonos.store') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Agrega el token CSRF para protección
                    descuento_id: descuentoId, // Envía el valor de descuento_id
                    valor: valor,
                    descripcion: descripcion,

                    // Agrega otros datos si es necesario
                },
                success: function(response) {
                    // Obtiene el valor de montoDescontado del JSON
                    var nuevoMontoDescontado = response.descuentos.montoDescontado;
                    // Obtiene el valor de saldo del JSON
                    var saldo = response.descuentos.saldo;
                    // Obtiene la tabla de DataTables
                    var table = $('#html5-extension').DataTable();
                    // Identifica la fila que deseas actualizar
                    var filaId = response.descuentos.id;
                    // Busca la fila en la tabla por su atributo data-id
                    var fila = table.row('[data-id="' + filaId + '"]');

                    if (fila.any()) {
                        // Obtiene el número de página actual
                        var currentPage = table.page();
                        // Obtiene la celda en la columna "Monto Descontado" (índice 3)
                        var cellMontoDescontado = table.cell(fila, 3);
                        // Obtiene la celda en la columna "Saldo" (índice 4)
                        var cellSaldo = table.cell(fila, 4);
                        // Actualiza el valor de la celda de Monto Descontado con el nuevo monto descontado
                        cellMontoDescontado.data(nuevoMontoDescontado);
                        // Actualiza el valor de la celda de Saldo con el nuevo saldo y el atributo "data-id"
                        var classToAdd = "badge badge-success mt-2 saldo-value";
                        if (saldo > 0) {
                            classToAdd = "badge badge-warning mt-2 saldo-value";
                        } else if (saldo < 0) {
                            classToAdd = "badge badge-danger mt-2 saldo-value";
                        }

                        cellSaldo.data('<span class="' + classToAdd + '" data-id="' + filaId + '">$' +
                            saldo + '</span');
                        // Vuelve a dibujar la fila
                        // El valor "false" evita que DataTables vuelva a la primera página
                        fila.invalidate().draw(false);

                        // Restaura el número de página
                        // El valor "false" evita que DataTables vuelva a la primera página
                        table.page(currentPage).draw(false);
                    } else {
                        console.log('La fila no se encontró en DataTables.');
                    }



                    if (response.success === true) {
                        // Si la respuesta es exitosa, muestra una notificación con SweetAlert
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: 'La información se ha guardado correctamente.',
                            showConfirmButton: false,
                            timer: 5000
                        })

                        // Limpia los campos de descripción y valor después de 5 segundos
                        setTimeout(function() {
                            $('#descripcion').val(''); // Limpia el campo de descripción
                            $('#valor').val(''); // Limpia el campo de valor
                        }, 5000);
                    } else {
                        error = response.error;
                        console.log(error);

                        // Si la respuesta no es exitosa, muestra una notificación de error con SweetAlert
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: error,
                            showConfirmButton: false,
                            timer: 5000
                        })
                    }

                    // Maneja la respuesta de la solicitud AJAX, por ejemplo, cierra el modal
                    $('#abonoModal').modal('hide');
                    // También puedes realizar otras acciones aquí según la respuesta.
                },
                error: function(error) {
                    // Maneja los errores si la solicitud falla
                    console.error(error);
                }
            });
        });



        // Agrega un evento click a los botones de eliminación
        $('.feather-x-circle').click(function() {


            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Envía el formulario de eliminación


                    $('#delete-form-' + rowId).submit();
                }
            });
        });


        // !! ajax para el ejemplo del data
        // $(document).ready(function() {
        //     // Agrega un manejador de eventos para los botones con la clase "action-button"
        //     $('.action-button').on('click', function() {
        //         var id = $(this).data('id');

        //         // Realiza una solicitud AJAX utilizando el ID
        //         $.ajax({
        //             url: '/tu-ruta/' + id, // Reemplaza '/tu-ruta/' con la ruta adecuada
        //             type: 'GET', // o 'POST' según tus necesidades
        //             success: function(response) {
        //                 // Manejar la respuesta de la solicitud AJAX aquí
        //                 console.log('Solicitud AJAX exitosa');
        //             },
        //             error: function(error) {
        //                 // Manejar errores de la solicitud AJAX aquí
        //                 console.error('Error en la solicitud AJAX:', error);
        //             }
        //         });
        //     });
        // });


        // Vincular eventos de clic para eliminar
        // function bindDeleteEvents() {
        //     document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
        //         botonEliminar.addEventListener('click', function(e) {
        //             e.preventDefault();

        //             const registroDescuentoId = this.getAttribute('data-registroDescuento-id');





        //             Swal.fire({
        //                 title: '¿Estás seguro?',
        //                 text: '¡Este registro se eliminará definitivamente!',
        //                 type: 'warning',
        //                 showCancelButton: true,
        //                 confirmButtonColor: '#3085d6',
        //                 cancelButtonColor: '#d33',
        //                 confirmButtonText: '¡Sí, eliminar!',
        //                 cancelButtonText: '¡Cancelar!',
        //                 preConfirm: () => {
        //                     // Crear un formulario dinámicamente
        //                     const formulario = document.createElement('form');
        //                     formulario.action =
        //                         `registroDescuentos/${registroDescuentoId}`; // Ruta de eliminación
        //                     formulario.method = 'POST'; // Método POST
        //                     formulario.style.display = 'none'; // Ocultar el formulario

        //                     // Agregar el token CSRF al formulario
        //                     const tokenField = document.createElement('input');
        //                     tokenField.type = 'hidden';
        //                     tokenField.name = '_token';
        //                     tokenField.value = '{{ csrf_token() }}';
        //                     formulario.appendChild(tokenField);

        //                     // Agregar un campo oculto para indicar que es una solicitud de eliminación
        //                     const methodField = document.createElement('input');
        //                     methodField.type = 'hidden';
        //                     methodField.name = '_method';
        //                     methodField.value = 'DELETE';
        //                     formulario.appendChild(methodField);

        //                     // Adjuntar el formulario al documento y enviarlo
        //                     document.body.appendChild(formulario);
        //                     formulario.submit();

        //                     return true;
        //                 },
        //             });
        //         });
        //     });
        // }

        //     // Volver a vincular eventos de clic después de cada redibujo
        //     table.on('draw.dt', function() {
        //         bindDeleteEvents();
        //     });

        // Detectar cambios en el select
        $('#records-per-page').change(function() {
            var newLength = $(this).val();
            table.page.len(newLength).draw();
        });

        $('#records-per-page-modal').on('change', function() {
            var recordsPerPage = $(this).val();
            table2.page.len(recordsPerPage).draw();
        });

        //     // Vincular eventos de clic para eliminar inicialmente
        //     bindDeleteEvents();
    </script>
    {{-- <script src="{{ asset('assets/libs/switchery/switchery.min.js') }}"></script> --}}
    {{-- <script>
        console.log('Hi!');
    </script> --}}




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


@stop
