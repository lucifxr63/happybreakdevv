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

$user_id = $_SESSION['user_id'];

// Obtener el historial de compras del usuario
$sql = "SELECT * FROM pedido WHERE Usuario_realizador = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
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

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/Static_Header_Footer.js"></script>
    <script>
        $(document).ready(function() {
            $('#historialTable').DataTable();
        });

        function editarPedido(id, indicaciones) {
            $('#editModal').show();
            $('#editPedidoId').val(id);
            $('#editPostIndicaciones').val(indicaciones);
        }

        function cerrarModal() {
            $('#editModal').hide();
        }
    </script>
    <style>
        /* Estilos para el modal de edición */
        #editModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        #editModalContent {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .dataTables_wrapper {
            position: relative;
            clear: both;
            margin-top: 256px;
        }
    </style>
</head>

<body>
    <header>
        <a href="./index.php" class="logo">
            <img src="../assets/images/logo.png" alt="">
        </a>
        <!-- Menu-Icon -->
        <i class="bx bx-menu" id="menu-icon"></i>
        <!-- Links -->
        <ul class="navbar">
            <li><a href="./index.php">Inicio</a></li>
            <li><a href="about.php">Sobre Nosotros</a></li>
            <li><a href="tienda.php">Productos</a></li>
            <li><a href="customers.php">Opiniones</a></li>
        </ul>
        <!-- Icon -->
        <div class="header-icon">
            <i class="bx bx-cart-alt"></i>
            <i class="bx bx-search" id="search-icon"></i>
            <i class="bx bx-user-circle" id="user-icon" onclick="toggleMenu()"></i>
            <div class="dropdown-menu" id="dropdown-menu">
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <a href="perfil.php">Información Personal</a>
                    <a href="historial.php">Historial</a>
                    <a href="../backend/Login/logout.php">Cerrar sesión</a>
                <?php else : ?>
                    <a href="login.php">Iniciar sesión</a>
                <?php endif; ?>
            </div>
        </div>
        <!-- Search Box -->
        <div class="search-box">
            <input type="search" name="" id="" placeholder="Buscar aqui...">
        </div>
    </header>
    <h1>Historial de Compras</h1>
    <div class="container">
        <table id="historialTable" class="display">
            <thead>
                <tr>
                    <th>Acciones</th>
                    <th>ID_Pedido</th>
                    <th>Producto Nombre</th>
                    <th>Producto Precio</th>
                    <th>Producto Cantidad</th>
                    <th>Fecha_ingreso</th>
                    <th>Estado_pedido</th>
                    <th>Usuario_realizador</th>
                    <th>Total_A_Pagar</th>
                    <th>Post_Indicaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historial as $pedido) : ?>
                    <tr>
                        <td>
                            <button onclick="editarPedido(<?php echo $pedido['ID_Pedido']; ?>, '<?php echo htmlspecialchars($pedido['Post_Indicaciones']); ?>')">Editar</button>
                            <button onclick="eliminarPedido(<?php echo $pedido['ID_Pedido']; ?>)">Eliminar</button>
                        </td>
                        <td><?php echo htmlspecialchars($pedido['ID_Pedido']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['producto_nombre']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['producto_precio']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['producto_cantidad']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Fecha_ingreso']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Estado_pedido']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Usuario_realizador']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Total_A_Pagar']); ?></td>
                        <td><?php echo htmlspecialchars($pedido['Post_Indicaciones']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal de Edición -->
    <div id="editModal" class="modal">
        <div id="editModalContent">
            <span class="close" onclick="cerrarModal()">&times;</span>
            <h2>Editar Pedido</h2>
            <form id="editForm" action="editar_pedido.php" method="POST">
                <input type="hidden" name="id_pedido" id="editPedidoId">
                <p>Post Indicaciones: <input type="text" name="post_indicaciones" id="editPostIndicaciones" required></p>
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <footer class="footer"></footer>
    <script>
        function editarPedido(id, indicaciones) {
            $('#editModal').show();
            $('#editPedidoId').val(id);
            $('#editPostIndicaciones').val(indicaciones);
        }

        function cerrarModal() {
            $('#editModal').hide();
        }

        function eliminarPedido(id) {
            if (confirm("¿Estás seguro de que deseas eliminar el pedido " + id + "?")) {
                // Lógica para eliminar el pedido
                window.location.href = 'eliminar_pedido.php?id=' + id;
            }
        }
    </script>
    <script>
        function toggleMenu() {
            var dropdownMenu = document.getElementById("dropdown-menu");
            dropdownMenu.classList.toggle("show");
        }

        // Cerrar el menú desplegable si el usuario hace clic fuera de él
        window.onclick = function(event) {
            if (!event.target.matches('#user-icon')) {
                var dropdowns = document.getElementsByClassName("dropdown-menu");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>

</html>