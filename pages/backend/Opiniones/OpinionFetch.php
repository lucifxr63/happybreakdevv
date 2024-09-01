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

// Consulta actualizada con el nombre correcto de la columna
$sql = "SELECT o.ID_Opinion, o.Opinion, o.Calificacion, u.Nombre
        FROM opiniones o
        JOIN usuarios u ON o.ID_Usuario = u.ID_Usuarios
        ORDER BY o.Fecha DESC";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='opinion-box' data-id='{$row['ID_Opinion']}' style='position: relative; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px;'>";
        echo "<div class='stars'>";
        for ($i = 0; $i < $row['Calificacion']; $i++) {
            echo "<i class='bx bxs-star'></i>";
        }
        echo "</div>";
        echo "<p>{$row['Opinion']}</p>";
        echo "<h5>{$row['Nombre']}</h5>";
        echo "</div>";
    }
} else {
    echo "<p>No hay opiniones aún.</p>";
}

$conn->close();
?>
