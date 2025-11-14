<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

// Insertar cliente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidopaterno = $_POST['apellidopaterno'];
    $apellidomaterno = $_POST['apellidomaterno'];
    $correo = $_POST['correo'];

    $stmt = $conn->prepare("INSERT INTO cliente(nombre, apellidopaterno, apellidomaterno, correo) 
                            VALUES(:nombre, :apellidopaterno, :apellidomaterno, :correo)");
    $stmt->execute([
        ':nombre' => $nombre,
        ':apellidopaterno' => $apellidopaterno,
        ':apellidomaterno' => $apellidomaterno,
        ':correo' => $correo
    ]);
}

// Consultar clientes
$stmt = $conn->query("SELECT * FROM cliente ORDER BY id_cliente");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes registrados</title>
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
        form {
            width: 80%;
            margin: 0 auto 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }
        input, button {
            display: block;
            width: 100%;
            margin-bottom: 12px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
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

<h2>Clientes registrados</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="apellidopaterno" placeholder="Apellido paterno" required>
    <input type="text" name="apellidomaterno" placeholder="Apellido materno">
    <input type="email" name="correo" placeholder="Correo electrónico" required>
    <button type="submit">➕ Registrar cliente</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellido paterno</th>
        <th>Apellido materno</th>
        <th>Correo</th>
        <th>Fecha de registro</th>
    </tr>
    <?php foreach($clientes as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c['id_cliente']) ?></td>
        <td><?= htmlspecialchars($c['nombre']) ?></td>
        <td><?= htmlspecialchars($c['apellidopaterno']) ?></td>
        <td><?= htmlspecialchars($c['apellidomaterno']) ?></td>
        <td><?= htmlspecialchars($c['correo']) ?></td>
        <td><?= htmlspecialchars($c['fecharegistro']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<a class="boton" href="index.php">🏠 Volver al Inicio</a>

</body>
</html>