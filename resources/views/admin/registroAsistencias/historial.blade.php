@extends('template.index')

@section('tittle-tab')
    Historial de Asistenicias
@endsection

@section('page-title')
    <a href="{{ route('admin.reportePaginas.index') }}">Historial de Asistenicias</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Historial de Asistencia</h2>
@stop

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/libs/switchery/switchery.min.css') }}" />
@stop

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row">
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
            </div>
            <div class="mq-960">

                @can('admin.registroAsistencias.create')
                    <a class="btn btn-primary float-right mr-4" href="{{ route('admin.registroAsistencias.index') }}">Regresar</a>
                @endcan
            </div>

            <div class="table-responsive mb-4 mt-4">

                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Fecha</th>
                            <th hidden>Actualizacion</th>
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
                            <th hidden>Actualizacion</th>
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
@stop

@section('js')
    <script src="{{ asset('template/plugins/table/datatable/datatables.js') }}"></script>
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
            "order": [
                [3, 'desc']
            ]
        });

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
                            const formulario = document.createElement('form');
                            formulario.action =
                                `registroAsistencias/${asistenciaId}`;
                            formulario.method = 'POST';
                            formulario.style.display = 'none';
                            const tokenField = document.createElement('input');
                            tokenField.type = 'hidden';
                            tokenField.name = '_token';
                            tokenField.value = '{{ csrf_token() }}';
                            formulario.appendChild(tokenField);
                            const methodField = document.createElement('input');
                            methodField.type = 'hidden';
                            methodField.name = '_method';
                            methodField.value = 'DELETE';
                            formulario.appendChild(methodField);
                            document.body.appendChild(formulario);
                            formulario.submit();

                            return true;
                        },
                    });
                });
            });
        }

        table.on('draw.dt', function() {
            bindDeleteEvents();
        });

        $('#records-per-page').change(function() {
            var newLength = $(this).val();
            table.page.len(newLength).draw();
        });

        bindDeleteEvents();

        $('#configModal').on('click', '.btn-primary', function() {
            var id = $('#config_id').val();
            var minutos = $('#tiempo').val();
            var nombre = $('#nombre').val();
            $.ajax({
                type: 'PUT',
                url: '{{ route('admin.registroAsistencia.configAsistencia') }}',
                data: {
                    _token: '{{ csrf_token() }}',
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
@stop
