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

$sql = "SELECT p.ID_Productos, p.Nombre, p.Precio, p.Categoria, p.Imagen, 
               IFNULL(AVG(v.Calificacion), 0) as PromedioValoracion,
               IFNULL(o.Precio, p.Precio) AS PrecioOferta,
               (o.ID_Oferta IS NOT NULL) AS EnOferta
        FROM productos p 
        LEFT JOIN valoraciones v ON p.ID_Productos = v.ID_Producto 
        LEFT JOIN ofertas o ON p.ID_Productos = o.Productos
        GROUP BY p.ID_Productos";
$result = $conn->query($sql);

$products = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

echo json_encode(array("status" => "success", "products" => $products));

$conn->close();
?>
