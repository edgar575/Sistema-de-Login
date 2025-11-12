<?php
$host = "localhost";       // Servidor local de XAMPP
$user = "usuario_login";   // Usuario MySQL que creaste
$pass = "miClaveSegura123"; // Contraseña asignada
$db   = "login_sesion";    // Nombre de la base de datos
$port = 3307;              // Puerto (usa 3306 si no cambiaste nada)

$conexion = new mysqli($host, $user, $pass, $db, $port);

// Verificar conexión
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
} else {
    // echo "✅ Conexión exitosa a la base de datos.";
}
?>
