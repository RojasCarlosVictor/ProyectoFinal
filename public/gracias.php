<?php
// configuración de base de datos y funciones
include '../config/config.php';
include '../includes/header.php';

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu compra</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/gracias.css">
</head>
<body>

<main>
    <h1>¡Gracias por tu compra!</h1>
    <p>Tu pedido ha sido realizado con éxito. Te enviaremos una confirmación a tu correo.</p>
    <p><a href="index.php">Volver al inicio</a></p>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>
