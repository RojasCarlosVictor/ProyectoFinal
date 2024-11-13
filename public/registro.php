<?php
// Incluir configuración de la base de datos
include '../config/config.php';
include '../includes/usuario_funciones.php';

$mensaje = ""; // Variable para el mensaje de éxito o error

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos del formulario
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $contrasena = trim($_POST['contrasena']);
    $contrasena_confirmar = trim($_POST['contrasena_confirmar']);
    
    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($correo) && !empty($contrasena) && !empty($contrasena_confirmar)) {
        if ($contrasena === $contrasena_confirmar) {
            // Verificar si el correo ya está registrado
            $sql = "SELECT * FROM usuarios WHERE correo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $mensaje = "Este correo ya está registrado. Por favor usa otro correo.";
            } else {
                // Encriptar la contraseña
                $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

                // Insertar  nuevo usuario en la base de datos
                $sql = "INSERT INTO usuarios (nombre, correo, contrasena) VALUES (?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sss", $nombre, $correo, $contrasena_hash);
                if ($stmt->execute()) {
                    // Redirigir después de un segundo con el mensaje
                    $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
                    header("refresh:2; url=login.php"); // Redirigir a la página de login después de 2 segundos
                    exit();
                } else {
                    $mensaje = "Hubo un error al registrar el usuario. Intenta de nuevo.";
                }
            }
        } else {
            $mensaje = "Las contraseñas no coinciden.";
        }
    } else {
        $mensaje = "Por favor completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../assets/css/registro.css">
</head>
<body>

    <div class="wrapper">
        <div class="form-container">
            <h2>Registrarse</h2>
            
            <!-- Mostrar mensaje de éxito o error -->
            <?php if ($mensaje): ?>
                <div class="message"><?php echo $mensaje; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="input-group">
                    <input type="text" name="nombre" placeholder="Nombre completo" required>
                </div>
                <div class="input-group">
                    <input type="email" name="correo" placeholder="Correo electrónico" required>
                </div>
                <div class="input-group">
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                </div>
                <div class="input-group">
                    <input type="password" name="contrasena_confirmar" placeholder="Confirmar contraseña" required>
                </div>
                <button type="submit" class="btn">Registrarse</button>
            </form>
            <p class="login-redirect">¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a></p>
        </div>
    </div>

</body>
</html>
