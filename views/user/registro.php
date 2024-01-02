<?php
require_once "views/templates/header.php"; //? template header
require_once "views/templates/navUser.php"; //? template navUser
?>

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
                <input class="btn btn--primario" type="submit" value="Registrar" name="registrar">
            </form>
        </div><!-- fin clase contenedor-formulario -->
        <div>
            <p>Si ya estás registrado pulsa <a href="index.php?accion="><b>Aqui.</b></a></p>
        </div><!-- fin clase contenedor-enlace -->
        <div class="errores">
            <p><?php echo $informacion; ?></p>
                <?php
                if (isset($errores)) {
                    foreach ($errores as $error) {
                        echo "<p class='error'>" . $error . "</p>";
                    }
                }
                ?>
        </div><!-- final Clase errores-->
<?php
require_once "views/templates/footer.php"; //? template footer
?>