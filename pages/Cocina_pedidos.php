<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos de Cocina Aprobados</title>
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/Static_Header_Footer.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar pedidos aprobados
            $.ajax({
                url: './backend/Cocina/fetch_pedidos.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    let tbody = $('#cocinaPedidosTable tbody');
                    data.forEach(function(pedido) {
                        let row = `
                            <tr>
                                <td>${pedido.ID_Pedido}</td>
                                <td>${pedido.producto_nombre}</td>
                                <td>${pedido.producto_cantidad}</td>
                                <td>${pedido.Post_Indicaciones}</td>
                                <td>${pedido.Estado_pedido}</td>
                                <td>
                                    <button onclick="verPedido(${pedido.ID_Pedido}, '${pedido.producto_nombre}', ${pedido.producto_cantidad}, '${pedido.Post_Indicaciones}')">Ver</button>
                                    <button onclick="notificarError(${pedido.ID_Pedido}, '${pedido.producto_nombre}')">Notificar Error</button>
                                    <button onclick="entregarPedido(${pedido.ID_Pedido})">Entregar</button>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });

                    // Inicializar DataTable
                    $('#cocinaPedidosTable').DataTable();
                },
                error: function(err) {
                    console.log("Error al obtener los datos: ", err);
                }
            });
        });

        // Mostrar modal con detalles del pedido
        function verPedido(id, nombre, cantidad, indicaciones) {
            $('#verPedidoModal').show();
            $('#pedidoNombre').text(nombre);
            $('#pedidoCantidad').text(cantidad);
            $('#pedidoIndicaciones').text(indicaciones);
        }

        function cerrarVerPedidoModal() {
            $('#verPedidoModal').hide();
        }

        // Modal para notificar error
        function notificarError(id, nombre) {
            $('#notificarErrorModal').show();
            $('#errorNombreProducto').val(nombre); // Prellenar el nombre del producto
            $('#idPedidoError').val(id); // Guardar el ID del pedido en un campo oculto

            // Prellenar la fecha actual
            let currentDate = new Date().toISOString().split('T')[0]; // Fecha en formato YYYY-MM-DD
            $('#fechaProblema').val(currentDate);
        }


        function cerrarNotificarErrorModal() {
            $('#notificarErrorModal').hide();
        }

        function enviarNotificarError() {
            let id_pedido = $('#idPedidoError').val();
            let nombre_producto = $('#errorNombreProducto').val();
            let descripcion = $('#descripcionProblema').val();
            let fecha = $('#fechaProblema').val();

            $.ajax({
                url: './backend/Cocina/problema_cocina.php',
                method: 'POST',
                data: {
                    id_pedido: id_pedido,
                    nombre_producto: nombre_producto,
                    descripcion: descripcion,
                    fecha: fecha
                },
                success: function(response) {
                    alert('Problema notificado correctamente');
                    $('#notificarErrorModal').hide();
                },
                error: function(err) {
                    alert('Hubo un error al notificar el problema');
                    console.log(err);
                }
            });
        }


        // Cambiar el estado del pedido a "Listo para entregar"
        function entregarPedido(id) {
            if (confirm("¿Estás seguro de que deseas marcar este pedido como listo para entregar?")) {
                $.ajax({
                    url: './backend/Cocina/entregar_pedido.php',
                    method: 'POST',
                    data: {
                        id_pedido: id
                    },
                    success: function(response) {
                        alert("El pedido ha sido marcado como 'Listo para entregar'.");
                        location.reload(); // Recargar la página para reflejar el cambio
                    },
                    error: function(err) {
                        alert("Hubo un error al cambiar el estado del pedido.");
                    }
                });
            }
        }
    </script>
    <style>
        .dataTables_wrapper {
            position: relative;
            clear: both;
            margin-top: 256px;
        }

        /* Estilos para los modales */
        #verPedidoModal,
        #notificarErrorModal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        #verPedidoModalContent,
        #notificarErrorModalContent {
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

    <h1>Pedidos Aprobados para Cocina</h1>
    <div class="container">
        <table id="cocinaPedidosTable" class="display">
            <thead>
                <tr>
                    <th>ID_Pedido</th>
                    <th>Producto Nombre</th>
                    <th>Producto Cantidad</th>
                    <th>Post Indicaciones</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se llenan dinámicamente con JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal para Ver Pedido -->
    <div id="verPedidoModal" class="modal">
        <div id="verPedidoModalContent">
            <span class="close" onclick="cerrarVerPedidoModal()">&times;</span>
            <h2>Detalles del Pedido</h2>
            <p>Nombre del Producto: <span id="pedidoNombre"></span></p>
            <p>Cantidad: <span id="pedidoCantidad"></span></p>
            <p>Post Indicaciones: <span id="pedidoIndicaciones"></span></p>
            <button onclick="cerrarVerPedidoModal()">Cerrar</button>
        </div>
    </div>

    <!-- Modal para Notificar Error -->
    <div id="notificarErrorModal" class="modal">
        <div id="notificarErrorModalContent">
            <span class="close" onclick="cerrarNotificarErrorModal()">&times;</span>
            <h2>Notificar Error en Pedido</h2>
            <form id="formNotificarError">
                <input type="hidden" id="idPedidoError"> <!-- ID del Pedido (oculto) -->
                <p>Nombre del Producto: <input type="text" id="errorNombreProducto" readonly></p> <!-- Nombre prellenado -->
                <p>Descripción del Problema: <input type="text" id="descripcionProblema" required></p> <!-- Descripción del problema -->
                <p>Fecha: <input type="text" id="fechaProblema" readonly></p> <!-- Fecha prellenada -->
                <button type="button" onclick="enviarNotificarError()">Enviar</button>
            </form>
        </div>
    </div>


    <footer class="footer"></footer>
</body>

</html>