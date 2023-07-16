@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Pagos</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- @can('admin.asignacionTurnos.create') --}}
            <a class="btn btn-primary" href="{{ route('admin.pagos.create') }}">Agregar pago</a>
            {{-- @endcan --}}

        </div>
        <table id="registroAsistencias" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th style="text-align:center">Fecha</th>
                    <th style="text-align:center">Nombre</th>
                    <th style="text-align:center">Devengado</th>
                    <th style="text-align:center">Descuentos</th>
                    <th style="text-align:center">Impuestos</th>
                    <th style="text-align:center">Neto</th>
                    <th style="text-align:center">Comprobante</th>
                    <th style="text-align:center">Editar</th>
                    <th style="text-align:center">Eliminar</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pagos as $pago)
                    <tr>
                        <td>{{ $pago->fecha }}</td>
                        <td>{{ $pago->user->name }}</td>
                        <td>{{ $pago->devengado }}</td>
                        <td>{{ $pago->descuento }}</td>
                        <td>{{ $pago->impuestoDescuento }}</td>
                        <td>{{ $pago->neto }}</td>

                        <td width="10px" style="text-align:center">
                            <a class="btn btn-secondary btn-sm" target="_blank" href="{{ route('admin.pagos.comprobantePagoPDF', $pago)}}" >Ver</a>
                        </td>
                        
                        {{-- @can('admin.asignacionTurnos.edit') --}}
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.pagos.comprobantePagoPDF', $pago) }}">Editar</a>
                        </td>
                        {{-- @endcan --}}
                        {{-- @can('admin.registroAsistencias.destroy') --}}
                        <td width="10px">
                            <form class="formulario-eliminar" action="{{ route('admin.pagos.destroy', $pago) }}"
                                method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                            </form>
                        </td>
                        {{-- @endcan --}}
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
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
                title: 'Registro de asistencia realizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'asistencia editada correctamente',
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
            $('#registroAsistencias').DataTable({
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
