<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_venta = $_POST['id_venta'];
    $monto = $_POST['monto'];
    $estado = $_POST['estado'];

    $stmt = $conn->prepare("INSERT INTO pago(id_venta, monto, estado, fecha_pago) 
                            VALUES(:id_venta, :monto, :estado, CURRENT_DATE)");
    $stmt->execute([
        ':id_venta' => $id_venta,
        ':monto' => $monto,
        ':estado' => $estado
    ]);
}

$stmt = $conn->query("SELECT * FROM pago ORDER BY id_pago");
$pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagos registrados</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; }
        h2 { text-align:center; }
        form, table { width:80%; margin:20px auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 0 10px rgba(0,0,0,0.2); }
        input, button, select { width:100%; padding:10px; margin-bottom:12px; }
        button { background:#007bff; color:white; border:none; border-radius:8px; }
        button:hover { background:#0056b3; }
        th { background:#007bff; color:white; }
        tr:nth-child(even){background:#f2f2f2;}
        a.boton { display:block; width:200px; margin:20px auto; text-align:center; background:#007bff; color:white; text-decoration:none; padding:12px; border-radius:8px; }
    </style>
</head>
<body>

<h2>Pagos registrados</h2>

<form method="POST">
    <input type="number" name="id_venta" placeholder="ID Venta" required>
    <input type="number" step="0.01" name="monto" placeholder="Monto" required>
    <select name="estado" required>
        <option value="pendiente">Pendiente</option>
        <option value="procesado">Procesado</option>
    </select>
    <button type="submit">➕ Registrar pago</button>
</form>

<table>
    <tr><th>ID Pago</th><th>ID Venta</th><th>Monto</th><th>Estado</th><th>Fecha</th></tr>
    <?php foreach($pagos as $p): ?>
    <tr>
        <td><?= htmlspecialchars($p['id_pago']) ?></td>
        <td><?= htmlspecialchars($p['id_venta']) ?></td>
        <td>$<?= htmlspecialchars($p['monto']) ?></td>
        <td><?= htmlspecialchars($p['estado']) ?></td>
        <td><?= htmlspecialchars($p['fecha_pago']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<a class="boton" href="index.php">🏠 Volver al Inicio</a>

</body>
</html>