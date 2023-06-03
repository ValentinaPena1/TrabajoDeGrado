<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #EDE7F6; /* Cambia el color de fondo a morado claro */
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #FFF; /* Cambia el color de fondo del contenedor a blanco */
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #AB47BC; /* Cambia el color de fondo del botón a morado */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #8E24AA; /* Cambia el color de fondo del botón al pasar el mouse */
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .success {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Restablecer Contraseña</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtener los datos del formulario
            $email = $_POST["email"];
            $password = $_POST["password"];

            // Validar los datos ingresados
            if (empty($email) || empty($password)) {
                echo "<p class='error'>Por favor, complete todos los campos del formulario.</p>";
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
                    echo "<p class='success'>Contraseña restablecida correctamente.</p>";
                } else {
                    echo "<p class='error'>Error al restablecer la contraseña: " . $conn->error . "</p>";
                }

                // Cerrar la conexión a la base de datos
                $conn->close();
            }
        }
        ?>
        <form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <input type="submit" value="Restablecer Contraseña">
            </div>
        </form>
    </div>
</body>
</html>
