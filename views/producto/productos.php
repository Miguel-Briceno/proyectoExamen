<?php
    require_once "views/templates/header.php"; //? template header
    require_once "views/templates/navProducto.php";//? template navUser 
?>

<section>
    <div class="contenedor">
        <div class="titulo">
            <h2>Panel de Administración</h2>
        </div><!-- final class título-->
        <div class="container-table">
            <h3>Bienvenido <?php echo $_SESSION['usuario']; ?></h3>
            <a href="index.php?accion=agregar">Agregar</a>
            <table border="2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th>***Acciones***</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Si existen productos en la bbdd se presenta en la siguiente
            tabla, con un foreach-->
                    <?php if ($resultados) : ?>
                        <?php foreach ($resultados as $resultado => $valor) : ?>
                            <tr>
                                <td><?php echo $valor['id_pro'] ?></td>
                                <td><?php echo $valor['nombre_pro'] ?></td>
                                <td><?php echo $valor['precio_pro'] ?></td>
                                <td><?php echo $valor['descripcion_pro'] ?></td>
                                <td class="btn">
                                    <a href="index.php?accion=editar&id_pro=<?php echo $valor['id_pro'] ?>">Editar</a>
                                    <a href="index.php?accion=eliminar&id_pro=<?php echo $valor['id_pro'] ?>">Eliminar</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        <!-- Si no existen productos en la bbdd se muestra el mensaje -->
                    <?php else : ?>
                        <tr>
                            <td colspan="6">"No hay productos"</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div><!-- final class contenedor-->
</section>

<?php
    require_once "views/templates/footer.php"; //? template footer    
?>