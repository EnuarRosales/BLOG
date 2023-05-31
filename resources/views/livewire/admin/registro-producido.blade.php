<div>
    <div class="card">
        <div class="card-body">
        
        </div>

        <table id="registroProducidos" class="table table-striped table-bordered shadow-lg mt-4">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Meta Estudio</th>
                    <th>Obj Diario</th>
                    <th>Produccion Reportada</th>
                    <th>Alarma-Diferencia</th>
                    <th>Cumplio</th>
                    <th>Dias Restantes</th>
                    <th>Valor Proyectado</th>
                    <th>Produccion Total</th>
                    <th>Saldo</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($fechas as $fecha)
                    <tr
                        @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0) {{-- class="p-3 mb-2 bg-success text-white" --}}
                        class="table-success"
                        {{-- class="p-3 mb-2 bg-success-subtle text-emphasis-success" --}}

                        @else
                        class="table-danger""
                        {{-- style="background-color:red;" --}} @endif>
                        <td>{{ $fecha->fecha }}</td>

                        <td>{{ $fecha->meta->nombre }}</td>
                        <td>{{ "$ " }}{{ round($fecha->meta->valor / $fecha->meta->dias, 2) }}</td>
                        <td>{{ "$ " }}{{ round($fecha->suma, 2) }}</td>
                        <td>{{ "$ " }}{{ round($fecha->suma - $fecha->meta->valor / $fecha->meta->dias, 2) }}
                        </td>
                        <td>
                            @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0)
                                Si
                            @else
                                No
                            @endif
                        </td>

                        <td>
                            @foreach ($fechas3 as $k)
                                @if ($k->meta_id == $fecha->meta->id)
                                    {{ $fecha->meta->dias - $k->date_count }}
                                @endif
                            @endforeach
                        </td>
                        @foreach ($fechas2 as $i)
                            @if ($i->meta_id == $fecha->meta->id)
                                @foreach ($fechas3 as $k)
                                    @if ($k->meta_id == $fecha->meta->id)
                                        {{-- {{ $k->cuenta }} --}}
                                        {{-- {{ $saldo = $i->suma - $k->cuenta * ($fecha->meta->valor / $fecha->meta->dias) }} --}}
                                        @php $saldo = $i->suma - ($k->date_count ) * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                        @php $saldoIdeal = ($k->date_count )  * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                        @php $sumaFecha = $i->suma; @endphp
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                        <td>
                            {{-- {{ $saldoIdeal }} --}}
                            {{ "$ " }}{{ round($saldoIdeal, 2) }}

                        </td>

                        <td>
                            {{-- {{ $sumaFecha }} --}}
                            {{ "$ " }}{{ round($sumaFecha, 2) }}

                        </td>
                        <td
                            @if ($saldo > 0) {{-- class="p-3 mb-2 bg-success text-white" --}}
                            class="bg-success"
                            {{-- class="p-3 mb-2 bg-success-subtle text-emphasis-success" --}}
    
                            @else
                            class="bg-danger" @endif>
                            {{ "$ " }}{{ round($saldo, 2) }}

                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
