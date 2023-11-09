<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Nuevo mensaje del formulario INSUMAR</title>
</head>
<body>
    
    <p>Hola! {{ $data['nameEmployee'] }} {{ $data['lastNameEmployee'] }} este es un mensaje automatico del formulario de insumar.</p>
    <p>Estos son los datos de contacto del usuario:</p>
    <ul>
        <li>Nombre: {{ $data['name'] }}</li>
        <li>Teléfono: {{ $data['phone'] }}</li>
        <li>E-mail de contacto: {{ $data['email_contact'] }}</li>
    </ul>
    <p>Mensaje: {{ $data['message'] }}</p>
</body>
</html>