@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado tipo moneda paginas</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.tipoMonedaPaginas.create') }}">Agregar tipo moneda pagina</a>
        </div>
        <table class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Valor</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($tipoMonedaPaginas as $tipoMonedaPagina)
                    <tr>
                        <td>{{ $tipoMonedaPagina->id }}</td>
                        <td>{{ $tipoMonedaPagina->nombre }}</td>
                        <td>{{ $tipoMonedaPagina->valor }}</td>
                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.tipoMonedaPaginas.edit', $tipoMonedaPagina) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form class="formulario-eliminar"
                                action="{{ route('admin.tipoMonedaPaginas.destroy', $tipoMonedaPagina) }}" method="POST">
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
                title: 'Tipo moneda pagina creada correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tipo moneda pagina actualizada correctamente',
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
