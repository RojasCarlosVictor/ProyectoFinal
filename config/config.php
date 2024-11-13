<?php
// Archivo de configuración de base de datos
$servername = "localhost";  // Servidor de base de datos
$username = "root";         // Usuario de base de datos (por defecto en XAMPP)
$password = "";             // Contraseña de base de datos (vacía en XAMPP por defecto)
$dbname = "mi_tienda";      // Nombre de la base de datos

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
