<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
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

// Verificar que se haya enviado el ID del pedido
if (isset($_POST['id_pedido'])) {
    $id_pedido = $_POST['id_pedido'];

    // Actualizar el estado del pedido a "Aprobado"
    $sql = "UPDATE pedido SET Estado_pedido = 'Aprobado' WHERE ID_Pedido = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_pedido);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Pedido aprobado exitosamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo aprobar el pedido."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "No se proporcionó el ID del pedido."]);
}

$conn->close();
?>
