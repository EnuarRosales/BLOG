@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Asignacion Turno</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            @can('admin.asignacionTurnos.create')
                <a class="btn btn-primary" href="{{ route('admin.asignacionTurnos.create') }}">Agregar Asignacion Turno</a>
            @endcan
 
        </div>
        <table id="asignacionTurnos" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo Persona</th>
                    <th>Turno Asignado</th>
                    @can('admin.asignacionTurnos.edit')
                        <th>Editar</th>
                    @endcan
                    @can('admin.asignacionTurnos.destroy')
                        <th>Eliminar</th>
                    @endcan
                </tr>
            </thead>
            <tbody>
                @foreach ($asignacionTurnos as $asignacionTurno)
                    <tr>
                        <td>{{ $asignacionTurno->id }}</td>
                        <td>{{ $asignacionTurno->user->name }}</td>
                        <td>{{ $asignacionTurno->user->tipoUsuario->nombre }}</td>
                        <td>{{ $asignacionTurno->turno->nombre }}</td>
                        @can('admin.asignacionTurnos.edit')
                            <td width="10px">
                                <a class="btn btn-secondary btn-sm"
                                    href="{{ route('admin.asignacionTurnos.edit', $asignacionTurno) }}">Editar</a>
                            </td>
                        @endcan
                        @can('admin.asignacionTurnos.destroy')
                            <td width="10px">
                                <form class="formulario-eliminar"
                                    action="{{ route('admin.asignacionTurnos.destroy', $asignacionTurno) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                                </form>
                            </td>
                        @endcan
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
                title: 'Asignacion de turno realizada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Asignacion de turno editada correctamente',
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
            $('#asignacionTurnos').DataTable(); //
        });
    </script>

@stop



{{-- PARA CAMBIAR LA PAGI --}}
{{-- {    
    "lengthMenu":[[5 ,10 ,50 ,-1 ],5,10,50,"all"]
} --}}
