<?php
require_once("conexion.php");
$conn = CConexion::ConexionBD();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_auto = $_POST['id_auto'];
    $fecha_inicio = $_POST['fecha_inicio'];
    $fecha_fin = $_POST['fecha_fin'];

    $stmt = $conn->prepare("INSERT INTO garantia(id_auto, fecha_inicio, fecha_fin) 
                            VALUES(:id_auto, :fecha_inicio, :fecha_fin)");
    $stmt->execute([
        ':id_auto' => $id_auto,
        ':fecha_inicio' => $fecha_inicio,
        ':fecha_fin' => $fecha_fin
    ]);
}

$stmt = $conn->query("SELECT * FROM garantia ORDER BY id_garantia");
$garantias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Garantías registradas</title>
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

<h2>Garantías registradas</h2>

<form method="POST">
    <input type="number" name="id_auto" placeholder="ID Auto" required>
    <input type="date" name="fecha_inicio" required>
    <input type="date" name="fecha_fin" required>
    <button type="submit">➕ Registrar garantía</button>
</form>

<table