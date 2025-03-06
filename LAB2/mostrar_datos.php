<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar datos
$sql = "SELECT id, nombre, email, edad FROM usuarios";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios Registrados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Usuarios Registrados</h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Acciones</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td>" . $row["nombre"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["edad"] . "</td>";
            echo "<td>
                    <a href='editar.php?id=" . $row["id"] . "'>Editar</a> | 
                    <a href='eliminar.php?id=" . $row["id"] . "'>Eliminar</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No hay usuarios registrados.</p>";
    }

    // Cerrar conexión
    $conn->close();
    ?>

    <br>
    <a href="formulario.html">
        <button>Volver al Registro</button>
    </a>

</body>
</html>
