<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "ludo";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta a la base de datos
$sql = "SELECT partida, fecha_partida, nivel, puntaje FROM tu_tabla";
$result = $conn->query($sql);

// Verificar si se encontraron resultados
if ($result->num_rows > 0) {
    // Mostrar los datos en una tabla HTML
    echo "<table class='table table-striped'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope='col'># Partida</th>";
    echo "<th scope='col'>Fecha Partida</th>";
    echo "<th scope='col'>Nivel</th>";
    echo "<th scope='col'>Puntaje</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>" . $row["partida"] . "</th>";
        echo "<td>" . $row["fecha_partida"] . "</td>";
        echo "<td>" . $row["nivel"] . "</td>";
        echo "<td>" . $row["puntaje"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
} else {
    echo "No se encontraron resultados.";
}

// Cerrar la conexión
$conn->close();
?>
