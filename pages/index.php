<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Happy Break Coffee</title>
    <!-- link de estilos-->
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <link rel="shortcut icon" href="../assets/images/caffeelogo.svg" type="image/x-icon"/>
    <script src="../assets/js/Static_Header_Footer.js"></script>
    <!-- link de iconos-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <header></header>
    <container class="dynamic-content">
        <!-- Home -->
        <section class="home">
            <div class="home-text">
                <h1>Empieza tu dia <br> con un cafe!</h1>
                <p> Tu cafeteria de confianza </p>
                <a href="tienda.php" class="btn">Compra Aqui ! </a>
            </div>
            <div class="img img-home">
                <img src="../assets/images/mainlogo.jpg" alt="">
            </div>
        </section>

        <!-- Sobre nosotros -->
        <section class="about">
            <div class="about-img">
                <img class="imagen-index" src="../assets/images/Nosotros/Staff (1).JPG" alt="">
            </div>
            <div class="about-text">
                <div class="about-tittle">Nosotros!</div>
                <p>En Happy Break Coffee, convertimos cada pausa en un momento especial. Disfruta de café de calidad, buen ambiente y calidez en cada visita. ¡Tu break más feliz está aquí! ☕</p>
                <p>Mas de 5 años alegrando tu mañana.</p>
                <a href="about.php" class="btn about-button">Saber mas..</a>
            </div>
        </section>

        <!-- Customers -->
        <section class="customers">
            <div class="clientes-index">
                <h2>Nuestros Clientes:</h2>
            </div>
            <!-- MTW XDDDD Reviews usuarios -->
            <div class="customers-container">
                <div class="box">
                    <div class="stars">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star-half"></i>
                    </div>
                    <p>Muy rico el cafe</p>
                    <h2>Matias Muñoz</h2>
                    <img src="../assets/images/rev1.jpg" alt="">
                </div>
                <div class="box">
                    <div class="stars">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star-half"></i>
                    </div>
                    <p>Muy rico el cafe le encanto a mi mujer</p>
                    <h2>Juan Garnizo</h2>
                    <img src="../assets/images/rev2.jpg" alt="">
                </div>
                <div class="box">
                    <div class="stars">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bx-star"></i>
                        <i class="bx bx-star"></i>
                        
                    </div>
                    <p>Buen cafe!</p>
                    <h2>Rosa Ramirez</h2>
                    <img src="../assets/images/rev2.jpg" alt="">
                </div>
                <div class="box">
                    <div class="stars">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bx-star"></i>
                        <i class="bx bx-star"></i>
                        
                    </div>
                    <p>Buen cafe!</p>
                    <h2>Rosa Ramirez</h2>
                    <img src="../assets/images/rev3.jpg" alt="">
                </div>
            </div>
        </section>
    </container>
    <footer class="footer"></footer>
    
    <script>
       
    </script>
</body>

</html>
