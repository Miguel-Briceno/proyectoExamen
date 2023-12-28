<?php
require_once "views/templates/header.php";//? template header
?>

<main>
    <div class="contenedor">
        <div class="titulo">
            <h2>Login Vendedores</h2>
        </div><!-- final Clase título -->
        <div class="contenedor-form">
            <!--//! aqui se encuentra el primer formulario que envia la información de login email y password
            //! a traves de la url se para una clave valor a la raiz del proyecto donde se va a procesar
            -->
            <form action="index.php?accion=login" method="POST">
                <div class="contenedor-input">
                    <label class="label" for="email">Correo Electronico:</label><!-- email-->
                    <input class="input" type="email" name="email" id="email" placeholder="Escribe tu correo electrónico" required>
                </div>
                <div class="contenedor-input">
                    <label class="label" for="contrasenia">Contraseña:</label><!-- password-->
                    <input class="input" type="password" name="contrasenia" id="contrasenia" placeholder="Escribe tu contrasenia" required>
                </div>
                <input type="hidden" name="inicioSession">
                <input class="input" type="submit" value="Iniciar Sesión">
            </form>
        </div><!-- final Clase contenedor-form -->
    </div><!-- final Clase contenedor-->
</main>
<?php
require_once "views/templates/footer.php";//? template footer
?>