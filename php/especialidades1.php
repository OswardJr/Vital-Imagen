<?php 
require_once("header.php");
 ?>
<div class="page-content">

    <div class="container-fluid">
        <div class="bread-content">
            <div class="container">
                <h4>Especialidades</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Areas medicas</span>
            </div>
        </div>
        <div class="row" style="">

            <div class="col-xs-12 ">
                 <?php 
                    require_once("../config/conexion.php");
                    $sql="SELECT id_especialidad,nombre_especialidad,descripcion_especialidad FROM especialidades WHERE status='activo'";
                    $result=$con->query($sql);
                    if($result->num_rows>0){
                     ?>
                <a href="nuevaespecialidad.php" class="btn btn-lca nuevo" style=""><span class="fa fa-user-plus"></span> Agregar Especialidad</a>
            
                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        <center>
                            <h3>Especialidades</h3>
                        </center>
                    </div>
                   
                    <div id="content"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tabla" class="display">
                                <thead>
                                    <th>Nombre de la Especialidad</th>
                                    <th>Doctores</th>
                                    <th>&nbsp;</th>
                                </thead>
                                <tbody>
                                    <?php while($row=mysqli_fetch_assoc($result)){
                                        $especialidad=$row['id_especialidad'];?>
                                    <tr>
                                        <td>
                                            <?php echo $row['nombre_especialidad'];?>
                                        </td>
                                        <td>
                                            <?php     
                                                $ndoctores_referidos="SELECT COUNT(*) FROM doctores INNER JOIN especialidades ON doctores.id_especialidad = especialidades.id_especialidad WHERE doctores.id_especialidad = '$especialidad'";
                                                $ndoctores=$con->query($ndoctores_referidos);
                                                $nrow2=mysqli_fetch_array($ndoctores);
                                                    echo $nrow2[0];
                                                $doctores_referidos="SELECT * FROM doctores INNER JOIN especialidades ON doctores.id_especialidad = especialidades.id_especialidad WHERE doctores.id_especialidad = '$especialidad'";
                                                $doctores=$con->query($doctores_referidos);
                                                ?>
                                        </td>
                                <td>
                                    <a href="#" data-target="#verespecialidad" data-toggle="modal" onclick="verespecialidad('<?php echo $row['nombre_especialidad']; ?>','<?php
                                        if($doctores->num_rows<1){
                                            echo 'No hay doctores asociados,';
                                                }else{   
                                                while($row2=mysqli_fetch_array($doctores)){
                                                    echo $row2['nombre'].' '.$row2['apellido'].',';
                                                }} ?>');" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                            <a href="editarespecialidad.php?id=<?php echo $row['id_especialidad']; ?>" class="btn  btn-warning"><span class="fa fa-pencil-square-o"></span></a>
                                            <a href="javascript:eliminar_especialidad('<?php echo $row['id_especialidad']; ?>');" class="btn  btn-danger"><span class="fa fa-trash"></span></a></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php }else{?>
                 <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay Especialidades registradas</h3>
                                 <a href="nuevaespecialidad.php" class="btn btn-lca nuevo" style=""><span class="fa fa-user-plus"></span> Agregar Especialidad</a>
                             </center>
                            <br>
                        </div> 
                <?php } ?>
            </div>



        </div>
    </div>
    <div class="modal fade modal-view" id="verespecialidad">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver especialidad</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/categoria1.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_nombre"></li>
                            <li class="list-group-item" id="ver_doctoresespecialidad"></li>
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
    var verespecialidad = function(nombre, doctores) {
        $('#ver_nombre').html('<b>Nombre : </b>' + nombre);
        var longitud = doctores.length;
        $('#ver_doctoresespecialidad').html('<b>Doctores referidos : </b>' + '<span class="referidos">' + doctores.substr(0, longitud - 1) + '</span>');
    };

    function eliminar_especialidad(id) {

        swal({
            title: 'Eliminar especialidad',
            text: "¿Desea eliminar esta especialidad?",
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
                url: "doctores/deleteespecialidad.php",
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
