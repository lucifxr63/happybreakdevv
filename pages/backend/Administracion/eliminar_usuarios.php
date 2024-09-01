<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_Usuarios'])) {
    $id_usuario = $_POST['ID_Usuarios'];

    // Consulta para eliminar el usuario
    $sql = "DELETE FROM usuarios WHERE ID_Usuarios = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error al eliminar el usuario";
    }

    $stmt->close();
}

$conn->close();
?>
