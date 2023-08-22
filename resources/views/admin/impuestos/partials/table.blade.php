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
        <a class="btn btn-secondary btn-sm" target="_blank"
            href="{{ route('admin.impuestos.comprobanteImpuestoPDF', $pago) }}">Ver</a>
    </td>
</tr>
