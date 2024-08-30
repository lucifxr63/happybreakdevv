document.addEventListener('DOMContentLoaded', () => {
    const cart = document.getElementById('cart');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const checkoutButton = document.getElementById('checkout');
    const cartIcon = document.querySelector('.cart-icon');
    const closeCarts = document.querySelector('.close-cart');

    let cartData = [];

    document.addEventListener('click', (event) => {
        if (event.target.classList.contains('add-to-cart')) {
            const productId = event.target.getAttribute('data-id');
            const productName = event.target.getAttribute('data-name');
            const productPrice = parseFloat(event.target.getAttribute('data-price'));

            const product = {
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1
            };

            addToCart(product);
            openCart();
        }

        if (event.target.classList.contains('decrease')) {
            const productId = event.target.getAttribute('data-id');
            decreaseQuantity(productId);
        }

        if (event.target.classList.contains('increase')) {
            const productId = event.target.getAttribute('data-id');
            increaseQuantity(productId);
        }

        if (event.target.classList.contains('remove')) {
            const productId = event.target.getAttribute('data-id');
            removeProduct(productId);
        }
    });

    function addToCart(product) {
        const existingProduct = cartData.find(item => item.id === product.id);

        if (existingProduct) {
            existingProduct.quantity += 1;
        } else {
            cartData.push(product);
        }

        renderCart();
        notifyProductAdded(product.name);
    }

    function renderCart() {
        cartItems.innerHTML = '';
        let total = 0;

        cartData.forEach(item => {
            const li = document.createElement('li');
            li.innerHTML = `
                ${item.name} - $${item.price} x ${item.quantity}
                <div class="controls">
                    <button class="decrease" data-id="${item.id}">-</button>
                    <button class="increase" data-id="${item.id}">+</button>
                    <button class="remove" data-id="${item.id}">Eliminar</button>
                </div>
            `;
            cartItems.appendChild(li);
            total += item.price * item.quantity;
        });

        cartTotal.textContent = total.toFixed(2);
    }

    function decreaseQuantity(productId) {
        const product = cartData.find(item => item.id === productId);

        if (product) {
            product.quantity -= 1;
            if (product.quantity <= 0) {
                removeProduct(productId);
            } else {
                renderCart();
            }
        }
    }

    function increaseQuantity(productId) {
        const product = cartData.find(item => item.id === productId);

        if (product) {
            product.quantity += 1;
            renderCart();
        }
    }

    function removeProduct(productId) {
        cartData = cartData.filter(item => item.id !== productId);
        renderCart();
    }

    function notifyProductAdded(productName) {
        alert(`${productName} ha sido agregado al carrito`);
    }

    cartIcon.addEventListener('click', () => {
        toggleCart();
    });

    closeCarts.addEventListener('click', () => {
        closeCart();
    });

    checkoutButton.addEventListener('click', () => {
        checkout();
    });

    function closeCart() {
        cart.classList.remove('open');
    }

    function openCart() {
        cart.classList.add('open');
    }

    function toggleCart() {
        cart.classList.toggle('open');
    }

    function checkout() {
        console.log('Iniciando checkout'); // Debugging message
        fetch('./checkout.php', { // Ruta relativa actualizada
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                productos: cartData,
                total_a_pagar: parseFloat(cartTotal.textContent)
            })
        })
            .then(response => {
                console.log(response); // Debugging message
                return response.json();
            })
            .then(data => {
                console.log(data); // Debugging message
                if (data.success) {
                    alert(data.message);
                    cartData = [];
                    renderCart();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
});
