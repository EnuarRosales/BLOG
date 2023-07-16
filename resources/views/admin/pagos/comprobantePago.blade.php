pd<html>

<head>
    <style>
        @page {
            margin: 80px 25px;
            margin-left: 80px;
            margin-right: 80px;
        }

        header {
            position: fixed;
            top: -60px;
            left: 0px;
            right: 0px;
            height: 50px;
        }

        footer {
            position: fixed;
            bottom: -60px;
            left: 10px;
            right: 0px;
            height: 50px;
        }
    </style>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #ffffff;
            padding: 20px;
            color: #333333;
        }

        .logo {
            display: inline-block;
            vertical-align: middle;
            width: 50px;
            height: 50px;
            margin-right: 10px;
        }

        .logo img {
            width: 100%;
            height: 100%;
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.5;
            font-size: 48px;
            color: #ffffff;
            font-weight: bold;
            pointer-events: none;
        }

        .content {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .image {
            text-align: center;
            margin-bottom: 20px;
        }

        .image img {
            max-width: 100%;
            height: auto;
        }

        .Paragrap {
            left: 270px;
            right: 100px;
        }

        .cabecera {
            background-color: black;
            color: white;


        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path() . '\image\Imagen2.png' }}" width="105" height="90">
        <p style="position: fixed; top: -60px; left: 220px; center: 0px; height: 50px; color:#858585;">
            COMPROBANTE DE PAGO
        </p>
        <br>
        <p style="position: fixed; top: -42px; left: 250px; center: 0px; height: 50px; color:#858585;">NIT 901683515-1
        </p>


    </header>
    <div class="content ex1">
        <p style="text-align:center;"> <b> HACE CONSTAR </b></p>

        <p class="Paragrap" style="text-align: justify;">
            Que el (la) Se
            El (la) suscrito (a) GERENTE de la empresa BLUM ICE STUDIOS S.A.S, hace constar que una vez verificada la
            base de datos del Sistema de Información para la Administración de estudios WC (SIAEWC), certifica que
            {{-- el(la) Señor(a)(ita) {{}} identificado (a) con CC No. {{}} se encuentra --}}
            prestando sus servicios, mediante CONTRATO DE MANDATO N°001 del 20 Mayo 2014, ostentando el cargo de MODELO.
        </p>


        <p style="text-align: justify;"">
            Se expide la presente constancia. Dada a los 20 días del mes de Mayo de 2023 en la ciudad de Bogotá D.C.
        </p>

        <p style="text-align: justify;">
            Atentamente;
        </p>
        <p style="text-align: justify;">
            Anderson Smith Rosales Salazar
            <br>
            Gerente BLUM ICE STUDIOS S.A.S.
        </p>
    </div>

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
                    <td>{{ $reportePagina->netoPesos }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

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
                    <td>{{ $descuento->valor }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    <table class="table" style="text-align:center">
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
                    <td>{{ $item->TRM }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Nombre: {{ $pago->user->name }}</p>
    <p>Fecha: {{ $pago->fecha }}</p>
    <p>Porcentaje: {{ $reportePagina->porcentajeTotal }}</p>
    





    <footer style="color: #858585;">
        Cali Barrio Ciudadela Comfandi <br>
        Conjunto Carrera 83C CLL 30-08
    </footer>
    {{--  <main>
    <p>page1</p>
    <p>page2></p>
  </main>  --}}
</body>

</html>
