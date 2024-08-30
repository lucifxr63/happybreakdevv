<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/styles/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <script src="../assets/js/Static_Header_Footer.js"></script>
    <link rel="stylesheet" href="../assets/styles/_footer.css">
</head>

<body>
    <header>
    </header>
    <div class="content">
        <section class="profile">
            <h1>Información Personal</h1>
            <p>Nombre: <?php echo $_SESSION['user_name']; ?></p>
            <p>Correo: <?php echo $_SESSION['user_email']; ?></p>
        </section>
        <section class="info">
            <h2>Actualizar Información</h2>
            <form action="update_profile.php" method="post">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" value="<?php echo $_SESSION['user_name']; ?>" required>

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['user_email']; ?>" required>

                <label for="phone">Teléfono:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="address">Dirección:</label>
                <input type="text" id="address" name="address" required>

                <label for="city">Ciudad:</label>
                <input type="text" id="city" name="city" required>

                <label for="state">Estado:</label>
                <input type="text" id="state" name="state" required>

                <label for="zip">Código Postal:</label>
                <input type="text" id="zip" name="zip" required>

                <label for="country">País:</label>
                <input type="text" id="country" name="country" required>

                <input type="submit" value="Actualizar">
            </form>
        </section>
    </div>
    <footer class="footer"></footer>
</body>

</html>