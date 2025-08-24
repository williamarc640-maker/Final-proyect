<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elegant Hunter - Register</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script src="ini.js"></script>
    <link rel="stylesheet" href="ini.css">
</head>
<body>
    <div class="container">
        <header>
            <nav>
                <div class="logo">Function Juntion℗</div>
                <ul>
                    <li><a href="index.php">inicio</a></li>
                <li><a href="misvis.php">¿quienes somos?</a></li>
                <li><a href="Contacto.php">Mas de Nosotros</a></li>
                <li><a href="car.php">catalogo</a></li>
                <li><a>|</a></li>
                <li><a href="ini.php">Iniciar Sesion</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section class="auth-form">
                <h1>Crear Cuenta</h1>
                <form id="register-form">
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Gmail</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirmar Contraseña</label>
                        <input type="password" id="confirm-password" name="confirm-password" required>
                    </div>
                    <button type="submit" class="btn">Registrar</button>
                </form>
                <p class="form-footer">¿Ya Tienes Cuenta? <a href="ini.php">Inicia Sesion aca</a></p>
            </section>
        </main>

        <footer>
            <div class="footer-content">
                <div class="social-links">
                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                    <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                </div>
                <p>&copy; 2024 Function Juntion℗. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <div id="notification" class="notification"></div>

    <script src="script.js"></script>
</body>
</html>