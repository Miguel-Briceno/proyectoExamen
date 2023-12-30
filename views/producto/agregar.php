<?php
    require_once "views/templates/header.php"; //? template header
    require_once "views/templates/navProducto.php";//? template navUser 
?>

    <div class="contenedor">
            <div class="contenedor-form">
                <form  action="index.php?accion=addProducto" method="POST">
                    <div class="titulo">
                        <h2>Agregar producto</h2>
                    </div>
                    <div class="contenedor-input">
                        <label for="nombre">Nombre: </label><br />
                        <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre del producto" required><br />
                    </div>
                    <div class="contenedor-input">
                        <label for="descripcion">Descripción: </label><br />
                        <textarea name="descripcion" id="descripcion" cols="32" rows="4" placeholder="Escribe la descripción del producto" required></textarea><br />
                    </div>
                    <div class="contenedor-input">
                        <label for="precio">Precio: </label><br />
                        <input type="number" name="precio" id="precio" placeholder="Escribe el precio del producto" required><br />
                    </div>
                    <div class="contenedor-input">
                        <input class="btn" type="submit" value="Agregar" name="agregar">
                        <a class="btn" href="index.php?accion=atras">Regresar</a>
                        <input type="hidden" name="addProducto" value="salvar">                        
                    </div>
                </form>
            </div>
    </div>
    <?php
    require_once "views/templates/footer.php"; //? template footer    
?>


