<?php
// Incluir el archivo de configuración de la base de datos
include '../config/config.php';
include '../includes/carrito_funciones.php';  // Incluir funciones del carrito

// Iniciar sesión si no está ya activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si se está eliminando un producto del carrito
if (isset($_GET['eliminar']) && is_numeric($_GET['eliminar'])) {
    $id_producto = (int)$_GET['eliminar'];
    eliminarProductoCarrito($id_producto);
    header("Location: carrito.php"); // Recargar la página para actualizar el carrito
    exit();
}

// Obtener los productos en el carrito desde la sesión
$productos_en_carrito = isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
$total_carrito = calcularTotalCarrito();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../assets/css/carrito.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    
    
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Carrito -->
    <main>
        <h1>Carrito de Compras</h1>
        
        <?php if (count($productos_en_carrito) > 0): ?>
            <div class="carrito">
                <ul>
                    <?php foreach ($productos_en_carrito as $producto): ?>
                        <li>
                            <img src="../assets/images/<?= htmlspecialchars($producto['imagen']) ?>" alt="<?= htmlspecialchars($producto['nombre']) ?>" width="50">
                            <p><?= htmlspecialchars($producto['nombre']) ?> - $<?= htmlspecialchars($producto['precio']) ?> x <?= htmlspecialchars($producto['cantidad']) ?></p>
                            <a href="carrito.php?eliminar=<?= $producto['id'] ?>" class="eliminar">Eliminar</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <p><strong>Total: $<?= htmlspecialchars($total_carrito) ?></strong></p>
                <a href="checkout.php" class="pagar">Ir a pagar</a>
            </div>
        <?php else: ?>
            <p>Tu carrito está vacío.</p>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

</body>
</html>
