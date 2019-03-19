<?php 
require_once("header.php");
 ?>
<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Usuarios</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Usuarios 
        </div>
    </div>
        <div class="row">
        	<div class="col-xs-12 col-xs-offset-">
                 <?php 
                    require_once("../config/conexion.php");
                    $sql="SELECT u.*,t.tipo FROM usuarios AS u INNER JOIN tipo_usuario AS t ON u.id_tipo=t.id_tipo";
                    $result=$con->query($sql);
                    $user=mysqli_num_rows($result);
                    if($user>0){
                     ?>
             
        		<a title="Agregar usuario" href="nuevousuario.php" class="btn btn-lca nuevo"><span class="fa fa-user-plus"></span>Nuevo usuario</a>
            <div class="panel panel-default" style="">
                <div class="panel-heading">
                    <center>
                        <h3 style="">Usuarios</h3>
                    </center>
                </div>

               <div id="content"></div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="tabla" class="table display">
                            <thead>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Usuario</th>
                                <th>Nivel Usuario</th>
                                <th>Status</th>
                                <th>Operaciones</th>
                            </thead>
                            <tbody>
                                <?php while($row=mysqli_fetch_array($result)){ ?>
                                <tr>
                                    <td>
                                        <?php echo $row['nombre']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['apellido']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['usuario']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['tipo']; ?>
                                    </td>
                                     <td><center><?php if($row['status']==='activo'){ ?><button style="" title="Activo" type="button" class="btn btn-success" ><i class="fa fa-chevron-up"></i></button>
                                <?php }else{ ?>
                                    <button type="button" title="inactivo" class="btn btn-danger" ><i class="fa fa-chevron-down"></i></button><?php } ?>
                                    </center></td>
                                    <td>
                                        <a href="#" title="Ver datos del usuario" onclick="verusuario('<?php echo $row['nombre']; ?>','<?php echo $row['apellido']; ?>','<?php echo $row['sexo']; ?>','<?php echo $row['usuario']; ?>','<?php echo $row['tipo']; ?>','<?php echo $row['correo']; ?>','<?php echo $row['pregunta_secreta']; ?>');" data-target="#verusuario" class="btn btn-info" data-toggle="modal"><i class="fa fa-eye"></i></a>
                                        <a href="editarusuario.php?id=<?php echo $row['id_usuario']; ?>"  title="Editar usuario" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                                        <a title="Eliminar usuario" href="javascript:eliminar_usuario('<?php echo $row['id_usuario']; ?>');" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php }else{ ?>
                        <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay usuarios registrados</h3>
                             <a href="nuevousuario.php" style="" class="btn btn-lca"><i class="fa fa-user-plus"></i> Registrar Usuario</a></center>
                            <br>
                         </div>    
            <?php } ?>
        </div>
    </div>
    <!--MODAL VISTA-->
    <div class="modal fade modal-view" id="verusuario">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver usuario</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/usuarios.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_nombreusuario"></li>
                            <li class="list-group-item" id="ver_apellidousuario"></li>
                            <li class="list-group-item" id="ver_sexousuario"></li>
                            <li class="list-group-item" id="ver_userusuario"></li>
                            <li class="list-group-item" id="ver_tipousuario"></li>
                            <li class="list-group-item" id="ver_correo"></li>
                            <li class="list-group-item" id="ver_preguntausuario"></li>
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
    var editarusuario = function(nombre, apellido, sexo, usuario, tipo, pregunta) {
        $('#edit_nombre').val(nombre);
        $('#edit_apellido').val(apellido);
        $('#edit_usuario').val(usuario);
        /*$('#edit_sexo').val(sexo);*/
    };
    var verusuario = function(nombre, apellido, sexo, usuario, tipo,correo, pregunta) {
        $('#ver_nombreusuario').html('<b>Nombre : </b>' + nombre);
        $('#ver_apellidousuario').html('<b>Apellido : </b>' + apellido);
        $('#ver_sexousuario').html('<b>Sexo : </b>' + sexo);
        $('#ver_userusuario').html('<b>Usuario : </b>' + usuario);
        $('#ver_tipousuario').html('<b>Nivel de usuario : </b>' + tipo);
         $('#ver_correo').html('<b>Correo : </b>' + correo);
        $('#ver_preguntausuario').html('<b>Pregunta secreta : </b>' + pregunta);
    };

</script>
<script>
    function eliminar_usuario(id) {

        swal({
            title: 'Eliminar Usuario',
            text: "¿Desea eliminar este usuario?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar',
            cancelButtonText: 'No, cancelar!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-warning',
            buttonsStyling: false
        }).then(function() {
            $.ajax({
                url: "usuarios/deleteusuario.php",
                type: "POST",
                data: 'id=' + id,
                success: function(respuesta) {
                    $('#content').html(respuesta);
                }
            });
            return true;
        }, function(dismiss) {})

    }

</script>
