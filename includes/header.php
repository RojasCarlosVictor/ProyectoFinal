<header class="site-header">
    <div class="header-container">
        <!-- Logo -->
        <div class="header-logo">
            <a href="index.php">
                <img src="/ProyectoF/assets/imagenes/logo.jpg" alt="Logo Tienda">
            </a>
        </div>

        <!-- Menú de navegación -->
        <nav class="header-nav">
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="carrito.php">Carrito</a></li>
            </ul>
        </nav>

        <!-- Iconos de redes sociales -->
        <div class="header-social-icons">
            <a href="#" class="header-social-icon">
                <img src="/ProyectoF/assets/imagenes/Facebook.png" alt="Facebook">
            </a>
            <a href="#" class="header-social-icon">
                <img src="/ProyectoF/assets/imagenes/Instagram.jpg" alt="Instagram">
            </a>
        </div>

        <!-- Agregar el botón de cerrar sesión si el usuario está logueado -->
        <?php if (isset($_SESSION['usuario_id'])): ?>
            <div class="header-logout">
                <a href="logout.php" class="logout-button">Cerrar sesión</a>
            </div>
        <?php endif; ?>
    </div>
</header>
