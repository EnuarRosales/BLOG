<table class="table tablaTotales" style="text-align:center">
    <thead class="cabecera">
        <tr>
            <th>Pagina</th>
            <th>TRM</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($TRM as $item)
            <tr>
                <td>{{ $item->pagina->nombre }}</td>
                <td>{{ number_format($item->TRM, 2, '.', ',') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>