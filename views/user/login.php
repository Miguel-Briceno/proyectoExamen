<?php
include "views/templates/header.php";
?>

<main>
    <div class="container">
        <form class="formulario" action="index.php?accion=login" method="POST">
            <div class="formulario-items">
                <label class="formulario-items_label" for="email">Correo Electronico:</label>
                <input class="formulario-items_input" type="email" name="email" id="email" placeholder="Escribe tu correo electrónico" required>
            </div>
            <div class="formulario-items">
                <label class="formulario-items_label" for="contrasenia">Contraseña:</label>
                <input class="formulario-items_input" type="password" name="contrasenia" id="contrasenia" placeholder="Escribe tu contrasenia" required>
            </div>
            <input type="hidden" name="inicioSession">
            <input type="submit" value="Iniciar Sesión" name="iniciarSesion">
        </form>
    </div>
</main>
<?php
include "views/templates/footer.php";
?>