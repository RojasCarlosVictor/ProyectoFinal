<?php
// Iniciar la sesión (si no se ha iniciado ya)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Comprobar si ya hay una sesión activa
if (isset($_SESSION['usuario_id'])) {
    // Si ya está logueado, redirigir a la página principal (index.php)
    if ($_SESSION['usuario_rol'] == 'admin') {
        header("Location: admin.php");  // Redirigir al panel de administración
    } else {
        header("Location: index.php");  // Redirigir a la página de usuario
    }
    exit();
}

// Incluir configuración de la base de datos
include '../config/config.php';

// Mensajes de error
$errorMessage = '';

// Comprobar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que los campos 'correo' y 'contrasena' existan en el POST
    if (isset($_POST['correo'], $_POST['contrasena'])) {
        $correo = trim($_POST['correo']);       // Limpiamos los datos recibidos
        $contrasena = trim($_POST['contrasena']);

        // Verificar que los campos no estén vacíos
        if (!empty($correo) && !empty($contrasena)) {
            // Preparar la consulta para verificar si el correo existe
            $sql = "SELECT * FROM usuarios WHERE correo = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $correo);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Si el correo existe, obtenemos los datos del usuario
                $usuario = $result->fetch_assoc();

                // Verificar la contraseña
                if (password_verify($contrasena, $usuario['contrasena'])) {
                    // Iniciar sesión y guardar los datos del usuario
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['nombre'] = $usuario['nombre'];
                    $_SESSION['correo'] = $usuario['correo'];
                    $_SESSION['usuario_rol'] = $usuario['rol'];  // Guardar el rol (user o admin)

                    // Redirigir según el rol del usuario
                    if ($usuario['rol'] == 'admin') {
                        header("Location: admin.php");  // Redirigir al panel de administración
                    } else {
                        header("Location: index.php");  // Redirigir a la página de usuario
                    }
                    exit();  // Detener el script después de la redirección
                } else {
                    $errorMessage = "La contraseña es incorrecta.";
                }
            } else {
                $errorMessage = "El correo no está registrado.";
            }
        } else {
            $errorMessage = "Por favor, completa todos los campos.";
        }
    } else {
        $errorMessage = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="../assets/css/registro.css">
</head>
<body>

    <div class="wrapper">
        <div class="form-container">
            <!-- Mensaje de error, si existe -->
            <?php if ($errorMessage): ?>
                <div class="error-message"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <h2>Iniciar sesión</h2>

            <form method="POST">
                <div class="input-group">
                    <input type="email" name="correo" placeholder="Correo electrónico" required>
                </div>
                <div class="input-group">
                    <input type="password" name="contrasena" placeholder="Contraseña" required>
                </div>
                <button type="submit" class="btn">Iniciar sesión</button>
            </form>

            <!-- Enlace para redirigir a registro si no tiene cuenta -->
            <p class="login-redirect">¿No tienes cuenta? <a href="registro.php">Regístrate</a></p>
        </div>
    </div>

</body>
</html>



