<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos de Caja</title>
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/Static_Header_Footer.js"></script>
    <script>
        $(document).ready(function () {
            // Hacer la petición AJAX al backend
            $.ajax({
                url: './backend/Caja/fetch_pedidos.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    let tbody = $('#pedidosTable tbody');
                    data.forEach(function (pedido) {
                        let row = `
                            <tr>
                                <td>
                                    <button onclick="editarPedido(${pedido.ID_Pedido}, '${pedido.Post_Indicaciones}')">Editar</button>
                                    <button onclick="eliminarPedido(${pedido.ID_Pedido})">Eliminar</button>
                                    <button onclick="aprobarPedido(${pedido.ID_Pedido})">Aprobar</button>
                                    <button onclick="generarRecibo(${pedido.ID_Pedido}, '${pedido.producto_nombre}', '${pedido.producto_precio}', '${pedido.producto_cantidad}', '${pedido.Fecha_ingreso}', '${pedido.Total_A_Pagar}')">Generar Recibo</button>
                                </td>
                                <td>${pedido.ID_Pedido}</td>
                                <td>${pedido.producto_nombre}</td>
                                <td>${pedido.producto_precio}</td>
                                <td>${pedido.producto_cantidad}</td>
                                <td>${pedido.Fecha_ingreso}</td>
                                <td>${pedido.Estado_pedido}</td>
                                <td>${pedido.Usuario_realizador}</td>
                                <td>${pedido.Total_A_Pagar}</td>
                                <td>${pedido.Post_Indicaciones}</td>
                            </tr>
                        `;
                        tbody.append(row);
                    });

                    // Inicializar DataTable
                    $('#pedidosTable').DataTable();
                },
                error: function (err) {
                    console.log("Error al obtener los datos: ", err);
                }
            });
        });

        function generarRecibo(id, nombre, precio, cantidad, fechaIngreso, totalPagar) {
            // Mostrar el modal
            $('#reciboModal').show();
            // Asignar los valores del pedido a los campos de sólo lectura
            $('#reciboProductoNombre').val(nombre);
            $('#reciboProductoPrecio').val(precio);
            $('#reciboProductoCantidad').val(cantidad);
            $('#reciboFechaIngreso').val(fechaIngreso);
            $('#reciboTotalAPagar').val(totalPagar);
        }

        function cerrarReciboModal() {
            $('#reciboModal').hide();
        }

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
                window.location.href = '../backend/eliminar_pedido.php?id=' + id;
            }
        }

        function aprobarPedido(id) {
            if (confirm("¿Estás seguro de que deseas aprobar el pedido " + id + "?")) {
                $.ajax({
                    url: './backend/Caja/aprobar_pedido.php',
                    method: 'POST',
                    data: { id_pedido: id },
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === "success") {
                            alert("Pedido aprobado exitosamente.");
                            location.reload(); // Recargar la página para actualizar el estado del pedido
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function (err) {
                        alert("Error al aprobar el pedido.");
                        console.log(err);
                    }
                });
            }
        }

        function toggleMenu() {
            var dropdownMenu = document.getElementById("dropdown-menu");
            dropdownMenu.classList.toggle("show");
        }

        // Cerrar el menú desplegable si el usuario hace clic fuera de él
        window.onclick = function (event) {
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
    <style>
        /* Estilos para el modal de edición */
        #editModal, #reciboModal {
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

        #editModalContent, #reciboModalContent {
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
        <a href="index.php" class="logo">
            <img src="../assets/images/logo.png" alt="Logo">
        </a>
        <i class="bx bx-menu" id="menu-icon"></i>
        <ul class="navbar">
            <li><a href="index.php">Inicio</a></li>
            <li><a href="about.php">Sobre Nosotros</a></li>
            <li><a href="tienda.php">Productos</a></li>
            <li><a href="customers.php">Opiniones</a></li>
        </ul>
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
        <div class="search-box">
            <input type="search" name="" id="" placeholder="Buscar aqui...">
        </div>
    </header>

    <h1>Historial de Pedidos de Caja</h1>
    <div class="container">
        <table id="pedidosTable" class="display">
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
                <!-- Los datos se llenan dinámicamente con JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal de Recibo -->
    <div id="reciboModal" class="modal">
        <div id="reciboModalContent">
            <span class="close" onclick="cerrarReciboModal()">&times;</span>
            <h2>Recibo de Compra</h2>
            <form>
                <p>Producto Nombre: <input type="text" id="reciboProductoNombre" readonly></p>
                <p>Producto Precio: <input type="text" id="reciboProductoPrecio" readonly></p>
                <p>Producto Cantidad: <input type="text" id="reciboProductoCantidad" readonly></p>
                <p>Fecha de Ingreso: <input type="text" id="reciboFechaIngreso" readonly></p>
                <p>Total a Pagar: <input type="text" id="reciboTotalAPagar" readonly></p>
                <button type="button" onclick="cerrarReciboModal()">Cerrar</button>
            </form>
        </div>
    </div>

    <footer class="footer"></footer>
</body>

</html>
