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
    die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_producto = $_POST['id'];

    // Eliminar la oferta asociada al producto
    $sql = "DELETE FROM ofertas WHERE Productos = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_producto);

    if ($stmt->execute()) {
        echo json_encode(array("status" => "success", "message" => "Oferta eliminada exitosamente."));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error al eliminar la oferta."));
    }

    $stmt->close();
} else {
    echo json_encode(array("status" => "error", "message" => "Solicitud inválida."));
}

$conn->close();
?>
