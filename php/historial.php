<?php 
require_once("header.php");
$id_historial=$_GET['idhistorial'];
$consulta=$con->query("SELECT * FROM consultas INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente INNER JOIN doctores ON consultas.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE consultas.ced_paciente='$id_historial'");
$paciente=$con->query("SELECT * FROM pacientes INNER JOIN ciudades ON pacientes.id_ciudad=ciudades.id_ciudad INNER JOIN estados ON ciudades.id_estado=estados.id_estado INNER JOIN municipios ON estados.id_estado=municipios.id_estado INNER JOIN parroquias ON pacientes.id_parroquia=parroquias.id_parroquia WHERE pacientes.ced_paciente='$id_historial'");
$p=mysqli_fetch_assoc($paciente);
$f=$p['fecha_nacimiento'];
$fi=explode('-', $f);
$fecha_n=$fi[2].'-'.$fi[1].'-'.$fi[0];
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
          <h4>Historial</h4>
           <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Pacientes <i class="fa fa-caret-right"></i> Historial del Paciente</span>
        </div>
    </div>
        
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="text-center">Historial</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <img src="../reportes/presupuestos/paz.jpg"  width="400px">
                    </div>
                     <div class="col-md-6">
                        <h4 class=""><strong><i>CLINICA UMI "LA PAZ"
                          <br>Rif: J-30256229-5 <br>
                          Tlf:0244-3225944 <br>
                          Dir:Avenida Victoria c/c Carlos Blank. Edif. Clinica LA PAZ C.A 
                        </i></strong></h4>
                    </div>
                </div>

                <div class="row" style="">
                      <table class="table table-bordered">
                          <tr><h4 class="text-center alert alert-info">Datos del Paciente</h4></tr>
                          <tr><td>Nro Historia: <?php echo $p['nro_historia']; ?></td>
                            <td>Cedula: <?php echo $p['ced_paciente']; ?></td>
                            <td>Nombres: <?php echo $p['nombres']; ?></td>
                             <td>Apellidos: <?php echo $p['apellidos']; ?></td>
                          </tr>   
                          <tr>
                             <td>Sexo: <?php echo $p['sexo']; ?></td>
                            <td>Fecha de Nacimiento: <?php echo $p['fecha_nacimiento']; ?></td>
                             <td>Teléfono: <?php echo $p['telefono']; ?></td>
                            <td>Estado: <?php echo $p['estado']; ?></td>
                          </tr> 
                          <tr>
                           
                            <td>Ciudad: <?php echo $p['ciudad']; ?></td>
                            <td>Municipio: <?php echo $p['municipio']; ?></td>
                            <td>Dirección: <?php echo $p['direccion']; ?></td>
                            <td>Responsable: <?php echo $p['responsable']; ?></td>
                          </tr>
                                   
                     </table>
                </div>

                <div class="row">
                    <div class="alert alert-info text-center"><h4>Consultas Realizadas</h4></div>
                    <table class="table table-bordered" id="tabla">
                        <thead>
                            <th>Fecha & Hora</th>
                            <th>Especialidad</th>
                            <th>Doctor</th>
                            <th>Consulta Por</th>
                            <th>Diagnostico</th>
                            <th>Ver</th>
                        </thead>
                        <tbody>
                          <?php while($c=mysqli_fetch_array($consulta)){ 
                               $fecha_actual=$c['fecha_actual'];
                              $Fe=explode('-', $fecha_actual);
                              $Fecha=$Fe[2].'-'.$Fe[1].'-'.$Fe[0];
                              $id_consulta=$c['id_consulta'];
                              $tabla='';
                              $insumos=$con->query("SELECT * FROM detalle_consulta INNER JOIN productos ON detalle_consulta.id_producto=productos.id_producto WHERE id_consulta='$id_consulta'");
                              $ini='No hay insumos en la consulta';
                            ?>
                          <tr>
                            <td><?php echo $c['fecha_actual'].'/'. $c['hora_actual']; ?></td>
                            <td><?php echo $c['nombre_especialidad']; ?></td>
                            <td><?php echo $c['nombre']; ?></td>
                            <td><?php echo $c['consulta_por']; ?></td>
                            <td><?php echo $c['diagnostico']; ?></td>
                            <td><a href="#" onclick="vercita('<?php echo $c['ced_paciente']?>','<?php echo $c['nombres']?>','<?php echo $c['nombre_especialidad']?>','<?php echo $c['nombre']?>','<?php echo str_replace('-', '/', date('d-m-Y',strtotime($fecha_actual))); ?>','<?php echo $c['consulta_por']; ?>','<?php echo $c['tratamiento']; ?>','<?php echo $c['diagnostico'] ?>','<?php echo $c['indicaciones'] ?>','<?php if($insumos->num_rows<1){
                                    echo $ini;
                                }else{
                                  while($i=mysqli_fetch_array($insumos)){
                                      echo $i['nombre_producto'].' '.'<strong>X</strong> '.$i['cantidad'].', ';
                                  }
                                }?>');" data-target="#verconsulta" data-toggle="modal" class="btn btn-primary" style=""><span class="fa fa-eye"></span></a></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                    </table>
                </div>

                              <div class="text-center botones-formulario col-md-12">                           
                                <a href="../reportes/pacientes/reportehistorial.php?cedula=<?php echo $p['ced_paciente']; ?>" target="_blank" id="Imprimir en PDF" name="guardar" class="btn btn-lca" style="" title="Exportar PDF">
                                    <img src="../public/multimedia/pdf.png">
                                </a>
                                <a href="../reportes/pacientes/exphistorial.php?cedula=<?php echo $p['ced_paciente']; ?>" id="Imprimir en Excel" class="btn btn-lca" name="guardar" style="" title="Exportar EXCEL">
                                   <img src="../public/multimedia/icon.png">
                                </a>
                                <a href="pacientes.php" class="btn btn-lca" title="regresar">
                                    <i class="fa fa-undo"></i>
                                </a>
                            </div>   

            </div>
        </div>
    </div>

      <div class="modal fade modal-view" id="verconsulta">
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
                                  <div class="col-md-12 text-center">
                                  <a href="#" class="btn btn-default btn-lg">Impimir</a>
                                </div>
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
<script type="text/javascript">
    var vercita = function(cedula, nombre,especialidad, doctor, fecha, consulta , tratamiento,diagnostico, indicaciones,insumos) {
       var longitud = insumos.length;
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