
<table class="table tablaTotales" style="text-align:center">
    <thead class="cabecera">
        <tr>
            <th>Pagina</th>
            <th>TRM</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportePaginas as $reportePagina)
            <tr>
                <td>{{ $reportePagina->pagina->nombre }}</td>
                <td>{{ number_format($reportePagina->TRM, 2, '.', ',') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<br>