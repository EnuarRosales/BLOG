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

        {{-- C:\laragon\www\BLOG-STUDIO\storage\app\public\logos\1-64d1967249271.png
        storage\app\public\logos\1-64d1967249271.png --}}
        <img src="{{ asset('/storage/app/public/logos/1-64d1967249271.png') }}" alt="{{'no hay nada'}}">

        <img class="QR" src="data:image/png;base64,{!!base64_encode($codigoQR)!!}">
        <p style="position: fixed; top: -60px; left: 220px; center: 0px; height: 200px; color:#858585;">
            CERTIFICACION TIEMPO
        </p>
        <br>
        <p style="position: fixed; top: -42px; left: 260px; center: 0px; height: 50px;  color:#858585;">NIT
            {{ $nitEmpresa }}
        </p>
    </header>


    <footer style="color: #858585;">
        @include('admin.pagos.partials.marcaAgua')
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
            , ostentando el cargo de {{ $user->tipoUsuario->nombre }}. Donde respecto al tiempo laborado, se reporta la
            siguiente información.
        </p>

        <table class="table" style="text-align:center">
            <thead class="cabecera">
                <tr>
                    <th>Años</th>
                    <th>Meses</th>
                    <th>Dias</th>
                </tr>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $tiempo->y }}</td>
                    <td>{{ $tiempo->m }}</td>
                    <td>{{ $tiempo->d }}</td>
                </tr>
            </tbody>
        </table>
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
