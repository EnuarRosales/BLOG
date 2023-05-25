@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado tipo metas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoMetas.create') }}">Agregar tipo meta</a>
        </div>
        <table class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Numero dias</th>
                    <th>Editar</th>
                    <th>Eliminar</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($tipoMetas as $tipoMeta)
                    <tr>
                        <td>{{ $tipoMeta->id }}</td>
                        <td>{{ $tipoMeta->nombre }}</td>
                        <td>{{ $tipoMeta->valor }}</td>
                        <td>{{ $tipoMeta->dias }}</td>

                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.tipoMetas.edit', $tipoMeta) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form class="formulario-eliminar" action="{{ route('admin.tipoMetas.destroy', $tipoMeta) }}"
                                method="POST">
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

@section('js')
    <script>
        console.log('Hi!');
    </script>

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
                title: 'Tipo Meta creada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tipo Meta actualizada correctamente',
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

@stop
