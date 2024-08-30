<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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

$pedido_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Verificar que el pedido pertenece al usuario actual
$sql = "SELECT * FROM pedido WHERE ID_Pedido = ? AND Usuario_realizador = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $pedido_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Eliminar el pedido
    $sql_delete = "DELETE FROM pedido WHERE ID_Pedido = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    $stmt_delete->bind_param("i", $pedido_id);
    if ($stmt_delete->execute()) {
        echo "Pedido eliminado con éxito.";
    } else {
        echo "Error al eliminar el pedido.";
    }
    $stmt_delete->close();
} else {
    echo "No tienes permiso para eliminar este pedido.";
}

$stmt->close();
$conn->close();

header("Location: historial.php");
exit();
?>
