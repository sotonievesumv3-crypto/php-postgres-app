<?php
class CConexion {
    public static function ConexionBD() {
        $host = "postgresql-urielnieves.alwaysdata.net";
        $port = "5432";
        $dbname = "urielnieves_bdnew";
        $username = "urielnieves";
        $password = "LEOMESSI123";

        try {
            $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "✅ Uriel se conectó correctamente a la Base de Datos";
        } catch (PDOException $exp) {
            echo "❌ No se pudo conectar: " . $exp->getMessage();
        }

        return $conn;
    }
}
?>