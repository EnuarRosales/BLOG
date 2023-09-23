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
                        <label class="mt-2">Mostrar:</label>
                        <select id="records-per-page" class="form-control form-control-sm custom-width-20">
                            <!-- Agregamos la clase form-control-sm -->
                            <option value="7">7</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                        </select>
                        <span class="ml-2 mt-2">registros por página</span>
                    </div>
                    <div class="mq-960">

                        <a class="btn btn-info float-right"
                            href="{{ route('admin.reportePaginas.verificadoMasivo') }}">Verificado
                            Masivo</a>

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
                                <th>TRM</th>
                                <th>Pesos</th>
                                <th>Porcentaje</th>
                                <th>Meta Porcentaje</th>
                                <th>Porcentaje Total</th>
                                <th>Total Pesos</th>
                                <th>Estado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reportePaginas as $reportePagina)
                                <tr>
                                    <td>{{ $reportePagina->id }}</td>
                                    <td>{{ $reportePagina->fecha }}</td>
                                    <td>{{ $reportePagina->user->name }}</td>
                                    <td>{{ $reportePagina->pagina->nombre }}</td>
                                    <td>{{ number_format($reportePagina->Cantidad) }}</td>
                                    <td>{{ $reportePagina->valorPagina }}</td>
                                    <td>{{ number_format($reportePagina->dolares, 2, '.', ',') }}</td>
                                    <td>{{ number_format($reportePagina->TRM, 2, '.', ',') }}</td>
                                    <td>{{ number_format($reportePagina->pesos, 2, '.', ',') }}</td>
                                    <td>{{ $reportePagina->user->tipoUsuario->porcentaje }}{{ ' %' }}</td>
                                    <td>{{ number_format($reportePagina->metaModelo) }}</td>
                                    <td>{{ number_format($reportePagina->porcentajeTotal) }}</td>
                                    <td>{{ number_format($reportePagina->netoPesos, 2, '.', ',') }}</td>
                                    <td id={{ $reportePagina->verificado }}>

                                        <div class="n-chk">
                                            <label class="new-control new-checkbox new-checkbox-rounded checkbox-primary">
                                                <input type="checkbox" {{ $reportePagina->verificado ? 'checked' : '' }}
                                                    class="new-control-input">
                                                <span class="new-control-indicator"></span> Estatus
                                            </label>
                                        </div>
                                        {{-- <input type="checkbox" class="new-control-input"

                                        data-id="{{ $reportePagina->id }}">
                                    <span class="new-control-indicator"></span> --}}
                                        {{-- <input type="checkbox" data-plugin="switchery" data-color="#77dd77"
                                        {{ $reportePagina->verificado ? 'checked' : '' }}
                                        data-id="{{ $reportePagina->id }}" data-secondary-color="#ff6961"
                                        data-size="small" /> --}}
                                    </td>

                                    <td width="10px">

                                        <a href="{{ route('admin.reportePaginas.edit', $reportePagina) }}"
                                            class="ml-4 rounded bs-tooltip" data-placement="top" title="Editar">
                                            <svg class="mr-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-edit-3">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                    <td width="10px">
                                        <a href="javascript:void(0);" class="ml-2 eliminar-registro rounded bs-tooltip"
                                            data-placement="top" title="Eliminar"
                                            data-reportePagina-id="{{ $reportePagina->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-x-circle table-cancel">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                                <line x1="9" y1="9" x2="15" y2="15"></line>
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
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
                                <th>TRM</th>
                                <th>Pesos</th>
                                <th>Porcentaje</th>
                                <th>Meta Porcentaje</th>
                                <th>Porcentaje Total</th>
                                <th>Total Pesos</th>
                                <th>Estado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
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

        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" /> --}}
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
                    "sLengthMenu": "Mostrar _MENU_ resultados por página",
                },
                "stripeClasses": [],
                "lengthMenu": [7, 10, 20, 50],
                "pageLength": 7
            });

            // Vincular eventos de clic para eliminar
            function bindDeleteEvents() {
                document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
                    botonEliminar.addEventListener('click', function(e) {
                        e.preventDefault();

                        const reportePaginaId = this.getAttribute('data-reportePagina-id');




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
                                formulario.action =
                                    `reportePaginas/${reportePaginaId}`; // Ruta de eliminación
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
        </script>
        <script src="{{ asset('assets/libs/switchery/switchery.min.js') }}"></script>
        {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
        {{-- <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

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
                    title: 'Descuento correctamente',
                    showConfirmButton: false,
                    timer: 2000
                })
            </script>
        @endif


    @stop
