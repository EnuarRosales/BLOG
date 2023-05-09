@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignacion Multa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @can('admin.registroMultas.create')
                <a class="btn btn-primary" href="{{ route('admin.asignacionMultas.create') }}">Agregar Asignacion Multa</a>
            @endcan
        </div>
        <table id="asignacionMultas" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Tipo multa</th>
                    <th>Valor Multa</th>
                    <th>Fecha</th>
                    @can('admin.registroMultas.edit')
                        <th>Editar</th>
                    @endcan
                    @can('admin.registroMultas.destroy')
                        <th>Eliminar</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($asignacionMultas as $asignacionMulta)
                    @if (auth()->user()->hasRole('Admin'))
                        @include('admin.asignacionMultas.partials.table')
                    @elseif (auth()->user()->hasRole('Monitor'))
                        @include('admin.asignacionMultas.partials.table')
                    @elseif($asignacionMulta->user->id == $userLogueado)
                        @include('admin.asignacionMultas.partials.table')
                    @endif
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
                title: 'Asignacion de multa realizada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Asignacion demulta editada correctamente',
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
            $('#asignacionMultas').DataTable(); //
        });
    </script>

@stop
