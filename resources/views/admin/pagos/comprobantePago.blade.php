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
        {{-- <img src="{{ public_path() . '\image\Imagen2.png' }}" width="105" height="90"> --}}
         {{-- <img src="{{ $logoEmpresa }}" width="105" height="90"> --}}
         <img src="{{ $logoEmpresa }}" width="100" height="90" style="margin-left: 20px; margin-top:20px">
        <img class="QR" src="data:image/png;base64,{!!base64_encode($codigoQR)!!}">
        <p style="position: fixed; top: -60px; left: 220px; center: 0px; height: 200px; color:#858585;">
            COMPROBANTE DE PAGO
        </p>
        <br>
        <p style="position: fixed; top: -42px; left: 260px; center: 0px; height: 50px;  color:#858585;">NIT
            {{ $nitEmpresa }}
        </p>
    </header>


    <footer style="color: #858585;">
        @include('admin.pagos.partials.marcaAgua')
        {{-- Cali Barrio Ciudadela Comfandi <br> --}}
        <p> {{ $nombreEmpresa }}</p>

    </footer>


    <div class="content ex1">
        <p style="text-align:center;"> <b> HACE CONSTAR </b></p>

        <p class="Paragrap" style="text-align: justify;">
            Que el (la) Señor (a) {{ $pago->user->name }} identificado con CC No. {{ $pago->user->cedula }},
            En la quincena del {{ $pago->fecha }} , se le consignaron los siguientes haberes:
        </p>
        @include('admin.pagos.partials.tablePagina')
        @include('admin.pagos.partials.tableDescuento')
        @include('admin.pagos.partials.tableMultaDescuento')
        @include('admin.pagos.partials.tableImpuestoDescuento')
        @include('admin.pagos.partials.tableTotal')
        @include('admin.pagos.partials.tableTRM')
        @include('admin.pagos.partials.tablePorcentaje')
    </div>
    <div class="content ex1">
        <p style="text-align: justify;"">
            Se expide la presente constancia. Dada a los {{ $date->day }} días del mes de {{ $date->monthName }}
            del año {{ $date->year }} en la ciudad de Cali
        </p>
    </div>
</body>

</html>
