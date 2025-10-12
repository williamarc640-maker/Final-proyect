document.addEventListener('DOMContentLoaded', () => {
    const productGrid = document.getElementById('product-grid');
    const cartItems = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');
    const checkoutBtn = document.getElementById('checkout-btn');
    const notification = document.getElementById('notification');
    const cartCount = document.getElementById('cart-count');

    // Productos desde PHP
    const products = (window.productos || []).map(p => ({
        id: p.producto_id,
        name: p.producto_nombre,
        price: parseFloat(p.producto_precio),
        image: p.producto_foto,
        stock: p.producto_stock
    }));

    let cart = [];

    function renderProducts() {
        productGrid.innerHTML = products.map(product => `
            <div class="product-card">
                <img src="${product.image}" alt="${product.name}" class="product-image">
                <div class="product-info">
                    <h3 class="product-title">${product.name}</h3>
                    <p class="product-price">$${product.price.toLocaleString('es-CO')}</p>
                    <button class="btn add-to-cart" data-id="${product.id}">Añadir al Carrito</button>
                </div>
            </div>
        `).join('');

        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', addToCart);
        });
    }

    function addToCart(e) {
        const id = parseInt(e.target.dataset.id);
        const product = products.find(p => p.id === id);
        if (!product) return;

        const item = cart.find(i => i.id === id);
        if (item) {
            if (item.quantity < product.stock) {
                item.quantity++;
            } else {
                showNotification('No hay más stock disponible.');
                return;
            }
        } else {
            cart.push({ ...product, quantity: 1 });
        }
        renderCart();
        showNotification('Producto añadido al carrito');
    }

    function renderCart() {
        if (cart.length === 0) {
            cartItems.innerHTML = '<p>El carrito está vacío.</p>';
            cartTotal.textContent = '0.00';
            if (cartCount) cartCount.textContent = '0';
            return;
        }
        cartItems.innerHTML = cart.map(item => `
            <div class="cart-item">
                <div class="cart-item-info">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div>
                        <span class="cart-item-title">${item.name}</span><br>
                        <span class="cart-item-price">$${item.price.toLocaleString('es-CO')}</span>
                    </div>
                </div>
                <div class="cart-item-quantity">
                    <button class="quantity-btn" data-id="${item.id}" data-action="decrease">-</button>
                    <span>${item.quantity}</span>
                    <button class="quantity-btn" data-id="${item.id}" data-action="increase">+</button>
                    <button class="quantity-btn" data-id="${item.id}" data-action="remove" title="Eliminar"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        `).join('');
        cartItems.querySelectorAll('.quantity-btn').forEach(btn => {
            btn.addEventListener('click', handleQuantity);
        });
        const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
        cartTotal.textContent = total.toLocaleString('es-CO');
        if (cartCount) cartCount.textContent = cart.reduce((sum, item) => sum + item.quantity, 0);
    }

    function handleQuantity(e) {
        const id = parseInt(e.target.dataset.id);
        const action = e.target.dataset.action;
        const item = cart.find(i => i.id === id);
        if (!item) return;
        if (action === 'increase') {
            if (item.quantity < item.stock) {
                item.quantity++;
            } else {
                showNotification('No hay más stock disponible.');
            }
        } else if (action === 'decrease') {
            item.quantity--;
            if (item.quantity <= 0) {
                cart = cart.filter(i => i.id !== id);
            }
        } else if (action === 'remove') {
            cart = cart.filter(i => i.id !== id);
        }
        renderCart();
    }

    function showNotification(msg) {
        if (!notification) return;
        notification.textContent = msg;
        notification.style.display = 'block';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 2000);
    }

    checkoutBtn.addEventListener('click', () => {
        if (cart.length === 0) {
            showNotification('El carrito está vacío.');
            return;
        }
        showNotification('¡Gracias por tu compra! (Simulado)');
        cart = [];
        renderCart();
    });

    renderProducts();
    renderCart();
});