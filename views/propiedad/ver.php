<?php
require_once "views/templates/header.php"; // template header
require_once "views/templates/navPropiedad.php"; // template navUser 
?>

<section>
    <div class="contenedor">
        <div class="titulo">
            <h2>Vista de la Propiedad</h2>
        </div><!-- final class título-->
        <?php if ($resultados) : ?>
            <?php foreach ($resultados as $resultado => $valor) : ?>
                
                <div>
                    <?php echo '<img height="200px" width="200px" src="http://localhost/proyectoExamen/asset/img/'.$valor["img_pro"].' " alt="foto '.$valor["nombre_pro"].' ">'?>
                </div>
                <div>
                    <p>Nombre: <?php echo " " . $valor['nombre_pro'] ?></p>
                </div>
                <div>
                    <p>Descripción: <?php echo " " . $valor['descripcion_pro'] ?></p>
                </div>
                <div>
                    <p><?php echo $valor['tamanio_pro'] . " " ?> mts²</p>
                </div>
                <div>
                    <p><img src="asset/img/icono_dormitorio.svg" alt="icono dormitorios"><?php echo ": " . $valor['dormitorios_pro'] ?></p>
                </div>
                <div>
                    <p><img src="asset/img/icono_wc.svg" alt="icono baños"><?php echo ": " . $valor['banios_pro'] ?></p>
                </div>
            <?php endforeach; ?>
            <!-- Si no existen productos en la bbdd se muestra el mensaje -->
        <?php else : ?>
            <tr>
                <td colspan="9">"No hay propiedades"</td>
            </tr>
        <?php endif; ?>
        <div class="contenedor-input">            
            <a class="btn" href="index.php?accion=atras">Regresar</a>
        </div>
        </tbody>
        </table>

    </div>
    </div><!-- final class contenedor-->
</section>

<?php
require_once "views/templates/footer.php"; // template footer    
?>