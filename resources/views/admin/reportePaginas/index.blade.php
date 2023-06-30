@extends('adminlte::page')

@section('title', 'Reporte Paginas')

@section('content_header')
    <h1>Listado de Reportes Paginas </h1>
@stop


@section('content')

    {{-- CONFIRMACION SI HAY ALGO MAL --}}
    @if (isset($errors) && $errors->any())
        @include('admin.reportePaginas.partials.modal-error')
    @endif

    <div class="card">
        <div class="card-body">
            {{-- @can('admin.asignacionTurnos.create') --}}
            <a class="btn btn-primary" href="{{ route('admin.reportePaginas.create') }}">Carga individual</a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Cargar Excel
            </button>
            @include('admin.reportePaginas.partials.import-excel')

            <a class="btn btn-primary" href="{{ route('admin.reportePaginas.reporteQuincena') }}">Porcentajes</a>

            <a class="btn btn-primary" href="{{ route('admin.reportePaginas.pagos') }}">Pagos</a>
            <a class="btn btn-primary " href="{{ route('admin.reportePaginas.verificadoMasivo') }}">Verificado Masivo</a>
        </div>
        <table id="reportePaginas" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    {{-- <th>ID</th>
                    <th>Fecha</th>
                    <th>Modelo</th>
                    <th>Pagina</th>
                    <th>Cantidad Tokens </th>
                    <th>TRM</th> --}}

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
                        <td>{{ $reportePagina->porcentaje }}{{ ' %' }}</td>
                        <td>{{ number_format($reportePagina->metaModelo->porcentaje) }}</td>
                        <td>{{ number_format($reportePagina->porcentajeTotal) }}</td>
                        <td>{{ number_format($reportePagina->netoPesos, 2, '.', ',') }}</td>
                        <td id={{ $reportePagina->verificado }}>

                            {{--@if ($reportePagina->verificado == 1)
                                <button type="button" class="btn btn-secondary btn-sm btn-success">Activa</button>
                            @else
                                <button type="button" class="btn btn-secondary btn-sm btn-danger">Inactiva</button>
                            @endif--}}
                            <input type="checkbox" data-plugin="switchery" data-color="#77dd77"
                                   {{$reportePagina->verificado?'checked':''}} data-id="{{$reportePagina->id}}"
                                   data-secondary-color="#ff6961" data-size="small"/>
                        </td>

                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.reportePaginas.edit', $reportePagina) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form class="formulario-eliminar"
                                action="{{ route('admin.reportePaginas.destroy', $reportePagina) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/switchery/switchery.min.css')}}" />
@stop

@section('js')
    <script src="{{asset('assets/libs/switchery/switchery.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                icon: 'success',
                title: 'Descuento registrado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'valorCero')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: 'No hay saldo que descontar',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
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
                icon: 'warning',
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
            $('#reportePaginas').DataTable({
                dom: 'Blfrtip',

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

        });

        $('[data-plugin="switchery"]').each(function (a, e) {
            let checkbox = new Switchery($(this)[0], $(this).data());
            $(this).change(function () {
                var id = $(this).data('id');
                var active = $(this).prop('checked');
                console.log(active);
                {{--{{route('admin.reportePaginas.updateStatus')}}--}}
                $.ajax({
                    url: `{{route('admin.reportePaginas.updateStatus')}}`,
                    type: 'post',
                    headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
                    dataType: 'json',
                    data: {id: id, active: active ? 1 : 0},
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (jqXHR, exception) {
                        console.log(jqXHR, exception);
                    }
                });
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
