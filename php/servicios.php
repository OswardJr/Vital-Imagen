<?php 
require_once("header.php");
 ?>

<div class="page-content">
    <div class="container-fluid">
        <div class="bread-content">
 <div class="container">
            <h3>Servicios</h3>
        </div>
    </div>
     <div id="content"></div>
        <div class="row" style="">
        	<div class="col-xs-12 col-xs-offset-">
        		
                <?php 
                    require_once("../config/conexion.php");
                    $sql="SELECT * FROM servicios ORDER BY id_servicio DESC";
                    $result=$con->query($sql);
                    $servicios=mysqli_num_rows($result);
                    if($servicios>0){
                     ?>
                     <a href="nuevoservicio.php" class="btn btn-lca nuevo" style=""><span class="fa fa-user-plus"></span> Nuevo Sevicio</a>
                    
        		<div class="panel panel-default panel-lista">
        			<div class="panel-heading">
        				<h4 style="">Pacientes</h4>
        			</div>

        			<div class="panel-body">
                        <div class="table-responsive">
        				<table id="tabla" class="table display">
        					<thead>
        						<th>Nombres</th>
                    <th>Descripción</th>
                    <th>Status</th>
        						<th>Operaciones</th>
        					</thead>
        					<tbody id="content">
                <?php while($row=mysqli_fetch_assoc($result)){ ?>
        						<tr>
        							<td><?php echo $row['nombre_servicio']; ?></td>
        							<td><?php echo $row['descripcion']; ?></td>
                      <td><center><?php if($row['status']==='Activo'){ ?><button style="" title="Activo" type="button" class="btn btn-success" ><i class="fa fa-chevron-up"></i></button>
                        <?php }else{ ?>
                        <button type="button" title="Inactivo" class="btn btn-danger" ><i class="fa fa-chevron-down"></i></button><?php } ?>
                          </center></td>
        							<td><a title="Editar servicio" href="editarservicio.php?id=<?php echo $row['id_servicio']; ?>" class="btn btn-warning"><span class="fa fa-pencil-square-o"></span></a> <a href="javascript:eliminar_servicio('<?php echo $row['id_servicio']; ?>');" class="btn btn-danger" title="Eliminar paciente" ><span class="fa fa-trash"></span></a></td>
        						</tr>
        						<?php } ?>
        					</tbody>
        				</table>
                  </div> 
        			</div>
        		</div>
                <?php }else{?>
             <div class="container-fluid" style="margin-bottom:360px;">
                            <center><h3><i class="fa fa-exclamation-triangle"></i> No hay servicios registrados</h3>
                             <a href="nuevoservicio.php" style="" class="btn btn-lca"><i class="fa fa-user-plus"></i> Registrar servicio</a></center>
                            <br>
                        </div>
                <?php } ?>
        	</div>
        </div>
</div>

</div>
 <?php require_once("footer.php"); ?>

  <script> 
  function eliminar_servicio(id){
        
  swal({
  title: 'Eliminar servicio',
  text: "¿Desea eliminar este servicio?",
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
                url:"sericios/deleteservicio.php",
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