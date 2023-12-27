<!-- Se hace el requerimiento de el template header-->
<?php require_once 'views/templates/header.php'; ?>
<?php require_once 'controllers/Productos_controller.php' ?>

<!-- Titulo--> 
<div class="titulo">
            <h2>Estamos Editando un Producto</h2>
        </div>
<!-- formulario -->
<div class="contenedor-form">
<?php if(!empty($resultados)): ?>                
    <?php foreach($resultados as $resultado=>$valor): ?>
    <form action="index.php?accion=actualizar" method="POST">
        <div class="contenedor-input">
            <label for="id">Id:</label>
            <input type="text" name="id_pro" id="id" value="<?= $valor['id_pro'] ?>" readonly>
        </div>
        <div class="contenedor-input">
            <label for="nombre_pro">Nombre:</label>
            <input type="text" name="nombre_pro" id="nombre_pro" value="<?= $valor['nombre_pro'] ?>" >
        </div>
        <div class="contenedor-input">
            <label for="precio_pro">Precio:</label>
            <input type="text" name="precio_pro" id="precio_pro" value="<?= $valor['precio_pro'] ?>" >
        </div>
        <div class="contenedor-input">
            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion_pro" id="descripcion" value="<?= $valor['descripcion_pro'] ?>" >
        </div>
        <div class="contenedor-input">
            <label for="idvendedor">Id Vendedor:</label>
            <input type="number" name="id_vendedor" id="idvendedor" value="<?= $valor['id_vendedor'] ?>" readonly>
        </div>
        <div class="contenedor-input">            
            <input type="submit" name="accion" value="Editar">
        </div>        
    </form>
    <?php endforeach; ?>
        <!-- Si no existen productos en la bbdd se muestra el mensaje -->
        <?php else: ?>
            <tr>
                <td colspan="6">"No hay productos"</td>
            </tr>
        <?php endif; ?>
</div> 
<!-- Se hace el requerimiento de el template footer-->
<?php require_once 'views/templates/footer.php'; ?> 