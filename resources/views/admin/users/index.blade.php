@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Personal</h1>
@stop

@section('content')    

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.users.create') }}">Agregar Usuario</a>
        </div>
        <table id="users"  class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cedula</th>
                    <th>Celular</th>
                    <th>Direccion</th>
                    <th>Email</th>
                    <th>Tipo Usuario</th>
                    <th>Editar</th>
                    <th>Eliminar</th>                    

                </tr>
            </thead>


            <tbody>
                @foreach ($users as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->cedula }}</td>
                        <td>{{ $usuario->celular }}</td>
                        <td>{{ $usuario->direccion }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->tipoUsuario->nombre }}</td>


                        <td width="10px">
                            <a class="btn btn-secondary btn-sm" href="{{ route('admin.users.edit', $usuario) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form class="formulario-eliminar" action="{{ route('admin.users.destroy', $usuario) }}" method="POST">
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
            $('#users').DataTable(); //
        });
    </script>

@stop
