<?php
session_start();

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cafeteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si los datos del formulario están presentes
if (isset($_POST['opinion']) && isset($_POST['calificacion'])) {
    $opinion = $_POST['opinion'];
    $calificacion = $_POST['calificacion'];
    $id_usuario = $_SESSION['user_id']; // Asume que el ID del usuario está guardado en la sesión

    // Insertar la opinión en la base de datos
    $sql = "INSERT INTO opiniones (ID_Usuario, Opinion, Calificacion, Fecha) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isi", $id_usuario, $opinion, $calificacion);
    
    if ($stmt->execute()) {
        echo "success"; // Responde con éxito
    } else {
        http_response_code(500);
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    http_response_code(400);
    echo "Datos del formulario incompletos.";
}

$conn->close();
?>
