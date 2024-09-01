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
    <title>Historial</title>
    <script src="../assets/js/Static_Header_Footer.js"></script>
</head>


<body>
    <header>

    </header>
    <section class="about" id="about">
        <div class="about-img">
            <img src="../assets/images/about.jpg" alt="">
        </div>
        <div class="about-text">
            <h2>Nosotros!</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis aliquid accusantium.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis aliquid accusantium.</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis aliquid accusantium.</p>
            <a href="#" class="btn">Saber mas..</a>
        </div>
    </section>
    <footer class="footer"></footer>

</body>

</html>