<?php
include "views/templates/header.php";//? template header
?>
<div class="contenedor"> 
    <!--//! Página index muestra la portada con un título, unas instrucciones y una imagenes sobre propiedades
    //! aqui el vendedor debe ingresar con su login a traves de la barra de navegación que se encuentra en el 
    //! header. 
-->
    <div class="titulo">
        <h2>Listado de propiedades de la Inmobiliaria MB</h2>
    </div><!-- final Clase título-->
    <div class="contenedor-parrafo">
        <p>Solo personal autorizado!!!</p>
        <p>Debe ingresar sus credenciales para Iniciar Sessión</p>
    </div><!-- final Clase contenedor-parrafo-->
        <table border="2">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>
                <!-- Si existen productos en la bbdd se presenta en la siguiente
            tabla, con un foreach-->
                <?php if(!empty($resultados)): ?>                
                <?php foreach($resultados as $resultado=>$valor): ?>                    
                        <tr>
                            <td><?php echo $valor['id_pro'] ?></td>
                            <td><?php echo $valor['nombre_pro'] ?></td>
                            <td><?php echo $valor['precio_pro'] ?></td>
                            <td><?php echo $valor['descripcion_pro'] ?></td>                           
                        </tr>
                    
                <?php endforeach; ?>
                <!-- Si no existen productos en la bbdd se muestra el mensaje -->
                <?php else: ?>
                    <tr>
                        <td colspan="6">"No hay productos"</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table> 
</div><!-- final Clase contenedor-->

<?php
include "views/templates/footer.php";//? template footer
?>