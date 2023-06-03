<?php
session_start();

// Inicio de sesión exitoso
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Obtener los datos del formulario
    $email = $_POST["Email"];
    $clave = $_POST["Clave"];

    // Validar los datos ingresados
    if (empty($email) || empty($clave)) {
        echo "Por favor, complete todos los campos del formulario.";
    } else {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ludo";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Verificar las credenciales del usuario en la base de datos
        $query = "SELECT * FROM usuarios WHERE Email = '$email' AND Clave = '$clave'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Las credenciales son correctas
            // Obtener el nombre del usuario desde la base de datos
            $row = $result->fetch_assoc();
            $nombre = $row['Nombre'];

            // Guardar el nombre y el correo electrónico en variables de sesión
            $_SESSION['nombre'] = $nombre;
            $_SESSION['email'] = $email;

            // Redirigir al usuario a la página de juegos
            header("Location: juegos.php");
            exit();
        } else {
            echo "Credenciales incorrectas. Por favor, verifica tu email y contraseña.";
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
}

// Verificar si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["registro"])) {
    // Obtener los datos del formulario
    $nombre = $_POST["Nombre"];
    $email = $_POST["Email"];
    $clave = $_POST["Clave"];

    // Validar los datos ingresados
    if (empty($nombre) || empty($email) || empty($clave)) {
        echo "Por favor, complete todos los campos del formulario.";
    } else {
        // Conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "ludo";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error en la conexión a la base de datos: " . $conn->connect_error);
        }

        // Verificar si el correo electrónico ya está registrado en la base de datos
        $sql = "SELECT * FROM usuarios WHERE Email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "El correo electrónico ingresado ya está registrado.";
        } else {
            // Insertar los datos en la base de datos
            $sql = "INSERT INTO usuarios (Nombre, Email, Clave, Estado) VALUES ('$nombre', '$email', '$clave', 1)";

            if ($conn->query($sql) === TRUE) {
                echo "Registro exitoso. Ahora puedes iniciar sesión.";
            } else {
                echo "Error al registrar los datos: " . $conn->error;
            }
        }

        // Cerrar la conexión a la base de datos
        $conn->close();
    }
}

?>
