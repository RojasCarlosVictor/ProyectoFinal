<?php
// Iniciar sesión una vez para todas las funciones en este archivo
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Función para agregar un producto al carrito
function agregarProductoCarrito($id, $nombre, $precio, $imagen) {
    // Crear el carrito en la sesión si no existe
    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // Verificar si el producto ya está en el carrito
    $producto_existe = false;
    foreach ($_SESSION['carrito'] as &$producto) {
        if ($producto['id'] == $id) {
            // Si el producto ya existe, incrementar la cantidad
            $producto['cantidad']++;
            $producto_existe = true;
            break;
        }
    }

    // Si el producto no está en el carrito, agregarlo
    if (!$producto_existe) {
        $_SESSION['carrito'][] = [
            'id' => $id,
            'nombre' => $nombre,
            'precio' => $precio,
            'imagen' => $imagen,
            'cantidad' => 1
        ];
    }
}

// Función para eliminar un producto del carrito por su ID
function eliminarProductoCarrito($id) {
    if (isset($_SESSION['carrito'])) {
        // Filtrar el carrito para excluir el producto con el ID proporcionado
        $_SESSION['carrito'] = array_filter($_SESSION['carrito'], function($producto) use ($id) {
            return $producto['id'] != $id;
        });

        // Reindexar el array después de la eliminación
        $_SESSION['carrito'] = array_values($_SESSION['carrito']);
    }
}

// Función para calcular el total de los productos en el carrito
function calcularTotalCarrito() {
    $total = 0;
    if (isset($_SESSION['carrito'])) {
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
    }
    return $total;
}

// Función para obtener el carrito completo desde la sesión
function obtenerCarrito() {
    return isset($_SESSION['carrito']) ? $_SESSION['carrito'] : [];
}
?>
