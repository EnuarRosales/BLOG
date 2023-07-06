@extends('adminlte::page')

@section('title', 'Reporte Paginas')

@section('content_header')
    <h1>Listado de Reportes Paginas </h1>
@stop


@section('content')

    {{-- CONFIRMACION SI HAY ALGO MAL --}}
    @if (isset($errors) && $errors->any())
        @include('admin.reportePaginas.partials.modal-error')
    @endif

    <div class="card">
        <div class="card-body">
            <a class="btn btn-primary" href="{{ route('admin.reportePaginas.index') }}">Volver</a>
            
        </div>
        <table id="reportePaginas" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Dolares</th>
                    <th>Meta</th>
                    <th>Porcentaje</th>
                    <th>Porcentaje Total</th>
                    {{-- <th>Editar</th>
                    <th>Eliminar</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($reporteQuincenas as $reporteQuincena)
                    <tr>
                        <td>{{ $reporteQuincena->fecha }}</td>
                        <td>{{ $reporteQuincena->user->name }}</td>                
                        <td>{{ number_format($reporteQuincena->suma, 2, '.', ',') }}</td>

                        {{-- <td>
                            @if ($reporteQuincena->suma >= 20)
                                @php $meta = 5; @endphp
                            @endif
                            {{ $meta }}

                        </td> --}}
                        <td>
                            @foreach ($metaModeloss as $metaModelo)
                                @if ( $reporteQuincena->suma >=$metaModelo->mayorQue )                                    
                                        @php $meta = $metaModelo->porcentaje;                                        
                                        @endphp
                                        {{ $meta }}                                    
                                    @break
                                    {{-- @else
                                    {{0}} --}}
                                @endif 
                                                      
                            @endforeach

                        </td>

                        <td>{{ $reporteQuincena->porcentaje}}</td>

                        <td>{{$reporteQuincena->porcentajeTotal}}</td>



                        {{-- <td>
                            @if ($reporteQuincena->suma >= 20)
                                @php $meta = 5; @endphp
                            @endif
                            {{ $meta }}

                        </td> --}}


                        {{-- <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.reportePaginas.edit', $reportePagina) }}">Editar</a>
                        </td>

                        <td width="10px">
                            <form class="formulario-eliminar"
                                action="{{ route('admin.reportePaginas.destroy', $reportePagina) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                            </form>
                        </td> --}}

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" />
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
                title: 'Descuento registrado correctamente',
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
    <script>
        $(document).ready(function() {
            $('#reportePaginas').DataTable({
                dom: 'Blfrtip',

                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
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
