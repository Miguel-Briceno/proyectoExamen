<?php
include "views/templates/header.php";
session_start();
?>
<div class="container">
        <form class="formulario" action="index.php?accion=addProducto" method="POST">
            <h1>Agregar producto</h1>
            <label for="nombre">Imagen: </label><br />
            <input type="text" name="imagen" id="imagen" placeholder="Escribe el nombre del producto" required><br />
            <label for="descripcion">Descripción: </label><br />
            <label for="nombre">Nombre: </label><br />
            <input type="text" name="nombre" id="nombre" placeholder="Escribe el nombre del producto" required><br />
            <label for="descripcion">Descripción: </label><br />
            <textarea name="descripcion" id="descripcion" cols="30" rows="5" placeholder="Escribe la descripción del producto" required></textarea><br />
            <label for="precio">Precio: </label><br />
            <input type="number" name="precio" id="precio" placeholder="Escribe el precio del producto" required><br />
            <input type="hidden" name="addProducto">
            <input type="submit" value="Agregar" name="agregar">                        
        </form>
    </div>

<?php
include "views/templates/footer.php";
?>