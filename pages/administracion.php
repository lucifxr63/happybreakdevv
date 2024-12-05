<?php
session_start();
$rol_id = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 0; // Obtener el rol del usuario desde la sesión
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <title>Gestión de Usuarios</title>
    <script src="../assets/js/Static_Header_Footer.js"></script>
</head>

<body>
    <header>
    </header>

    <div class="container-lista-usuarios" style="margin-top: 100px;">
        <div class="titulo-lista-usuarios">Lista de Usuarios</div>
        <table id="usuariosTable" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
        </table>
    </div>

    <footer class="footer"></footer>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#usuariosTable').DataTable({
                "ajax": '../pages/backend/Administracion/listar_usuarios.php', // Cambia esto a la ruta de tu archivo PHP
                "columns": [{
                        "data": "ID_Usuarios"
                    },
                    {
                        "data": "Usuario"
                    },
                    {
                        "data": "Correo"
                    },
                    {
                        "data": "Rol_ID", // Aquí aseguramos que es Rol_ID
                        "render": function(data, type, row) {
                            return '<select class="form-control rol-select" data-id="' + row.ID_Usuarios + '">' +
                                '<option value="0"' + (data == "0" ? " selected" : "") + '>Cliente</option>' +
                                '<option value="1"' + (data == "1" ? " selected" : "") + '>Empleado</option>' +
                                '<option value="2"' + (data == "2" ? " selected" : "") + '>Invitado</option>' +
                                '<option value="3"' + (data == "3" ? " selected" : "") + '>Mantenedor</option>' +
                                '</select>';
                        }
                    },
                    {
                        "data": "Estado"
                    },
                    {
                        "data": null,
                        "render": function(data, type, row) {
                            return '<button class="btn btn-primary edit-btn" data-id="' + row.ID_Usuarios + '">Editar</button> <button class="btn btn-danger delete-btn" data-id="' + row.ID_Usuarios + '">Eliminar</button>';
                        }
                    }
                ]

            });

            // Manejo del cambio de rol
            $('#usuariosTable').on('change', '.rol-select', function() {
                var id = $(this).data('id');
                var nuevoRol = $(this).val();

                // Enviar solicitud AJAX para actualizar el rol
                $.ajax({
                    url: '../pages/backend/Administracion/actualizar_usuarios.php', // Cambia esto a la ruta de tu script PHP de actualización
                    type: 'POST',
                    data: {
                        ID_Usuarios: id,
                        Rol: nuevoRol
                    },
                    success: function(response) {
                        alert('Rol actualizado correctamente');
                        table.ajax.reload(); // Recargar la tabla para reflejar los cambios
                    },
                    error: function() {
                        alert('Error al actualizar el rol');
                    }
                });
            });

            // Manejo de la edición y eliminación de usuarios
            $('#usuariosTable').on('click', '.edit-btn', function() {
                var id = $(this).data('id');
                // Aquí puedes redirigir a una página de edición o abrir un modal con la información
            });

            $('#usuariosTable').on('click', '.delete-btn', function() {
                var id = $(this).data('id');
                if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
                    // Aquí harías una solicitud AJAX para eliminar el usuario
                    $.ajax({
                        url: '../pages/backend/Administracion/eliminar_usuarios.php', // Cambia esto a la ruta de tu script de eliminación
                        type: 'POST',
                        data: {
                            ID_Usuarios: id
                        },
                        success: function(response) {
                            alert('Usuario eliminado correctamente');
                            table.ajax.reload(); // Recargar la tabla para reflejar los cambios
                        },
                        error: function() {
                            alert('Error al eliminar el usuario');
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>