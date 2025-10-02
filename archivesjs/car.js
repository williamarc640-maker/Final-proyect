document.addEventListener('DOMContentLoaded', () => {
    const productGrid = document.getElementById('product-grid');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const cartCount = document.getElementById('cart-count');
    const checkoutBtn = document.getElementById('checkout-btn');
    const notification = document.getElementById('notification');
// productos disponibles, detalles y sus imagenes
    const products = [
        { id: 1, name: 'Muñeco de chiken little', price: 50.000, image: 'img/muñeco.jpg' },
        { id: 2, name: 'Arreglo de rosas', price: 70.000, image: 'img/rosas.jpg' },
        { id: 3, name: 'Bolso', price: 120.000, image: 'img/bolso.jpg' },
        { id: 4, name: 'Vestido de bebe', price: 95.000, image: 'img/vestido.jpg' },
        { id: 5, name: 'Aretes Miyuki', price: 40.000, image: 'img/aretes.jpeg' },
        { id: 6, name: 'Muñeco de perro', price: 45.000, image: 'img/muñeco-perro.jpeg' },
        { id: 7, name: 'Vestido niña', price: 85.000, image: 'img/vestido-niña.jpeg' },
        { id: 8, name: 'Muñeco de la virgen de villa Margarita', price: 120.000, image: 'img/muñeco-virgencita.jpeg' },
    ];

    let cart = [];

    function renderProducts() {
        productGrid.innerHTML = products.map(product => `
            <div class="product-card">
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">${product.name}</h3>
                    <p class="product-price">$${product.price.toFixed(3)}</p>
                    <button class="btn add-to-cart" data-id="${product.id}">Añadir al Carrito</button>
                </div>
            </div>
        `).join('');

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', addToCart);
        });
    }

    function addToCart(e) {
        const productId = parseInt(e.target.getAttribute('data-id'));
        const product = products.find(p => p.id === productId);
        const existingItem = cart.find(item => item.id === productId);

        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({ ...product, quantity: 1 });
        }

        updateCart();
        showNotification(`${product.name} añadido al carro`);
    }

    function updateCart() {
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-info">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div>
                        <p class="cart-item-title">${item.name}</p>
                        <p class="cart-item-price">$${item.price.toFixed(3)}</p>
                    </div>
                </div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn decrease" data-id="${item.id}">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn increase" data-id="${item.id}">+</button>
                </div>
            </div>
        `).join('');

        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        cartTotal.textContent = total.toFixed(3);
        cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);

        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', updateQuantity);
        });
    }

    function updateQuantity(e) {
        const productId = parseInt(e.target.getAttribute('data-id'));
        const item = cart.find(item => item.id === productId);
        
        if (e.target.classList.contains('increase')) {
            item.quantity++;
        } else if (e.target.classList.contains('decrease')) {
            item.quantity--;
            if (item.quantity === 0) {
                cart = cart.filter(i => i.id !== productId);
            }
        }

        updateCart();
    }

    function showNotification(message) {
        notification.textContent = message;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 3000);
    }

    checkoutBtn.addEventListener('click', () => {
        if (cart.length === 0) {
            showNotification('Tu carrito esta vacio');
        } else {
            showNotification('¡Gracias por tu compra!');
            cart = [];
            updateCart();
        }
    });

    renderProducts();
});