@if ($descuentosArray == 'lleno')
    <table class="table" style="text-align:center">
        <thead class="cabecera">
            <tr>
                <th>Descuento</th>
                <th>Cantidad</th>
                <th>Devengado</th>
                <th>Deducido</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($descuentos as $descuento)
                <tr>
                    <td>{{ $descuento->nombre }}</td>
                    <td></td>
                    <td></td>
                    <td>{{ number_format($descuento->valor, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
@endif
