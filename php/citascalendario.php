<?php
require_once("header.php");
?>
<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container-fluid">
            <h4>Consultas</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Consultas</span>
        </div>
    </div>
        <div class="row" style="margin-top:10px;">
        <a href="consulta_rapida.php" style="" class="btn btn-lca nuevo"><i class="fa fa-plus"></i> Nueva Consulta</a>
        <div>
<?php  
require_once("../config/conexion.php"); 
$cita=$con->query("SELECT * FROM citas WHERE status_atencion='Pendiente'");
?>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Calendario</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Consultas para hoy</a></li>
   
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home"><?php if($cita->num_rows>0){ ?> 
      <div id="calendar" class="separador">
                
            </div><?php }else{ ?>
              <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay Citas registradas</h3>
                                <a href="nuevacita1.php" style="" class="btn btn-lca"><i class="fa fa-plus"></i> Nueva cita</a>
                             </center>
                            <br>
                        </div> 
               
            <?php } ?>
          </div>
    <div role="tabpanel" class="tab-pane" id="profile">
        <?php
            $fecha=date('Y-m-d');
            $hora=date('H:i:s');
            $consultapendientes=$con->query("SELECT p.*,d.nombre,e.nombre_especialidad,c.status_atencion,c.id_citas,c.hora FROM citas AS c INNER JOIN pacientes AS p ON c.ced_paciente=p.ced_paciente INNER JOIN doctores AS d ON d.id_doctor=c.id_doctor  INNER JOIN especialidades AS e ON d.id_especialidad=e.id_especialidad WHERE c.status_atencion='Pendiente' AND c.fecha_cita='$fecha'");
            $consulta=$con->query("SELECT p.*,d.nombre,e.nombre_especialidad,c.fecha_actual,c.id_consulta,c.consulta_por,c.tratamiento,c.indicaciones,c.diagnostico FROM consultas AS c INNER JOIN pacientes AS p ON c.ced_paciente=p.ced_paciente INNER JOIN doctores AS d ON d.id_doctor=c.id_doctor  INNER JOIN especialidades AS e ON d.id_especialidad=e.id_especialidad ORDER BY id_consulta DESC LIMIT 7");
            if($consultapendientes->num_rows>0){
            ?>
    
       
            <table class="table table-bordered" style="margin-top: 10px;">
                <thead>
                    <th>Nombre</th>
                    <th>Doctor</th>
                    <th>Especialidad</th>
                    <th>Hora</th>
                    <th>Consulta</th>
                    <th>&nbsp;</th>
                </thead>
                <tbody>
                <?php while($row=mysqli_fetch_array($consultapendientes)){
                  ?>
                    <tr>
                        <td><?php echo $row['nombres'];  ?></td>
                        <td><?php echo $row['nombre'];  ?></td>
                        <td><?php echo $row['nombre_especialidad'];  ?></td>
                        <td><?php echo $row['hora'];  ?></td>
                        <td><button title="Pendiente" type="button" class="btn btn-danger"><i class="fa fa-product-hunt" aria-hidden="true"></i></button></td>
                        <td><a href="nuevaconsulta.php?id=<?php echo $row['id_citas']; ?>" class="btn btn-primary" title="Ir a la consulta"><i class="fa fa-address-book-o"></i></a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
             <?php }else{ ?>
             <div class="container-fluid" style="">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay Consultas asignadas para el dia de Hoy</h3>
                             </center>
                            <br>
                        </div>
        
            <?php } ?>
            <div class="panel panel-default" style="margin-top: 40px;">
                <div class="panel-heading">
                    <h4>Ultimas Consultas Realizadas</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered" id="">
                        <thead>
                            <th>Nombre</th>
                            <th>Doctor</th>
                            <th>Fecha</th>
                             <th>Detalles Consulta</th>
                        </thead>
                        <tbody>
                            <?php while($row2=mysqli_fetch_array($consulta)){ 
                              $fecha_actual=$row2['fecha_actual'];
                              $Fe=explode('-', $fecha_actual);
                              $Fecha=$Fe[2].'-'.$Fe[1].'-'.$Fe[0];
                              $id_consulta=$row2['id_consulta'];
                              $tabla='';
                              $insumos=$con->query("SELECT * FROM detalle_consulta INNER JOIN productos ON detalle_consulta.id_producto=productos.id_producto WHERE id_consulta='$id_consulta'");
                              $ini='No hay insumos en la consulta';
                              ?>
                            <tr>
                                <td><?php echo $row2['nombres']; ?></td>
                                <td><?php echo $row2['nombre']; ?></td>
                                 <td><?php echo $Fecha; ?></td>
                                <td><a href="#" onclick="vercita('<?php echo $row2['id_consulta'] ?>','<?php echo $row2['ced_paciente']?>','<?php echo $row2['nombres']?>','<?php echo $row2['nombre_especialidad']?>','<?php echo $row2['nombre']?>','<?php echo str_replace('-', '/', date('d-m-Y',strtotime($fecha_actual))); ?>','<?php echo $row2['consulta_por']; ?>','<?php echo $row2['tratamiento']; ?>','<?php echo $row2['diagnostico'] ?>','<?php echo $row2['indicaciones'] ?>','<?php if($insumos->num_rows<1){
                                    echo $ini;
                                }else{
                                  while($i=mysqli_fetch_array($insumos)){
                                      echo $i['nombre_producto'].' '.'<strong>X</strong> '.$i['cantidad'].', ';
                                  }
                                }?>');" data-target="#vercita" data-toggle="modal" class="btn btn-primary" style=""><span class="fa fa-eye" style=""></span></a></td>                       
                             </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        
    <!--Panel-->

         

</div>
<!--Tab-->
<div class="modal fade modal-view" id="vercita">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                                <h3 class="modal-title"> Ver Detalles de la Consulta</h3>
                            </div>
                            <div class="modal-body">
                               
                              
                                
                                <div class="row">

                                   <div class="col-md-12">
                                   
                                     <table class="table">
                                       <tr>
                                         <td id="ver_cedula"></td>
                                         <td id="ver_nombres"></td>
                                       </tr>
                                       <tr>
                                         <td id="ver_especialidad"></td>
                                         <td id="ver_doctor"></td>
                                       </tr>
                                       <tr>
                                         <td id="ver_fecha"></td>
                                         <td id="ver_insumos"></td>
                                       </tr>
                                     </table>
                                   </div>

                                </div>

                                <div class="row">
                                  <div class="col-md-6">
                                    <h5 class="text-center">Consulta por:</h5>
                                    <div class="alert alert-info" id="ver_consulta"></div>
                                  </div>
                                

                               
                                  <div class="col-md-6">
                                    <h5 class="text-center">Tratamiento:</h5>
                                    <div class="alert alert-success" id="ver_tratamiento"></div>
                                  </div>
                                </div>

                                 <div class="row">
                                  <div class="col-md-6">
                                    <h5 class="text-center">Diagnostico:</h5>
                                    <div class="alert alert-danger" id="ver_diagnostico"></div>
                                  </div>
                             

                                
                                  <div class="col-md-6">
                                    <h5 class="text-center">Indicaciones:</h5>
                                    <div class="alert alert-warning" id="ver_indicaciones"></div>
                                  </div>
                                </div>
                          
                          <div class="row">
                          <form action="../reportes/consultas/reporteconsulta.php" method="POST">
                            <div class="col-md-4 col-md-offset-5">
                              <input type="hidden" id="id_consulta" name="id_consulta">
                              <input class="btn btn-primary" value="Imprimir" type="submit" id="imprimir" name="imprimir">
                            </div>
                          </form>
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
            
        </div>
    </div>
</div>
<?php require_once("footer.php"); ?>
<script type="text/javascript">
    var vercita = function(id_consulta,cedula, nombre,especialidad, doctor, fecha, consulta , tratamiento,diagnostico, indicaciones,insumos) {
       var longitud = insumos.length;
                    $('#id_consulta').val(id_consulta);
                    $('#ver_cedula').html('<b>Cedula del Paciente : </b>' + cedula);
                    $('#ver_nombres').html('<b>Nombre del Paciente : </b>' + nombre);
                    $('#ver_especialidad').html('<b>Especialidad : </b>' + especialidad);
                    $('#ver_doctor').html('<b>Doctor : </b>' + doctor);
                     $('#ver_insumos').html('<b>Insumos : </b>' +insumos.substr(0, longitud - 1) );
                    $('#ver_fecha').html('<b>Fecha : </b>' + fecha);
                    $('#ver_consulta').html(consulta);
                    $('#ver_tratamiento').html(tratamiento);
                    $('#ver_diagnostico').html(diagnostico);
                    $('#ver_indicaciones').html(indicaciones);
                   


  };
</script>