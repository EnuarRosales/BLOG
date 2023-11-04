@extends('template.index')

@section('tittle-tab')
    Reporte de Asistenicias
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Reporte de Asistenicias</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Lista de asistencia</h2>
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
            {{-- <div class="card">
                <div class="card-body"> --}}
            <div class="row">
                {{-- <div class="col">
                            @yield('content_header')
                        </div> --}}
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

                        @can('admin.registroAsistencias.create')
                            <a class="btn btn-primary float-right mr-4"
                                href="{{ route('admin.registroAsistencias.create') }}">Registrar
                                Asistencia</a>
                        @endcan
                        @can('admin.registroAsistencias.create')
                            <button class="btn btn-primary float-right mr-4" data-toggle="modal"
                                data-target="#configModal">Tiempo de Advertencia</button>
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
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Multa</th>
                            @can('admin.registroAsistencias.control')
                                <th>Control</th>
                            @endcan
                            @can('admin.registroAsistencias.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroAsistencias.destroy')
                                <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($asistencias as $asistencia)
                            @if (auth()->user()->hasRole('Administrador') ||
                                    auth()->user()->hasRole('Monitor') ||
                                    $asistencia->user->id == $userLogueado)
                                @include('admin.registroAsistencias.partials.table')
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Multa</th>
                            @can('admin.registroAsistencias.control')
                                <th>Control</th>

                            @endcan
                            @can('admin.registroAsistencias.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroAsistencias.destroy')
                                <th>Eliminar</th>
                            @endcan
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="configModalLabel">Configuración de Tiempo de Advertencia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Campo para ingresar el nombre -->
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="hidden" value="{{ $configAsistencia->id }}" id="config_id">
                        <input type="text" class="form-control" id="nombre" placeholder="Escribe el nombre aquí"
                            value="{{ $configAsistencia->nombre }}">
                    </div>
                    <!-- Campo para ingresar los minutos -->
                    <div class="form-group">
                        <label for="tiempo">Minutos:</label>
                        <input type="text" class="form-control" id="tiempo" placeholder="Escribe los minutos aquí"
                            value="{{ $configAsistencia->tiempo / 60 }}">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>
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
                buttons: [
                    // {
                    //     extend: 'copy',
                    //     className: 'btn'
                    // },
                    // {
                    //     extend: 'csv',
                    //     className: 'btn'
                    // },
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
            "pageLength": 7
        });

        // Vincular eventos de clic para eliminar
        function bindDeleteEvents() {
            document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
                botonEliminar.addEventListener('click', function(e) {
                    e.preventDefault();

                    const asistenciaId = this.getAttribute('data-asistencia-id');



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
                                `registroAsistencias/${asistenciaId}`; // Ruta de eliminación
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

        // Manejar el clic en el botón "Guardar" dentro del modal
        $('#configModal').on('click', '.btn-primary', function() {
            // Obtener los valores ingresados por el usuario
            var id = $('#config_id').val();
            var minutos = $('#tiempo').val();
            var nombre = $('#nombre').val();

            // Realizar una solicitud PUT (o POST) a la ruta
            $.ajax({
                type: 'PUT', // Cambiar a 'POST' si es necesario
                url: '{{ route('admin.registroAsistencia.configAsistencia') }}',
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF para protección
                    id: id,
                    minutos: minutos,
                    nombre: nombre
                },
                success: function(response) {
                    if (response.success) {
                        $('#configModal').modal('hide');
                        Swal.fire(
                            'Actualizado!',
                            'El tiempo de advertencia se Actualizo',
                            'success'
                        )
                    }

                },
                error: function(xhr, status, error) {
                    // Manejar cualquier error, si es necesario
                    console.error('Error al guardar datos');
                }
            });
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
    @endif
    {{--
    <script>
        document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
            botonEliminar.addEventListener('click', function(e) {
                e.preventDefault();

                const asistenciaId = this.getAttribute('data-asistencia-id');

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
                            `registroAsistencias/${asistenciaId}`; // Ruta de eliminación
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
    </script> --}}





@stop
