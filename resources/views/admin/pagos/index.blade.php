@extends('template.index')

@section('tittle-tab')
    Certificaciones-Laboral
@endsection

@section('page-title')
    <a href="{{ route('admin.users.userCertificacion') }}"> Certificaciones-Laboral</a>

@endsection

@section('content_header')
    <h2 class="ml-3">Pagos</h2>
@stop

@section('styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/custom_dt_html5.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/plugins/table/datatable/dt-global_style.css') }}">

@endsection

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
        <div class="widget-content widget-content-area br-6">
            <div class="row g-2">
                <div class="col">
                    @yield('content_header')
                </div>
                <div class="col">
                    <a class="btn btn-primary float-right" href="{{ route('admin.paginas.create') }}">Agregar Pagina</a>
                </div>
            </div>
            <div class="table-responsive mb-4 mt-4">
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <div class="row">
                        <div class="col-md-6 d-flex align-items-center ml-3">
                            <label class="mb-0 mr-2">Mostrar:</label>
                            <select id="records-per-page" class="form-control form-control-sm custom-width-20">
                                <!-- Agregamos la clase form-control-sm -->
                                <option value="7">7</option>
                                <option value="10">10</option>
                                <option value="20">20</option>
                                <option value="50">50</option>
                            </select>
                            <span class="ml-2">registros por página</span>
                            <!-- Agregamos un espacio después del select -->
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>

    {{-- <div class="card">
        <div class="card-body">

        </div>
        <table id="registroAsistencias" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th style="text-align:center">Fecha</th>
                    <th style="text-align:center">Nombre</th>
                    <th style="text-align:center">Devengado</th>
                    <th style="text-align:center">Descuentos</th>
                    <th style="text-align:center">Impuestos</th>
                    <th style="text-align:center">Multas</th>
                    <th style="text-align:center">Neto</th>
                    <th style="text-align:center">Comprobante</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($pagos as $pago)
                    @if (auth()->user()->hasRole('Administrador'))
                        @include('admin.pagos.partials.tableIndex')
                    @elseif (auth()->user()->hasRole('Monitor'))
                        @include('admin.pagos.partials.tableIndex')
                    @elseif($pago->user->id == $userLogueado)
                        @include('admin.pagos.partials.tableIndex')
                    @endif
                @endforeach

            </tbody>
        </table>

    </div> --}}

@stop



@section('js')
    <script>
        console.log('Hi!');
    </script>

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


@stop
