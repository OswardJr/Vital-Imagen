<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Doctores</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control<i class="fa fa-caret-right"></i> Doctores</span>
        </div>
    </div>
        <div class="row" style="">
        	<div class="col-xs-12 col-xs-offset-">
          
                    <?php 
                    require_once("../config/conexion.php");
                    $sql="SELECT d.*,e.nombre_especialidad FROM doctores AS d INNER JOIN especialidades AS e ON d.id_especialidad=e.id_especialidad";
                    $result=$con->query($sql);
                    $especialidades=$con->query("SELECT * FROM especialidades WHERE status='activo'");
                    $e=mysqli_num_rows($especialidades);
                    $d=mysqli_num_rows($result);
                    if($e>0){
                    if($d>0){
                     ?>
        		<a href="nuevodoctor.php" class="btn btn-lca nuevo" style=""><span class="fa fa-user-plus"></span> Agregar Doctor</a>

                 <a href="../reportes/doctores/reportedoctores.php" style="margin-right:15px;" target="_blank"><img style="width: 40px;" src="../public/multimedia/pdf.png" class="col-xs-offset-8" title="Exportar PDF"></a>
                         <a href="../reportes/doctores/exdoctores.php"><img style="width: 40px;" src="../public/multimedia/icon.png" class="btn btn-lca" title="Exportar Excel"></a>

        		<div class="panel panel-default" style="">
        			<div class="panel-heading">
        				<center><h3>Doctores</h3></center>
        			</div>
        		
                    <div id="content"></div>
        			<div class="panel-body">
                     <div class="table-responsive">
        				<table id="tabla" class=" table display">
        					<thead>
        						<th>Cedula</th>
        						<th>Nombre</th>
        						<th>Apellido</th>
        						<th>Especialidad</th>
                                <th>Status</th>
        						<th>Operaciones</th>
        					</thead>
        					<tbody id="content">
        					<?php while($row=mysqli_fetch_array($result)){ ?>
        						<tr>
        							<td><?php echo $row['cedula']; ?></td>
        							<td><?php echo $row['nombre']; ?></td>
        							<td><?php echo $row['apellido'] ?></td>
        							<td><?php echo $row['nombre_especialidad']; ?></td>
                                    <td><center><?php if($row['status']==='Activo'){ ?><button style="" title="Activo" type="button" class="btn btn-success" ><i class="fa fa-chevron-up"></i></button>
                                    <?php }else{ ?>
                                    <button type="button" title="Inactivo" class="btn btn-danger" ><i class="fa fa-chevron-down"></i></button><?php } ?>
                                    </center></td>
        							<td><a href="#" data-target="#verdoctor" data-toggle="modal" onclick="verdoctor('<?php echo $row['cedula']; ?>','<?php echo $row['nombre']; ?>','<?php echo $row['apellido']; ?>','<?php echo $row['sexo']; ?>','<?php echo $row['nombre_especialidad']; ?>','<?php echo $row['telefono']; ?>','<?php echo $row['correo']; ?>','<?php echo $row['direccion'];?>');" class="btn  btn-info" ><span class="fa fa-eye" style=""></span></a> <a href="editardoctor.php?id=<?php echo $row['id_doctor']; ?>" class="btn  btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_doctor('<?php echo $row['id_doctor']; ?>');" class="btn  btn-danger"><span class="fa fa-trash"></span></a></td>
        						</tr>
        						<?php } ?>
        					</tbody>
        				</table>
                        </div>
        			</div>
        		</div>
                <?php }else{ ?>
                <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay doctores registrados</h3>
                             <a href="nuevodoctor.php" style="" class="btn btn-lca"><i class="fa fa-user-plus"></i> Registrar Doctores</a></center>
                            <br>
                        </div>
                <?php } ?>
                <?php }else{ ?>
                     <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay Areas medicas registradas registradas por ende no puede registrar doctores</h3>
                             <a href="nuevaespecialidad.php" style="" class="btn btn-lca"><i class="fa fa-user-plus"></i> Registrar Especialidad</a></center>
                            <br>
                        </div>
                <?php } ?>
        	</div>


    
  </div>
</div>
    <div class="modal fade modal-view" id="verdoctor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver doctor</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/Login-avatar.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                           <li class="list-group-item" id="ver_cedula"></li>
                            <li class="list-group-item" id="ver_nombre"></li>
                            <li class="list-group-item" id="ver_apellido"></li>
                            <li class="list-group-item" id="ver_sexo"></li>
                            <li class="list-group-item" id="ver_especialidad"></li>
                            <li class="list-group-item" id="ver_telefono"></li>
                            <li class="list-group-item" id="ver_correo"></li>
                            <li class="list-group-item" id="ver_direccion"></li>
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
  var verdoctor = function(cedula,nombre,apellido,sexo,especialidad,telefono,correo,direccion) {
        $('#ver_cedula').html('<b>Cedula : </b>' + cedula);
        $('#ver_nombre').html('<b>Nombre : </b>' + nombre);
        $('#ver_apellido').html('<b>Apellido : </b>' + apellido);
         $('#ver_sexo').html('<b>Sexo : </b>' + sexo);
        $('#ver_especialidad').html('<b>Especialidad : </b>' + especialidad);
        $('#ver_telefono').html('<b>Telefono : </b>' + telefono);
        $('#ver_correo').html('<b>Correo : </b>' + correo);
        $('#ver_direccion').html('<b>Direccion : </b>' + direccion);


    };      
      
  function eliminar_doctor(id){
        
  swal({
  title: 'Eliminar doctor',
  text: "¿Desea eliminar este doctor?",
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
                url:"doctores/deletedoctor.php",
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