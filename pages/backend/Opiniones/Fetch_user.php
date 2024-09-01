<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(array("status" => "error", "message" => "Usuario no ha iniciado sesión"));
    exit();
}

// Obtener el ID del usuario de la sesión
$user_id = $_SESSION['user_id'];

$servername = "127.0.0.1";  // Dirección del servidor
$username = "root";         // Nombre de usuario de la base de datos
$password = "";             // Contraseña de la base de datos (en blanco si no hay contraseña)
$dbname = "cafeteria";      // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta SQL para obtener los datos del usuario actual
$sql = "SELECT ID_Usuarios, Usuario, Rol_ID, Rol FROM usuarios WHERE ID_Usuarios = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    echo json_encode(array("status" => "success", "user" => $user));
} else {
    echo json_encode(array("status" => "error", "message" => "Usuario no encontrado"));
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
