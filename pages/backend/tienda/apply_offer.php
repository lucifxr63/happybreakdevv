<?php
header('Content-Type: application/json');

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Comprobar si el usuario es mantenedor (rol 3)
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 3) {
        echo json_encode(['status' => 'error', 'message' => 'No tienes permisos para realizar esta acción.']);
        exit;
    }

    // Conectar a la base de datos
    $servername = "127.0.0.1";  
    $username = "root";         
    $password = "";             
    $dbname = "cafeteria";      

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
    }

    $productId = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $percentage = isset($_POST['percentage']) ? intval($_POST['percentage']) : 0;

    if ($productId > 0 && $percentage > 0 && $percentage <= 100) {
        $sql = "UPDATE productos SET Precio = Precio - (Precio * ? / 100) WHERE ID_Productos = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $percentage, $productId);

        if ($stmt->execute()) {
            echo json_encode(array("status" => "success", "message" => "Oferta aplicada exitosamente."));
        } else {
            echo json_encode(array("status" => "error", "message" => "No se pudo aplicar la oferta."));
        }

        $stmt->close();
    } else {
        echo json_encode(array("status" => "error", "message" => "Datos inválidos."));
    }

    $conn->close();
}
?>
