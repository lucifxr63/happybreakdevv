<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../login.php");
    exit;
}

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

if (isset($_POST['id_pedido'])) {
    $id_pedido = $_POST['id_pedido'];

    // Actualizar el estado del pedido a "Listo para entregar"
    $sql = "UPDATE pedido SET Estado_pedido = 'Listo para entregar' WHERE ID_Pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pedido);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Pedido listo para entregar."]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo actualizar el estado del pedido."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No se proporcionó el ID del pedido."]);
}

$conn->close();
?>
