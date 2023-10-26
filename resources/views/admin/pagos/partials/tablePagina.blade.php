<table class="table" style="text-align:center">
    <thead class="cabecera">
        <tr>
            <th>Paginas</th>
            <th>Cantidad</th>
            <th>Devengado</th>
            <th>Deducido</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportePaginas as $reportePagina)
            <tr>
                <td>{{ $reportePagina->pagina->nombre }}</td>
                <td>{{ $reportePagina->Cantidad }}</td>
                <td>{{ number_format($reportePagina->netoPesos, 2, '.', ',') }}</td>
                <td></td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>
