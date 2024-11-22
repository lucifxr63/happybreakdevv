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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>

<body>
<header>
        <a href="index.php" class="logo">
            <img src="../assets/images/logo.png" alt="">
        </a>
        <!-- Menu-Icon -->
        <i class="bx bx-menu" id="menu-icon"></i>
        <!-- Links -->
        <ul class="navbar">
            <li><a href="index.php">Inicio</a></li>
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
    <section class="home" id="home">
        <div class="home-text">
            <h1>Empieza tu dia <br> con un cafe!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident</p>
            <a href="#" class="btn">Compra ahora</a>
        </div>
        <div class="home-img">
            <img src="../assets/images/main.png" alt="">
        </div>
    </section>

</body>

</html>