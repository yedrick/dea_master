<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial con Fondo para Imprimir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #004d6b;
            margin: 0px;
        }
        .card {
            width: 350px;
            height: 400px;
            background: linear-gradient(135deg, #004d6b, #2d9ec4); /* Gradiente azul oscuro */
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
            background-color: red;
        }
        .page {
            display: grid;
            grid-template-columns: 1fr 1fr; /* Dos columnas para las credenciales */
            gap: 20px;
            padding: 20px;
            page-break-after: always; /* Cada "hoja" en PDF será una página */
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff; /* Texto blanco */
            margin-bottom: 10px;
        }

        .qr-container {
            margin: 20px auto;
            width: 100px;
            height: 100px;
            border-radius: 10px;
            background: #ffffff; /* Fondo blanco para QR */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .qr-container img {
            width: 100%;
            height: 100%;
        }

        .info {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #ffffff; /* Texto blanco */
        }


    </style>
</head>
<body>
    @foreach ($students as $student)
    <div class="page">
        <div class="card">
            <div class="header">COLEGIO SAN LUIS DE GONZAGA</div>
            <div class="qr-container">
                <?php
                    // mejorar la codificacion
                    $code=md5($student->id);

                    $codigoQR = QrCode::format('svg')->backgroundColor(255, 255, 255)->size(20)->generate($code);
                ?>
                <img src="data:image/png;base64, {!! base64_encode($codigoQR) !!}" alt="" >
            </div>
            <div class="info">
                <p>Nombre: {{ $student->first_name.' '.$student->last_name }}</p>
                <p>Grado: {{ $student->course->grade->name.' '.$student->course->grade->level->name }}<</p>
                <p>Grupo: {{ $student->course->name }}</p>
                <p >Credencial válida hasta 2024</p>

        </div>
    </div>
    @endforeach
</body>
</html>
