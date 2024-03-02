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
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Monto a Descuentar</th>
                            <th>Monto Descontado</th>
                            <th>Saldo</th>
                            <th>Tipo Descuento</th>
                            <th>Usuario</th>
                            @can(['admin.registroDescuentos.total', 'admin.registroDescuentos.parcial'])
                                <th>Descontar</th>
                            @endcan
                            {{-- @can('')
                                <th>Descontar</th>
                            @endcan --}}
                            @can('admin.registroDescuentos.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroDescuentos.destroy')
                                <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registroDescuentos as $registroDescuento)
                            @if (auth()->user()->hasRole('Administrador'))
                                @include('admin.registroDescuentos.partials.table')
                            @elseif (auth()->user()->hasRole('Monitor'))
                                @include('admin.registroDescuentos.partials.table')
                            @elseif($registroDescuento->user->id == $userLogueado)
                                @include('admin.registroDescuentos.partials.table')
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Monto a Descuentar</th>
                            <th>Monto Descontado</th>
                            <th>Saldo</th>
                            <th>Tipo Descuento</th>
                            <th>Usuario</th>
                            @can(['admin.registroDescuentos.total', 'admin.registroDescuentos.parcial'])
                                <th>Descontar</th>
                            @endcan
                            @can('admin.registroDescuentos.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroDescuentos.destroy')
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

                    const registroDescuentoId = this.getAttribute('data-registroDescuento-id');





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
                                `registroDescuentos/${registroDescuentoId}`; // Ruta de eliminación
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
    <script>
        console.log('Hi!');
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
