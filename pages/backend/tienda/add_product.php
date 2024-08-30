<?php
header('Content-Type: application/json');

$servername = "127.0.0.1";  // Dirección del servidor
$username = "root";         // Nombre de usuario de la base de datos
$password = "";             // Contraseña de la base de datos (en blanco si no hay contraseña)
$dbname = "cafeteria";      // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error)));
}

$nombre = $_POST['nombre'];
$precio = $_POST['precio'];
$categoria = $_POST['categoria'];
$fecha_compra = $_POST['fecha_compra'];
$fecha_expiracion = $_POST['fecha_expiracion'];
$stock = $_POST['stock'];
$imagen = $_POST['imagen'];
$proveedor = $_POST['proveedor'];
$pais_origen = $_POST['pais_origen'];
$lactosa = isset($_POST['lactosa']) ? 1 : 0;
$gluten = isset($_POST['gluten']) ? 1 : 0;
$descripcion_producto = $_POST['descripcion_producto'];
$contador = isset($_POST['contador']) ? $_POST['contador'] : 0;  // Establecer contador en 0 si no se proporciona
$comentarios = isset($_POST['comentarios']) ? $_POST['comentarios'] : NULL;  // Permitir comentarios NULL

// Preparar la declaración SQL
$stmt = $conn->prepare("INSERT INTO productos (Nombre, Precio, Categoria, Fecha_de_compra, Fecha_de_EX, Stock, Imagen, Proveedor, Pais_origen, Lactosa, Gluten, Descripcion_Producto, Contador, Comentarios)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Vincular parámetros
$stmt->bind_param("sdsssisssiisis", $nombre, $precio, $categoria, $fecha_compra, $fecha_expiracion, $stock, $imagen, $proveedor, $pais_origen, $lactosa, $gluten, $descripcion_producto, $contador, $comentarios);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Nuevo producto agregado exitosamente"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
