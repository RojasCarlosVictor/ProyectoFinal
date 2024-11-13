<?php
// Incluir configuración de la base de datos y funciones de usuario
include '../config/config.php';
include '../includes/header.php';
include '../includes/usuario_funciones.php';



// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    // Redirigir al login si no está logueado
    header("Location: login.php");
    exit;
}

// Recuperar el carrito (desde la sesión)
$carrito = $_SESSION['carrito'] ?? [];

// Calcular el total del carrito
$total = array_reduce($carrito, function($sum, $item) {
    return $sum + ($item['precio'] * $item['cantidad']);
}, 0);

// Si el formulario de confirmación se envía y el carrito no está vacío
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($carrito)) {
    // Llamar a la función para registrar la compra
    $resultado = registrarCompra($conn);

    // Si la compra fue exitosa, redirigir a la página de gracias
    if ($resultado === "Compra registrada exitosamente.") {
        header("Location: gracias.php");
        exit;
    } else {
        // Mostrar el error si la compra no pudo ser registrada
        echo "<p>Error al registrar la compra: " . htmlspecialchars($resultado) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Finalizar Compra</title>
    <link rel="stylesheet" href="../assets/css/checkout.css">
    <link rel="stylesheet" href="../assets/css/header.css">

</head>
<body>

<main>
    <h1>Resumen de  Compra</h1>

    <div class="productos-destacados">
        <?php if (!empty($carrito)): ?>
            <?php foreach ($carrito as $item): ?>
                <div class="producto">
                    <p><strong><?php echo htmlspecialchars($item['nombre']); ?></strong></p>
                    <p>Precio: $<?php echo number_format($item['precio'], 2); ?></p>
                    <p>Cantidad: <?php echo $item['cantidad']; ?></p>
                    <p>Total: $<?php echo number_format($item['precio'] * $item['cantidad'], 2); ?></p>
                </div>
            <?php endforeach; ?>
            <h3>Total de la Compra: $<?php echo number_format($total, 2); ?></h3>

            <!-- Formulario para confirmar el pedido -->
            <form method="post">
                <button type="submit">Confirmar Pedido</button>
            </form>
        <?php else: ?>
            <p>No hay productos en el carrito.</p>
        <?php endif; ?>
    </div>
</main>

<?php include '../includes/footer.php'; ?>
</body>
</html>

