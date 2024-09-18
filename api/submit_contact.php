<?php
// Reemplaza con los detalles de conexión a tu base de datos
$servername = "localhost";
$username = "root";
$password = ""; // Por defecto, la contraseña es vacía en XAMPP/WAMP/MAMP
$dbname = "restaurante_quesillos_lo_nuestro";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['name'];
    $correo = $_POST['email'];
    $mensaje = $_POST['message'];
    
    // Preparar y vincular
    $stmt = $conn->prepare("INSERT INTO contacto (nombre, correo, mensaje) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $mensaje);

    // Ejecutar la declaración
    if ($stmt->execute()) {
        // Redirigir a la página de agradecimiento
        header("Location: thank_you.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
