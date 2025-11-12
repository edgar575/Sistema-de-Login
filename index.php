<?php
session_start();
 include("conexion.php"); // ✅ conexión a la base

$error = ""; 
$alert_registro = "";

// Si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $captcha = trim($_POST['captcha']);

    // Validar CAPTCHA
    if (!isset($_SESSION['captcha_result']) || $captcha != $_SESSION['captcha_result']) {
        $error = "Verificación CAPTCHA incorrecta 😐";
    } else {
        // Buscar usuario en la base de datos
        $sql = "SELECT clave FROM usuarios WHERE usuario = ?";
        $stmt = $conexion->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("s", $usuario);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hash);
                $stmt->fetch();

                // Verificar la contraseña
                if (password_verify($password, $hash)) {
                    $_SESSION['usuario'] = $usuario;
                    header("Location: bienvenidos.php");
                    exit();
                } else {
                    $error = "Contraseña incorrecta 😕";
                }
            } else {
                $alert_registro = "¡Usuario no encontrado! Por favor regístrate antes.";
            }

            $stmt->close();
        } else {
            $error = "Error al preparar la consulta: " . $conn->error;
        }
    }
}

// Generar nuevo CAPTCHA
$num1 = rand(1, 10);
$num2 = rand(1, 10);
$operacion_num = rand(0, 2);
switch ($operacion_num) {
    case 0:
        $operacion = '+';
        $_SESSION['captcha_result'] = $num1 + $num2;
        break;
    case 1:
        $operacion = '-';
        $_SESSION['captcha_result'] = $num1 - $num2;
        break;
    case 2:
        $operacion = 'x';
        $_SESSION['captcha_result'] = $num1 * $num2;
        break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>

        <?php if ($error != ""): ?>
            <div class="mensaje"><?= $error ?></div>
        <?php endif; ?>

        <?php if ($alert_registro != ""): ?>
            <div class="mensaje"><?= $alert_registro ?></div>
        <?php endif; ?>

        <form action="" method="POST" autocomplete="off">
            <input type="text" id="usuario" name="usuario" placeholder="Usuario" required autocomplete="off">

            <input type="password" id="password" name="password" placeholder="Contraseña" required autocomplete="off">

            <input type="text" name="captcha" 
                   placeholder="Verificación (No soy un robot): <?= $num1 . ' ' . $operacion . ' ' . $num2 ?> = ?" 
                   required autocomplete="off">

            <button type="submit">Entrar</button>

            <p>¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
        </form>
    </div>
</body>
</html>
