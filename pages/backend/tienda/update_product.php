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
    echo json_encode(array("status" => "error", "message" => "Conexión fallida: " . $conn->connect_error));
    exit();
}

$id = $_POST['id'];
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
$contador = $_POST['contador'];
$comentarios = $_POST['comentarios'];

$sql = "UPDATE productos SET Nombre=?, Precio=?, Categoria=?, Fecha_de_compra=?, Fecha_de_EX=?, Stock=?, Imagen=?, Proveedor=?, Pais_origen=?, Lactosa=?, Gluten=?, Descripcion_Producto=?, Contador=?, Comentarios=? WHERE ID_Productos=?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode(array("status" => "error", "message" => "Error en la preparación de la declaración: " . $conn->error));
    exit();
}

$stmt->bind_param("sdsssisssiisisi", $nombre, $precio, $categoria, $fecha_compra, $fecha_expiracion, $stock, $imagen, $proveedor, $pais_origen, $lactosa, $gluten, $descripcion_producto, $contador, $comentarios, $id);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Producto actualizado exitosamente"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error al actualizar el producto: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>
