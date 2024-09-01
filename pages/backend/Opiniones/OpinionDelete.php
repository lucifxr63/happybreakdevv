<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $opinionId = intval($_POST['id']);

        // Conexión a la base de datos
        $conn = new mysqli('127.0.0.1', 'root', '', 'cafeteria');
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "DELETE FROM opiniones WHERE ID_Opinion = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $opinionId);

        if ($stmt->execute()) {
            echo "success";
        } else {
            http_response_code(500);
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        http_response_code(400);
        echo "ID de opinión no proporcionado.";
    }
} else {
    http_response_code(403);
    echo "Método no permitido.";
}
?>
