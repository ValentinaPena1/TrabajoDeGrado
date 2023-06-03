<!DOCTYPE html>
<html>
<head>
    <title>Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .profile-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        .profile-container h2 {
            text-align: center;
        }

        .profile-table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-table th,
        .profile-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>Perfil</h2>
        <table class="profile-table">
            <thead>
                <tr>
                    <th>Uararios</th>
                    <th>correo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "ludo";

                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("Error de conexión: " . $conn->connect_error);
                }

                // Consulta a la tabla "niveles"
                $sql = "SELECT Nombre, Email FROM usuarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["Nombre"] . "</td>";
                        echo "<td>" . $row["Email"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No se encontraron registros.</td></tr>";
                }

                // Cierre de la conexión a la base de datos
                $conn->close();
                ?>
                