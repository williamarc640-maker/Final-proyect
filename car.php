<!-- car.php -->
<!-- codigo para obtener los productos de la base de datos -->
<?php
require_once 'gestion/producto.php';
$productos = Producto::obtenerTodo();
?>
<!-- codigo HTML -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SummerWooll℗ - Catálogo</title>
<!-- estilos y scripts -->
    <link rel="stylesheet" href="styles/car.css">
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        window.productos = <?= json_encode($productos) ?>;
    </script>
    <script src="archivesjs/car.js" defer></script>
</head>
<body>
<!-- header -->
<?php include 'inc/header.php'; ?>
<main>
    <section id="catalog" class="catalog">
        <h1>Nuestro catálogo</h1>
        <div class="product-grid" id="product-grid">
<!-- Los productos se renderizan por JS -->
        </div>
    </section>
    <section id="cart" class="cart">
        <h2>Carrito de compra</h2>
        <div id="cart-items"></div>
        <div class="cart-total">
            <strong>Total: COP <span id="cart-total">0.00</span></strong>
        </div>
        <button id="checkout-btn" class="btn">Comprar</button>
    </section>
</main>
<!-- notificacion -->
<div id="notification" class="notification"></div>
<!-- Modal de detalles del producto -->
<div id="product-modal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal" id="close-modal">&times;</span>
        <img id="modal-image" src="" alt="" class="modal-image">
        <h3 id="modal-title"></h3>
        <p id="modal-category"></p>
        <p id="modal-price"></p>
        <p id="modal-stock"></p>
        <button id="modal-add-cart" class="btn">Añadir al Carrito</button>
    </div>
</div>
<!-- footer -->
<?php include 'inc/footer.php'; ?>
</body>

<!--el codigo de samuel, intentar ponerlo en un archivo aparte-->
<script>
function checkCheckoutVisibility(){
    var cartTotalEl = document.getElementById('cart-total');
    var checkoutBtn = document.getElementById('checkout-btn');
    if (!cartTotalEl || !checkoutBtn) return;
        var total = parseFloat((cartTotalEl.textContent || cartTotalEl.value || '0').replace(/[^0-9.,]/g,'').replace(',', '.')) || 0;
    if (total <= 0) {
        checkoutBtn.style.display = 'none';
    } else {
        checkoutBtn.style.display = 'inline-block';
    }
}
// Run on load and whenever cart changes (if there's a function updateCart, try to hook it)
document.addEventListener('DOMContentLoaded', function(){
    checkCheckoutVisibility();
  // observe changes to cart-total element text
    var cartTotalEl = document.getElementById('cart-total');
    if (cartTotalEl) {
        var observer = new MutationObserver(function(){ checkCheckoutVisibility(); });
        observer.observe(cartTotalEl, { childList: true, characterData: true, subtree: true });
    }
  // also attach to checkout form submit to redirect to payment
    var checkoutBtn = document.getElementById('checkout-btn');
    if (checkoutBtn) {
        checkoutBtn.addEventListener('click', function(e){
        e.preventDefault();
      // trigger the earlier pay-with-cart logic if present
        var hidden = document.getElementById('hidden-total');
        if (!hidden) {
        // create form to submit total
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = 'payment.php';
            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'total';
            input.id = 'hidden-total';
            var cartTotalEl = document.getElementById('cart-total');
            var total = (cartTotalEl && (cartTotalEl.textContent || cartTotalEl.value)) ? cartTotalEl.textContent : '0';
            total = total.replace(/[^0-9.,]/g,'').replace(',', '.');
            input.value = parseFloat(total) || 0;
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        } else {
            document.getElementById('pay-form').submit();
        }
        });
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  // Intercept buttons with data-action="pay" or class "btn-pay" and redirect to payment.php
    document.querySelectorAll('button, input[type=button], input[type=submit]').forEach(function(el){
        const text = (el.textContent || el.value || '').toLowerCase();
        if (text.includes('pagar') || text.includes('finalizar compra') || el.dataset.action === 'pay' || el.classList.contains('btn-pay')) {
            el.addEventListener('click', function(e){
            e.preventDefault();
        // Optionally you could pass cart info via session or query params
            window.location.href = 'payment.php';
            });
        }
    });
});
</script>


<!-- PAY BUTTON: calcula total y envía a payment.php -->
<div style="margin:20px 0;">
    <form id="pay-form" action="payment.php" method="post">
        <input type="hidden" name="total" id="hidden-total" value="">
        <button type="button" id="pay-with-cart" class="btn-pay">Pagar</button>
    </form>
</div>

<script>
function parsePrice(text){
  // extrae números de formato como 12.345,67 o 12345.67
    text = (text||'').replace(/[^0-9.,]/g,'').trim();
    if(!text) return 0;
  // cambia coma por punto si es separador decimal
    if (text.indexOf(',') > -1 && text.indexOf('.') === -1) {
        text = text.replace(',', '.');
    } else {
        text = text.replace(/,/g,''); // eliminar miles
    }
    var v = parseFloat(text) || 0;
    return v;
}

document.getElementById('pay-with-cart').addEventListener('click', function(){
  // busca elementos con clase .cart-item y dentro .price y .qty o inputs .quantity
    var total = 0;
  // if there's an element with id cart-total use it
    var totEl = document.getElementById('cart-total');
    if (totEl) {
        total = parsePrice(totEl.textContent || totEl.value);
    } else {
    document.querySelectorAll('.cart-item').forEach(function(item){
        var priceEl = item.querySelector('.price');
        var qtyEl = item.querySelector('.qty') || item.querySelector('input.quantity');
        var price = parsePrice(priceEl ? priceEl.textContent : '0');
        var qty = qtyEl ? (parseInt(qtyEl.value||qtyEl.textContent)||1) : 1;
        total += price * qty;
        });
    }
  // fallback: try any element with data-price attribute
    if (total === 0) {
        document.querySelectorAll('[data-price]').forEach(function(el){
            var p = parsePrice(el.dataset.price);
            var q = parseInt(el.dataset-quantity || el.dataset.qty || 1) || 1;
            total += p*q;
        });
    }

  // ensure at least something
    if (total <= 0) {
        alert('No se detectó un total en el carrito.');
        return;
    }

  // send as USD with two decimals (server handles currency)
    document.getElementById('hidden-total').value = total.toFixed(2);
    document.getElementById('pay-form').submit();
});
</script>
</html>