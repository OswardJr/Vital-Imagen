<?php
    require_once('header.php');
?>
    <!--El contenido maldito leo tiene que ir aqui en una etiqueta pagewrapper-->
    <?php
    /*Datos de los graficos*/
    require_once("../config/conexion.php");
    $productos=$con->query("SELECT COUNT(*) FROM productos WHERE status_producto='activo'");
    $chartpro=mysqli_fetch_array($productos);
    $categorias=$con->query("SELECT COUNT(*) FROM categorias WHERE status_categoria='activo' ");
    $chartcat=mysqli_fetch_array($categorias);
    $pacientes=$con->query("SELECT COUNT(*) FROM pacientes WHERE status='activo'");
    $chartpac=mysqli_fetch_array($pacientes);
    $especialidad=$con->query("SELECT COUNT(*) FROM especialidades");
    $chartesp=mysqli_fetch_array($especialidad);
    $doctores=$con->query("SELECT COUNT(*) FROM doctores WHERE status='activo'");
    $chartdoc=mysqli_fetch_array($doctores);
    $proveedores=$con->query("SELECT COUNT(*) FROM proveedores WHERE status_proveedor='activo'");
    $chartprove=mysqli_fetch_array($proveedores);
?>
        <div class="page-content">
            <!--Aqui se maqueta-->
            <div class="container-fluid">
            <div class="bread-content">
                <div class="container">
                    <h4>Inicio</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio</span>
                </div>
            </div>

                <div class="row">
                    <div class="col-xs-12" style="margin-top:20px;">
                        <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h3>Historial</h3>
                    </div>
                    <div class="panel-body">
                       <div class="table-responsive">
                        <table id="tabla" class="display">
                            <thead>
                                <th>Usuario</th>
                                <th>Tipo de accion</th>
                                <th>Descripcion</th>
                                <th>Fecha/Hora</th>
                            </thead>
                            <tbody>
                                <?php
                            $sql="SELECT * FROM bitacora INNER JOIN usuarios ON bitacora.usuario_id = usuarios.id_usuario WHERE status='Activo' ORDER BY fecha DESC";
                            $result=$con->query($sql);
                            while($row=mysqli_fetch_array($result)){
                        ?>
                                    <tr>

                                        <td>
                                            <?php echo $row['nombre'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['accion'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['descripcion'];?>
                                        </td>
                                        <td>
                                            <?php echo $row['fecha'];?>
                                        </td>
                                    </tr>
                                    <?php }?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                    </div>
                </div>


                <!--Tiene que ser cerrado con 2 div-->
            </div>
            <?php
    require_once('footer.php');
?>
        </div>
