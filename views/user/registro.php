<?php
require_once "views/templates/header.php"; //? template header
require_once "views/templates/navUser.php"; //? template navUser
?>
<main>
    <div class="contenedor">
        <div class="titulo">
            <h2>Registro Vendedores</h2>
        </div><!-- final Clase título -->
        <div class="contenedor-form">
            <!-- // * Formulario de registro 
-->         <form class="formulario" action="index.php?accion=registrar" method="POST">
                <div class="contenedor-input">
                    <label class="label" for="email">Correo Electronico:</label>
                    <input class="input" type="email" name="email" id="email" placeholder="Escribe tu correo electrónico" required>
                </div>
                <div class="contenedor-input">
                    <label class="label" for="contrasenia">Contraseña:</label>
                    <input class="input" type="password" name="contrasenia" id="contrasenia" placeholder="Escribe tu contraseña" required>
                </div>
                <div class="contenedor-input">
                    <label class="label" for="conContrasenia">Confirmar contraseña:</label>
                    <input class="input" type="password" name="conContrasenia" id="conContrasenia" placeholder="Confirma tu contraseña" required>
                </div>
                <input type="submit" value="Registrar" name="registrar">
            </form>
        </div><!-- fin clase contenedor-formulario -->
        <div class="contenedor-input">
            <a href="index.php?accion=">Login</a>
        </div><!-- fin clase contenedor-enlace -->
        <div class="errores">
        </div><!-- final Clase contenedor-form -->
    </div><!-- final Clase contenedor-->
</main>
<!--// todo: si el array errores no esta vacio se muestran en pantalla
-->


<?php
require_once "views/templates/footer.php"; //? template footer
?>