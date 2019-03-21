<?php 
require_once("header.php");
$id=$_GET['id'];
$sql2="SELECT * FROM doctores WHERE id_doctor='$id'";
$result2=$con->query($sql2);
$row2=$result2->fetch_assoc();
?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
 <div class="container">
            <span class="breadcoumb"> Doctores <i class="fa fa-caret-right"></i> Editar doctor</span>
        </div>
    </div>
        <div class="row">
        	<div class="col-xs-12 col-xs-offset-">
        
             <div id="mensajes"></div>
        		<div class="panel panel-default" style="margin-top:20px;">
        			<div class="panel-heading" style="">
        				<center><h3>Modificar Doctor</h3></center>
        			</div>
                    
        			<div class="panel-body">
                <form action="" id="form_doctor">
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="nombre">Cedula: <span style="color: red;">*</span></label>
                                <input type="text" name="cedula" id="cedula" placeholder="Ejemp: 123456"  maxlength="12" readonly class="form-control" value="<?php echo $row2['nac_doctor'].$row2['ced_doctor']; ?>">
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="nombre">Nombres: <span style="color: red;">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" maxlength="20" onkeypress="return validar_saltos(event)" placeholder="Ejemp: Leonardo Eduardo" value="<?php echo $row2['nombres']; ?>">
                            </div>     
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="apellido">Apellidos: <span style="color: red;">*</span></label>
                                <input type="text" name="apellido" id="apellido" class="form-control" maxlength="20" onkeypress="return validar_saltos(event)" placeholder="Ejemp:Romero Padron" value="<?php echo $row2['apellidos']; ?>">
                            </div>     
                            
                             <div class="form-group col-md-6 col-sm-12">
                                <label for="password">Sexo: <span style="color: red;">*</span></label>
                                <select id="sexo" name="sexo" class="form-control">
                                    <option value="">Seleccione el sexo del doctor</option>
                                     <option value="Masculino"<?php if($row2['sexo']=='Masculino')echo 'selected'; ?>>Masculino</option>
                                      <option value="Femenino" <?php if($row2['sexo']=='Femenino')echo 'selected'; ?>>Femenino</option>
                                </select>
                            </div> 

                               <div class="form-group col-md-4 col-sm-12">
                                 <label for="">Telefono: <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="telefono" name="telefono" maxlength="15"  placeholder="Ejemp: 0000-0000000" value="<?php echo $row2['telefono']; ?>">
                                </div>

                                 <div class="form-group col-md-4 col-sm-12">
                                 <label for="">Correo:</label>
                                <input type="text" class="form-control" id="correo" name="correo"  placeholder="ejm: example@gmail.com" value="<?php echo $row2['correo']; ?>">
                                </div>
                                
                           
                            

                            <div class="form-group col-md-4 col-sm-12">
                                 <label for="">Status: <span style="color: red;">*</span></label>
                                <select name="status" class="form-control" id="">
                                  <option value="Activo"<?php if($row2['status']==='Activo') echo 'selected'; ?>>Activo</option>
                                  <option value="Inactivo" <?php if($row2['status']==='Inactivo') echo 'selected'; ?>>Inactivo</option>
                                </select>
                            </div>

                             <div class="form-group col-sm-12">
                                 <label for="">Dirección:</label>
                                  <textarea name="direccion" id="direccion" maxlength="100" cols="30" rows="2" class="form-control"><?php echo $row2['direccion']; ?></textarea>
                              </div>

                           
                           <div class="text-center botones-formulario">                           
                                <button type="submit" id="guardar" name="guardar" class="btn btn-lca" style="">
                                    <i class="fa fa-save" title="Guardar"></i>
                                </button>
                              <input type="hidden" name="id_doctor" value="<?php echo $id ?>">
                                <a href="doctores.php" class="btn btn-lca" title="Regresar">
                                    <i class="fa fa-undo"></i>
                                </a>
                            </div>   
                            <div class="text-center col-xs-12"><h5><strong>Complete los campos requeridos <span style="color: red;">*</span></strong></h5></div>                     
                        </form>
              </div>
        		</div>
        	</div>
       
</div>



</div>
 <?php require_once("footer.php"); ?>
<script src="<?php echo SERVERURL; ?>public/js/doctores/updatedoctor.js"></script>
<script>
$(document).ready(function(){
  $('#telefono').mask('9999-9999999');
});
</script>