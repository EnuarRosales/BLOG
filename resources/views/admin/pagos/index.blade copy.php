@extends('template.index')

@section('tittle-tab')
    Certificaciones-Laboral
@endsection

@section('page-title')
    <a href="{{ route('admin.users.userCertificacion') }}"> Certificaciones-Laboral</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Pagos</h2>
@stop

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

@endsection

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row">
                <div class="col-2">
                    <div style="display: flex; padding-top:20px">
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
                <div class="col-5">
                </div>
                <div class="col-md-2">
                    <label for="mes">Año:</label>
                    <select name="anio" id="anio" class="form-control">
                        <option value="">Seleccionar año</option>
                        @foreach ($anios as $anio)
                          <option value="{{ $anio }}">{{ $anio }}</option>
                        @endforeach
                      </select>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="mes">Mes:</label>
                        <select name="mes" id="mes" class="form-control">
                            <option value="" selected>Seleccione un mes</option>
                            <option value="01">01 - Enero</option>
                            <option value="02">02 - Febrero</option>
                            <option value="03">03 - Marzo</option>
                            <option value="04">04 - Abril</option>
                            <option value="05">05 - Mayo</option>
                            <option value="06">06 - Junio</option>
                            <option value="07">07 - Julio</option>
                            <option value="08">08 - Agosto</option>
                            <option value="09">09 - Septiembre</option>
                            <option value="10">10 - Octubre</option>
                            <option value="11">11 - Noviembre</option>
                            <option value="12">12 - Diciembre</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1" style="padding: 33px">
                    <button type="submit" class="btn btn-primary" id="btnFiltrar">Filtrar</button>
                </div>
            </div>

            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Devengado</th>
                            <th>Descuentos</th>
                            <th>Impuestos</th>
                            <th>Multas</th>
                            <th>Neto</th>
                            <th>Comprobante</th>
                            <th hidden>Mes</th>
                            <th hidden>Año</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($pagos as $pago)
                            @if (auth()->user()->hasRole('Administrador'))
                                @include('admin.pagos.partials.tableIndex')
                            @elseif (auth()->user()->hasRole('Monitor'))
                                @include('admin.pagos.partials.tableIndex')
                            @elseif($pago->user->id == $userLogueado)
                                @include('admin.pagos.partials.tableIndex')
                            @endif
                        @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Fecha</th>
                            <th>Nombre</th>
                            <th>Devengado</th>
                            <th>Descuentos</th>
                            <th>Impuestos</th>
                            <th>Multas</th>
                            <th>Neto</th>
                            <th>Comprobante</th>

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
        });

        // Vincular eventos de clic para eliminar
        function bindDeleteEvents() {
            document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
                botonEliminar.addEventListener('click', function(e) {
                    e.preventDefault();
                    const paginasId = this.getAttribute('data-pagina-id');
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¡Este registro se eliminará definitivamente!',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡Sí, eliminar!',
                        cancelButtonText: '¡Cancelar!',
                        preConfirm: () => {
                            // Crear un formulario dinámicamente
                            const formulario = document.createElement('form');
                            formulario.action = `paginas/${paginasId}`; // Ruta de eliminación
                            formulario.method = 'POST'; // Método POST
                            formulario.style.display = 'none'; // Ocultar el formulario

                            // Agregar el token CSRF al formulario
                            const tokenField = document.createElement('input');
                            tokenField.type = 'hidden';
                            tokenField.name = '_token';
                            tokenField.value = '{{ csrf_token() }}';
                            formulario.appendChild(tokenField);

                            // Agregar un campo oculto para indicar que es una solicitud de eliminación
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            formulario.appendChild(methodField);

                            // Adjuntar el formulario al documento y enviarlo
                            document.body.appendChild(formulario);
                            formulario.submit();
                            return true;
                        },
                    });
                });
            });
        }

        // Volver a vincular eventos de clic después de cada redibujo
        table.on('draw.dt', function() {
            bindDeleteEvents();
        });

        // Detectar cambios en el select
        $('#records-per-page').change(function() {
            var newLength = $(this).val();
            table.page.len(newLength).draw();
        });

        // Vincular eventos de clic para eliminar inicialmente
        bindDeleteEvents();

        function filtrarTabla() {
            const mes = $('#mes').val();
            const anio = $('#anio').val();
            table.column(8).search(mes).column(9).search(anio);
            table.draw();
        }

        const btnFiltrar = document.getElementById('btnFiltrar');
        btnFiltrar.addEventListener('click', filtrarTabla);

        $(document).ready(function() {
            const fechaActual = new Date();
            var mesActual = fechaActual.getMonth();
            if (mesActual < 10) {
                mesActual = '0' + mesActual;
            }
            const anioActual = fechaActual.getFullYear();
            console.log(mesActual);
            filtrarTablaIncial(mesActual, anioActual);
        });

        function filtrarTablaIncial(mes, anio) {
            // Código para aplicar filtros
            table.column(8).search(mes)
                .column(9).search(anio);

            table.draw();
        }
    </script>
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
                title: 'Registro de asistencia realizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'success',
                title: 'asistencia editada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif (session('mensaje'))
        <script>
            Swal.fire({
                position: 'top-end',
                type: 'error',
                title: "{{ session('mensaje') }}",
                showConfirmButton: false,
                timer: 5000
            });
        </script>
    @endif


@stop
