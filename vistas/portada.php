<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© SummerWooll - pagina principal</title>
<!-- links -->
    <link rel="stylesheet" href="styles/portada.css">  
    <link rel="stylesheet" href="styles/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<!-- header -->
<?php include 'inc/header.php'; ?>
    <main>
<!-- hero section -->
        <section id="home" class="hero">
            <h1>©SummerWooll</h1>
            <p>Nosotros eclipsamos al resto</p>
            <a href="car.php" class="cta-button">¡¡Explora Nuestro Catalogo!!</a>
        </section>
<!-- about us -->
        <section id="about" class="content-section">
            <h2>Nuestros principales atributos</h2>
            <p>Creamos piezas artesanales con hilo y mucha dedicación, combinando tradición, color y creatividad</p>
<!-- features -->
            <div class="feature-grid">
                <div class="feature">
                    <i class="fas fa-tshirt"></i>
                    <h3>Diseños personalizados</h3>
                    <p>Cada figura se adapta a tus gustos: colores, formas y estilos únicos.</p>
                </div>
<!-- feature 2 -->
                <div class="feature">
                    <i class="fas fa-leaf"></i>
                    <h3>Hecho con amor y detalle</h3>
                    <p>Cada pieza es tejida a mano con paciencia y cuidado en cada punto.</p>
                </div>
<!-- feature 3 -->
                <div class="feature">
                    <i class="fas fa-paint-brush"></i>
                    <h3>Materiales de calidad</h3>
                    <p>Usamos hilos resistentes y ecológicos que garantizan durabilidad y belleza.</p>
                </div>
            </div>
        </section>
    </main>
<!-- footer -->
<?php include 'inc/footer.php'; ?>
</body>
</html>