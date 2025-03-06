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

// Validar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $email = trim($_POST["email"]);
    $edad = trim($_POST["edad"]);
    
    $errores = [];

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($edad)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Validar el formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido.";
    }

    // Validar que la edad sea un número positivo
    if (!is_numeric($edad) || $edad <= 0) {
        $errores[] = "La edad debe ser un número positivo.";
    }

    // Si hay errores, mostrarlos y detener el proceso
    if (!empty($errores)) {
        foreach ($errores as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        echo "<a href='index.html'>Volver al formulario</a>";
        exit();
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES ('$nombre', '$email', '$edad')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>Registro exitoso.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}

// Cerrar conexión
$conn->close();
?>

<br>
<a href="index.html">Volver al formulario</a>
<a href="mostrar_datos.php">Ver usuarios</a>
