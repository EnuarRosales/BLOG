@extends('adminlte::page')

@section('title', 'Empresa')

@section('content_header')
    <h1>Empresa</h1>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary mb-4" href="{{ route('admin.empresa.create') }}">Agregar Empresa</a>
            <table id="empresas" class="table table-hover table-striped table-bordered shadow-lg mt-5">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Representante</th>
                    <th>Numero de Rooms</th>
                    <th>Cantidad de modelos</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($empresas as $empresa)
                    <tr>
                        <td>{{ $empresa->name }}</td>
                        <td>{{ $empresa->address }}</td>
                        <td>{{ $empresa->representative }}</td>
                        <td>{{ $empresa->number_rooms }}</td>
                        <td>{{ $empresa->capacity_models }}</td>
                        <td>
                            <div class="btn-group">
                                @can('admin.empresa.edit')
                                    <a href="{{ route('admin.empresa.edit', $empresa) }}" class="btn btn-info btn-sm"
                                       title="Editar empresa">
                                        <i class='fa fa-edit'></i>
                                    </a>
                                @endcan
                                @can('admin.empresa.destroy')
                                    <form class="formulario-eliminar ml-1" action="{{ route('admin.empresa.destroy', $empresa) }}"
                                          method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </form>
                                @endcan
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="styleshet">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#empresas').DataTable(); //
        });
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

        });
    </script>
@stop
