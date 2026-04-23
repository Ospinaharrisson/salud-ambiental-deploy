<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error inesperado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="display-4 text-danger">¡Ups!</h1>
        <p class="lead">Ha ocurrido un error inesperado.</p>
        <p class="text-muted">Por favor, inténtalo de nuevo más tarde.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Volver al inicio</a>
    </div>    
</body>
</html>
