<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Pago con Tarjeta - Stripe</title>
  <script src="https://js.stripe.com/v3/"></script>
  <link rel="stylesheet" href="style.css">
  <style>
    body { font-family: Arial; background: #f5f5f5; margin:0; padding:40px; }
    .container { background:#fff; max-width:400px; margin:auto; padding:20px; border-radius:12px; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
    button { background:#6a0dad; color:#fff; border:none; padding:12px; border-radius:6px; width:100%; cursor:pointer; }
    button:hover { background:#7a1ec5; }
  </style>
</head>
<body>
  <div class="container">
    <h2>💜 Pago Seguro</h2>
    <p>Introduce los datos de tu tarjeta para completar el pago.</p>
    <form id="payment-form">
      <div id="card-element"></div>
      <br>
      <button id="submit">Pagar</button>
      <div id="error-message" style="color:red;margin-top:10px;"></div>
    </form>
  </div>

  <script>
    const stripe = Stripe("<?php echo $stripe_public_key; ?>");
    const elements = stripe.elements();
    const card = elements.create("card");
    card.mount("#card-element");

    const form = document.getElementById("payment-form");
    form.addEventListener("submit", async (e) => {
      e.preventDefault();
      const {paymentIntent, error} = await fetch("process_payment.php", {
        method: "POST",
      }).then(r => r.json());

      if (error) {
        document.getElementById("error-message").textContent = error;
        return;
      }

      const result = await stripe.confirmCardPayment(paymentIntent.client_secret, {
        payment_method: { card: card }
      });

      if (result.error) {
        document.getElementById("error-message").textContent = result.error.message;
      } else {
        if (result.paymentIntent.status === "succeeded") {
          window.location.href = "payment_success.php";
        }
      }
    });
  </script>
</body>
</html>


