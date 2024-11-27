<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial con Fondo para Imprimir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            width: 350px;
            height: 500px;
            background: linear-gradient(135deg, #004d6b, #2d9ec4); /* Gradiente azul oscuro */
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            position: relative;
            margin-left: 15px;
        }

        /* Patrón de cuadrados */
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.6;
        }

        /* Líneas diagonales estilizadas */
        .card::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: repeating-linear-gradient(
                45deg,
                rgba(255, 255, 255, 0.2),
                rgba(255, 255, 255, 0.2) 3px,
                transparent 3px,
                transparent 6px
            );
            opacity: 0.4;
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            color: #ffffff; /* Texto blanco */
            margin-bottom: 10px;
        }

        .qr-container {
            margin: 20px auto;
            width: 150px;
            height: 150px;
            border-radius: 10px;
            overflow: hidden;
            background: #ffffff; /* Fondo blanco para QR */
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .qr-container img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .info {
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
            color: #ffffff; /* Texto blanco */
        }

        .footer {
            position: absolute;
            bottom: 10px;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #e0f7fa; /* Texto azul claro */
        }

        /* Estilos específicos para impresión */
        @media print {
            body {
                
                margin-left: 20px;
              
            }

            .card {
                margin: 0 auto; /* Centrar la tarjeta */
                box-shadow: none; /* Quitar sombras para impresión */
                page-break-inside: avoid; /* Evitar cortes entre páginas */
                background: linear-gradient(135deg, #004d6b, #2d9ec4); /* Asegurar fondo */
            }

            .card::before,
            .card::after {
                display: block; /* Asegurarse de que los estilos sean visibles */
            }

            .qr-container img {
                width: 100%;
                height: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">Nombre de la Institución</div>
        <div class="qr-container">
            <img src="qr-code.png" alt="Código QR">
        </div>
        <div class="info">
            <p>Nombre: Juan Pérez</p>
            <p>Grado: 5to Primaria</p>
            <p>Grupo: A</p>
        </div>
        <div class="footer">Credencial válida hasta 2024</div>
    </div>
    <div class="card">
        <div class="header">Nombre de la Institución</div>
        <div class="qr-container">
            <img src="qr-code.png" alt="Código QR">
        </div>
        <div class="info">
            <p>Nombre: Juan Pérez</p>
            <p>Grado: 5to Primaria</p>
            <p>Grupo: A</p>
        </div>
        <div class="footer">Credencial válida hasta 2024</div>
    </div>
    <div class="card">
        <div class="header">Nombre de la Institución</div>
        <div class="qr-container">
            <img src="qr-code.png" alt="Código QR">
        </div>
        <div class="info">
            <p>Nombre: Juan Pérez</p>
            <p>Grado: 5to Primaria</p>
            <p>Grupo: A</p>
        </div>
        <div class="footer">Credencial válida hasta 2024</div>
    </div>
</body>
</html>