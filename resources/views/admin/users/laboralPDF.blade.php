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
        {{-- <img src="{{ public_path() . '\image' . $logoEmpresa }}" width="100" height="90" style="margin-left: 20px; margin-top:20px"> --}}
        
        <img src="{{ asset('image/' . $logoEmpresa) }}" width="100" height="90" style="margin-left: 20px; margin-top:20px">

        
        <img class="QR" src="data:image/png;base64,{!! base64_encode($codigoQR) !!}">
        <p style="position: fixed; top: -60px; left: 220px; center: 0px; height: 200px; color:#858585;">
            CERTIFICACION LABORAL
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
            El (la) suscrito (a) GERENTE de la empresa {{ $nombreEmpresa }}, hace constar que una vez verificada la
            base de datos del Sistema de Información para la Administración de estudios WC (SIAEWC), certifica que
            el (la) Señor (a) (ita) {{ $user->name }} identificado (a) con CC No. {{ $user->cedula }} se encuentra
            prestando sus servicios a nuestra empresa, mediante CONTRATO DE MANDATO, desde el dia
            {{ $fechaAntigua->day }} de {{ $fechaAntigua->monthName }} del año {{ $fechaAntigua->year }}
            , ostentando el cargo de {{ $user->tipoUsuario->nombre }}.
        </p>
    </div>

    <div class="content ex1">
        <p style="text-align: justify;"">
            Se expide la presente constancia. Dada a los {{ $date->day }} días del mes de {{ $date->monthName }}
            del año {{ $date->year }} en la ciudad de Cali
        </p>
    </div>

    <div class="content ex1">
        <p style="text-align: justify;">
            Atentamente;
            <br>
            <br>
            <br>
        </p>
        <p style="text-align: justify;">
            {{ $gerenteEmpresa }}
            <br>
            Gerente {{ $nombreEmpresa }}
        </p>
    </div>
</body>

</html>
