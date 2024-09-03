<?php
session_start();
$rol_id = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 0; // Obtener el rol del usuario desde la sesión
?>
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
        .price {
            color: #fefefe;
        }

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

        /* Estilos para el formulario de administración de productos */
        .product-admin {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .product-admin h2 {
            margin-bottom: 20px;
        }

        .product-admin .form-group {
            margin-bottom: 10px;
        }

        .product-admin .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .product-admin .form-group input,
        .product-admin .form-group textarea,
        .product-admin .form-group button {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }

        .product-admin .form-group button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        .products-container .box {
            border: 1px solid #ddd;
            transition: box-shadow .3s;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }

        .box:hover {
            box-shadow: 0 0 112px rgba(33, 33, 33, .2);
        }

        .products-container .box img {
            max-width: 100%;
            height: auto;

            border-radius: 25px;
        }

        .products-container .box h3 {
            margin: 10px 0;
        }

        .products-container .box .content span {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: white !important;
        }

        .products-container .box .content button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 1px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 2%;
            ;
        }

        /* Estilos para el formulario modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1001;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                <select id="categories" onchange="filterByCategory()">
                    <option value="">Categorías</option>
                    <option value="Café">Café</option>
                    <option value="Repostería">Repostería</option>
                    <option value="Tetería">Tetería</option>
                    <option value="Dulces">Dulces</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="price-range">Filtrar por precio:</label>
                <input type="range" id="price-range" name="price-range" min="0" max="10000" value="5000" oninput="filterByPrice(this.value)">
                <span>$0 — $10000</span>
            </div>
            <div class="filter-group">
                <label for="sort">Ordenar por:</label>
                <select id="sort">
                    <option value="latest">El Último</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="sort">Elementos a mostrar:</label>
                <select id="sort">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="all">Todo</option>
                </select>
            </div>
        </section>

        <section class="products" id="products">
            <!-- Secciones de productos por categoría -->
            <div class="products-container" id="Café">
                <h2>Café</h2>
                <!-- Productos de Café -->
            </div>
            <div class="products-container" id="Repostería">
                <h2>Repostería</h2>
                <!-- Productos de Repostería -->
            </div>
            <div class="products-container" id="Tetería">
                <h2>Tetería</h2>
                <!-- Productos de Tetería -->
            </div>
            <div class="products-container" id="Dulces">
                <h2>Dulces</h2>
                <!-- Productos de Dulces -->
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

        <!-- Formulario de administración de productos -->
        <section class="product-admin" style="display: none;">
            <h2>Agregar Nuevo Producto</h2>
            <form id="product-form">
                <div class="form-group">
                    <label for="product-name">Nombre del Producto</label>
                    <input type="text" id="product-name" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="product-price">Precio del Producto</label>
                    <input type="number" id="product-price" name="precio" required>
                </div>
                <div class="form-group">
                    <label for="product-category">Categoría</label>
                    <input type="text" id="product-category" name="categoria" required>
                </div>
                <div class="form-group">
                    <label for="purchase-date">Fecha de Compra</label>
                    <input type="date" id="purchase-date" name="fecha_compra" required>
                </div>
                <div class="form-group">
                    <label for="expiration-date">Fecha de Expiración</label>
                    <input type="date" id="expiration-date" name="fecha_expiracion" required>
                </div>
                <div class="form-group">
                    <label for="product-stock">Stock</label>
                    <input type="number" id="product-stock" name="stock" required>
                </div>
                <div class="form-group">
                    <label for="product-image">URL de la Imagen del Producto</label>
                    <input type="url" id="product-image" name="imagen">
                </div>
                <div class="form-group">
                    <label for="product-provider">Proveedor</label>
                    <input type="text" id="product-provider" name="proveedor" required>
                </div>
                <div class="form-group">
                    <label for="product-origin">País de Origen</label>
                    <input type="text" id="product-origin" name="pais_origen" required>
                </div>
                <div class="form-group">
                    <label for="lactosa">Lactosa</label>
                    <input type="checkbox" id="lactosa" name="lactosa">
                </div>
                <div class="form-group">
                    <label for="gluten">Gluten</label>
                    <input type="checkbox" id="gluten" name="gluten">
                </div>
                <div class="form-group">
                    <label for="product-description">Descripción del Producto</label>
                    <textarea id="product-description" name="descripcion_producto"></textarea>
                </div>
                <div class="form-group">
                    <label for="contador">Contador</label>
                    <input type="number" id="contador" name="contador" value="0">
                </div>
                <div class="form-group">
                    <label for="comentarios">Comentarios</label>
                    <textarea id="comentarios" name="comentarios"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit">Agregar Producto</button>
                </div>
            </form>
        </section>

        <!-- Modal para editar productos -->
        <div id="editModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Editar Producto</h2>
                <form id="edit-form">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group">
                        <label for="edit-name">Nombre del Producto</label>
                        <input type="text" id="edit-name" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-price">Precio del Producto</label>
                        <input type="number" id="edit-price" name="precio" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-category">Categoría</label>
                        <input type="text" id="edit-category" name="categoria" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-purchase-date">Fecha de Compra</label>
                        <input type="date" id="edit-purchase-date" name="fecha_compra" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-expiration-date">Fecha de Expiración</label>
                        <input type="date" id="edit-expiration-date" name="fecha_expiracion" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-stock">Stock</label>
                        <input type="number" id="edit-stock" name="stock" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-image">URL de la Imagen del Producto</label>
                        <input type="url" id="edit-image" name="imagen">
                    </div>
                    <div class="form-group">
                        <label for="edit-provider">Proveedor</label>
                        <input type="text" id="edit-provider" name="proveedor" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-origin">País de Origen</label>
                        <input type="text" id="edit-origin" name="pais_origen" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-lactosa">Lactosa</label>
                        <input type="checkbox" id="edit-lactosa" name="lactosa">
                    </div>
                    <div class="form-group">
                        <label for="edit-gluten">Gluten</label>
                        <input type="checkbox" id="edit-gluten" name="gluten">
                    </div>
                    <div class="form-group">
                        <label for="edit-description">Descripción del Producto</label>
                        <textarea id="edit-description" name="descripcion_producto"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-contador">Contador</label>
                        <input type="number" id="edit-contador" name="contador">
                    </div>
                    <div class="form-group">
                        <label for="edit-comentarios">Comentarios</label>
                        <textarea id="edit-comentarios" name="comentarios"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit">Actualizar Producto</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para valorar productos -->
        <div id="rateModal" class="modal">
            <div class="modal-content">
                <span class="close-rate">&times;</span>
                <h2>Valorar Producto</h2>
                <form id="rate-form">
                    <input type="hidden" id="rate-product-id" name="id">
                    <div class="form-group">
                        <label for="rating">Calificación</label>
                        <select id="rating" name="rating" required>
                            <option value="1">1 Estrella</option>
                            <option value="2">2 Estrellas</option>
                            <option value="3">3 Estrellas</option>
                            <option value="4">4 Estrellas</option>
                            <option value="5">5 Estrellas</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit">Enviar Valoración</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Modal para aplicar ofertas -->
        <div id="offerModal" class="modal">
            <div class="modal-content">
                <span class="close-offer">&times;</span>
                <h2>Aplicar Oferta</h2>
                <form id="offer-form">
                    <input type="hidden" id="offer-product-id" name="id">
                    <div class="form-group">
                        <label for="offer-percentage">Porcentaje de Descuento (%)</label>
                        <input type="number" id="offer-percentage" name="percentage" min="1" max="100" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Aplicar Oferta</button>
                    </div>
                </form>
            </div>
        </div>

    </main>

    <footer class="footer"></footer>

    <script src="../assets/js/carrito.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let userRoleId = 0;
            let userRole = "";

            // Fetch para obtener los datos del usuario actual
            fetch('../pages/backend/tienda/fetch_users.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const usuario = data.user;
                        userRoleId = usuario.Rol_ID;
                        userRole = usuario.Rol;

                        if (userRoleId === 3 || userRole === "Mantenedor") {
                            document.querySelector('.product-admin').style.display = 'block';
                        }
                    } else {
                        console.error('Error fetching user:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));

            fetch('../pages/backend/tienda/fetch_products.php')
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        data.products.forEach(product => {
                            const categoryContainer = document.getElementById(product.Categoria);
                            if (categoryContainer) {
                                const isOnOffer = product.Precio < product.Precio_Original; // Suponiendo que tienes `Precio_Original` en tu producto
                                const productBox = document.createElement('div');
                                productBox.classList.add('box');
                                productBox.innerHTML = `
                            <img src="${product.Imagen}" alt="${product.Nombre}">
                            <h3>${product.Nombre} <small>ID: ${product.ID_Productos}</small></h3>
                            <div class="content">
                                <span class="price" style="color: ${isOnOffer ? 'red' : 'black'};">
                                    $${product.Precio}
                                </span>
                                <span class="rating">Promedio: ${parseFloat(product.PromedioValoracion).toFixed(2)} estrellas</span>
                                <button class="add-to-cart" data-name="${product.Nombre}" data-price="${product.Precio}">Agregar al carro</button>
                                <button class="rate-product" data-id="${product.ID_Productos}">Valorar</button>
                                ${(userRoleId === 3 || userRole === "Mantenedor") ? `
                                <button class="edit-product" data-id="${product.ID_Productos}">Editar</button>
                                ${isOnOffer ? `
                                <button class="remove-offer" data-id="${product.ID_Productos}">Eliminar Oferta</button>` : `
                                <button class="apply-offer" data-id="${product.ID_Productos}">Aplicar Oferta</button>`}
                                <button class="delete-product" data-id="${product.ID_Productos}">Eliminar</button>` : ''}
                            </div>
                        `;
                                categoryContainer.appendChild(productBox);
                            } else {
                                console.error(`No se encontró el contenedor para la categoría: ${product.Categoria}`);
                            }
                        });

                        document.querySelectorAll('.rate-product').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.id;
                                openRateModal(productId);
                            });
                        });

                        document.querySelectorAll('.edit-product').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.id;
                                fetch(`../pages/backend/tienda/get_product.php?id=${productId}`)
                                    .then(response => response.json())
                                    .then(productData => {
                                        if (productData.status === 'success') {
                                            const product = productData.product;
                                            document.getElementById('edit-id').value = product.ID_Productos;
                                            document.getElementById('edit-name').value = product.Nombre;
                                            document.getElementById('edit-price').value = product.Precio;
                                            document.getElementById('edit-category').value = product.Categoria;
                                            document.getElementById('edit-purchase-date').value = product.Fecha_de_compra;
                                            document.getElementById('edit-expiration-date').value = product.Fecha_de_EX;
                                            document.getElementById('edit-stock').value = product.Stock;
                                            document.getElementById('edit-image').value = product.Imagen;
                                            document.getElementById('edit-provider').value = product.Proveedor;
                                            document.getElementById('edit-origin').value = product.Pais_origen;
                                            document.getElementById('edit-lactosa').checked = product.Lactosa;
                                            document.getElementById('edit-gluten').checked = product.Gluten;
                                            document.getElementById('edit-description').value = product.Descripcion_Producto;
                                            document.getElementById('edit-contador').value = product.Contador;
                                            document.getElementById('edit-comentarios').value = product.Comentarios;

                                            document.getElementById('editModal').style.display = "block";
                                        } else {
                                            alert('Error al cargar los datos del producto: ' + productData.message);
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                    });
                            });
                        });

                        document.querySelectorAll('.delete-product').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.id;
                                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                                    fetch(`../pages/backend/tienda/delete_product.php`, {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded'
                                            },
                                            body: `id=${productId}`
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.status === 'success') {
                                                alert('Producto eliminado exitosamente');
                                                location.reload(); // Recargar la página para mostrar los cambios
                                            } else {
                                                alert('Error al eliminar el producto: ' + data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.');
                                        });
                                }
                            });
                        });

                        document.querySelectorAll('.apply-offer').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.id;
                                document.getElementById('offer-product-id').value = productId;
                                document.getElementById('offerModal').style.display = "block";
                            });
                        });

                        document.querySelectorAll('.remove-offer').forEach(button => {
                            button.addEventListener('click', function() {
                                const productId = this.dataset.id;
                                if (confirm('¿Estás seguro de que deseas eliminar esta oferta?')) {
                                    fetch('../pages/backend/tienda/remove_offer.php', {
                                            method: 'POST',
                                            headers: {
                                                'Content-Type': 'application/x-www-form-urlencoded'
                                            },
                                            body: `id=${productId}`
                                        })
                                        .then(response => response.json())
                                        .then(data => {
                                            if (data.status === 'success') {
                                                alert('Oferta eliminada exitosamente');
                                                location.reload(); // Recargar la página para mostrar los cambios
                                            } else {
                                                alert('Error al eliminar la oferta: ' + data.message);
                                            }
                                        })
                                        .catch(error => {
                                            console.error('Error:', error);
                                            alert('Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.');
                                        });
                                }
                            });
                        });

                    } else {
                        console.error('Error fetching products:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        document.querySelector('.close-rate').addEventListener('click', function() {
            document.getElementById('rateModal').style.display = "none";
        });

        document.querySelector('.close-offer').addEventListener('click', function() {
            document.getElementById('offerModal').style.display = "none";
        });

        document.getElementById('offer-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            fetch('../pages/backend/tienda/apply_offer.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Verifica aquí lo que devuelve el servidor
                    if (data.status === 'success') {
                        alert('Oferta aplicada exitosamente');
                        document.getElementById('offerModal').style.display = "none";
                        location.reload(); // Recargar para actualizar los precios
                    } else {
                        alert('Error al aplicar la oferta: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.');
                });
        });

        function openRateModal(productId) {
            const rateModal = document.getElementById('rateModal');
            document.getElementById('rate-product-id').value = productId;
            console.log("Product ID for rating:", productId); // Agrega esto para depurar
            rateModal.style.display = "block";
        }
        document.getElementById('rate-form').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);

            console.log("Form data:", Array.from(formData.entries())); // Verifica los datos que se están enviando

            fetch('../pages/backend/tienda/rate_product.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Verifica aquí lo que devuelve el servidor
                    if (data.status === 'success') {
                        alert('Valoración enviada exitosamente');
                        document.getElementById('rateModal').style.display = "none";
                        location.reload(); // Recargar para actualizar los datos
                    } else {
                        alert('Error al enviar la valoración: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al procesar la solicitud. Por favor, inténtalo de nuevo más tarde.');
                });
        });
    </script>

</body>

</html>