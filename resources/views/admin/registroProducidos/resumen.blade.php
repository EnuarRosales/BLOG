@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Resumen produccion</h1>

@stop

@section('content')

    <div class="card">
            {{-- <livewire:admin.registro-producido :fecha="$fecha" /> --}}

        @livewire('admin.registro-producido', ['fechas' => $fechas,'fechas2' => $fechas2,'fechas3' => $fechas3])




    @stop
    @section('css')
        <link rel="stylesheet" href="/css/admin_custom.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="styleshet">
        <link    @livewireStyles     >
        
    @stop

    @section('js')
        <script>
            console.log('Hi!');
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script @livewireScripts ></script>
        

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
