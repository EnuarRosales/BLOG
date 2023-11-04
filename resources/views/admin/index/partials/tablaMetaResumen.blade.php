



            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget widget-table-three">
                        <div class="widget-heading">
                            <h5 class="">Cumplimiento meta</h5>
                        </div>
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table">

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
                                        @foreach ($dataResumenMeta[0] as $fecha)
                                            <tr data-fecha="{{ $fecha->fecha }}">
                                                <td>{{ $fecha->fecha }}</td>
                                                <td>{{ $fecha->meta->nombre }}</td>
                                                <td>
                                                    {{ "$ " }}{{ round($fecha->meta->valor / $fecha->meta->dias, 2) }}
                                                </td>
                                                <td>{{ "$ " }}{{ round($fecha->suma, 2) }}</td>
                                                <td
                                                    @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0) class="badge badge-success mt-2"
                                @else
                                class="badge badge-danger mt-2" @endif>
                                                    {{ "$ " }}{{ round($fecha->suma - $fecha->meta->valor / $fecha->meta->dias, 2) }}
                                                </td>
                                                <td>
                                                    @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0)
                                                        Si
                                                    @else
                                                        No
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach ($dataResumenMeta[2] as $k)
                                                        @if ($k->meta_id == $fecha->meta->id)
                                                            {{ $fecha->meta->dias - $k->date_count }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                @foreach ($dataResumenMeta[1] as $i)
                                                    @if ($i->meta_id == $fecha->meta->id)
                                                        @foreach ($dataResumenMeta[2] as $k)
                                                            @if ($k->meta_id == $fecha->meta->id)
                                                                @php $saldo = $i->suma - ($k->date_count ) * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                                                @php $saldoIdeal = ($k->date_count )  * ($fecha->meta->valor / $fecha->meta->dias); @endphp
                                                                @php $sumaFecha = $i->suma; @endphp
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                                <td>
                                                    {{ "$ " }}{{ round($saldoIdeal, 2) }}

                                                </td>
                                                <td>
                                                    {{ "$ " }}{{ round($sumaFecha, 2) }}

                                                </td>
                                                <td
                                                    @if ($saldo > 0) class="badge badge-success mt-2"
                
                                @else
                                class="badge badge-danger mt-3" @endif>
                                                    {{ "$ " }}{{ round($saldo, 2) }}

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
