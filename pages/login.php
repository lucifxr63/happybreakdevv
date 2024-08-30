<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sitio web Responsivo Caffe</title>
    <!-- link de estilos-->
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/login.css">
    
    <!-- link de iconos-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="../assets/js/Static_Header_Footer.js"></script>
</head>

<body>
    <header>
    </header>

    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="./backend/Login/registro.php" method="POST">
                <h1>Crea Tu Cuenta!</h1>
                <span>Usa tu Correo Electronico Aqui!</span>
                <input type="text" name="nombre" placeholder="Nombre completo" required />
                <input type="text" name="usuario" placeholder="Usuario" required />
                <input type="email" name="correo" placeholder="Email" required />
                <input type="password" name="contrasena" placeholder="Contraseña" required />
                <button type="submit">Crear</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="./backend/Login/login.php" method="POST">
                <h1>Inicia Sesion Aqui!</h1>
                <span>Usa tu cuenta</span>
                <input type="email" name="correo" placeholder="Email" required />
                <input type="password" name="contrasena" placeholder="Contraseña" required />
                <a href="#">Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar Sesion</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Bienvenido devuelta!</h1>
                    <p>Para permanecer conectado con nosotras, inicia tu sesion!</p>
                    <button class="ghost" id="signIn">Iniciar Sesion</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hola, Amigo!</h1>
                    <p>Ingresa tus datos para crear tu cuenta!</p>
                    <button class="ghost" id="signUp">Crear Cuenta</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const container = document.getElementById('container');

    signUpButton.addEventListener('click', () => {
        container.classList.add("right-panel-active");
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove("right-panel-active");
    });
</script>
</html>
