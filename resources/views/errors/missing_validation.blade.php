<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Validación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8d7da;
            color: #721c24;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            font-size: 24px;
        }
        p {
            font-size: 18px;
            margin-bottom: 20px;
        }
        .error-message {
            font-weight: bold;
            color: #721c24;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Errors Encontrados</h1>
        <p class="error-message">{{ $errorMessage }}</p>
    </div>
</body>
</html>
