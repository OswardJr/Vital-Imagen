<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
            <div class="container">
                <h4>Lotes</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario <i class="fa fa-caret-right"></i> Lotes</span>
            </div>
        </div>
        <?php 
            require_once("../config/conexion.php");
            $sql="SELECT * FROM inventario INNER JOIN proveedores ON inventario.proovedores_id = proveedores.id_proveedor INNER JOIN lotes ON inventario.lotes_id = lotes.id_lote INNER JOIN productos ON inventario.productos_id = productos.id_producto";
            $result=$con->query($sql);
        
            $sql2="SELECT * FROM proveedores WHERE status_proveedor='Activo'";
            $result2=$con->query($sql2);
        ?>
  
        <div class="row" style="">
            <div class="col-xs-12">
                <?php if($result2->num_rows >= 1){  ?>
                <?php
                    if($result->num_rows >= 1){               
                ?>
                 <a href="addnuevolote.php" class="btn btn-lca nuevo" style=""><span class="fa fa-cubes" ></span> Nuevo lote</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center>
                            <h3>Lotes</h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <div class="table table-responsive">
                            <table id="tabla" class="display">
                                <thead>
                                    <th>Lote del producto</th>
                                    <th>Codigo del lote</th>
                                    <th>Cantidad Ingresada</th>
                                    <th>status del lote</th>
                                    <th>Proveedor del lote</th>
                                    <th>Ver</th>
                                </thead>
                                <tbody id="content">
                                    <?php while($row=mysqli_fetch_assoc($result)){
                                        $idlote=$row['id_lote'];
                                        $datoslote=$con->query("SELECT * FROM inventario INNER JOIN lotes ON inventario.lotes_id ='$idlote' ");
                                        $infolote=mysqli_fetch_array($datoslote);
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['nombre_producto']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['codigo_lote']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['cantidad']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['status_inventario']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nombre_proveedor']; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-primary" href="#" data-target="#verlote" data-toggle="modal" onclick="verlote('<?php echo $row['codigo_lote']; ?>',
                                                '<?php echo $row['nombre_producto']; ?>','<?php echo $row['fechaEnt']; ?>','<?php echo $row['fechaVenc']; ?>',
'<?php echo $row['nombre_proveedor']; ?>',
'<?php echo $row['productos_lote']; ?>',
'<?php echo $infolote['status_inventario']; ?>');"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                    <center>
                        <h3 style=""><i class="fa fa-exclamation-triangle"></i> No ha realizado ningun ingreso de lotes <br>no existe ningun lote activo o pendiente</h3>
                        <a style="margin-bottom:290px;" href="addnuevolote.php" class="btn btn-lca"> <i class="fa fa-plus"></i> Nuevo lote</a>
                    </center>
                <?php  }}else{ ?>
                     <center>
                        <h3><i class="fa fa-exclamation-triangle"></i> ¡Atencion! debe registrar un proveedor para ingresar un lote</h3>
                        <a href="proveedores.php" style="margin-bottom:290px;" class="btn btn-lca"><i class="fa fa-sign-in"></i>Ir a proveedores</a>
                    </center>
                 <?php  } ?>
            </div>
        </div>

         <div class="modal fade modal-view" id="verlote">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver lote</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/boxs.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_nombreproducto"></li>
                             <li class="list-group-item" id="ver_existencia"></li>
                            <li class="list-group-item" id="ver_nombreproductoLote"></li>
                            <li class="list-group-item" id="ver_proveedores"></li>
                            <li class="list-group-item" id="ver_status"></li>
                            <li class="list-group-item" id="ver_fechaEnt"></li>
                            <li class="list-group-item" id="ver_fechaVenc"></li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="text-center">
                        Para cerrar esta ventana haga click fuera de ella o presione el boton cerrar.
                    </div>
                </div>
            </div>
        </div>
    </div>
     
    </div>
</div>
<?php require_once("footer.php"); ?>
<script>
  var verlote = function(nombre,producto,entrada,vencimiento,stock,proveedores,status) {
        $('#ver_nombreproducto').html('<b>Codigo del lote : </b>' + nombre);
        $('#ver_existencia').html('<b>proveedor del lote: </b>' + stock);
        $('#ver_nombreproductoLote').html('<b>Producto : </b>' + producto);
        $('#ver_proveedores').html('<b>Numero de productos ingresados en el lote: </b>' + proveedores);
        $('#ver_status').html('<b>Status del lote : </b>' + status);
        $('#ver_fechaEnt').html('<b>Fecha de entrada del lote: </b>' + entrada);
        $('#ver_fechaVenc').html('<b>Fecha de vencimiento del lote : </b>' + vencimiento);
  };  
</script>