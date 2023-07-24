@if ($multasDescuentosArray == 'lleno')
    <table class="table" style="text-align:center">
        <thead class="cabecera">
            <tr>
                <th>Multa</th>
                <th>Cantidad</th>
                <th>Devengado</th>
                <th>Deducido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($multasDescuentos as $multasDescuento)
                <tr>
                    <td>{{ $multasDescuento->tipoMulta->nombre }}</td>
                    <td>{{ $multasDescuento->count }}</td>
                    <td></td>
                    <td>{{ number_format($multasDescuento->tipoMulta->costo * $multasDescuento->count, 2, '.', ',') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
@endif
