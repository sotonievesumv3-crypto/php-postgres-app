<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $anio = $_POST['anio'];

    $stmt = $conn->prepare("INSERT INTO auto(marca, modelo, precio, anio) 
                            VALUES(:marca, :modelo, :precio, :anio)");
    $stmt->execute([
        ':marca' => $marca,
        ':modelo' => $modelo,
        ':precio' => $precio,
        ':anio' => $anio
    ]);
}

$stmt = $conn->query("SELECT * FROM auto ORDER BY id_auto");
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Autos registrados</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; padding: 40px; }
        h2 { text-align: center; color: #333; }
        form, table { width: 80%; margin: 20px auto; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.2); }
        input, button { width: 100%; padding: 10px; margin-bottom: 12px; font-size: 16px; }
        button { background: #007bff; color: white; border: none; border-radius: 8px; cursor: pointer; }
        button:hover { background: #0056b3; }
        table { border-collapse: collapse; }
        th, td { text-align: center; padding: 12px; }
        th { background: #007bff; color: white; }
        tr:nth-child(even) { background: #f2f2f2; }
        a.boton { display: block; width: 200px; margin: 20px auto; text-align: center; background: #007bff; color: white; text-decoration: none; padding: 12px; border-radius: 8px; }
        a.boton:hover { background: #0056b3; }
    </style>
</head>
<body>

<h2>Autos registrados</h2>

<form method="POST">
    <input type="text" name="marca" placeholder="Marca" required>
    <input type="text" name="modelo" placeholder="Modelo" required>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="number" name="anio" placeholder="Año" required>
    <button type="submit">➕ Registrar auto</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Precio</th>
        <th>Año</th>
    </tr>
    <?php foreach($autos as $a): ?>
    <tr>
        <td><?= htmlspecialchars($a['id_auto']) ?></td>
        <td><?= htmlspecialchars($a['marca']) ?></td>
        <td><?= htmlspecialchars($a['modelo']) ?></td>
        <td>$<?= htmlspecialchars($a['precio']) ?></td>
        <td><?= htmlspecialchars($a['anio']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<a class="boton" href="index.php">🏠 Volver al Inicio</a>

</body>
</html>