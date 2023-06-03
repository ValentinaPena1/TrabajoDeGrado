<?php
$servername = "localhost";
$username = ""; // Deja el campo vacío
$password = ""; // Deja el campo vacío
$database = "ludo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Error al conectar a la base de datos: " . $conn->connect_error);
}

// Aquí puedes realizar consultas y operaciones en la base de datos

// Cerrar conexión
$conn->close();
?>
