<?php
session_start();
require_once "conexion.php"; // Asegúrate que conexion.php está correcto y en la misma carpeta

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recoger y limpiar datos
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $usuario  = trim($_POST['usuario'] ?? '');
    $clave    = trim($_POST['clave'] ?? '');

    // Validaciones básicas
    if ($nombre === "" || $apellido === "" || $email === "" || $usuario === "" || $clave === "") {
        $mensaje = "⚠️ Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "⚠️ El correo electrónico no tiene un formato válido.";
    } else {
        // Comprobar si ya existe usuario o email
        $check = $conexion->prepare("SELECT id FROM usuarios WHERE usuario = ? OR email = ?");
        if (!$check) {
            $mensaje = "❌ Error en la consulta: " . $conexion->error;
        } else {
            $check->bind_param("ss", $usuario, $email);
            $check->execute();
            $check->store_result();

            if ($check->num_rows > 0) {
                $mensaje = "⚠️ El usuario o el correo ya están registrados.";
                $check->close();
            } else {
                $check->close();

                // Insertar nuevo usuario con contraseña hasheada
                $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
                $insert = $conexion->prepare("INSERT INTO usuarios (nombre, apellido, email, usuario, clave) VALUES (?, ?, ?, ?, ?)");

                if (!$insert) {
                    $mensaje = "❌ Error al preparar el registro: " . $conexion->error;
                } else {
                    $insert->bind_param("sssss", $nombre, $apellido, $email, $usuario, $clave_hash);
                    if ($insert->execute()) {
                        $mensaje = "✅ Usuario registrado exitosamente. Ahora puedes iniciar sesión.";
                        // Opcional: redirigir automáticamente al login después de 2s
                        // header("Refresh:2; url=index.php");
                    } else {
                        $mensaje = "❌ Error al registrar el usuario: " . $insert->error;
                    }
                    $insert->close();
                }
            }
        }
    }

    // Cerrar conexión (opcional, pero limpio)
    // $conexion->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="css/registro.css">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            background: linear-gradient(120deg, #002b36, #004b63);
            background-size: 600% 600%;
            animation: fondoAnimado 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @keyframes fondoAnimado {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        .contenedor {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 40px;
            border-radius: 20px;
            width: 380px;
            box-shadow: 0 0 25px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: aparecer 1s ease-in-out;
        }

        @keyframes aparecer {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h2 {
            color: #fff;
            margin-bottom: 25px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.8);
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            background: #fff;
            box-shadow: 0 0 8px #00d2ff;
        }

        button {
            width: 100%;
            padding: 10px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
            color: white;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(90deg, #0072ff, #00c6ff);
            transform: scale(1.05);
        }

        .mensaje {
            color: #fff;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
        }

        a {
            color: #00c6ff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>


</head>
<body>
    <div class="contenedor">
        <form method="POST" action="">
            <h2>Registrar Usuario</h2>

            <?php if ($mensaje != ""): ?>
                <div class="mensaje"><?= $mensaje ?></div>
            <?php endif; ?>

            <input type="text" name="nombre" placeholder="Nombre de la persona" required>
            <input type="text" name="apellido" placeholder="Apellido de la persona" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="text" name="usuario" placeholder="Nombre de usuario" required>
            <input type="password" name="clave" placeholder="Contraseña" required>

            <button type="submit">Registrarse</button>
            <p style="color:white; margin-top:15px;">¿Ya tienes cuenta? <a href="index.php">Inicia sesión</a></p>
        </form>
    </div>
</body>
</html>
