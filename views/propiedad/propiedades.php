<?php
    require_once "views/templates/header.php"; //? template header
    require_once "views/templates/navPropiedad.php";//? template navUser 
?>

<section>
    <div class="contenedor">
        <div class="titulo">
            <h2>Panel de Administración</h2>
        </div><!-- final class título-->
        <div class="container-table">
            <h3>Bienvenido <?php echo $_SESSION['usuario']; ?></h3>
            <form action="index.php?accion=filtrar" method="POST">
                <label for="filtro">Ordenar por:</label>
                <select name="filtro" id="filtro">
                    <option value="" selected disabled>Filtrar</option>
                    <option value="nombre">Nombre</option>
                    <option value="precio">Precio</option>
                    <option value="tipo">Tipo</option>
                </select>
                <input type="hidden" name="realizar" value="filtro">
                <input type="submit" value="Ordenar">
            </form>
            <a href="index.php?accion=agregar">Agregar</a>
            <table border="2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Metros Cuadrados</th>
                        <th>Dormitorios</th>
                        <th>Servicios</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Dirección</th>
                        <th>***Acciones***</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Si existen productos en la bbdd se presenta en la siguiente
            tabla, con un foreach-->
                    <?php if ($resultados) : ?>
                        <?php foreach ($resultados as $resultado => $valor) : ?>
                            <tr>
                                <td><?php echo $valor['id'] ?></td>
                                <td><?php echo $valor['nombre_pro'] ?></td>
                                <td><?php echo $valor['tamanio_pro'] ?></td>
                                <td><?php echo $valor['dormitorios_pro'] ?></td>
                                <td><?php echo $valor['banios_pro'] ?></td>
                                <td><?php echo $valor['precio_pro'] ?></td>
                                <td><?php echo $valor['tipo_pro'] ?></td>                                
                                <td><?php echo $valor['direccion_pro'] ?></td>                                
                                <td class="btn">
                                    <a href="index.php?accion=ver&id=<?php echo $valor['id'] ?>">Ver</a>
                                    <a href="index.php?accion=editar&id=<?php echo $valor['id'] ?>">Editar</a>
                                    <a href="index.php?accion=eliminar&id=<?php echo $valor['id'] ?>">Eliminar</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        <!-- Si no existen productos en la bbdd se muestra el mensaje -->
                    <?php else : ?>
                        <tr>
                            <td colspan="9">"No hay propiedades"</td>
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