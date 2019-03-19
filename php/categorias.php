<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Categorias</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario <i class="fa fa-caret-right"></i> Categorias</span>
        </div>
    </div>
        <?php 
            require_once("../config/conexion.php");
            $sql="SELECT * FROM categorias WHERE status_categoria='Activo'";
            $result=$con->query($sql);
        ?>
        
        <div class="row" style="">
            <div class="col-xs-12">
            <div id="error" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button><center><h5 id="mensajes">¡Categoria Eliminada con exito!</h5></center></div>
                <?php
                    if($result->num_rows >= 1){               
                ?>
                <a href="nuevacategoria.php" class="btn btn-lca btn-lg-lca" style="margin-bottom:25px; margin-top:15px;"><span class="fa fa-user-plus" ></span> Agregar categoria</a>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center>
                            <h3>Categorias</h3>
                        </center>
                    </div>
                    <div id="content"></div>
                    <div class="panel-body">
                        <div class="table table-responsive">
                            <table id="tabla" class="display">
                                <thead>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Operaciones</th>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['nombre_categoria']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['descripcion_categoria']; ?>
                                        </td>
                                        <td><a href="#" onclick="vercategoria('<?php echo $row['nombre_categoria']?>','<?php echo $row['descripcion_categoria']?>');" data-target="#ver_categoria" data-toggle="modal" class="btn  btn-info" ><span class="fa fa-eye" style=""></span></a> <a href="editarcategoria.php?id=<?php echo $row['id_categoria']; ?>" class="btn  btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_categoria('<?php echo $row['id_categoria']; ?>');" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }else{ ?>
                    <center>
                        <h3 style="margin-bottom:40px;"><i class="fa fa-exclamation-triangle"></i> No se han encontrado categorias registradas</h3>
                        <a href="nuevacategoria.php" class="btn btn-lca btn-new" style="margin-bottom:281px;"><span class="fa fa-user-plus" ></span> Agregar categoria</a>
                    </center>
                <?php  } ?>
            </div>
        </div>
    
     <div class="modal fade modal-view" id="ver_categoria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver Categoria</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/categoria.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_nombre"></li>
                            <li class="list-group-item" id="ver_descripcion"></li>
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
      var vercategoria = function(nombre, descripcion) {
        $('#ver_nombre').html('<b>Nombre : </b>' + nombre);
        $('#ver_descripcion').html('<b>Descripcion : </b>' + descripcion);
  };              
     
     
 $('#error').hide();
     function eliminar_categoria(id){
          swal({
  title: '¿Eliminar categoria?',
  text: "Si elimina esta categoria se eliminaran los productos derivados de ella",
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
                url:"categorias/deletecategoria.php",
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