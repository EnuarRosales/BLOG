<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante</title>
    <link rel="stylesheet" href="{!! asset('css/pdf.css') !!}">
</head>

<body>

    <body>
        <header>
            <img src="{{ public_path() . '\image\Imagen2.png' }}" width="105" height="90">
            <p style="position: fixed; top: -60px; left: 220px; center: 0px; height: 50px; color:#858585;">
                COMPROBANTE DE PAGO
            </p>
            <br>
            <p style="position: fixed; top: -42px; left: 250px; center: 0px; height: 50px; color:#858585;">NIT
                901683515-1
            </p>
        </header>

        <div class="content ex1">
            <p style="text-align:center;"> <b> HACE CONSTAR </b></p>

            <p class="Paragrap" style="text-align: justify;">
                Que el (la) Señor (a) {{ $pago->user->name }} identificado con CC No. {{ $pago->user->cedula }},
                En la quincena del {{ $pago->fecha }} , se le consignaron los siguientes haberes:
            </p>

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


            @if ($descuentosArray == 'lleno')
                {{ 'vacio' }}
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

            {{-- descuentos --}}


            {{-- multas --}}

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



            @if ($pago->impuestoDescuento > 1)
                <table class="table" style="text-align:center">
                    <thead class="cabecera">
                        <tr>
                            <th>Impuesto</th>
                            <th>Cantidad</th>
                            <th>Devengado</th>
                            <th>Deducido</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($descuentos as $descuento) --}}
                        <tr>
                            <td>{{ $pago->impuestos->nombre }}</td>
                            <td>{{ $pago->impuestoPorcentaje . '%' }}</td>
                            <td></td>
                            <td>{{ number_format($pago->impuestoDescuento, 2, '.', ',') }}</td>
                        </tr>
                    </tbody>
                </table>
                <br>
            @endif

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
                    {{-- @foreach ($descuentos as $descuento) --}}
                    <tr>
                        <td>Total</td>
                        <td></td>
                        <td>{{ number_format($pago->devengado, 2, '.', ',') }}</td>
                        <td>{{ number_format($pago->devengado-$pago->neto, 2, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td>Neto a pagar</td>
                        <td></td>
                        <td></td>
                        <td>{{ number_format($pago->neto, 2, '.', ',') }}</td>
                    </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
            <br>

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


            <table class="table tablaIndividual" style="text-align:center">
                <thead class="cabecera">
                    <tr>
                        <th>Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $reportePagina->porcentajeTotal }}</td>
                    </tr>
                </tbody>
            </table>


            <br>






            <p style="text-align: justify;"">
                Se expide la presente constancia. Dada a los 16 días del mes de Julio de 2023 en la ciudad de Bogotá
                D.C.
            </p>





            {{-- <p>Nombre: {{ $pago->user->name }}</p>
            <p>Nombre: {{ $pago->user->name }}</p>
            <p>Fecha: {{ $pago->fecha }}</p>
            <p>Porcentaje: {{ $reportePagina->porcentajeTotal }}</p> --}}




        </div>

        
        
      





        <footer style="color: #858585;">
            Cali Barrio Ciudadela Comfandi <br>
            Conjunto Carrera 83C CLL 30-08
        </footer>




    </body>

    <p class="texto-vertical-2"> Sistema de Información para la Administración de estudios WC (SIAEWC)</p>

    

</html>
