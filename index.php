<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <style>
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 40px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        th, td {
            text-align: center;
            padding: 12px;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.boton {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 12px;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }
        a.boton:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
require_once("conexion.php"); // Asegúrate de que el archivo de tu clase esté en esta ruta

try {
    // Crear conexión
    $conn = CConexion::ConexionBD();

    // Consulta SQL
    $query = 'SELECT * FROM public.usuarios';

    // Ejecutar consulta
    $stmt = $conn->prepare($query);
    $stmt->execute();

    // Mostrar resultados en una tabla HTML
    echo "<h2>Lista de Usuarios</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Correo</th></tr>";

    // Recorrer resultados
    while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($fila['id_usuarios']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['nombre']) . "</td>";
        echo "<td>" . htmlspecialchars($fila['correo']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {
    echo "<p style='color:red; text-align:center;'>❌ Error al mostrar los usuarios: " . $e->getMessage() . "</p>";
}
?>

<a class="boton" href="insertarUsuario.php">➕ Añadir Usuario</a>

</body>
</html>
