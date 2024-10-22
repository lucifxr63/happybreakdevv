<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'No has iniciado sesión']);
    exit;
}

// Verificar si se recibió el ID del pedido
if (!isset($_POST['id_pedido'])) {
    echo json_encode(['status' => 'error', 'message' => 'ID de pedido no proporcionado']);
    exit;
}

$id_pedido = $_POST['id_pedido'];

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cafeteria";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Conexión fallida: ' . $conn->connect_error]));
}

// Actualizar el estado del pedido a "entregado"
$sql = "UPDATE pedido SET Estado_pedido = 'entregado' WHERE ID_Pedido = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta']);
    exit;
}
$stmt->bind_param("i", $id_pedido);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Pedido marcado como entregado']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el pedido']);
}

$stmt->close();
$conn->close();
?>
