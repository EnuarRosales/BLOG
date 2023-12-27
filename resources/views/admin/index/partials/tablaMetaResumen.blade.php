@if ($dataResumenMeta != 0)
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-three">
                <div class="widget-heading">
                    <h5 class="">Control de meta</h5>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table" id="table_resumenmeta">

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
                                            {{ "$ " }}{{ $fecha->meta->valor / $fecha->meta->dias == intval($fecha->meta->valor / $fecha->meta->dias) ? number_format($fecha->meta->valor / $fecha->meta->dias, 0, ',', '.') : number_format($fecha->meta->valor / $fecha->meta->dias, 2, ',', '.') }}
                                        </td>
                                        <td>{{ "$ " }}{{ $fecha->suma == intval($fecha->suma) ? number_format($fecha->suma, 0, ',', '.') : number_format($fecha->suma, 2, ',', '.') }}
                                        </td>



                                        <td
                                            @if ($fecha->suma - $fecha->meta->valor / $fecha->meta->dias > 0) class="badge badge-success mt-2"
                                    @else
                                    class="badge badge-danger mt-2" @endif>
                                            {{ "$ " }}{{ $fecha->suma - $fecha->meta->valor / $fecha->meta->dias == intval($fecha->suma - $fecha->meta->valor / $fecha->meta->dias) ? number_format($fecha->suma - $fecha->meta->valor / $fecha->meta->dias, 0, ',', '.') : number_format($fecha->suma - $fecha->meta->valor / $fecha->meta->dias, 2, ',', '.') }}
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
                                            {{ "$ " }}{{ $saldoIdeal == intval($saldoIdeal) ? number_format($saldoIdeal, 0, ',', '.') : number_format($saldoIdeal, 2, ',', '.') }}

                                        </td>
                                        <td>
                                            {{ "$ " }}{{ $sumaFecha == intval($sumaFecha) ? number_format($sumaFecha, 0, ',', '.') : number_format($sumaFecha, 2, ',', '.') }}

                                        </td>
                                        <td
                                            @if ($saldo > 0) class="badge badge-success mt-2"
                    
                                    @else
                                    class="badge badge-danger mt-3" @endif>
                                            {{ "$ " }}{{ $saldo == intval($saldo) ? number_format($saldo, 0, ',', '.') : number_format($saldo, 2, ',', '.') }}

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
@else
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget widget-table-three">
                <div class="widget-heading">
                    <h5 class="">Cumplimiento meta <span style="color: red; font-weight: bold;"> Programa una meta
                        </span></h5>
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
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endif
