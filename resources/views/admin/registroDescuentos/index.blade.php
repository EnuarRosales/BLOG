@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Listado de Descuentos </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {{-- @can('admin.asignacionTurnos.create') --}}
                <a class="btn btn-primary" href="{{ route('admin.registroDescuentos.create') }}">Agregar Descuent</a>
            {{-- @endcan --}}

        </div>
        <table id="registroDescuentos" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>ID</th>                    
                    <th>Fecha</th>    
                    <th>Monto a Descuentar</th>               
                    <th>Monto Descuento</th>
                    <th>Saldo</th>
                    <th>Tipo Descuento</th>
                    <th>Usuario</th>
                    <th>Descontar</th>
                    <th>Descontar</th>
                    <th>Editar</th>
                    {{-- <th>Eliminar</th>                   --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($registroDescuentos as $registroDescuento)
                    <tr>
                        <td>{{$registroDescuento->id }}</td>
                        <td>{{$registroDescuento->fecha}}</td>
                        <td>{{$registroDescuento->montoDescuento}}</td>
                        <td>{{$registroDescuento->montoDescontado}}</td>
                        <td>{{$registroDescuento->saldo =$registroDescuento->montoDescuento - $registroDescuento->montoDescontado}}</td>
                        <td>{{$registroDescuento->tipoDescuento->nombre}}</td>                        
                        <td>{{$registroDescuento->user->name}}</td>  
                        {{-- <td>{{$registroDescuento->user->saldo}}</td>  --}} 
                        
                        {{-- <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.registroDescuento.descuentoTotal',$registroDescuento)}}">Total</a>
                        </td> --}}

                        <td width="10px">
                            <form action="{{route('admin.registroDescuentos.descuentoTotal',$registroDescuento) }}" method="PUT">
                                @csrf                               
                                <button type="submit" class="btn btn-dark btn-sm">ENUAR</button>
                            </form>
                        </td>

                        {{-- <td width="10px">
                            <a class="btn btn-secondary btn-sm"
                                href="{{ route('admin.registroDescuentos.edit',$registroDescuento)}}" method="POST">Parcial</a>
                        </td> --}}
                        

                        {{-- @can('admin.asignacionTurnos.edit') --}}
                            <td width="10px">
                                <a class="btn btn-secondary btn-sm"
                                    href="{{ route('admin.registroDescuentos.edit',$registroDescuento)}}">Editar</a>
                            </td>
                        {{-- @endcan --}}
                        {{-- @can('admin.registroAsistencias.destroy') --}}
                            <td width="10px">
                                <form class="formulario-eliminar"
                                    action="{{ route('admin.registroDescuentos.destroy', $registroDescuento) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
                                </form>
                            </td>
                        {{-- @endcan --}}                       

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
                title: 'Descuento registrado correctamente',
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
            $('#registroDescuentos').DataTable(); //
        });
    </script>

@stop
