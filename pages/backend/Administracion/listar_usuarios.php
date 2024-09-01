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

// Consulta para obtener los usuarios
$sql = "SELECT ID_Usuarios, Usuario, Correo, Rol_ID, Estado FROM usuarios"; // Aquí se cambió Rol por Rol_ID
$result = $conn->query($sql);

$usuarios = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
}

// Devolver los datos en formato JSON
echo json_encode(array("data" => $usuarios));

$conn->close();
?>
