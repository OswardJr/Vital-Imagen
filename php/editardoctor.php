<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
 <div class="container">
            <h4>Editar doctor</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Doctores <i class="fa fa-caret-right"></i> Editar doctor</span>
        </div>
    </div>
        <div class="row">
        	<div class="col-xs-12 col-xs-offset-">
        
             <div id="mensajes"></div>
        		<div class="panel panel-default" style="margin-top:20px;">
        			<div class="panel-heading" style="">
        				<center><h3>Modificar Doctor</h3></center>
        			</div>
                       <?php require_once("../config/conexion.php");
                       $id=$_GET['id'];
                                $sql="SELECT * FROM especialidades";
                                $result=$con->query($sql);
                                $sql2="SELECT d.*,e.nombre_especialidad FROM doctores AS d INNER JOIN especialidades AS e ON d.id_especialidad=e.id_especialidad WHERE id_doctor='$id'";
                                $result2=$con->query($sql2);
                                $row2=$result2->fetch_assoc();
                                 ?>
        			<div class="panel-body">
                <form action="" id="form_doctor">
                            <div class="form-group col-md-4">
                                <label for="nombre">Cedula <span style="color: red;">*</span></label>
                                <input type="text" name="cedula" id="cedula" class="form-control" placeholder=" ejm: V-24924739" readonly value="<?php echo $row2['cedula']; ?>">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre <span style="color: red;">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Leonardo" value="<?php echo $row2['nombre']; ?>">
                            </div>     
                            <div class="form-group col-md-4">
                                <label for="apellido">Apellido <span style="color: red;">*</span></label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Padron" value="<?php echo $row2['apellido']; ?>">
                            </div>     
                            
                             <div class="form-group col-md-4">
                                <label for="password">Sexo <span style="color: red;">*</span></label>
                                <select id="sexo" name="sexo" class="form-control">
                                    <option value="">Seleccione el sexo del doctor</option>
                                     <option value="Masculino"<?php if($row2['sexo']=='Masculino')echo 'selected'; ?>>Masculino</option>
                                      <option value="Femenino" <?php if($row2['sexo']=='Femenino')echo 'selected'; ?>>Femenino</option>
                                </select>
                            </div> 

                               <div class="form-group col-md-4">
                                 <label for="">Telefono <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="telefono" name="telefono"  placeholder="ejm: 0416-2415105" value="<?php echo $row2['telefono']; ?>">
                                </div>

                                 <div class="form-group col-md-4">
                                 <label for="">Correo</label>
                                <input type="text" class="form-control" id="correo" name="correo"  placeholder="ejm: example@gmail.com" value="<?php echo $row2['correo']; ?>">
                                </div>
                                 <div class="form-group col-md-6">
                                 <label for="">Dirección</label>
                                  <textarea name="direccion" id="direccion" cols="30" rows="10" class="form-control"><?php echo $row2['direccion']; ?></textarea>
                                </div>
                           
                             <div class="form-group col-md-6">
                                <label for="nombre">Especialidad <span style="color: red;">*</span></label>
                                <?php require_once("../config/conexion.php");
                                $sql="SELECT * FROM especialidades WHERE status='activo'";
                                $result=$con->query($sql);
                                 ?>
                               <select name="especialidad" id="especialidad" class="form-control">
                                <option value="">Seleccione la Especialidad</option>
                               <?php while($row=$result->fetch_assoc()){ ?>
                                   <option value="<?php echo $row['id_especialidad']; ?>"<?php if($row['id_especialidad']===$row2['id_especialidad']) echo 'selected'; ?>><?php echo $row['nombre_especialidad']; ?></option>
                                   <?php } ?>
                               </select>
                            </div>

                            <div class="form-group col-md-6">
                                 <label for="">Status <span style="color: red;">*</span></label>
                                <select name="status" class="form-control" id="">
                                  <option value="Activo"<?php if($row2['status']==='Activo') echo 'selected'; ?>>Activo</option>
                                  <option value="Inactivo" <?php if($row2['status']==='Inactivo') echo 'selected'; ?>>Inactivo</option>
                                </select>
                                </div>

                                <div class="form-group col-md-6">
                                 <label for="">Cantidad de Citas/Consultas</label>
                                  <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?php echo $row2['cantidad_citas']; ?>" min="1" max="10">
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
  <script src="../public/js/doctores/updatedoctor.js"></script>
 <script>
   $(document).ready(function(){
      $('#fecha_nacimiento').datepicker({
        changeMonth: true,
        changeYear: true
      });
   });
 </script>
 <script src="../public/js/datepicker-es.js"></script>