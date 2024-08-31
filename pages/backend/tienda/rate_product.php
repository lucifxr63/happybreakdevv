<?php
header('Content-Type: application/json');
session_start(); // Asegurarse de iniciar la sesión

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cafeteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error));
    exit();
}

// Verificar si el ID del usuario está en la sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(array("status" => "error", "message" => "Usuario no autenticado"));
    exit();
}

$id_producto = $_POST['id'];
$rating = $_POST['rating'];
$id_usuario = $_SESSION['user_id']; // Suponiendo que el ID del usuario está en la sesión

// Verificar que todos los campos necesarios estén presentes
if (empty($id_producto) || empty($rating) || empty($id_usuario)) {
    echo json_encode(array("status" => "error", "message" => "Faltan campos obligatorios"));
    exit();
}

$sql = "INSERT INTO valoraciones (ID_Producto, ID_Usuario, Calificacion) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(array("status" => "error", "message" => "Error en la preparación de la declaración: " . $conn->error));
    exit();
}

$stmt->bind_param("iii", $id_producto, $id_usuario, $rating);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Valoración registrada exitosamente"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al registrar la valoración: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
