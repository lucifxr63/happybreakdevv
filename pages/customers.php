<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deja tu Opinión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons CSS -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <script src="../assets/js/Static_Header_Footer.js"></script>
</head>

<body>
    <header>
        <!-- Tu header aquí -->
    </header>
    <section class="opinion container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Deja tu Opinión:</h2>
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#opinionModal">
                Dejar Opinión
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="opinionModal" tabindex="-1" aria-labelledby="opinionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="opinionForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="opinionModalLabel">Deja tu Opinión</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-3">
                                <label for="opinion" class="form-label">Opinión:</label>
                                <textarea name="opinion" id="opinion" rows="4" class="form-control" required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="calificacion" class="form-label">Calificación:</label>
                                <select name="calificacion" id="calificacion" class="form-select" required>
                                    <option value="" disabled selected>Selecciona una calificación</option>
                                    <option value="1">1 estrella</option>
                                    <option value="2">2 estrellas</option>
                                    <option value="3">3 estrellas</option>
                                    <option value="4">4 estrellas</option>
                                    <option value="5">5 estrellas</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Enviar Opinión</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sección para mostrar las opiniones existentes -->
        <div class="opiniones mt-4">
            <h2>Opiniones de otros clientes:</h2>
            <div id="opinionesContainer" class="customers-container"></div> <!-- Aquí se cargarán las opiniones -->
        </div>
    </section>
    <footer class="footer"></footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS (incluye Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script -->
    <script>
        let userRoleId = 0; // Inicialmente define userRoleId
        let userRole = ""; // Inicialmente define userRole

        // Fetch para obtener los datos del usuario actual
        fetch('../pages/backend/Opiniones/Fetch_user.php')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    userRoleId = data.user.Rol_ID;
                    userRole = data.user.Rol;

                    // Mostrar botones de eliminar solo si el usuario es Mantenedor
                    if (userRoleId === 3 || userRole === "Mantenedor") {
                        document.querySelectorAll('.btn-delete-opinion').forEach(btn => btn.style.display = 'inline-block');
                    }
                } else {
                    console.error('Error fetching user:', data.message);
                }
            })
            .catch(error => console.error('Error:', error));


        function loadOpinions() {
            $.ajax({
                url: '../pages/backend/Opiniones/OpinionFetch.php',
                type: 'GET',
                success: function(data) {
                    let opinionsContainer = $("#opinionesContainer");
                    opinionsContainer.html(data); // Cargar opiniones en el contenedor

                    // Agregar botones de eliminación en el frontend
                    $('.opinion-box').each(function() {
                        let opinionId = $(this).data('id');
                        let deleteBtn = $('<button>')
                            .addClass('btn-delete-opinion')
                            .css({
                                'position': 'absolute',
                                'top': '10px',
                                'right': '10px',
                                'display': 'none' // Ocultar por defecto
                            })
                            .text('X')
                            .click(function() {
                                deleteOpinion(opinionId);
                            });

                        $(this).append(deleteBtn);
                    });

                    // Mostrar los botones de eliminar solo si el usuario es Mantenedor
                    if (userRoleId === 3 || userRole === "Mantenedor") {
                        $('.btn-delete-opinion').show();
                    }
                },
                error: function(error) {
                    console.error('Error al cargar las opiniones:', error);
                    $("#opinionesContainer").html("<p>Error al cargar las opiniones.</p>");
                }
            });
        }
        $(document).ready(function() {
            // Función para cargar opiniones desde el backend


            // Cargar opiniones cuando la página se carga por primera vez
            loadOpinions();

            // AJAX para enviar la opinión sin recargar la página
            $("#opinionForm").on("submit", function(e) {
                e.preventDefault(); // Previene el comportamiento por defecto del formulario

                $.ajax({
                    url: '../pages/backend/Opiniones/OpinionADD.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.trim() === "success") {
                            // Cerrar el modal
                            var opinionModal = bootstrap.Modal.getInstance(document.getElementById('opinionModal'));
                            opinionModal.hide();

                            // Limpiar el formulario
                            $("#opinionForm")[0].reset();

                            // Notificar al usuario
                            alert('¡Gracias por tu opinión!');

                            // Recargar las opiniones
                            loadOpinions();
                        } else {
                            // Manejar errores específicos
                            alert('Error: ' + response);
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        alert('Hubo un problema al enviar tu opinión.');
                    }
                });
            });
        });

        // Función para eliminar una opinión
        function deleteOpinion(opinionId) {
            if (confirm("¿Estás seguro de que quieres eliminar esta opinión?")) {
                $.ajax({
                    url: '../pages/backend/Opiniones/OpinionDelete.php',
                    type: 'POST',
                    data: {
                        id: opinionId
                    },
                    success: function(response) {
                        if (response.trim() === "success") {
                            alert('Opinión eliminada exitosamente.');
                            loadOpinions(); // Recargar opiniones
                        } else {
                            alert('Error al eliminar la opinión.');
                        }
                    },
                    error: function(error) {
                        console.error('Error:', error);
                        alert('Hubo un problema al eliminar la opinión.');
                    }
                });
            }
        }
    </script>
</body>

</html>