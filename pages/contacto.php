<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <title>Historial</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="../assets/js/Static_Header_Footer.js"></script>
</head>

<body>
    <header>
        <!-- Aquí iría el contenido del header -->
    </header>

    <main>
        <section class="customer-service">
            <h1>Atención al Cliente</h1>
            <p>Bienvenido a la sección de Atención al Cliente de Happy Break Coffee. Nos esforzamos por brindar un servicio excepcional y estamos aquí para ayudarle con cualquier consulta o problema que pueda tener.</p>

            <h2>Contacto</h2>
            <p>Para comunicarse con nuestro equipo de atención al cliente, puede utilizar el siguiente formulario:</p>

            <form action="enviar_formulario.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br><br>

                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono"><br><br>

                <label for="mensaje">Mensaje:</label><br>
                <textarea id="mensaje" name="mensaje" rows="4" required></textarea><br><br>

                <button type="submit">Enviar Mensaje</button>
            </form>

            
    </main>


    <footer class="footer"></footer>

</body>

</html>