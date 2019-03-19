<?php
require_once("header.php");
 ?>

<div class="page-content">


    <div class="container-fluid">
           <div class="bread-content">
            <div class="container">
                <h4>Presupuestos</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Presupuestos</span>
            </div>
        </div>
        <div class="row" style="">
        	<div class="col-xs-12 col-xs-offset-">
             
            <div class="" style="">
               
        		<a href="nuevopresupuesto.php" class="btn btn-lca nuevo  col-xs-offset"><span class="fa fa-line-chart"></span> Nuevo Presupuesto</a>
                </div>
        		<div class="panel panel-default" id="oculto" style="">
        			<div class="panel-heading">
        				<center><h3 style="">Presupuestos Asignados</h3></center>
        			</div>
        			<?php
        			require_once("../config/conexion.php");
        			$sql="SELECT * FROM presupuestos INNER JOIN pacientes ON pacientes.ced_paciente = presupuestos.ced_paciente WHERE presupuestos.status='Activo'";
                    $result=$con->query($sql);
        			 ?>
        			<div class="panel-body" id="">
                     <div class="table-responsive">
        				<table id="tabla" class=" table display">
        					<thead>
        						<th>Nro Presupuesto</th>
        						<th>Cedula</th>
                                <th>Nombre</th>
        						<th>Tipo de Intervencion</th>
                                <th>Fecha</th>
                                <th>Ver/Editar/Eliminar</th>
        					</thead>
        					<tbody id="content">
                            <?php while($row = mysqli_fetch_assoc($result)){ 
                               
                                ?>
        						<tr>
                                    <td><?php echo $row['nro_presupuesto'];  ?></td>
        							<td><?php echo $row['ced_paciente'];  ?></td>
        							<td><?php echo $row['nombres']; ?></td>
                                      <td><?php echo $row['tipo_intervencion']; ?></td>
                                        <td><?php echo $row['fecha_presupuesto']; ?></td>
        							<td><a href="#" data-target="#verpresupuesto" data-toggle="modal" onclick="verpresupuesto('<?php echo $row['nro_presupuesto']; ?>',
                            '<?php echo $row['ced_paciente'] ?>',
                            '<?php echo $row['nombres']; ?>',
                            '<?php echo $row['tipo_intervencion']; ?>');" class="btn btn-info" style=""><span class="fa fa-eye" style=""></span></a> <a href="editarpresupuesto.php?id=<?php echo $row['nro_presupuesto']; ?>" class="btn btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_presupuesto('<?php echo $row['nro_presupuesto']; ?>');" class="btn btn-danger"><span class="fa fa-trash"></span></a> <a href="../reportes/presupuestos/presupuestos.php?id=<?php echo $row['nro_presupuesto']; ?>" title="PDF" target="_blank"><img src="../public/multimedia/pdf.png" alt="Exportar PDF"></a> </td>
        						</tr>
        					<?php } ?>
        					</tbody>
        				</table>
                        </div>
        			</div>
        		</div>
        	</div>
        </div>
</div>
    <div class="modal fade modal-view" id="verpresupuesto">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver presupuesto</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/presupuesto.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_nro"></li>
                           <li class="list-group-item" id="ver_cedula"></li>
                            <li class="list-group-item" id="ver_nombre"></li>
                            <li class="list-group-item" id="ver_apellido"></li>
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
    var verpresupuesto = function(nro_presupuesto,cedula,nombre,apellido) {
         $('#ver_nro').html('<b>Nro del Presupuesto : </b>0000' + nro_presupuesto);
        $('#ver_cedula').html('<b>Nombre del paciente : </b>' + cedula);
        $('#ver_nombre').html('<b>Apellido del paciente : </b>' + nombre);
        $('#ver_apellido').html('<b>Fecha del presupuesto : </b>' + apellido);
      
    };           
     
  function eliminar_presupuesto(id){
        
  swal({
  title: 'Eliminar registro',
  text: "¿Desea eliminar este registro?",
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
                url:"presupuestos/deletepresupuesto.php",
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