@extends('template.index')

@section('tittle-tab')
    Resumen de Producidos
@endsection

@section('page-title')
    <a href="{{ route('admin.registroProducidos.index') }}">Reporte de Producidos</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Resumen produccion</h2>

@stop
@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" />

    <style>
        #filtro-panel {
            /* position: fixed; */
            top: 0;
            right: 0;
            width: 0;
            height: 100%;
            /* background-color: #fff; */
            /* border-left: 1px solid #ccc; */
            /* box-shadow: -5px 0 10px rgba(0, 0, 0, 0.1); */
            transition: width 0.3s ease-in-out;
            overflow-x: hidden;
        }

        #filtro-panel.open {
            width: 430px;
            /* Ancho deseado del panel */
        }

        #fecha-inicial,
        #fecha-final {
            margin-right: 10px;
            /* Espacio entre los campos de fecha */
        }

        .filtrar {
            background-color: #0073e6;
            /* Color de fondo para el botón */
            color: #fff;
            /* Color de texto del botón */
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        #filtrar:hover {
            background-color: #0054a6;
            /* Cambiar el color cuando el mouse está sobre el botón */
        }
    </style>
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">

            <div class="row">
                <div class="col-7">
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
                </div>
                <div class="col-5" style="display: flex; flex-direction: row-reverse; justify-content: space-between;">
                    <button type="button" class="btn btn-primary" id="open-filter-modal" data-toggle="modal"
                        data-target="#miModal">Abrir Filtros</button>
                </div>
            </div>



            {{-- INICIA TABLA --}}
            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Meta Estudio</th>
                            <th>Obj Diario</th>
                            <th>Produccion Reportada</th>
                            <th>Alarma-Diferencia</th>
                            <th>Cumplio</th>
                            <th>Dias Restantes</th>
                            <th>Valor Proyectado</th>
                            <th>Produccion Total</th>
                            <th>Saldo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fechas as $fecha)
                            <tr data-fecha="{{ $fecha->fecha }}" data-meta="{{ $fecha->meta->id }}">
                                <td>{{ $fecha->fecha }}</td>
                                <td>{{ $fecha->meta->nombre }}</td>
                                <td>
                                    {{ "$ " }}{{ round($fecha->meta->valor / $fecha->meta->dias, 2) }}</td>
                                <td>{{ "$ " }}{{ round($fecha->suma, 2) }}</td>
                                <td
                                    @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0) class="badge badge-success mt-2"
                            @else
                            class="badge badge-danger mt-2" @endif>
                                    {{ "$ " }}{{ round($fecha->suma - $fecha->meta->valor / $fecha->meta->dias, 2) }}
                                </td>
                                <td>
                                    @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0)
                                        Si
                                    @else
                                        No
                                    @endif
                                </td>
                                <td>
                                    @foreach ($fechas3 as $k)
                                        @if ($k->meta_id == $fecha->meta->id)
                                            {{ $fecha->meta->dias - $k->date_count }}
                                        @endif
                                    @endforeach
                                </td>
                                @foreach ($fechas2 as $i)
                                    @if ($i->meta_id == $fecha->meta->id)
                                        @foreach ($fechas3 as $k)
                                            @if ($k->meta_id == $fecha->meta->id)
                                                @php $saldo = $i->suma - ($k->date_count ) * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                                @php $saldoIdeal = ($k->date_count )  * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                                @php $sumaFecha = $i->suma; @endphp
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <td>
                                    {{ "$ " }}{{ round($saldoIdeal, 2) }}

                                </td>
                                <td>
                                    {{ "$ " }}{{ round($sumaFecha, 2) }}

                                </td>
                                <td
                                    @if ($saldo > 0) class="badge badge-success mt-2"

                            @else
                            class="badge badge-danger mt-3" @endif>
                                    {{ "$ " }}{{ round($saldo, 2) }}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>Meta Estudio</th>
                            <th>Obj Diario</th>
                            <th>Produccion Reportada</th>
                            <th>Alarma-Diferencia</th>
                            <th>Cumplio</th>
                            <th>Dias Restantes</th>
                            <th>Valor Proyectado</th>
                            <th>Produccion Total</th>
                            <th>Saldo</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
            {{-- FIN DE LA TABLA --}}


            <div class="modal" id="miModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Contenido del modal -->
                        <div class="modal-header">
                            <h5 class="modal-title">Filtros</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">

                            <input type="radio" name="radio_fecha" id="radio_fecha" onclick="toggleRadioFecha()">
                            <label for="radio_fecha">Fecha</label>

                            <div id="filtro-panel" class="mb-3"
                                style="display: flex; justify-content: center; align-items: center;">


                                <input type="date" id="fecha-inicial">
                                <input type="date" id="fecha-final">
                                <div>
                                    <button id="Limpiar_fechas" class="filtrar">Limpiar</button>

                                </div>


                            </div><br>

                            <input type="radio" name="radio_meta" id="radio_meta" onclick="toggleRadioMeta()">
                            <label for="radio_meta">Meta</label>

                            {{-- <div id="filtro-panel-select" class="mb-3" style="display: flex; justify-content: center; align-items: center;"> --}}
                            <div class="mb-3" style="display: flex; align-items: center;">

                                <select id="metaSelect" class="form-control ml-2" style="margin-bottom: 0;">
                                    <option value="">Seleccione una opción</option>
                                    @foreach ($metas as $meta)
                                        <option value="{{ $meta->id }}">{{ $meta->nombre }}</option>
                                    @endforeach
                                </select>
                                <button id="Limpiar_meta" class="flitrar btn btn-primary"
                                    style="margin-left: 10px;">Limpiar</button>
                            </div>

                            {{-- <button id="Limpiar_meta" class="flitrar btn btn-primary">Limpiar</button> --}}
                            {{-- </div> --}}
                            {{-- </div> --}}
                            <br>

                            <div class="mb-3" style="display: flex; justify-content: center; align-items: center;">
                                <button id="filtrar" class="filtrar mr-2">Filtrar</button>
                                <!-- Agregamos un margen a la derecha -->
                                <button id="Limpiar" class="filtrar">Limpiar</button>
                            </div>
                        </div>
                        {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- <div class="card">

        <div class="card-body">

        </div>

        <table id="registroProducidos" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>

            </thead>
            <tbody>

            </tbody>
        </table>
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
        var table = $('#html5-extension').DataTable({
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [{
                        extend: 'excel',
                        className: 'btn',

                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9], // Incluye las columnas necesarias
                            format: {
                                body: function(data, rowIdx, colIdx, node) {
                                    // Formatea las columnas 2, 3 y 4 para eliminar el signo de dólar y convertirlas en números
                                    if (colIdx === 2 || colIdx === 3 || colIdx === 4 || colIdx === 7 ||
                                        colIdx === 8 || colIdx === 9) {
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
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7,
            paging: true, // Habilita la paginación
            info: true, // Habilita la información de registros
        });

        // Detectar cambios en el select
        $('#records-per-page').on('change', function() {
            var newPageLength = $(this).val(); // Obtener el nuevo valor seleccionado

            table.page.len(newPageLength).draw(); // Cambiar la longitud de página y redibujar la tabla
        });

        var radioActivo_fecha = 0;
        var radio_fecha = document.getElementById("radio_fecha");

        function toggleRadioFecha() {

            if (radioActivo_fecha == 0) {
                radio_fecha.checked = true;
                radioActivo_fecha = 1;
            } else {
                radioActivo_fecha = 0;
                radio_fecha.checked = false;
            }
        }

        var radioActivo_meta = 0;
        var radio_meta = document.getElementById("radio_meta");

        function toggleRadioMeta() {

            if (radioActivo_meta == 0) {
                radio_meta.checked = true;
                radioActivo_meta = 1;
            } else {
                radioActivo_meta = 0;
                radio_meta.checked = false;
            }
        }

        $(document).ready(function() {

            var rowsShowFecha = 0;
            var rowsHideFecha = 0;
            var clickFil = 0;


            document.getElementById('open-filter-modal').addEventListener('click', function() {
                document.getElementById('filtro-panel').classList.add('open');
            });

            //se ejecta pra actualizar la cantidad de registros
            $('#filtrar').on('click', function() {
                // Cambiar la longitud de página a 50 (o tu valor deseado)
                table.page.len(100).draw();
                ejecutarFiltro();
            });

            //se ejecta pra actualizar la cantidad de registros
            $('#filtrar').on('click', function() {
                // Cambiar la longitud de página a 50 (o tu valor deseado)
                table.page.len(100).draw();
                ejecutarFiltro();
            });


            table.on('draw.dt', function() {
                // var infoText = "Mostrando " + 1 + " a " + rowsShowFecha + " de " + (rowsShowFecha + rowsHideFecha) +
                //     " registros visibles";
                var infoText = "Mostrando un total de " + rowsShowFecha + " Registros filtrados";
                $(".dataTables_info").html(infoText);
            });


            function ejecutarFiltro() {
                var fechaInicial = new Date($('#fecha-inicial').val());
                var fechaFinal = new Date($('#fecha-final').val());
                var selectedMetaId = $("#metaSelect").val(); // Obtener la meta seleccionada en el select
                $('#records-per-page').prop('disabled', true);

                // Reiniciar las variables antes de contar
                rowsShowFecha = 0;
                rowsHideFecha = 0;

                // Reiniciar las variables antes de contar
                rowsShowMeta = 0;
                rowsHideMeta = 0;

                if (radio_meta.checked == true && radio_fecha.checked == true) {

                    if (fechaInicial.toString() === "Invalid Date" && fechaFinal.toString() === "Invalid Date") {
                        // Muestra un mensaje de error con SweetAlert2
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Error',
                            text: 'Faltan fechas inicial y final',
                        });
                        return false;
                    } else {
                        if (fechaInicial.toString() === "Invalid Date") {
                            // Muestra un mensaje de advertencia con SweetAlert2
                            Swal.fire({
                                position: 'top-end',
                                type: 'warning',
                                title: 'Para este filtro falta fecha inicial',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return false;
                        }

                        if (fechaFinal.toString() === "Invalid Date") {
                            // Muestra un mensaje de advertencia con SweetAlert2
                            Swal.fire({
                                position: 'top-end',
                                type: 'warning',
                                title: 'Para este filtro falta fecha final',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return false;
                        }
                    }

                    if (selectedMetaId == "") {
                        // Muestra un mensaje de error con SweetAlert2
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Error',
                            text: 'Debe Seleccionar una Opcion',
                        });
                        return false;
                    }

                    table.column(0).data().each(function(value, index) {
                        var fechaFila = new Date(value);
                        var metaId = $(table.row(index).node()).data("meta");

                        if (
                            (fechaFila >= fechaInicial && fechaFila <= fechaFinal) &&
                            (selectedMetaId === "" || selectedMetaId == metaId)
                        ) {
                            $(table.row(index).node()).show();
                            rowsShowFecha += 1;
                            rowsShowMeta += 1;
                        } else {
                            $(table.row(index).node()).hide();
                            rowsHideFecha += 1;
                            rowsHideMeta += 1;
                        }
                    });
                } else if (radio_fecha.checked == true) {

                    if (fechaInicial.toString() === "Invalid Date" && fechaFinal.toString() === "Invalid Date") {
                        // Muestra un mensaje de error con SweetAlert2
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Error',
                            text: 'Faltan fechas inicial y final',
                        });
                        return false
                    } else {
                        if (fechaInicial.toString() === "Invalid Date") {
                            // Muestra un mensaje de advertencia con SweetAlert2
                            Swal.fire({
                                position: 'top-end',
                                type: 'warning',
                                title: 'Para este filtro falta fecha inicial',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return false
                        }

                        if (fechaFinal.toString() === "Invalid Date") {
                            // Muestra un mensaje de advertencia con SweetAlert2
                            Swal.fire({
                                position: 'top-end',
                                type: 'warning',
                                title: 'Para este filtro falta fecha final',
                                showConfirmButton: false,
                                timer: 2000
                            });
                            return false
                        }

                        table.column(0).data().each(function(value, index) {
                            var fechaFila = new Date(value);

                            if (fechaFila >= fechaInicial && fechaFila <= fechaFinal) {
                                $(table.row(index).node()).show();
                                rowsShowFecha += 1;
                            } else {
                                $(table.row(index).node()).hide();
                                rowsHideFecha += 1;
                            }
                        });

                        document.getElementById('filtro-panel').classList.add('open');
                    }

                } else if (radio_meta.checked == true) {

                    if (selectedMetaId == "") {
                        // Muestra un mensaje de error con SweetAlert2
                        Swal.fire({
                            position: 'top-end',
                            type: 'error',
                            title: 'Error',
                            text: 'Debe Seleccionar una Opcion',
                        });
                        return false
                    }

                    table.column(0).data().each(function(value, index) {
                        var metaId = $(table.row(index).node()).data(
                            "meta"); // Obtener el valor de data-meta de la fila

                        if (selectedMetaId === "" || selectedMetaId == metaId) {
                            $(table.row(index).node()).show();
                            rowsShowFecha += 1;
                        } else {
                            $(table.row(index).node()).hide();
                            rowsHideFecha += 1;
                        }
                    });
                }

            }

        });

        $('#Limpiar_fechas').on('click', function() {
            // Limpiar los campos de fecha
            $('#fecha-inicial').val('');
            $('#fecha-final').val('');
            radioActivo_fecha = 0;
            radio_fecha.checked = false;

        });

        $('#Limpiar_meta').on('click', function() {
            document.getElementById("metaSelect").value = "";
            radioActivo_meta = 0;
            radio_meta.checked = false;
        });

        $('#Limpiar').on('click', function() {
            // Limpiar los campos de fecha
            $('#fecha-inicial').val('');
            $('#fecha-final').val('');
            radioActivo_fecha = 0;
            radio_fecha.checked = false;

            document.getElementById("metaSelect").value = "";
            radioActivo_meta = 0;
            radio_meta.checked = false;

            // Mostrar todas las filas
            $('table tbody tr').show();
        });
    </script>
    <script src="{{ asset('assets/libs/switchery/switchery.min.js') }}"></script>
    <script></script>

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
            $('#registroProducidos').DataTable({
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
