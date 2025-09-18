<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© Function Juntion℗ - pagina principal</title>
<!-- links -->
    <link rel="stylesheet" href="styles/index.css">  
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
<!-- header -->
<?php include 'header.php'; ?>
    <main>
<!-- hero section -->
        <section id="home" class="hero">
            <h1>©Function Juntion</h1>
            <p>Nosotros Eclipsamos al Resto</p>
            <a href="plans.php" class="cta-button">¡¡Explora Nuestros planes!!</a>
        </section>
<!-- about us -->
        <section id="about" class="content-section">
            <h2>Acerca de Nosotros</h2>
            <p>Somos una compañia de alojamiento web para compañias pequeñas, eligenos por: </p>
<!-- features -->
            <div class="feature-grid">
                <div class="feature">
                    <i class="fas fa-tshirt"></i>
                    <h3>Calidad de servicio</h3>
                    <p>Gran calidad en servidores, seguridad para nuestros usuarios y rendimiento</p>
                </div>
<!-- feature 2 -->
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>Exclusividad</h3>
                    <p>Precios baratos y accequibles para toda clase de publico</p>
                </div>
<!-- feature 3 -->
                <div class="feature">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Gran capacidad de personalizacion</h3>
                    <p>Tenemos una gran cantidad de aspectos que puedes modificar a tu gusto</p>
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
<!-- chatbot -->
<?php include 'chatbot.php'; ?>
<!-- footer -->
<?php include 'footer.php'; ?>
</body>
</html>