<?php
// Incluir el archivo de configuración de la base de datos
include '../config/config.php';
include '../includes/carrito_funciones.php';

// Iniciar sesión si no está ya activa
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    // Redirigir al login si no está autenticado
    header("Location: login.php");
    exit();
}

// Verificar si se está agregando un producto al carrito
if (isset($_GET['agregar']) && is_numeric($_GET['agregar'])) {
    $id_producto = (int)$_GET['agregar'];

    // Obtener detalles del producto de la base de datos
    $sql = "SELECT * FROM productos WHERE id = $id_producto";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $producto = $result->fetch_assoc();

        // Agregar producto al carrito con la función en carrito_funciones.php
        agregarProductoCarrito(
            $producto['id'],
            $producto['nombre'],
            $producto['precio'],
            $producto['imagen']
        );

        // Mostrar mensaje de éxito y redirigir al carrito
        echo "<script>
                alert('Producto agregado al carrito');
                window.location.href = 'index.php';
              </script>";
        exit();
    }
}

// Consulta para obtener todos los productos para mostrar en la página
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="/ProyectoF/assets/css/index.css">
    <link rel="stylesheet" href="/ProyectoF/assets/css/header.css">
    
    <script src="/ProyectoF/assets/js/cart.js"></script>
</head>
<body>

    <!-- Header -->
    <?php include '../includes/header.php'; ?>

    <!-- Mostrar nombre de usuario si está logueado -->
    <div class="welcome-message">
        <?php if (isset($_SESSION['usuario_nombre'])): ?>
            <p>Bienvenido, <?php echo $_SESSION['usuario_nombre']; ?>!</p>
        <?php endif; ?>
    </div>

    <!-- Botón para ver el carrito en la parte superior de la página -->
    <div class="ver-carrito-container">
        <a href="carrito.php" class="ver-carrito">Ver Carrito</a>
    </div>

    <!-- Sección de productos -->
    <main>
        <h1>Productos Destacados</h1>
        <div class="productos-destacados">
            <?php
            // Mostrar productos desde la base de datos
            if ($result->num_rows > 0) {
                while ($producto = $result->fetch_assoc()) {
                    $imagenProducto = htmlspecialchars($producto['imagen']);
                    $imagenRuta = "../assets/imagenes/" . $imagenProducto; // Ruta de la imagen en la carpeta assets/imagenes
                    echo '<div class="producto">';
                    echo '<img src="' . $imagenRuta . '" alt="' . htmlspecialchars($producto['nombre']) . '" class="producto-imagen">';
                    echo '<h3>' . htmlspecialchars($producto['nombre']) . '</h3>';
                    echo '<p>' . htmlspecialchars($producto['descripcion']) . '</p>';
                    echo '<p class="precio">$' . htmlspecialchars($producto['precio']) . '</p>';
                    // Botón para agregar al carrito con el ID del producto
                    echo '<a href="index.php?agregar=' . $producto['id'] . '" class="agregar-al-carrito">Agregar al carrito</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>No hay productos disponibles.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include '../includes/footer.php'; ?>

</body>
</html>
