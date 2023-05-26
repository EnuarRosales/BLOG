@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Resumen Produccion</h1>
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
                    <th>Valor</th>
                    <th>Alarma</th>    
                    <th>Cumplio</th> 
                    <th>Saldo</th>               
                                      
                </tr>
            </thead>
            <tbody>
                @foreach ($fechas as $fecha)
                    <tr>                      
                        <td>{{$fecha->fecha}}</td>
                        <td>{{$fecha->suma}}</td>  
                        <td>{{$fecha->suma}}</td>
                        <td>{{$fecha->suma}}</td>
                        <td>{{$fecha->cumplio}}</td>

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