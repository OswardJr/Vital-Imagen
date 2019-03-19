<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Proveedores</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario <i class="fa fa-caret-right"></i> Proveedores</span>
        </div>
    </div>
        <?php 
            require_once("../config/conexion.php");
            $sql="SELECT * FROM proveedores WHERE status_proveedor='Activo'";
            $result=$con->query($sql);
        ?>
     
        <div class="row" style="">
            <div class="col-xs-12">
            <div id="error" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button><center><h5 id="mensajes"></h5></center></div>
                <?php
                    if($result->num_rows >= 1){               
                ?>
                <a href="nuevoproveedor.php" class="btn btn-lca nuevo" style=""><span class="fa fa-plus" ></span> Agregar proveedor</a>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center>
                            <h3>Proveedores</h3>
                        </center>
                    </div>
                    <div id="content"></div>
                    <div class="panel-body">
                        <div class="table table-responsive">
                            <table id="tabla" class="display">
                                <thead>
                                    <th>Nombre de la empresa</th>
                                    <th>RIF</th>
                                    <th>Nombre del contacto</th>
                                    <th>Localidad</th>
                                    <th>Operaciones</th>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($result)){ ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['nombre_proveedor']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['rif_proveedor']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $row['contacto_proveedor']; ?>
                                        </td> 
                                        <td>
                                            <?php echo $row['localidad_proveedor']; ?>
                                        </td>                                      
                                        <td><a href="#" data-target="#verproveedor" data-toggle="modal" onclick="verproveedor('<?php echo $row['nombre_proveedor'];?>','<?php echo $row['rif_proveedor'];?>','<?php echo $row['contacto_proveedor'];?>','<?php echo $row['localidad_proveedor'];?>','<?php echo $row['telefono_proveedor'];?>');" class="btn  btn-info" ><span class="fa fa-eye" style=""></span></a> <a href="editarproveedor.php?id=<?php echo $row['id_proveedor']; ?>" class="btn  btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_proveedor('<?php echo $row['id_proveedor']; ?>');" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                    <center>
                        <h3 style="margin-bottom:40px;"><i class="fa fa-exclamation-triangle"></i> No se han encontrado proveedores registrados</h3>
                        <a href="nuevoproveedor.php" class="btn btn-lca btn-new" style="margin-bottom:281px;"><span class="fa fa-plus" ></span> Agregar proveedor</a>
                    </center>
                <?php  } ?>
            </div>
        </div>

    </div>
    <div class="modal fade modal-view" id="verproveedor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver proveedor</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/proveedorr.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                           <li class="list-group-item" id="ver_nombre"></li>
                           <li class="list-group-item" id="ver_rif"></li>
                           <li class="list-group-item" id="ver_contacto"></li>
                           <li class="list-group-item" id="ver_localidad"></li>
                           <li class="list-group-item" id="ver_telefono"></li>
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
<?php require_once("footer.php"); ?>
 <script>
   var verproveedor = function(nombre,rif,contacto,localidad,telefono) {
        $('#ver_nombre').html('<b>Nombre : </b>' + nombre);
        $('#ver_rif').html('<b>RIF : </b>' + rif);
        $('#ver_contacto').html('<b>Nombre del contacto : </b>' + contacto);
        $('#ver_localidad').html('<b>Localidad : </b>' + localidad);
        $('#ver_telefono').html('<b>Telefono : </b>' + telefono);
    };            
        
 $('#error').hide();
     function eliminar_proveedor(id){
        
  swal({
  title: 'Eliminar proveedor',
  text: "¿Desea eliminar este proveedor?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, eliminar',
  cancelButtonText: 'No, cancelar!',
  confirmButtonClass: 'btn btn-primary',
  cancelButtonClass: 'btn btn-warning',
  buttonsStyling: false
}).then(function () {
            $.ajax({
                url:"proveedores/deleteproveedor.php",
                type:"POST",
                data: 'id='+id,
                success:function(respuesta){
                    $('#content').html(respuesta);
                }
            });
            return true;    
}, function (dismiss) {
})


     }



 </script>