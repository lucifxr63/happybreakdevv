<?php
header('Content-Type: application/json');

$servername = "127.0.0.1";  // Dirección del servidor
$username = "root";         // Nombre de usuario de la base de datos
$password = "";             // Contraseña de la base de datos (en blanco si no hay contraseña)
$dbname = "cafeteria";      // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error));
    exit();
}

// Verificar si el ID de la categoría está presente en la solicitud POST
if (!isset($_POST['id_categoria'])) {
    echo json_encode(array("status" => "error", "message" => "ID de la categoría no proporcionado"));
    exit();
}

$id_categoria = $_POST['id_categoria'];

$sql = "DELETE FROM categorias WHERE id_categoria=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(array("status" => "error", "message" => "Error en la preparación de la declaración: " . $conn->error));
    exit();
}

$stmt->bind_param("i", $id_categoria);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Categoría eliminada exitosamente"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al eliminar la categoría: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
