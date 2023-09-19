<tr>
    <td>{{ $pago->fecha }}</td>
    <td>{{ $pago->user->name }}</td>
    <td>
        @foreach ($impuestos as $impuesto)
            @if ($impuesto->id == $pago->impuesto_id)
                {{ $impuesto->nombre }}
            @endif
        @endforeach
    </td>
    <td>{{ number_format($pago->impuestoPorcentaje, 2, '.', ',') }}</td>
    <td>{{ number_format($pago->impuestoDescuento, 2, '.', ',') }}</td>
    <td width="10px" style="text-align:center">
        <a class=" bs-tooltip" data-placement="top" title="Ver"
            href="{{ route('admin.impuestos.comprobanteImpuestoPDF', $pago) }}"><svg class="rounded mr-2"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-eye">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg></a>

    </td>
</tr>
