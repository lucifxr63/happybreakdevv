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

// Obtener el historial de todos los pedidos
$sql = "SELECT * FROM pedido";
$result = $conn->query($sql);

$historial = [];
while ($row = $result->fetch_assoc()) {
    $productos = json_decode($row['productos'], true);
    foreach ($productos as $producto) {
        $row['producto_id'] = $producto['id'];
        $row['producto_nombre'] = $producto['name'];
        $row['producto_precio'] = $producto['price'];
        $row['producto_cantidad'] = $producto['quantity'];
        $historial[] = $row;
    }
}

$conn->close();

// Enviar los datos en formato JSON al frontend
header('Content-Type: application/json');
echo json_encode($historial);
?>
