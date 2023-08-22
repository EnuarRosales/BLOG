<tr>
    <td>{{ $pago->fecha }}</td>
    <td>{{ $pago->user->name }}</td>
    <td>{{ number_format($pago->devengado, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->descuento, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->impuestoDescuento, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->multaDescuento, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->neto, 2, '.', ',') }}</td>
    <td width="10px" style="text-align:center">
        <a class="btn btn-secondary btn-sm" target="_blank"
            href="{{ route('admin.pagos.comprobantePagoPDF', $pago) }}">Ver</a>
    </td>
  
    {{-- <td width="10px">
        <a class="btn btn-secondary btn-sm" href="{{ route('admin.pagos.comprobantePagoPDF', $pago) }}">Editar</a>
    </td>
  
    <td width="10px">
        <form class="formulario-eliminar" action="{{ route('admin.pagos.destroy', $pago) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-dark btn-sm">Eliminar</button>
        </form>
    </td> --}}

</tr>
