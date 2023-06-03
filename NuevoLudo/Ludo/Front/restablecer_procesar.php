<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validar los datos ingresados
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos del formulario.";
    } else {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $dbpassword = ""; // Cambia esta variable si tu contraseña de base de datos es diferente
        $dbname = "ludo";

        $conn = new mysqli($servername, $username, $dbpassword, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Actualizar la contraseña en la base de datos
        $sql = "UPDATE usuarios SET Clave = '$password' WHERE Email = '$email'";

        if ($conn->query($sql) === TRUE) {
            echo "Contraseña restablecida correctamente.";
        } else {
            echo "Error al restablecer la contraseña: " . $conn->error;
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
}
?>
