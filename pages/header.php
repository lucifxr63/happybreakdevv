<?php
session_start();

// Verificar si existe la clave 'user_role' en la sesión para evitar errores de índice
$rol_id = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 0; // Obtener el rol del usuario desde la sesión o 0 por defecto
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'guest'; // Por defecto 'guest' si no está logueado
?>
<a href="./index.php" class="logo">
    <img src="../assets/images/logooriginal.png" alt="">
</a>
<!-- Menu-Icon -->
<i class="bx bx-menu" id="menu-icon"></i>
<!-- Links -->
<ul class="navbar">
    <li><a href="./index.php">Inicio</a></li>
    <li><a href="about.php">Sobre Nosotros</a></li>
    <li><a href="tienda.php">Productos</a></li>
    <li><a href="contacto.php">Contacto</a></li>
    <li><a href="customers.php">Opiniones</a></li>

    <!-- Verificar si el usuario es cocina (rol_id 2 o 'cocina') -->
    <?php if ($rol_id == 2 || $user_role == 'cocina'): ?>
        <li><a href="Cocina_pedidos.php">Cocina</a></li>
    <?php endif; ?>

    <!-- Verificar si el usuario es caja (rol_id 1 o 'caja') -->
    <?php if ($rol_id == 1 || $user_role == 'caja'): ?>
        <li><a href="Caja_pedidos.php">Caja</a></li>
        <li><a href="ventas.php">Ventas</a></li>
    <?php endif; ?>

    <!-- Verificar si el usuario es mantenedor (rol_id 3 o 'mantenedor') -->
    <?php if ($rol_id == 3 || $user_role == 'mantenedor'): ?>
        <li><a href="administracion.php">Administración</a></li>
        <li><a href="ventas.php">Ventas</a></li>
    <?php endif; ?>
</ul>

<!-- Icon -->
<div class="header-icon">
    <i class="bx bx-cart-alt" id="cart-icon"></i>
    <i class="bx bx-search" id="search-icon"></i>
    <i class="bx bx-user-circle" id="user-icon" onclick="toggleMenu()"></i>
    <div class="dropdown-menu" id="dropdown-menu">
        <!-- Mostrar las opciones del perfil solo si el usuario ha iniciado sesión -->
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
    <input type="search" name="" id="" placeholder="Buscar aquí...">
</div>

<!-- Script para hacer console log de rol_id y user_role -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const rolId = "<?php echo $rol_id; ?>";
        const userRole = "<?php echo $user_role; ?>";

        console.log("Rol ID:", rolId);
        console.log("User Role:", userRole);
    });
</script>
