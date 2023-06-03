<?php
// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtiene los datos del formulario
    $rol = $_POST["rol"];

    // Realiza la conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "ludo";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Prepara la consulta SQL para insertar el nuevo rol
    $sql = "INSERT INTO rol (Rol) VALUES ('$rol')";

    if ($conn->query($sql) === TRUE) {
        // Redirecciona a juegos.php después de agregar el rol
        header("Location: juegos.php");
        exit();
    } else {
        echo "Error al agregar el rol: " . $conn->error;
    }

    // Cierre de la conexión a la base de datos
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agregar Rol</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        h1 {
            text-align: center;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Agregar Rol</h1>
        <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <label for="rol">Rol:</label>
            <input type="text" name="rol" id="rol" required>
            <input type="submit" value="Agregar">
        </form>
    </div>
</body>
</html>
