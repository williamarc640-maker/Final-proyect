<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>© Function Juntion℗ - contacto</title>
<!-- links -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="styles/contacto.css">
</head>
<body>
<!-- perfil usuario -->
<section class="seccion-perfil-usuario">
    <div class="perfil-usuario-header">
        <div class="perfil-usuario-portada">
            <div class="perfil-usuario-avatar">
<!-- boton para cambiar foto de avatar -->
                <img src="img/icono-FJ.PNG" alt="img-avatar">
                <button type="button" class="boton-avatar">
                    <i class="far fa-image"></i>
                </button>
            </div>
<!-- boton para cambiar foto de portada -->
            <button type="button" class="boton-portada">
                <i class="far fa-image"></i> Cambiar fondo
            </button>
        </div>
    </div>
<!-- cuerpo del perfil -->
    <div class="perfil-usuario-body">
        <div class="perfil-usuario-bio">
            <h3 class="titulo">Funtion Junction®</h3>
            <p class="texto">Somos programadores de sotfware aprendises en busca de mejorar nuestros servicios</p>
        </div>
<!-- datos usuario -->
        <div class="perfil-usuario-footer">
            <ul class="lista-datos">
<!-- iconos -->
                <li><i class="icono fas fa-share-alt"></i> Redes sociales</li>
                <li><i class="icono fas fa-envelope"></i> email</li>
                <li><i class="icono fas fa-briefcase"></i> estudiantes
                </li>
            </ul>
<!-- datos usuario -->
            <ul class="lista-datos">
               <a href="index.php"> <li>Inicio</li></a>
                <a href="misvis.php"><li>¿quienes somos?</li></a>
                <li><a href="plans.php">Planes</a></li>
            </ul>
        </div>
<!-- redes sociales -->
        <div class="redes-sociales">
            <a href="" class="boton-redes facebook fab fa-facebook-f"><i class="icon-facebook"></i></a>
            <a href="" class="boton-redes twitter fab fa-twitter"><i class="icon-twitter"></i></a>
            <a href="" class="boton-redes instagram fab fa-instagram"><i class="icon-instagram"></i></a>
        </div>
    </div>
</section>
<style>
 /* estilos para las redes sociales fijas */
    .mensaje a {
        color: inherit;
        margin-right: .5rem;
        display: inline-block;
    }
    .mensaje a:hover {
        color: #309B76;
        transform: scale(1.4)
    }
    </style>
<!-- redes sociales fijas -->
    <div class="mis-redes" style="display: block;position: fixed;bottom: 1rem;left: 1rem; opacity: 0.5; z-index: 1000;">
        <p style="font-size: .75rem;"></p>
        <div>
            <a target="_blank" href="https://www.facebook.com"><i class="fab fa-facebook-square"></i></a>
            <a target="_blank" href="https://twitter.com"><i class="fab fa-twitter"></i></a>
            <a target="_blank" href="https://www.instagram.com"><i class="fab fa-instagram"></i></a>
            <a target="_blank" href="https://www.youtube.com"><i class="fab fa-youtube"></i></a>
        </div>
    </div>
    </body>
    </html>
