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

$pedido_id = $_POST['id_pedido'];
$post_indicaciones = $_POST['post_indicaciones'];
$user_id = $_SESSION['user_id'];

// Verificar que el pedido pertenece al usuario actual
$sql = "SELECT * FROM pedido WHERE ID_Pedido = ? AND Usuario_realizador = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $pedido_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Actualizar las post indicaciones del pedido
    $sql_update = "UPDATE pedido SET Post_Indicaciones = ? WHERE ID_Pedido = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("si", $post_indicaciones, $pedido_id);
    if ($stmt_update->execute()) {
        echo "Pedido actualizado con éxito.";
    } else {
        echo "Error al actualizar el pedido.";
    }
    $stmt_update->close();
} else {
    echo "No tienes permiso para editar este pedido.";
}

$stmt->close();
$conn->close();

header("Location: historial.php");
exit();
?>
