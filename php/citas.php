<?php
require_once("header.php");
 ?>

    <div class="page-content">

        <div class="container-fluid">
            <div class="bread-content">
                <div class="container">
                    <h4>Citas</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control de citas<i class="fa fa-caret-right"></i> Lista de citas</span>
                </div>
               
            </div>
            <div class="row" style="">
                <div class="container-fluid flex-content">
                  <?php
                    require_once("../config/conexion.php");
                    $sql="SELECT p.ced_paciente,p.nombres,p.apellidos,d.nombre,d.apellido,e.nombre_especialidad,c.id_citas,c.fecha_cita,c.hora,c.status_atencion FROM citas AS c INNER JOIN pacientes AS p ON c.ced_paciente=p.ced_paciente INNER JOIN doctores AS d ON d.id_doctor=c.id_doctor INNER JOIN especialidades AS e ON e.id_especialidad=d.id_especialidad WHERE c.status_atencion='Pendiente'";
                    $result=$con->query($sql);
                    $especialidades=$con->query("SELECT * FROM especialidades WHERE status='activo'");
                    $doctores=$con->query("SELECT * FROM doctores WHERE status='Activo'");

                    if($especialidades->num_rows>0){
                    if($doctores->num_rows>0){
                    if($result->num_rows>0){
                     ?>
                    <a href="nuevacita1.php" style="" class="btn btn-lca"><i class="fa fa-plus"></i> Nueva cita</a>
                    <form action="" class="form-inline">
                        <div class="form-group">
                            <label for="cedula" style="font-size: 18px;">Fecha:</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="00/00/0000 ">
                                <span class="input-group-btn ">
                                        <button class="btn btn-default" style="" type="button" onclick="buscar_cita();"><span class="fa fa-search"></span></button>
                            </div>
                        </div>
                    </form>
                </div>
                
           
                <div class="col-xs-12">
                    
                    <div class="panel panel-default" id="oculto" style="">
                        <div class="panel-heading">
                            <center>
                                <h4 style="color:">Citas</h4>
                            </center>
                        </div>
                      
                            <div id="content"></div>
                            <div class="panel-body" id="">
                                <div class="table-responsive">
                                    <table id="tabla" class="table table-bordered table-striped">
                                        <thead>
                                            <th>Nombre</th>
                                            <th>Especialidad</th>
                                            <th>Doctor</th>
                                            <th>Fecha</td>
                                                <th>Hora</th>
                                                <th>Consulta</th>
                                                <th>Operaciones</th>
                                        </thead>
                                        <tbody>
                                            <?php while($row=mysqli_fetch_array($result)){ 
                     $fecha=$row['fecha_cita'];
                     $date=date('Y-m-d');
                    ?>

                                            <tr>
                                                <td>
                                                    <?php echo $row['nombres']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['nombre_especialidad']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['nombre']; ?>
                                                </td>
                                                <td>
                                                    <?php echo str_replace('-', '/', date('d-m-Y',strtotime($fecha))); ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['hora']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['status_atencion']; ?>
                                                </td>
                                                <td><a href="#" onclick="vercita('<?php echo $row['ced_paciente']?>','<?php echo $row['nombres']?>','<?php echo $row['apellidos']?>','<?php echo $row['nombre_especialidad']?>','<?php echo $row['nombre'].' '.$row['apellido']?>','<?php echo str_replace('-', '/', date('d-m-Y',strtotime($fecha))); ?>');" data-target="#vercita" data-toggle="modal" class="btn btn-info" style=""><span class="fa fa-eye" style=""></span></a> <a href="editarcita.php?id=<?php echo $row['id_citas']; ?>" class="btn btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_cita('<?php echo $row['id_citas']; ?>')" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                           
                    </div>
                </div>
                </div>
                  
            </div>   
            <?php }else{ ?>
               
               <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay Citas registradas</h3>
                                <a href="nuevacita1.php" style="" class="btn btn-lca"><i class="fa fa-plus"></i> Nueva cita</a>
                             </center>
                            <br>
                        </div> 
               
                <?php }?>

                <?php }else{ ?>

                    <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay doctores registrados</h3>
                                <a href="nuevodoctor.php" style="" class="btn btn-lca"><i class="fa fa-plus"></i> Nuevo doctor</a>
                             </center>
                            <br>
                        </div> 

                <?php } ?>

                <?php }else{?>

                  <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay Areas medicas registradas</h3>
                                <a href="nuevaespecialidad.php" style="" class="btn btn-lca"><i class="fa fa-plus"></i> Nueva Area Medica</a>
                             </center>
                            <br>
                        </div> 
               

                <?php } ?>
                <div class="modal fade modal-view" id="vercita">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                                <h3 class="modal-title"> Ver cita</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-6 text-center">
                                        <img src="../public/multimedia/op-doctora.png" alt="">
                                    </div>
                                    <ul class="col-xs-6 list-group">
                                        <li class="list-group-item" id="ver_cedula"></li>
                                        <li class="list-group-item" id="ver_nombres"></li>
                                        <li class="list-group-item" id="ver_apellidos"></li>
                                        <li class="list-group-item" id="ver_especialidad"></li>
                                        <li class="list-group-item" id="ver_doctor"></li>
                                        <li class="list-group-item" id="ver_fecha"></li>
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
           
        
            <?php require_once("footer.php"); ?>
            <script>
                function buscar_cita() {
                    var fecha = $('#fecha').val();
                    if (fecha === "") {
                        swal("Ingrese una fecha", "", "error");
                        return false;
                    }
                    $.ajax({
                        url: "citas/buscar_cita.php",
                        typr: "GET",
                        data: 'fecha=' + fecha,
                        success: function(registro) {
                            if (registro) {
                                $('#content').html(registro);
                                $('#oculto').fadeIn('slow');
                            } else {
                                swal("La Fecha Ingresada No posee Citas disponibles", "", "error");
                                $('#fecha_cita').val("");
                            }
                        }

                    });
                    return false;
                }

            </script>

            <script>
                var vercita = function(cedula, nombre, apellido, especialidad, doctor, fecha) {
                    $('#ver_cedula').html('<b>Cedula : </b>' + cedula);
                    $('#ver_nombres').html('<b>Nombre : </b>' + nombre);
                    $('#ver_apellidos').html('<b>Apellido : </b>' + apellido);
                    $('#ver_especialidad').html('<b>Especialidad : </b>' + especialidad);
                    $('#ver_doctor').html('<b>Doctor : </b>' + doctor);
                    $('#ver_fecha').html('<b>Fecha : </b>' + fecha);

                };

                function eliminar_cita(id) {

                    swal({
                        title: 'Eliminar cita',
                        text: "¿Desea eliminar esta cita?",
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
                            url: "citas/deletecita.php",
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
             <script>
 $('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});
  </script>
