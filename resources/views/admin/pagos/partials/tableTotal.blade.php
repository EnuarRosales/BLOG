<table class="table" style="text-align:center">
    <thead class="cabecera">
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Total</td>
            <td></td>
            <td>{{ number_format($pago->devengado, 2, '.', ',') }}</td>
            <td>{{ number_format($pago->devengado - $pago->neto, 2, '.', ',') }}</td>
        </tr>
        <tr>
            <td>Neto a pagar</td>
            <td></td>
            <td></td>
            <td>{{ number_format($pago->neto, 2, '.', ',') }}</td>
        </tr>
    </tbody>
</table>
<br>
