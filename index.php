<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conectar PHP con PostgreSQL</title>
</head>
<body>
    <?php
    include_once("conexion.php");

    $conexion = new CConexion();
    $conexion->ConexionBD();
    ?>
</body>
</html>
    