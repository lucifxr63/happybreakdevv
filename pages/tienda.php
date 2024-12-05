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
        

        .product-title{
            font-family: "Noto Serif", serif;
            font-weight: 800;
            font-size: 2rem;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 2%;
            padding: 2%;
           
        }

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
            border: 0px solid #ddd;
            transition: box-shadow .3s;
            padding: 5px;
            margin: 5px;
            
            text-align: center;
        }

        .box:hover {
            box-shadow: 0 0 112px rgba(33, 33, 33, .2);
        }

        .products-container .box img {
            max-width: 100%;
            height: auto;
            border-radius: 5%;
        }

        .products-container .box h3 {
            margin: 10px 0;
            
        }

        .products-container .box .content span {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
            color: white !important;
            max-width: 60%;
            width: 50%;
        }

        .products-container .box .content button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 1px;
            cursor: pointer;
            border-radius: 5px;
            margin-bottom: 2%;
            max-width: 60%;
            width: 50%;
            
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
        #addProductButton {
    display: none; /* Inicialmente oculto */
    padding: 10px 20px;
    background-color: #28a745; /* Color verde */
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 25px; /* Bordes redondeados */
    cursor: pointer;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombra */
    transition: all 0.3s ease; /* Transición suave */
}

/* Efecto hover */
#addProductButton:hover {
    background-color: #218838; /* Verde más oscuro */
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2); /* Sombra más intensa */
    transform: scale(1.05); /* Agrandar ligeramente */
}

/* Efecto focus */
#addProductButton:focus {
    outline: none;
    box-shadow: 0 0 8px rgba(40, 167, 69, 0.5); /* Brillo al hacer focus */
}
/* Estilos para el modal */
.modal {
    display: none; /* Oculto por defecto */
    position: fixed;
    z-index: 1001;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.6); /* Fondo oscuro translúcido */
    padding-top: 60px;
}

/* Contenido del modal */
.modal-content {
    background-color: #ffffff;
    margin: 5% auto;
    padding: 30px 20px;
    border-radius: 15px; /* Bordes redondeados */
    width: 50%; /* Ancho del modal */
    max-width: 600px; /* Máximo ancho */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Sombra */
    animation: fadeIn 0.3s ease; /* Animación de entrada */
}

/* Botón de cerrar */
.close-add, .close-rate, .close-offer, .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    transition: color 0.3s ease; /* Transición para el hover */
}

/* Hover en botón de cerrar */
.close-add:hover, .close-rate:hover, .close-offer:hover, .close:hover {
    color: #000; /* Cambia a negro al pasar el cursor */
}

/* Encabezado del modal */
.modal-content h2 {
    font-family: 'Noto Serif', serif;
    font-size: 24px;
    font-weight: bold;
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

/* Formularios dentro del modal */
.modal-content form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Inputs y textarea */
.modal-content form .form-group input,
.modal-content form .form-group textarea,
.modal-content form .form-group select {
    width: 100%;
    padding: 10px 15px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 8px; /* Bordes suaves */
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

/* Efecto focus en inputs y textarea */
.modal-content form .form-group input:focus,
.modal-content form .form-group textarea:focus,
.modal-content form .form-group select:focus {
    outline: none;
    border-color: #28a745; /* Verde para focus */
    box-shadow: 0 0 8px rgba(40, 167, 69, 0.4); /* Sombra suave */
}

/* Etiquetas de formulario */
.modal-content form .form-group label {
    font-size: 14px;
    font-weight: bold;
    color: #555;
}

/* Botón dentro del modal */
.modal-content form .form-group button {
    background-color: #007bff; /* Azul */
    color: #fff;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 8px; /* Bordes suaves */
    cursor: pointer;
    transition: all 0.3s ease;
    align-self: center; /* Centrar el botón */
}

/* Hover en el botón */
.modal-content form .form-group button:hover {
    background-color: #0056b3; /* Azul más oscuro */
    transform: scale(1.05); /* Aumentar tamaño */
}

/* Animación para el modal */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
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
                    <option value="Dulces">Almuerzos</option>
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
      <!-- Botón para abrir el modal de agregar producto -->
<button id="addProductButton" style="display: none;">Agregar Producto</button>


        <!-- Seccion con los productos alo sans porfa no se rian -->
        <section class="products" id="products">

             <!--  Titulos de categorias de los productos -->
            <h2 class="product-title">Café
                
            </h2>

            <div class="products-container" id="Café">
            </div>
            
            <h2 class="product-title">Repostería</h2>

            <div class="products-container" id="Repostería">
            </div>

            <h2 class="product-title">Tetería</h2>

            <div class="products-container" id="Tetería">
            </div>

            <h2 class="product-title">Almuerzos</h2>

            <div class="products-container" id="Almuerzos">
            </div>

            <h2 class="product-title">Dulces</h2>

            <div class="products-container" id="Dulces">
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

<!-- Modal para agregar productos -->
<div id="addProductModal" class="modal">
    <div class="modal-content">
        <span class="close-add">&times;</span>
        <h2>Agregar Nuevo Producto</h2>
        <form id="add-product-form">
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
    </div>
</div>


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
document.addEventListener('DOMContentLoaded', function () {
    let userRoleId = 0;
    let userRole = "";

    // **Obtener información del usuario actual**
    fetch('../pages/backend/tienda/fetch_users.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                const usuario = data.user;
                userRoleId = usuario.Rol_ID;
                userRole = usuario.Rol;

                // Mostrar el botón de agregar producto si es mantenedor
                if (userRoleId === 3 || userRole === "Mantenedor") {
                    document.getElementById('addProductButton').style.display = 'block';
                }
            } else {
                console.error('Error fetching user:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));

    // **Obtener y renderizar los productos**
    fetch('../pages/backend/tienda/fetch_products.php')
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                renderProducts(data.products);
                attachEventListeners(); // Agregar eventos a los elementos dinámicos
            } else {
                console.error('Error fetching products:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));

    // **Renderizar productos**
    function renderProducts(products) {
        products.forEach(product => {
            const categoryContainer = document.getElementById(product.Categoria);
            if (categoryContainer) {
                const isOnOffer = product.Precio < product.Precio_Original;
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
    }

    // **Agregar eventos dinámicos**
    function attachEventListeners() {
        // Editar Producto
        document.querySelectorAll('.edit-product').forEach(button => {
            button.addEventListener('click', openEditModal);
        });

        // Eliminar Producto
        document.querySelectorAll('.delete-product').forEach(button => {
            button.addEventListener('click', deleteProduct);
        });

        // Botón para abrir el modal de oferta
    document.querySelectorAll('.apply-offer').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            document.getElementById('offer-product-id').value = productId;
            document.getElementById('offerModal').style.display = 'block';
        });
    });

        // Remover Oferta
        document.querySelectorAll('.remove-offer').forEach(button => {
            button.addEventListener('click', removeOffer);
        });

        // Valorar Producto
        document.querySelectorAll('.rate-product').forEach(button => {
            button.addEventListener('click', openRateModal);
        });
    }

    // **Abrir Modal de Agregar Producto**
    const addProductButton = document.getElementById('addProductButton');
    const addProductModal = document.getElementById('addProductModal');
    const closeAddModal = document.querySelector('.close-add');

    addProductButton.addEventListener('click', function () {
        addProductModal.style.display = 'block';
    });

    closeAddModal.addEventListener('click', function () {
        addProductModal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === addProductModal) {
            addProductModal.style.display = 'none';
        }
    });
    // Botón para cerrar el modal de oferta
    document.querySelector('.close-offer').addEventListener('click', function () {
        document.getElementById('offerModal').style.display = 'none';
    });

    // **Enviar formulario de agregar producto**
    const addProductForm = document.getElementById('add-product-form');
    addProductForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(addProductForm);

        fetch('../pages/backend/tienda/add_product.php', {
            method: 'POST',
            body: formData,
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    alert('Producto agregado exitosamente');
                    addProductModal.style.display = 'none';
                    location.reload();
                } else {
                    alert('Error al agregar el producto: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error al procesar la solicitud:', error);
                alert('Hubo un error al intentar agregar el producto.');
            });
    });

    // **Abrir Modal de Edición**
    function openEditModal() {
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

                    document.getElementById('editModal').style.display = 'block';
                } else {
                    alert('Error al cargar los datos del producto: ' + productData.message);
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // **Eliminar Producto**
    function deleteProduct() {
        const productId = this.dataset.id;
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            fetch('../pages/backend/tienda/delete_product.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${productId}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Producto eliminado exitosamente');
                        location.reload();
                    } else {
                        alert('Error al eliminar el producto: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // **Abrir Modal de Ofertas**
    function openOfferModal() {
        const productId = this.dataset.id;
        document.getElementById('offer-product-id').value = productId;
        document.getElementById('offerModal').style.display = 'block';
    }

    // **Remover Oferta**
    function removeOffer() {
        const productId = this.dataset.id;
        if (confirm('¿Estás seguro de que deseas eliminar esta oferta?')) {
            fetch('../pages/backend/tienda/remove_offer.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${productId}`,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Oferta eliminada exitosamente');
                        location.reload();
                    } else {
                        alert('Error al eliminar la oferta: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    }

    // **Abrir Modal de Valoración**
    function openRateModal() {
        const productId = this.dataset.id;
        document.getElementById('rate-product-id').value = productId;
        document.getElementById('rateModal').style.display = 'block';
    }

    // Cerrar el modal de valoración
    document.querySelector('.close-rate').addEventListener('click', function () {
        document.getElementById('rateModal').style.display = 'none';
    });

    // Cerrar el modal de edición
    document.querySelector('.close').addEventListener('click', function () {
        document.getElementById('editModal').style.display = 'none';
    });
});

    </script>

</body>

</html>