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
    <header style="margin-bottom: 50%">
        <img src="{{ public_path() . '\image\Imagen2.png' }}" width="105" height="90">
        <p style="position: fixed; top: -60px; left: 220px; center: 0px; height: 200px; color:#858585;">
            COMPROBANTE DE IMPUESTOS
        </p>
        <br>
        <p style="position: fixed; top: -42px; left: 250px; center: 0px; height: 50px;  color:#858585;">NIT          
            
            {{$nitEmpresa}}
        </p>

    </header>

    <div class="content ex1">
        <p style="text-align:center;"> <b> HACE CONSTAR </b></p>

        <p class="Paragrap" style="text-align: justify;">
            Que el (la) Señor (a) {{ $pago->user->name }} identificado con CC No. {{ $pago->user->cedula }},
            En la quincena del {{ $pago->fecha }} , se le realizo la siguiente retencion:
        </p>



        {{-- descuentos --}}
        @if ($pago->impuestoDescuento > 1)
            <table class="table" style="text-align:center">
                <thead class="cabecera">
                    <tr>
                        <th>Concepto</th>
                        <th>Porcentaje</th>
                        <th>Base Grabable</th>
                        <th>Retenido</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($descuentos as $descuento) --}}
                    <tr>
                        <td>{{ $pago->impuestos->nombre }}</td>
                        <td>{{ $pago->impuestoPorcentaje . '%' }}</td>
                        <td>{{ $pago->devengado}}</td>
                        <td>{{ number_format($pago->impuestoDescuento, 2, '.', ',') }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
        @endif

        <br>

        <p class="ParagrapNormative" style="text-align: justify;">
            ESTE DOCUMENTO NO REQUIERE PARA SU VALIDEZ FIRMA, DE ACUERDO CON EL ARTICULO 10 DEL DECRETO 836 DE 1991,
            RECOPILADO EN EL ARTICULO 1.6.1.12.12 DEL DECRETO 1625 DE 2016 MATERIA TRIBUTARIA DE OCTUBRE 11 DE 2016, QUE
            REGULA EL CONTENIDO DEL CERTIFICADO DE RETENCIONES A TITULO DE RENTA
        </p>

        {{-- <p class="texto-vertical-2"> Sistema de Información para la Administración de estudios WC (SIAEWC)</p> --}}

    </div>



    <div class="content ex1">


        


        <p style="text-align: justify;"">
            Se expide la presente constancia. Dada a los {{ $date->day }} días del mes de {{ $date->monthName }}
            del
            año {{ $date->year }} en la ciudad de Cali

        </p>

    </div>


    @include('admin.pagos.partials.footer')
    @include('admin.pagos.partials.marcaAgua')

    {{-- <p class="texto-vertical-2"> Sistema de Información para la Administración de estudios WC (SIAEWC)</p> --}}

</body>

</html>
