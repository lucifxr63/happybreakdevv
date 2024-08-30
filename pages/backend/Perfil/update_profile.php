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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user_id'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $estado = $_POST['estado'];

    $sql = "UPDATE Usuarios SET Nombre=?, Correo=?, Telefono=?, Estado=? WHERE ID_Usuarios=?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ssssi", $nombre, $correo, $telefono, $estado, $userId);

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $nombre;
            $_SESSION['user_email'] = $correo;
            header("Location: perfil.php");
            exit;
        } else {
            echo "Error actualizando el perfil: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparando la consulta: " . $conn->error;
    }
}
$conn->close();
?>
