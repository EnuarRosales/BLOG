<tr>
    <td>{{ $pago->fecha }}</td>
    <td>{{ $pago->user->name }}</td>
    <td>{{ number_format($pago->devengado, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->descuento, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->impuestoDescuento, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->multaDescuento, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->neto, 2, '.', ',') }}</td>
    {{-- <td width="10px" style="text-align:center">


        <a class="btn btn-secondary btn-sm" target="_blank"
            href="">Ver</a>
    </td> --}}

    <td width="10px" style="text-align:center">
        <a class=" bs-tooltip" data-placement="top" title="Ver" target="_blank"
            href="{{ route('admin.pagos.comprobantePagoPDF', $pago) }}"><svg class="rounded mr-2"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-eye">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg></a>

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
