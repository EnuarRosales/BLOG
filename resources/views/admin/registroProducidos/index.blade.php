@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de Producidos </h1>
@stop


@section('content')
    <div class="card">
        <div class="card-body">
            {{-- @can('admin.asignacionTurnos.create') --}}
            <a class="btn btn-primary" href="{{ route('admin.registroProducidos.create') }}">Agregar Producido</a>

            <a class="btn btn-secondary" href="{{ route('admin.registroProducidoss.reporte_dia') }}">Resumen</a>
            {{-- @endcan --}}
        </div>



        <table id="registroProducidos" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Valor</th>
                    <th>Alarma</th>
                    <th>Cumplio</th>
                    <th>Saldo</th>
                    <th>Meta</th>
                    <th>Pagina</th>
                    <th>Usuario</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registroProducidos as $registroProducido)
                    <tr>
                        <td>{{ $registroProducido->id }}</td>
                        <td>{{ $registroProducido->fecha }}</td>
                        <td>{{ $registroProducido->valorProducido }}</td>
                        <td>{{ $registroProducido->alarma }}</td>
                        <td>{{ $registroProducido->cumplio }}</td>
                        <td>{{ $registroProducido->saldo }}</td>
                        <td>{{ $registroProducido->meta->nombre }}</td>
                        <td>{{ $registroProducido->pagina->nombre }}</td>
                        <td>{{ $registroProducido->user->name }}</td>


                        {{-- @can('admin.asignacionTurnos.edit') --}}
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.registroProducidos.edit', $registroProducido) }}">Editar</a>
                        </td>
                        {{-- @endcan
                        {{-- @can('admin.registroAsistencias.destroy') --}}
                        <td width="10px">
                            <form class="formulario-eliminar"
                                action="{{ route('admin.registroProducidos.destroy', $registroProducido) }}"
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="styleshet">
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
                title: 'Producido registrado correctamente',
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

    {{-- <script>
        $(document).ready(function() {
            $('#registroProducidos').DataTable(); //
        });
    </script> --}}

    <script>
        var table = $('#registroProducidos').DataTable();
        // Sort by column 1 and then re-draw
        table
            .order([
                [1, 'asc']
            ])
            .draw(true);
    </script>

@stop
