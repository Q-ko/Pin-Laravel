<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>Nuevo cliente registrado</title>
</head>
<body>
    <h1>Nuevo cliente registrado</h1>
    <p>Se ha registrado un nuevo cliente en el sistema:</p>
    <ul>
        <li>Nombre: {{ $cliente ['nombre'] }}</li>
        <li>Email: {{ $cliente ['email'] }}</li>
        <li>Teléfono: {{ $cliente ['telefono'] }}</li>
        <li>Comentario: {{ $cliente ['comentario'] }}</li>
    </ul>
</body>
</html>


    




