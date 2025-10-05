<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© SummerWooll - pagina principal</title>
<!-- links -->
    <link rel="stylesheet" href="styles/index.css">  
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<!-- header -->
<?php include 'header.php'; ?>
    <main>
<!-- hero section -->
        <section id="home" class="hero">
            <h1>©SummerWooll</h1>
            <p>lema</p>
            <a href="car.php" class="cta-button">¡¡Explora Nuestro Catalogo!!</a>
        </section>
<!-- about us -->
        <section id="about" class="content-section">
            <h2>Titulo</h2>
            <p>informacion</p>
<!-- features -->
            <div class="feature-grid">
                <div class="feature">
                    <i class="fas fa-tshirt"></i>
                    <h3>caracteristica 1</h3>
                    <p>informacion</p>
                </div>
<!-- feature 2 -->
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>caracteristica 2</h3>
                    <p>informacion</p>
                </div>
<!-- feature 3 -->
                <div class="feature">
                    <i class="fas fa-paint-brush"></i>
                    <h3>caracteristica 3</h3>
                    <p>informacion</p>
                </div>
            </div>
        </section>
<!-- newsletter -->
        <section id="newsletter" class="content-section">
            <h2>Unete a Nuestra comunidad</h2>
            <p>Mantente actualizado</p>
            <form id="newsletter-form">
                <input type="email" placeholder="Enter your email" required>
                <button type="submit">Suscribete</button>
            </form>
        </section>
    </main>
<!-- footer -->
<?php include 'footer.php'; ?>
</body>
</html>