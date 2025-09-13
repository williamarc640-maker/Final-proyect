<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Function Juntion℗</title>
<!-- links -->
    <script src="archivesjs/index.js"></script>
    <link rel="stylesheet" href="styles/index.css">  
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
<!-- header -->
<?php include 'header.php'; ?>
    <main>
<!-- hero section -->
        <section id="home" class="hero">
            <h1>Function Juntion℗</h1>
            <p>Nosotros Eclipsamos al Resto</p>
            <a href="car.php" class="cta-button">¡¡Explora Nuestro Catalogo!!</a>
        </section>
<!-- about us -->
        <section id="about" class="content-section">
            <h2>Acerca de Nosotros</h2>
            <p>Somos una compañia de ropa para ir de caza o vestir elegante a preferencia presentando gran comodidad y estilo al momento de ir a momentos especiales de gran importancia o tambien ir Casual</p>
<!-- features -->
            <div class="feature-grid">
                <div class="feature">
                    <i class="fas fa-tshirt"></i>
                    <h3>Calidad de Materiales</h3>
                    <p>Resistente, Comodo y para todas las ocasiones </p>
                </div>
<!-- feature 2 -->
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>Exclusividad</h3>
                    <p>ofresemos servicios persoalizados para nuestros clientes mas fieles y recurrentes </p>
                </div>
<!-- feature 3 -->
                <div class="feature">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Diseños Unicos</h3>
                    <p>Tenemos un estilo que nos diferencia de la competenvcia, exlusivo para salir e ir de forma casual y elegante a la misma vez </p>
                </div>
            </div>
        </section>
<!-- collections -->
        <section id="collections" class="content-section">
            <h2>nuestro catalogo</h2>
            <div class="collection-slider">
                <div class="collection-item">
<!-- coleccions hunt -->
                    <center><img src="img/icono-medio-FJ.PNG"  alt="Hunting Collection"></center>
                    <h3>coleccion de caza</h3>
                    <p>Ruge con la naturaleza y mezclate con el ambiente con nuestra coleccion de caza</p>
                </div>
                <div class="collection-item">
<!-- coleccions formal -->
                    <center><img src="img/icono-medio-FJ.PNG"  alt="Formal Collection"></center>
                    <h3>Collecion elegante</h3>
                    <p>Se la envidia de tus colegas deslumbrando nuestras telas</p>
                </div>
                <div class="collection-item">
<!-- coleccions casual -->
                    <center><img src="img/icono-medio-FJ.PNG" alt="Casual Collection"></center>
                    <h3>Coleccion casual</h3>
                    <p>Piezas versatiles para cualquier momento y lugar</p>
                </div>
            </div>
<!-- slider controls -->
            <div class="slider-controls">
                <button class="prev-btn"><i class="fas fa-chevron-left"></i></button>
                <button class="next-btn"><i class="fas fa-chevron-right"></i></button>
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