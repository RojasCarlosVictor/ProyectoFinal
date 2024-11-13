<?php
// que la sesión esté iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para registrar una compra
function registrarCompra($conn) {
    // Verificar si el usuario está logueado
    if (!isset($_SESSION['usuario_id'])) {
        return "Error: Debes iniciar sesión para realizar una compra.";
    }

    // Obtener el ID del usuario
    $usuario_id = $_SESSION['usuario_id'];

    // Verificar si el carrito de compras no está vacío
    if (!isset($_SESSION['carrito']) || empty($_SESSION['carrito'])) {
        return "Error: El carrito de compras está vacío.";
    }

    // Calcular el total de la compra
    $total = 0;
    foreach ($_SESSION['carrito'] as $producto) {
        $total += $producto['precio'] * $producto['cantidad'];
    }

    // Insertar el pedido en la tabla 'pedidos'
    $sql = "INSERT INTO pedidos (usuario_id, total, estado, fecha) VALUES (?, ?, 'pendiente', CURRENT_TIMESTAMP)";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        return "Error en la preparación de la consulta para insertar el pedido.";
    }
    $stmt->bind_param("id", $usuario_id, $total);
    if (!$stmt->execute()) {
        return "Error: No se pudo registrar el pedido. Intenta de nuevo.";
    }

    // Obtener el ID del pedido insertado
    $pedido_id = $stmt->insert_id;

    // Insertar los detalles del pedido en la tabla 'pedido_detalles'
    $sql_detalles = "INSERT INTO pedido_detalles (pedido_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)";
    $stmt_detalles = $conn->prepare($sql_detalles);

    if ($stmt_detalles === false) {
        return "Error en la preparación de la consulta para insertar los detalles del pedido.";
    }

    // Recorrer el carrito y registrar los detalles de cada producto
    foreach ($_SESSION['carrito'] as $producto) {
        $stmt_detalles->bind_param("iiid", $pedido_id, $producto['id'], $producto['cantidad'], $producto['precio']);
        if (!$stmt_detalles->execute()) {
            return "Error al registrar los detalles del pedido. Intenta de nuevo.";
        }
    }

    // Vaciar el carrito después de registrar la compra
    unset($_SESSION['carrito']);

    // Devolver un mensaje de éxito
    return "Compra registrada exitosamente.";
}
?>
