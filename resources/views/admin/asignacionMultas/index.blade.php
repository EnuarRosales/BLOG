@extends('template.index')

@section('tittle-tab', 'Registro Multas')

@section('page-title')
    <a href="{{ route('admin.asignacionMultas.index') }}"> Registro Multas</a>
@endsection

@section('content_header')
    <h2 class="ml-3">Lista multas</h2>
@stop

@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

@endsection

@section('content')
    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row g-2">
                <div class="col">
                    <div style="display: flex;">
                        <label class="mt-2 ml-3 mr-1">Registros :</label>
                        <select id="records-per-page" class="form-control custom-width-20">
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    @can('admin.registroMultas.create')
                        <a class="btn btn-primary float-right mr-4" href="{{ route('admin.asignacionMultas.create') }}">Agregar
                            Multa</a>
                    @endcan
                </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Tipo multa</th>
                            <th>Valor Multa</th>
                            <th>Valor Multa</th>
                            <th>Fecha</th>
                            <th>Descontar</th>
                            <th>Observacion</th>
                            {{-- @can('admin.registroMultas.edit') --}}
                                <th>Acciones</th>
                            {{-- @endcan --}}
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Tipo multa</th>
                            <th>Valor Multa</th>
                            <th>Valor Multa</th>
                            <th>Fecha</th>
                            <th>Descontar</th>
                            <th>Observacion</th>
                            {{-- @can('admin.registroMultas.edit') --}}
                                <th>Acciones</th>
                            {{-- @endcan --}}

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
                            columns: [0, 1, 2, 4, {
                                visible: false,
                                columns: [4]
                            }, 5]
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
                url: "{{ route('admin.asignacionMulta.datatable') }}",
                type: 'GET',
                dataType: 'json',
            },
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'usuario_name',
                    name: 'usuario_name',
                },
                {
                    data: 'multa_name',
                    name: 'multa_name',
                },
                {
                    data: 'multa_valor_format',
                    name: 'multa_valor_format',
                    render: function(data, type, row) {
                        if (type === 'display' || type === 'filter') {
                            return formatCurrency(data);
                        }
                        return data;
                    },

                },
                {
                    data: 'multa_valor',
                    name: 'multa_valor',
                    visible: false,
                },
                {
                    data: 'fecha',
                    name: 'fecha',
                },

                {
                    data: 'observacion',
                    name: 'observacion',
                },
                
                {
                    data: 'generar_descuento',
                    name: 'generar_descuento',
                    @can('admin.registroMultas.descontar')
                        visible: true,
                    @else
                        visible: false,
                    @endcan
                },

                

                {
                    data: 'acciones',
                    name: 'acciones',
                    @can('admin.registroMultas.edit')
                        visible: true,
                    @else
                        visible: false,
                    @endcan
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
                [5, 'desc'] // 1 es el índice de la columna que contiene las fechas
            ],
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
                        url: `{{ route('admin.asignacionMulta.eliminar') }}`,
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
                minimumFractionDigits: value % 1 === 0 ? 0 :
                2, // 0 decimales si es un número entero, 2 decimales en caso contrario
            };

            return new Intl.NumberFormat('es-CO', options).format(value);
        }

        // En tu script JavaScript

        $(document).on('change', '.toggle-switch', function() {
            var id = $(this).data('id');
            var status = $(this).prop('checked') ? 1 : 0;
            // Realiza la llamada Ajax
            $.ajax({
                url: "{{ route('admin.generar.descuento', ['id' => 'id']) }}".replace(
                    'id', id),
                type: 'GET',
                data: {
                    status: status
                },

                success: function(data) {
                    // Muestra un mensaje de éxito con SweetAlert
                    Swal.fire({
                        position: 'top-end',
                        type: 'success',
                        title: 'Estado actualizado con éxito',
                        text: 'Descuento actual: ' + data.estado,
                        showConfirmButton: false,
                        timer: 2500
                    });
                },
                error: function(error) {
                    // Muestra un mensaje de error con SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al actualizar el estado'
                    });
                }
            });

        });

        // Detectar cambios en el select
        $('#records-per-page').change(function() {
            var newLength = $(this).val();
            table.page.len(newLength).draw();
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
                title: 'Asignacion de multa realizada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'Asignacion demulta editada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif


@stop
