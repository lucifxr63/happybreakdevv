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
            <div class="home-img">
                <img src="../assets/images/main.png" alt="">
            </div>
        </section>

        <!-- Sobre nosotros -->
        <section class="about">
            <div class="about-img">
                <img src="../assets/images/Nosotros/Staff (1).JPG" alt="">
            </div>
            <div class="about-text">
                <h2>Nosotros!</h2>
                <p>Tu cafeteria de confianza!.</p>
                <p>Tu cafeteria de confianza!.</p>
                <p>Tu cafeteria de confianza!.</p>
                <a href="#" class="btn">Saber mas..</a>
            </div>
        </section>

        <!-- productos -->
        <section class="products">
            <div class="heading">
                <h2>Productos populares:</h2>
            </div>
            <!-- Container -->
            <div class="products-container">
                <div class="box">
                    <img src="../assets/images/p1.png" alt="">
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <a href="#">Agregar al carro</a>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p2.png" alt="">
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <a href="#">Agregar al carro</a>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p3.png" alt="">
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <a href="#">Agregar al carro</a>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p4.png" alt="">
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <a href="#">Agregar al carro</a>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p5.png" alt="">
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <a href="#">Agregar al carro</a>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p6.png" alt="">
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <a href="#">Agregar al carro</a>
                    </div>
                </div>
            </div>
            <!-- Botón Ver más -->
            <div class="view-more-container">
                <a href="../pages/tienda.php" class="view-more-btn">Ver más</a>
            </div>
        </section>

        <!-- Customers -->
        <section class="customers">
            <div class="heading">
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
                    <p>¡Perfecto para empezar el día! Happy Break Coffee tiene el mejor café que he probado en la ciudad. El ambiente es tranquilo y acogedor, ideal para trabajar o relajarse. Además, el personal siempre tiene una sonrisa y sabe exactamente cómo prepararte el café perfecto. ¡Recomendadísimo!</p>
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
                    <p>Muy rico el cafe y tambien como se tiran a mi mujer</p>
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
