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
            {{-- <div class="card"> --}}
            {{-- <div class="card-body">
                    <div class="row">
                        <div class="col">
                            @yield('content_header')
                        </div> --}}
            <div class="row">

                <div class="col">


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

            {{-- </div>
            </div> --}}

            <div class="table-responsive mb-4 mt-4">

                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Valor</th>

                            <th>Meta</th>
                            <th>Pagina</th>
                            <th>Usuario que registra</th>
                            @can('admin.registroProduccion.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroProduccion.destroy')
                                <th>Eliminar</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($registroProducidos as $registroProducido)
                            <tr>
                                <td>{{ $registroProducido->id }}</td>
                                <td>{{ $registroProducido->fecha }}</td>
                                <td>{{ $registroProducido->valorProducido }}</td>

                                <td>{{ $registroProducido->meta->nombre }}</td>
                                <td>{{ $registroProducido->pagina->nombre }}</td>
                                <td>{{ $registroProducido->user->name }}</td>

                                @if (auth()->user()->hasRole('Admin'))
                                    @include('admin.registroProducidos.partials.buttons')
                                @elseif($registroProducido->user->id == $userLogueado)
                                    @include('admin.registroProducidos.partials.buttons')
                                @else
                                    <td class="text-center"> <i class="fas fa-eye-slash"> </i> </td>
                                    <td class="text-center"> <i class="fas fa-eye-slash"> </i> </td>
                                @endif

                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Fecha</th>
                            <th>Valor</th>

                            <th>Meta</th>
                            <th>Pagina</th>
                            <th>Usuario que registra</th>
                            @can('admin.registroProduccion.edit')
                                <th>Editar</th>
                            @endcan
                            @can('admin.registroProduccion.destroy')
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

                    const registroProducidoId = this.getAttribute('data-registroProducido-id');




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
                                `registroProducidos/${registroProducidoId}`; // Ruta de eliminación
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

    {{-- <script>
        document.querySelectorAll('.eliminar-registro').forEach(botonEliminar => {
            botonEliminar.addEventListener('click', function(e) {
                e.preventDefault();

                const registroProducidoId = this.getAttribute('data-registroProducido-id');

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
                            `registroProducidos/${registroProducidoId}`; // Ruta de eliminación
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
