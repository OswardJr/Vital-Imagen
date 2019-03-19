<?php 
require_once("header.php");
?>
<?php 
require_once("../config/conexion.php");
$cedula=$_GET['cedula'];
$sql="SELECT * FROM pacientes WHERE ced_paciente='$cedula'";
$result=$con->query($sql);
$rows= mysqli_fetch_assoc($result);
$nfecha=explode('-',$rows['fecha_nacimiento']);
$fecha = "{$nfecha[2]}/{$nfecha[1]}/{$nfecha[0]}";
$ubicacione=$con->query("SELECT * FROM pacientes INNER JOIN ciudades ON pacientes.id_ciudad=ciudades.id_ciudad INNER JOIN estados ON estados.id_estado=ciudades.id_estado WHERE pacientes.ced_paciente='$cedula'");
$e=mysqli_fetch_assoc($ubicacione);
$ubicacionm=$con->query("SELECT * FROM pacientes INNER JOIN parroquias ON pacientes.id_parroquia=parroquias.id_parroquia INNER JOIN municipios ON parroquias.id_municipio=municipios.id_municipio INNER JOIN estados ON estados.id_estado=municipios.id_estado WHERE pacientes.ced_paciente='$cedula'");
$m=mysqli_fetch_assoc($ubicacionm);
?>

 <div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
             <h4>Nuevo Paciente</h4>
           <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Pacientes <i class="fa fa-caret-right"></i>Editar Paciente</span>
        </div>
    </div>
        <div class="row" style="margin-top:10px;">
          
            <div class="col-xs-12 col-xs-offset-">
              <div id="mensajes"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><h4>Modificar Paciente</h4></center>
                    </div>
                    <div class="panel-body">
                        <form  id="form_paciente">
                           <div class="row">
                           <div class="form-group col-xs-4" id="marcado">
                              <label for="">Cedula <span style="color: red;">*</span></label>
                               <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cedula " required pattern="[a-zA-Z]{1}\d[0-9]*" title="V24924739" minlength="3" maxlength="12" readonly value="<?php echo $rows['ced_paciente']; ?>">
                           </div>

                            <div class="form-group col-xs-4">
                              <label for="">Nombre <span style="color: red;">*</span></label>
                               <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombre" required pattern="[a-zA-Z]*" title="Solo letras" value="<?php echo $rows['nombres']; ?>">
                           </div>

                            <div class="form-group col-xs-4">
                               <label for="">Apellido <span style="color: red;">*</span></label>
                               <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellido" required pattern="[a-zA-Z]*" title="Solo letras" minlength="3" maxlength="20" value="<?php echo $rows['apellidos']; ?>">
                           </div>
                         </div>

                           <div class="form-group col-xs-4">
                           <label for="">Sexo <span style="color: red;">*</span></label>
                           <select name="sexo" id="sexo" class="form-control" required>
                             <option value="">Seleccione el sexo:</option>
                             <option value="Masculino" <?php if($rows['sexo']=='Masculino')echo 'selected'; ?>>Masculino</option>
                             <option value="Femenino" <?php if($rows['sexo']=='Femenino')echo 'selected'; ?>>Femenino</option>
                           </select>
                            </label>

                           </div>

                         
                           <div class="form-group col-xs-4">
                            <label for="">Fecha de nacimiento <span style="color: red;">*</span></label>
                               <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento" required pattern="\d{2}\/\d{2}\/\d{4}" title="dd/mm/yyyy" value="<?php echo $fecha ?>">
                           </div>
                              
                              <input type="hidden" id="edad" name="edad" value="<?php echo $row['edad']; ?>">              

                            <div class="form-group col-xs-4">
                               <label for="">Teléfono <span style="color: red;">*</span></label>
                               <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" required pattern="\d{4}-\d[0-9]*" title="0416-2415105" maxlength="15" value="<?php echo $rows['telefono']; ?>">
                           </div>

                            <div class="form-group col-xs-4">
                             <label for="">Estado <span style="color: red;">*</span></label>
                             <?php 
                             require("../config/conexion.php");
                             $estados=$con->query("SELECT * FROM estados");?>
                               <select name="estado" id="estado" class="form-control" required>
                                
                                <option value="">----------------------------------------------</option>
                                <?php while($row=mysqli_fetch_assoc($estados)){ ?>
                                <option value="<?php echo $row['id_estado']; ?>" <?php if($row['estado']===$e['estado']) echo 'selected'; ?> ><?php echo $row['estado']; ?></option>
                                <?php } ?>
                               </select>
                           </div>

                               <div class="form-group col-xs-4">
                                 <label for="">Ciudad <span style="color: red;">*</span></label>
                                   <select class="form-control" id="ciudad" name="ciudad" required>
                                  <?php $ciudad=$con->query("SELECT * FROM ciudades INNER JOIN estados ON ciudades.id_estado=estados.id_estado WHERE estados.estado='Aragua'"); 
                                    while($c=mysqli_fetch_array($ciudad)){
                                  ?>
                                  <option value="<?php echo $c['id_ciudad'];?>"<?php if($c['id_ciudad']===$e['id_ciudad']) echo 'selected'; ?>><?php echo $c['ciudad']; ?></option>
                                  <?php } ?>
                                  </select>
                               </div>

                                 <div class="form-group col-xs-4">
                                  <label for="">Municipio <span style="color: red;">*</span></label>
                                   <select class="form-control" id="municipio" name="municipio" required>
                                  <?php 
                                  $municipio=$con->query("SELECT * FROM municipios INNER JOIN estados ON municipios.id_estado=estados.id_estado WHERE estados.estado='Aragua'");
                                  while($mi=mysqli_fetch_array($municipio)){
                                   ?>
                                  }
                                  <option value="<?php echo $m['id_municipio']; ?>" <?php if($mi['id_municipio']===$m['id_municipio']) echo 'selected'; ?>><?php echo $mi['municipio']; ?></option>
                                  <?php } ?>
                                  </select>
                               </div>
                             <div class="form-group col-xs-6">
                               <label for="">Parroquia <span style="color: red;">*</span></label>
                               <select class="form-control" id="parroquia" name="parroquia" required>
                              <?php 
                                $parroquia=$con->query("SELECT * FROM parroquias INNER JOIN municipios ON parroquias.id_municipio=municipios.id_municipio WHERE municipios.municipio='José Félix Ribas'");
                                while($pi=mysqli_fetch_array($parroquia)){
                               ?>
                               <option value="<?php echo $pi['id_parroquia']; ?>" <?php if($pi['id_parroquia']===$m['id_parroquia']) echo 'selected'; ?>><?php echo $pi['parroquia']; ?></option>
                               <?php } ?>
                            </select>
                           </div>
                            <div class="form-group col-xs-6">
                             <label for="">Dirección <span style="color: red;">*</span></label>
                             <textarea name="direccion" id="direccion" cols="80" rows="80" class="form-control" required  pattern="[a-zA-Z#]*" title="Solo numeros,letras y #" minlength="3" maxlength="50"><?php echo $rows['direccion']; ?></textarea>
                           </div>
                          
                                                                               
                             <div class="form-group col-xs-6" id="res">
                             <label for="">Responsable <span style="color: red;">*</span></label>
                              <input type="" class="form-control" name="responsable"  id="responsable" placeholder="Referente del paciente" required pattern="[a-zA-Z]*" title="Solo letras" minlength="3" maxlength="20" value="<?php echo $rows['responsable']; ?>">
                           </div>

                            <div class="form-group col-xs-6" id="res">
                             <label for="">Status<span style="color: red;">*</span></label>
                              <select name="status" class="form-control" id="">
                                <option value="Activo"<?php if($rows['status']==='Activo') echo 'selected'; ?>>Activo</option>
                                <option value="Inactivo" <?php if($rows['status']==='Inactivo') echo 'selected'; ?>>Inactivo</option>
                              </select>
                           </div>
                         
                            <div class="text-center botones-formulario">                           
                                <button type="submit" id="guardar" name="guardar" class="btn btn-lca" style="" title="Guardar">
                                    <i class="fa fa-save"></i>
                                </button>
                                <a href="pacientes.php" class="btn btn-lca" title="regresar">
                                    <i class="fa fa-undo"></i>
                                </a>
                            </div>   
                            <div class="form-group col-xs-12 text-center"><h5><strong>Complete los campos requeridos <span style="color: red;">*</span> </strong></h5></div>                   
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
</div>
 <?php require_once("footer.php"); ?>
<script src="../public/js/buscar_cedula.js"></script>
<script src="../public/js/calculo_edad.js"></script>
<script>
  $(document).ready(function(){
    var d=new Date();
    $('#fecha_nacimiento').datepicker({
     changeMonth: true,
      changeYear: true,
      maxDate:d
    });
  });
</script>
<script src="../public/js/cargar_ubicacion.js"></script>
<script src="../public/js/datepicker-es.js"></script>
<script src="../public/js/pacientes/editarpaciente.js"></script>