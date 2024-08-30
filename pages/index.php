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
    <link rel="stylesheet" href="../assets/styles/_footer.css">
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

        <!-- Sobre nosotros -->
        <section class="about">
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
            <!-- Container -->
            <div class="customers-container">
                <div class="box">
                    <div class="stars">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star-half"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis aliquid accusantium.</p>
                    <h2>(Cliente 1)</h2>
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis aliquid accusantium.</p>
                    <h2>(Cliente 2)</h2>
                    <img src="../assets/images/rev2.jpg" alt="">
                </div>
                <div class="box">
                    <div class="stars">
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star"></i>
                        <i class="bx bxs-star-half"></i>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus facilis aliquid accusantium.</p>
                    <h2>(Cliente 3)</h2>
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
