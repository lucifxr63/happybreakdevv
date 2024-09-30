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

if (isset($_POST['id_pedido']) && isset($_POST['nombre_producto']) && isset($_POST['descripcion']) && isset($_POST['fecha'])) {
    $id_pedido = $_POST['id_pedido'];
    $nombre = $_POST['nombre_producto'];
    $descripcion = $_POST['descripcion'];
    $fecha = $_POST['fecha'];

    // Insertar el problema en la tabla problema_cocina
    $sql = "INSERT INTO problema_cocina (Nombre, Descripcion, ID_Pedido, Fecha, Estado) VALUES (?, ?, ?, ?, 'Pendiente')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssis", $nombre, $descripcion, $id_pedido, $fecha);
    
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Problema registrado correctamente."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error al registrar el problema."]);
    }

    $stmt->close();
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos."]);
}

$conn->close();
?>
