<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial Escolar</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            width: 600px;
            background-image: url('imagenes/CREDENCIAL.jpg');

            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            border: 2px solid #d4d4d4;
        }
        .header {
            font-size: 24px;
            font-weight: bold;
            color: #4caf50;
            margin-bottom: 10px;
        }
        .sub-header {
            font-size: 18px;
            color: #888;
            margin-bottom: 20px;
        }
        .photo {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            border: 3px solid #d4d4d4;
        }
        .photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .info {
            text-align: left;
            font-size: 16px;
            margin: 0 40px;
        }
        .info p {
            margin: 5px 0;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">COLEGIO SAN LUIS DE GONZADA</div>
        <div class="sub-header">Credencial del Estudiante</div>
        <div class="photo">
            <img src="foto-estudiante.jpg" alt="Foto del estudiante">
        </div>
        <div class="info">
            <p><strong>Nombre completo:</strong> <?php echo $nombreCompleto; ?></p>
            <p><strong>Grado:</strong> <?php echo $grado; ?></p>
            <p><strong>Grupo:</strong> <?php echo $grupo; ?></p>
            <p><strong>Ciclo Escolar:</strong> <?php echo $cicloEscolar; ?></p>
            <p><strong>Docente titular:</strong> <?php echo $docente; ?></p>
        </div>
        <div class="footer">
            <p>Escuela Primaria</p>
        </div>
    </div>
</body>
</html>
