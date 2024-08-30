<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tienda</title>
    <!-- link de estilos-->
    <link rel="stylesheet" href="../assets/styles/main.css">
    <link rel="stylesheet" href="../assets/styles/_footer.css">
    <!-- link de iconos-->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script src="../assets/js/Static_Header_Footer.js"></script>
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
                    <h3>Americano Pure</h3>
                    <div class="content">
                        <span>$25</span>
                        <button class="add-to-cart" data-id="1" data-name="Americano Pure" data-price="25">Agregar al carro</button>
                    </div>
                </div>
                <!-- Repite para otros productos -->
            </div>
            <!-- Botón Ver más -->
            <div class="view-more-container">
                <a href="../pages/tienda.php" class="view-more-btn">Ver más</a>
            </div>
        </section>

        <!-- Carrito -->
        <div id="cart" class="cart">
            <h2>Carrito de Compras</h2>
            <ul id="cart-items"></ul>
            <div class="cart-summary">
                <p>Total: $<span id="cart-total">0</span></p>
                <button id="checkout">Checkout</button>
            </div>
        </div>
    </main>

    <footer>
        <!-- Tu código del footer -->
    </footer>

    <script src="scripts.js"></script>
    
</body>

</html>
