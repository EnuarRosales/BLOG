@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Personal</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            
        </div>
        <table id="users" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha ingreso</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Celular</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Tipo Usuario</th>
                    @can('admin.users.edit')
                        <th>Certificacion</th>
                    @endcan                    
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->fechaIngreso}}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->cedula }}</td>
                        <td>{{ $user->celular }}</td>
                        <td>{{ $user->direccion }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->tipoUsuario->nombre }}</td>

                        @can('admin.users.edit')
                            <td width="10px" style="text-align:center">
                                <a class="btn btn-secondary btn-sm" target="_blank" href="{{ route('admin.users.certificacionLaboralPDF', $user) }}">Ver</a>
                            </td>
                        @endcan
                        
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="styleshet"> --}}


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />




@stop

@section('js')
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
                title: 'Usuario creado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Usuario actualizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'updateRol')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Asignacion de rol exitosa',
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
            $('#users').DataTable({
                dom: 'Blfrtip',

                buttons: [
                    'copy', 'csv', 'excel','pdf', 'print'
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