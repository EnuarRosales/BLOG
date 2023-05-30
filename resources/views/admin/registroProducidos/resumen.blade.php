@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Resumen produccion</h1>


@stop




@section('content')
    <div class="card">
        <div class="card-body">




            {{-- @can('admin.asignacionTurnos.create') --}}


            {{-- <a class="btn btn-secondary" href="{{ route('admin.registroProducidos.create') }}">Resumen</a> --}}
            {{-- @endcan --}}
        </div>






        <table id="registroProducidos" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Meta Estudio</th>
                    <th>Obj Diario</th>
                    <th>Produccion Reportada</th>
                    <th>Alarma-Diferencia</th>
                    <th>Cumplio</th>
                    <th>Dias Restantes</th>
                    <th>Valor Proyectado</th>
                    <th>Produccion Total</th>
                    <th>Saldo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($fechas as $fecha)
                    <tr
                        @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0) {{-- class="p-3 mb-2 bg-success text-white" --}}
                        class="table-success"
                        {{-- class="p-3 mb-2 bg-success-subtle text-emphasis-success" --}}

                        @else
                        class="table-danger""
                        {{-- style="background-color:red;" --}} @endif>
                        <td>{{ $fecha->fecha }}</td>

                        

                        <td>{{ $fecha->meta->nombre }}</td>
                        <td>{{ "$ " }}{{ round($fecha->meta->valor / $fecha->meta->dias, 2) }}</td>
                        <td>{{ "$ " }}{{ round($fecha->suma, 2) }}</td>
                        <td>{{ "$ " }}{{ round($fecha->suma - $fecha->meta->valor / $fecha->meta->dias, 2) }}</td>
                        <td>
                            @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0)
                                Si
                            @else
                                No
                            @endif
                        </td>

                        <td>

                            @foreach ($fechas3 as $k)
                                @if ($k->meta_id == $fecha->meta->id)
<<<<<<< HEAD
                                @php $dias++;                              
                                
                                @endphp
                                 {{-- {{$dias."'ojo'"}} --}}

                                 {{$dias}}
                                    
=======
                                    {{ $fecha->meta->dias - $k->date_count }}
>>>>>>> 5ef9fab75f42572dabce5fb23d70e6226c295e5b
                                @endif
                            @endforeach
<<<<<<< HEAD

                            

=======
>>>>>>> 5ef9fab75f42572dabce5fb23d70e6226c295e5b
                        </td>
                        @foreach ($fechas2 as $i)
                            @if ($i->meta_id == $fecha->meta->id)
                                @foreach ($fechas3 as $k)
                                    @if ($k->meta_id == $fecha->meta->id)
                                        {{-- {{ $k->cuenta }} --}}
                                        {{-- {{ $saldo = $i->suma - $k->cuenta * ($fecha->meta->valor / $fecha->meta->dias) }} --}}
                                        @php $saldo = $i->suma - ($k->date_count ) * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                        @php $saldoIdeal = ($k->date_count )  * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                        @php $sumaFecha = $i->suma; @endphp
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        <td>
                            {{-- {{ $saldoIdeal }} --}}
                            {{ "$ " }}{{ round($saldoIdeal, 2) }}

                        </td>


                        <td>
                            {{-- {{ $sumaFecha }} --}}
                            {{ "$ " }}{{ round($sumaFecha, 2) }}

                        </td>
                        <td
                            @if ($saldo > 0) {{-- class="p-3 mb-2 bg-success text-white" --}}
                            class="bg-success"
                            {{-- class="p-3 mb-2 bg-success-subtle text-emphasis-success" --}}
    
                            @else
                            class="bg-danger" @endif>
                            {{ "$ " }}{{ round($saldo, 2) }}

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
                title: 'Producido registrado correctamente',
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
            $('#registroProducidos').DataTable(); //
        });
    </script>

@stop
