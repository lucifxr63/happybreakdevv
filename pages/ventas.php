<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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

// Obtener todos los pedidos con estado "entregado"
$sql = "SELECT * FROM pedido WHERE Estado_pedido = 'entregado'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$ventas_entregadas = [];
while ($row = $result->fetch_assoc()) {
    $productos = json_decode($row['productos'], true);
    foreach ($productos as $producto) {
        $row['producto_id'] = $producto['id'];
        $row['producto_nombre'] = $producto['name'];
        $row['producto_precio'] = $producto['price'];
        $row['producto_cantidad'] = $producto['quantity'];
        $ventas_entregadas[] = $row;
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Boleta - Ventas Entregadas</title>
    <script src="../assets/js/Static_Header_Footer.js"></script>
</head>

<body>
    <header>
        <!-- Aquí iría el contenido del header -->
    </header>

    <div class="container" style="margin-top: 100px;">
        <h1>Boleta - Ventas Entregadas</h1>
        <table id="ventasTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventas_entregadas as $venta) : ?>
                    <tr>
                        <td><?php echo htmlspecialchars($venta['ID_Pedido']); ?></td>
                        <td><?php echo htmlspecialchars($venta['producto_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($venta['producto_precio']); ?></td>
                        <td><?php echo htmlspecialchars($venta['producto_cantidad']); ?></td>
                        <td><?php echo htmlspecialchars($venta['producto_precio'] * $venta['producto_cantidad']); ?></td>
                        <td><?php echo htmlspecialchars($venta['Fecha_ingreso']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p>Generado el <?php echo date('Y-m-d H:i:s'); ?></p>
    </div>

    <footer class="footer"></footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ventasTable').DataTable();
        });
    </script>
</body>

</html>
