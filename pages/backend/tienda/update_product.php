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

// Validar campos obligatorios
if (!isset($_POST['id'], $_POST['nombre'], $_POST['precio'], $_POST['categoria'], $_POST['fecha_compra'], $_POST['fecha_expiracion'], $_POST['stock'], $_POST['proveedor'], $_POST['pais_origen'])) {
    echo json_encode(array("status" => "error", "message" => "Faltan datos obligatorios"));
    exit();
}

// Capturar y sanitizar los datos
$id = (int)$_POST['id'];
$nombre = trim($_POST['nombre']);
$precio = (float)$_POST['precio'];
$categoria = trim($_POST['categoria']);
$fecha_compra = trim($_POST['fecha_compra']);
$fecha_expiracion = trim($_POST['fecha_expiracion']);
$stock = (int)$_POST['stock'];
$imagen = isset($_POST['imagen']) ? trim($_POST['imagen']) : null;
$proveedor = trim($_POST['proveedor']);
$pais_origen = trim($_POST['pais_origen']);
$lactosa = isset($_POST['lactosa']) ? 1 : 0;
$gluten = isset($_POST['gluten']) ? 1 : 0;
$descripcion_producto = isset($_POST['descripcion_producto']) ? trim($_POST['descripcion_producto']) : null;
$contador = isset($_POST['contador']) ? (int)$_POST['contador'] : 0;
$comentarios = isset($_POST['comentarios']) ? trim($_POST['comentarios']) : null;

// Validar fechas
if (!strtotime($fecha_compra) || !strtotime($fecha_expiracion)) {
    echo json_encode(array("status" => "error", "message" => "Formato de fecha inválido"));
    exit();
}

// Validar que el producto existe
$result = $conn->query("SELECT ID_Productos FROM productos WHERE ID_Productos = $id");
if ($result->num_rows === 0) {
    echo json_encode(array("status" => "error", "message" => "El producto con ID $id no existe"));
    exit();
}

// Preparar la declaración SQL
$sql = "UPDATE productos SET 
            Nombre = ?, 
            Precio = ?, 
            Categoria = ?, 
            Fecha_de_compra = ?, 
            Fecha_de_EX = ?, 
            Stock = ?, 
            Imagen = ?, 
            Proveedor = ?, 
            Pais_origen = ?, 
            Lactosa = ?, 
            Gluten = ?, 
            Descripcion_Producto = ?, 
            Contador = ?, 
            Comentarios = ? 
        WHERE ID_Productos = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    error_log("Error al preparar la consulta: " . $conn->error);
    echo json_encode(array("status" => "error", "message" => "Error al preparar la consulta"));
    exit();
}

// Vincular parámetros
$stmt->bind_param(
    "sdsssisssiisisi", 
    $nombre, 
    $precio, 
    $categoria, 
    $fecha_compra, 
    $fecha_expiracion, 
    $stock, 
    $imagen, 
    $proveedor, 
    $pais_origen, 
    $lactosa, 
    $gluten, 
    $descripcion_producto, 
    $contador, 
    $comentarios, 
    $id
);

// Ejecutar la declaración
if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Producto actualizado exitosamente"));
} else {
    error_log("Error al ejecutar la consulta: " . $stmt->error);
    echo json_encode(array("status" => "error", "message" => "Error al actualizar el producto: " . $stmt->error));
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>
