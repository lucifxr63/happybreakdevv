<?php session_start(); ?>
<a href="index.php" class="logo">
    <img src="../assets/images/logooriginal.png" alt="">
</a>
<!-- Menu-Icon -->
<i class="bx bx-menu" id="menu-icon"></i>
<!-- Links -->
<ul class="navbar">
    <li><a href="index.php">Inicio</a></li>
    <li><a href="about.php">Sobre Nosotros</a></li>
    <li><a href="tienda.php">Productos</a></li>
    <li><a href="contacto.php">contacto</a></li>
    <li><a href="customers.php">Opiniones</a></li>
</ul>
<!-- Icon -->
<div class="header-icon">
    <i class="bx bx-cart-alt" id="cart-icon"></i>
    <i class="bx bx-search" id="search-icon"></i>
    <i class="bx bx-user-circle" id="user-icon" onclick="toggleMenu()"></i>
    <div class="dropdown-menu" id="dropdown-menu">
        <?php if (isset($_SESSION['user_id'])) : ?>
            <a href="perfil.php">Información Personal</a>
            <a href="historial.php">Historial</a>
            <a id="logout" href="../pages/backend/Login/logout.php">Cerrar sesión</a>
        <?php else : ?>
            <a href="login.php">Iniciar sesión</a>
        <?php endif; ?>
    </div>
</div>
<!-- Search Box -->
<div class="search-box">
    <input type="search" name="" id="" placeholder="Buscar aqui...">
</div>
