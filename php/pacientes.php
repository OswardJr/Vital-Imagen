<?php 
require_once("header.php");
 ?>

<div class="page-content">
    <div class="container-fluid">
        <div class="bread-content">
 <div class="container">
            <h3>Pacientes</h3>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Pacientes </span>
        </div>
    </div>
     <div id="content"></div>
        <div class="row" style="">
        	<div class="col-xs-12 col-xs-offset-">
        		
                <?php 
                    require_once("../config/conexion.php");
                    $sql="SELECT * FROM pacientes ORDER BY nro_historia ASC limit 10";
                    $result=$con->query($sql);
                    $pacientes=mysqli_num_rows($result);
                    if($pacientes>0){
                     ?>
                     <a href="nuevopaciente.php" class="btn btn-lca nuevo" style=""><span class="fa fa-user-plus"></span> Nuevo Paciente</a>

                        <a href="../reportes/pacientes/reportepacientes.php" style="margin-right:15px;" target="_blank"><img style="width: 40px;" src="../public/multimedia/pdf.png" class="col-xs-offset-8" title="Exportar PDF"></a>
                         <a href="../reportes/pacientes/expacientes.php"><img style="width: 40px;" src="../public/multimedia/icon.png" class="btn btn-lca" title="Exportar Excel"></a>
                    
        		<div class="panel panel-default panel-lista">
        			<div class="panel-heading">
        				<h4 style="">Pacientes</h4>
        			</div>

        			<div class="panel-body">
                        <div class="table-responsive">
        				<table id="tabla" class="table display">
        					<thead>
        						<th>Nombre</th>
        						<th>Dirección</th>
        						<th>Teléfono</th>
                                <th>Edad</th>
                                <th>Estado</th>
        						<th>Operaciones</th>
        					</thead>
        					<tbody id="content">
        					<?php while($row=mysqli_fetch_assoc($result)){ 
                                 $fecha=$row['fecha_nacimiento'];

                            ?>
        						<tr>
        							<td><?php echo $row['nombres']; ?></td>
        							<td><?php echo $row['direccion']; ?></td>
        							<td><?php echo $row['telefono']; ?></td>
                                    <td><?php echo $row['edad']; ?></td>
                                     <td><center><?php if($row['status']==='Activo'){ ?><button style="" title="Activo" type="button" class="btn btn-success" ><i class="fa fa-chevron-up"></i></button>
                                <?php }else{ ?>
                                    <button type="button" title="Inactivo" class="btn btn-danger" ><i class="fa fa-chevron-down"></i></button><?php } ?>
                                    </center></td>
        							<td><a title="Ver datos del paciente" href="#" data-target="#verpaciente" data-toggle="modal" onclick="verpaciente('<?php echo $row['ced_paciente']; ?>','<?php echo $row['nombres']; ?>','<?php echo $row['apellidos']; ?>','<?php echo $row['sexo']; ?>','<?php echo str_replace('-', '/', date('d-m-Y',strtotime($fecha)));?>','<?php echo $row['edad']; ?>','<?php echo $row['telefono']; ?>','<?php echo $row['direccion']; ?>','<?php echo $row['responsable']; ?>');" class="btn btn-info" style=""><span class="fa fa-eye" style=""></span></a> <a title="Editar paciente" href="editarpaciente.php?cedula=<?php echo $row['ced_paciente']; ?>" class="btn btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_paciente('<?php echo $row['ced_paciente']; ?>');" class="btn btn-danger" title="Eliminar paciente" ><span class="fa fa-trash"></span></a> <a href="historial.php?idhistorial=<?php echo $row['ced_paciente']; ?>" class="btn btn-primary"><i class="fa fa-address-book" title="Historial"></i></a></td>
        						</tr>
        						<?php } ?>
        					</tbody>
        				</table>
                        </div>
                   
        			</div>
        		</div>
                <?php }else{?>
             <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay pacientes registrados</h3>
                             <a href="nuevopaciente.php" style="" class="btn btn-lca"><i class="fa fa-user-plus"></i> Registrar paciente</a></center>
                            <br>
                        </div>
                <?php } ?>
        	</div>
        </div>
</div>
<div class="modal fade modal-view" id="verpaciente">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver paciente</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/icon-medicina.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_cedula"></li>
                            <li class="list-group-item" id="ver_nombre"></li>
                            <li class="list-group-item" id="ver_apellidos"></li>
                            <li class="list-group-item" id="ver_sexo"></li>
                            <li class="list-group-item" id="ver_fechanacimiento"></li>
                            <li class="list-group-item" id="ver_edad"></li>
                            <li class="list-group-item" id="ver_telefono"></li>
                            <li class="list-group-item" id="ver_direccion"></li>
                            <li class="list-group-item" id="ver_responsable"></li>
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
    var verpaciente = function(cedula,nombres,apellidos,sexo, fechaNac,edad, telefono, direccion, responsable) {
        $('#ver_cedula').html('<b>Cedula : </b>' + cedula);
        $('#ver_nombre').html('<b>Nombres : </b>' + nombres);
        $('#ver_apellidos').html('<b>Apellidos : </b>' + apellidos);
        $('#ver_sexo').html('<b>Sexo : </b>' + sexo);
        $('#ver_fechanacimiento').html('<b>Fecha de nacimiento : </b>' + fechaNac);
        $('#ver_edad').html('<b>Edad : </b>' + edad);
        $('#ver_telefono').html('<b>Telefono : </b>' + telefono);
        $('#ver_direccion').html('<b>Direccion : </b>' + direccion);
        $('#ver_responsable').html('<b>Responsable : </b>' + responsable);
    };  
      
      
  function eliminar_paciente(cedula){
        
  swal({
  title: 'Eliminar paciente',
  text: "¿Desea eliminar este paciente?",
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
                url:"pacientes/delete.php",
                type:"POST",
                data: 'cedula='+cedula,
                success:function(respuesta){
                    $('#content').html(respuesta);
                }
            });
            return true;    
}, function (dismiss) {
})

}



 </script>