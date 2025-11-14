<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Agencia</title>
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
            margin: 10px auto;
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
require_once("conexion.php");

try {
    $conn = CConexion::ConexionBD();
    echo "<p style='text-align:center; color:green;'>✔ CHIREY AGENCIA</p>";

    $query = 'SELECT * FROM public.usuarios';
    $stmt = $conn->prepare($query);
    $stmt->execute();

    echo "<h2>Lista de Usuarios</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Correo</th></tr>";

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

<!-- Botones de navegación -->
<h2>Panel de gestión</h2>
<a class="boton" href="insertarUsuario.php">➕ Añadir Usuario</a>
<a class="boton" href="clientes.php">👥 Ver Clientes</a>
<a class="boton" href="autos.php">🚗 Ver Autos</a>
<a class="boton" href="ventas.php">🛒 Ver Ventas</a>
<a class="boton" href="pagos.php">💳 Ver Pagos</a>
<a class="boton" href="garantias.php">🛡️ Ver Garantías</a>
<a class="boton" href="promociones.php">🎁 Ver Promociones</a>

</body>
</html>