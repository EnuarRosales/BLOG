<table class="table tablaIndividual" style="text-align:center">
    <thead class="cabecera">
        <tr>
            <th>Porcentaje</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reportePaginas as $reportePagina)
            <tr>
                <td>{{ $reportePagina->porcentajeTotal }}</td>
            </tr>
        @break
    @endforeach
</tbody>
</table>
