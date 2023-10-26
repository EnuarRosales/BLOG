@if ($pago->impuestoDescuento > 1)
    <table class="table" style="text-align:center">
        <thead class="cabecera">
            <tr>
                <th>Impuesto</th>
                <th>Cantidad</th>
                <th>Devengado</th>
                <th>Deducido</th>
            </tr>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($descuentos as $descuento) --}}
            <tr>
                <td>{{ $pago->impuestos->nombre }}</td>
                <td>{{ $pago->impuestoPorcentaje . '%' }}</td>
                <td></td>
                <td>{{ number_format($pago->impuestoDescuento, 2, '.', ',') }}</td>
            </tr>
        </tbody>
    </table>
    <br>
@endif
