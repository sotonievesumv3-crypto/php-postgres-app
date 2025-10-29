<?php
require_once("conexion.php"); // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $correoSD = $_POST['correo1'];

    try {
        $conn = CConexion::ConexionBD();

        $query = "INSERT INTO usuarios (nombre, correo) VALUES (:nombre, :correo)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correoSD);
        $stmt->execute();

        echo "<p style='color:green;'>✅ Usuario agregado correctamente.</p>";
    } catch (PDOException $er) {
        echo "<p style='color:red;'>❌ Error al insertar: " . $er->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Usuario</title>
    <style>
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
        body {
            font-family: Arial;
            background-color: #f4f4f4;
            padding: 40px;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
            max-width: 400px;
            margin: auto;
        }
        input[type=text], input[type=email] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input[type=submit] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>

<h2>Agregar Usuario</h2>

<form action="" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" id="nombre" required>

    <label for="correo">Correo:</label>
    <input type="email" name="correo1" id="correo1" required>

    <input type="submit" value="Guardar Usuario">
</form>

<a class="boton" href="index.php"> Regresar al Inicio  </a>

</body>
</html>
