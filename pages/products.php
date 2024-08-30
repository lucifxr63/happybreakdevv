<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda</title>
    <!-- link de estilos-->
    <link rel="stylesheet" href="../assets/styles/main.css">
    <!-- link de iconos-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="../assets/js/Static_Header_Footer.js"></script>
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <style>
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            z-index: 1000;
        }

        .cart {
            position: fixed;
            right: -400px;
            top: 0;
            width: 400px;
            height: 100%;
            background-color: white;
            box-shadow: -2px 0 5px rgba(0, 0, 0, 0.5);
            transition: right 0.3s;
            padding: 20px;
            z-index: 1000;
        }

        .cart.open {
            right: 0;
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .cart-header .close-cart {
            font-size: 24px;
            cursor: pointer;
        }

        .cart ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cart li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .cart li .controls {
            display: flex;
            gap: 10px;
        }

        .cart li .controls button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px;
            cursor: pointer;
        }

        .cart-summary {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            margin-top: 10px;
        }

        #checkout {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <!-- Tu código del header -->
    </header>

    <main>
        <!-- Filtros -->
        <section class="filters">
            <div class="filter-group">
                <label for="categories">Filtrado por:</label>
                <select id="categories">
                    <option value="">Categorías</option>
                    <!-- Agregar opciones de categorías aquí -->
                </select>
            </div>
            <div class="filter-group">
                <label for="price-range">Filtrar por precio:</label>
                <input type="range" id="price-range" name="price-range" min="0" max="50" value="50">
                <span>$0 — $50</span>
            </div>
            <div class="filter-group">
                <label for="sort">Ordenar por:</label>
                <select id="sort">
                    <option value="latest">El Último</option>
                    <!-- Agregar más opciones de ordenamiento aquí -->
                </select>
            </div>
            <div class="filter-group">
                <label for="sort">Elementos a mostrar:</label>
                <select id="sort">
                    <option value="latest">10</option>
                    <option value="latest">20</option>
                    <option value="latest">50</option>
                    <option value="latest">Todo</option>
                    <!-- Agregar más opciones de ordenamiento aquí -->
                </select>
            </div>
        </section>

        <!-- Productos -->
        <section class="products" id="products">
            <div class="heading">
                <h2>Productos populares:</h2>
            </div>
            <!-- Container -->
            <div class="products-container">
                <div class="box">
                    <img src="../assets/images/p1.png" alt="">
                    <h3>Americano a</h3>
                    <div class="content">
                        <span>$25</span>
                        <button class="add-to-cart" data-id="1" data-name="Americano a" data-price="25">Agregar al carro</button>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p1.png" alt="">
                    <h3>Americano b</h3>
                    <div class="content">
                        <span>$25</span>
                        <button class="add-to-cart" data-id="2" data-name="Americano b" data-price="25">Agregar al carro</button>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p1.png" alt="">
                    <h3>Americano c</h3>
                    <div class="content">
                        <span>$25</span>
                        <button class="add-to-cart" data-id="3" data-name="Americano c" data-price="25">Agregar al carro</button>
                    </div>
                </div>
                <div class="box">
                    <img src="../assets/images/p1.png" alt="">
                    <h3>Americano d</h3>
                    <div class="content">
                        <span>$25</span>
                        <button class="add-to-cart" data-id="4" data-name="Americano d" data-price="25">Agregar al carro</button>
                    </div>
                </div>
                <!-- Repite para otros productos -->
            </div>
            <!-- Botón Ver más -->
            <div class="view-more-container">
                <a href="../pages/tienda.php" class="view-more-btn">Ver más</a>
            </div>
        </section>

        <!-- Icono del carrito -->
        <div class="cart-icon">
            <i class="bx bx-cart"></i>
        </div>

        <!-- Carrito -->
        <div id="cart" class="cart">
            <div class="cart-header">
                <h2>Carrito de Compras</h2>
                <span class="close-cart" id="close-cart">x</span>
            </div>
            <ul id="cart-items"></ul>
            <div class="cart-summary">
                <p>Total: $<span id="cart-total">0</span></p>
                <button id="checkout">Checkout</button>
            </div>
        </div>
    </main>

    <footer class="footer"></footer>

    <script src="../assets/js/carrito.js"></script>
</body>
<script>
    

</script>
</html>
