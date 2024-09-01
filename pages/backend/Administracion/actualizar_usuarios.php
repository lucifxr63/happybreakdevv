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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID_Usuarios']) && isset($_POST['Rol'])) {
    $id_usuario = $_POST['ID_Usuarios'];
    $nuevo_rol = $_POST['Rol'];

    // Consulta para actualizar el rol del usuario
    $sql = "UPDATE usuarios SET Rol_ID = ? WHERE ID_Usuarios = ?"; // Aquí también se usa Rol_ID
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $nuevo_rol, $id_usuario);

    if ($stmt->execute()) {
        echo "Rol actualizado correctamente";
    } else {
        echo "Error al actualizar el rol";
    }

    $stmt->close();
}

$conn->close();
?>
