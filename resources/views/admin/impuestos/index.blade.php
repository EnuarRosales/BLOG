@extends('adminlte::page')

@section('title', 'Studio WC')

@section('content_header')
    <h1>Lista de impuestos</h1>
@stop


@section('content')

    {{-- @if (session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif --}}

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.impuestos.create') }}">Agregar Impuesto</a>
        </div>
        <table class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Porcentaje</th>
                    <th>Mayor Que</th>
                    <th>Activo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>


                </tr>
            </thead>


            <tbody>
                @foreach ($impuestos as $impuesto)
                    <tr>
                        <td>{{ $impuesto->id }}</td>
                        <td>{{ $impuesto->nombre }}</td>
                        <td>{{ $impuesto->porcentaje }}</td>
                        <td>{{ $impuesto->mayorQue }}</td>
                        {{-- <td>{{ $impuesto->estado }}</td> --}}

                        <td>

                            {{-- @if ($impuesto->estado == 1)
                                <button type="button" class="btn btn-secondary btn-sm btn-success">Activa</button>
                            @else
                                <button type="button" class="btn btn-secondary btn-sm btn-danger">Inactiva</button>
                            @endif --}}

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pruba" id="radio1">
                                <label  class="form-check-label" for="radio1">{{$impuesto->estado}}</label>
}}
                            </div>

                        </td>




                        <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.impuestos.edit', $impuesto) }}">Editar</a>
                        </td>

                        <td class="bg-light" width="10px">
                            <form class="formulario-eliminar" action="{{ route('admin.impuestos.destroy', $impuesto) }}"
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
                title: 'Tipo Usuario realizado correctamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @elseif(session('info') == 'update')
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Tipo Usuario actualizado correctamente',
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
