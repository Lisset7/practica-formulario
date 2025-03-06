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

// Verificar si se envió el formulario para actualizar datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $edad = $_POST["edad"];

    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', edad='$edad' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}

// Obtener datos del usuario si se envió un ID
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit();
    }
} else {
    echo "ID no proporcionado.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <form method="post" action="editar.php">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        Edad: <input type="number" name="edad" value="<?php echo $row['edad']; ?>" required><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
