<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $stmt = $conn->prepare("INSERT INTO promocion(nombre, descripcion, fecha_inicio, fecha_fin) 
                            VALUES(:nombre, :descripcion, :fecha_inicio, :fecha_fin)");
    $stmt->execute([
        ':nombre' => $nombre,
        ':descripcion' => $descripcion,
        ':fecha_inicio' => $fecha_inicio,
        ':fecha_fin' => $fecha_fin
    ]);
}

$stmt = $conn->query("SELECT * FROM promocion ORDER BY id_promocion");
$promociones = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Promociones registradas</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; }
        h2 { text-align:center; }
        form, table { width:80%; margin:20px auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 0 10px rgba(0,0,0,0.2); }
        input, textarea, button { width:100%; padding:10px; margin-bottom:12px; font-size:16px; }
        button { background:#007bff; color:white; border:none; border-radius:8px; cursor:pointer; }
        button:hover { background:#0056b3; }
        table { border-collapse: collapse; }
        th, td { text-align:center; padding:12px; }
        th { background:#007bff; color:white; }
        tr:nth-child(even){background:#f2f2f2;}
        a.boton { display:block; width:200px; margin:20px auto; text-align:center; background:#007bff; color:white; text-decoration:none; padding:12px; border-radius:8px; }
        a.boton:hover { background:#0056b3; }
    </style>
</head>
<body>

<h2>Promociones registradas</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la promoción" required>
    <textarea name="descripcion" placeholder="Descripción" rows="3"></textarea>
    <input type="date" name="fecha_inicio" required>
    <input type="date" name="fecha_fin" required>
    <button type="submit">➕ Registrar promoción</button>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Fecha inicio</th>
        <th>Fecha fin</th>
    </tr>
    <?php foreach($promociones as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id_promocion']) ?></td>
        <td><?= htmlspecialchars($p['nombre']) ?></td>
        <td><?= htmlspecialchars($p['descripcion']) ?></td>
        <td><?= htmlspecialchars($p['fecha_inicio']) ?></td>
        <td><?= htmlspecialchars($p['fecha_fin']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<a class="boton" href="index.php">🏠 Volver al Inicio</a>

</body>
</html>