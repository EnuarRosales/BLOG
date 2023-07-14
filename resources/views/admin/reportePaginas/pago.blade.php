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
            <a class="btn btn-success" href="{{ route('admin.pagos.enviarPago') }}">Enviar Pagos</a>
        </div>
        <table id="reportePaginas" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Devengado</th>
                    <th>Impuesto</th>
                    <th>Descuento</th>
                    <th>Neto</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($pagos as $pago)
                    @foreach ($impuestos as $impuesto)
                        <tr>
                            <td>{{ $pago->fecha }}</td>
                            <td>{{ $pago->user->name }}</td>

                            <td>{{ number_format($pago->suma, 2, '.', ',') }}</td>

                            <td>
                                {{-- {{ ($impuesto->porcentaje / 100) * $pago->suma }} --}}
                                @if ($pago->suma > $impuesto->mayorQue)
                                    @php
                                        $variableImpuesto = ($impuesto->porcentaje / 100) * $pago->suma;
                                    @endphp
                                    {{ number_format($variableImpuesto, 2, '.', ',') }}
                                @endif
                            </td>

                            <td>
                                @foreach ($descuentos as $descuento)
                                    @if ($pago->user_id == $descuento->user_id)
                                        {{-- @php$meta = $metaModelo->porcentaje;
                                    @endphp --}}
                                        {{ number_format($descuento->suma, 2, '.', ',') }}
                                    @break
                                @endif
                            @endforeach
                        </td>


                        <td>
                            {{-- {{$descuento->suma }} --}}

                            @if ($array == 'lleno')
                                {{-- {{ number_format($pago->suma - $descuento->suma, 2, '.', ',') }} --}}
                                @if ($pago->user_id == $descuento->user_id)
                                    {{ number_format($pago->suma - $descuento->suma - ($impuesto->porcentaje / 100) * $pago->suma, 2, '.', ',') }}
                                @endif

                                @if ($pago->user_id != $descuento->user_id)
                                    {{ number_format($pago->suma - ($impuesto->porcentaje / 100) * $pago->suma, 2, '.', ',') }}
                                @endif
                            @else
                                {{ number_format($pago->suma, 2, '.', ',') }}
                            @endif

                        </td>
                    </tr>
                @endforeach
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
@elseif(session('info') == 'enviarPagos')
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Pagos enviados exitosamente',
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
