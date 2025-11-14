<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];
    $id_auto = $_POST['id_auto'];
    $total = $_POST['total'];

    $stmt = $conn->prepare("INSERT INTO venta(id_cliente, id_auto, total, fecha_venta) 
                            VALUES(:id_cliente, :id_auto, :total, CURRENT_DATE)");
    $stmt->execute([
        ':id_cliente' => $id_cliente,
        ':id_auto' => $id_auto,
        ':total' => $total
    ]);
}

$stmt = $conn->query("SELECT * FROM venta ORDER BY id_venta");
$ventas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas registradas</title>
    <style>
        body { font-family: Arial; background:#f4f4f4; padding:40px; }
        h2 { text-align:center; }
        form, table { width:80%; margin:20px auto; background:#fff; padding:20px; border-radius:12px; box-shadow:0 0 10px rgba(0,0,0,0.2); }
        input, button { width:100%; padding:10px; margin-bottom:12px; }
        button { background:#007bff; color:white; border:none; border-radius:8px; }
        button:hover { background:#0056b3; }
        th { background:#007bff; color:white; }
        tr:nth-child(even){background:#f2f2f2;}
        a.boton { display:block; width:200px; margin:20px auto; text-align:center; background:#007bff; color:white; text-decoration:none; padding:12px; border-radius:8px; }
    </style>
</head>
<body>

<h2>Ventas registradas</h2>

<form method="POST">
    <input type="number" name="id_cliente" placeholder="ID Cliente" required>
    <input type="number" name="id_auto" placeholder="ID Auto" required>
    <input type="number" step="0.01" name="total" placeholder="Total" required>
    <button type="submit">➕ Registrar venta</button>
</form>

<table>
    <tr><th>ID Venta</th><th>ID Cliente</th><th>ID Auto</th><th>Total</th><th>Fecha</th></tr>
    <?php foreach($ventas as $v): ?>
    <tr>
        <td><?= htmlspecialchars($v['id_venta']) ?></td>
        <td><?= htmlspecialchars($v['id_cliente']) ?></td>
        <td><?= htmlspecialchars($v['id_auto']) ?></td>
        <td>$<?= htmlspecialchars($v['total']) ?></td>
        <td><?= htmlspecialchars($v['fecha_venta']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<a class="boton" href="index.php">🏠 Volver al Inicio</a>

</body>
</html>