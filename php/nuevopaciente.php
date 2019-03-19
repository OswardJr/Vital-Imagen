<?php 
require_once("header.php");
if(isset($_GET['ced']) && !empty([$_GET['ced']])){
    $cedulaIngresada = $_GET['ced'];
}
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
          <h4>Nuevo Paciente</h4>
           <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Pacientes <i class="fa fa-caret-right"></i> Nuevo Paciente</span>
        </div>
    </div>
        <div class="row" style="margin-top:15px;">
          
            <div class="col-xs-12 col-xs-offset-">
              <div id="mensajes"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Registro Paciente</h3>
                    </div>
                    <div class="panel-body">
                        <form  id="form_paciente">
                           <div class="row">
                            
                           <div class="form-group col-md-4" id="marcado">
                              <label for="">Cedula <span style="color: red;">*</span></label>
                                 <div class="input-group form-flex" style="">
                                <div class="input-group-btn">
                                 <select name="nacionalidad" id="nacionalidad" class="form-control">
                                <option value="V">V</option>
                                <option value="E">E</option>
                                </select>
                                </div>
                                 <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Ingrese Cedula " required pattern="[a-zA-Z]{1}\d[0-9]*" title="V24924739" minlength="3" maxlength="12" value="<?php if(isset($_GET['ced']) && !empty([$_GET['ced']])){ echo $cedulaIngresada;} ?>">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" title="Verificar cedula"  type="button" id="buscar"><span class="fa fa-search" style=""></span></button>
                               </div>
                           </div>

                            <div class="form-group col-md-4">
                              <label for="">Nombre <span style="color: red;">*</span></label>
                               <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Nombre" required pattern="[a-zA-Z]*" title="Solo letras">
                           </div>

                            <div class="form-group col-md-4">
                               <label for="">Apellido <span style="color: red;">*</span></label>
                               <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellido" required pattern="[a-zA-Z]*" title="Solo letras" minlength="3" maxlength="20">
                           </div>
                         </div>

                           <div class="form-group col-md-4">
                           <label for="">Sexo <span style="color: red;">*</span></label>
                           <select name="sexo" id="sexo" class="form-control" required>
                             <option value="">Seleccione el sexo:</option>
                             <option value="Masculino">Masculino</option>
                             <option value="Femenino">Femenino</option>
                           </select>
                            </label>

                           </div>

                         
                           <div class="form-group col-md-4">
                            <label for="">Fecha de nacimiento <span style="color: red;">*</span></label>
                               <input type="text" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" placeholder="Fecha de nacimiento" required pattern="\d{2}\/\d{2}\/\d{4}" title="dd/mm/yyyy">
                           </div>
                              
                              <input type="hidden" id="edad" name="edad">              

                            <div class="form-group col-md-4">
                               <label for="">Teléfono <span style="color: red;">*</span></label>
                               <input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" required pattern="\d{4}-\d[0-9]*" title="0416-2415105" maxlength="15">
                           </div>

                            <div class="form-group col-md-4">
                             <label for="">Estado <span style="color: red;">*</span></label>
                             <?php 
                             require("../config/conexion.php");
                             $estados=$con->query("SELECT * FROM estados");?>
                               <select name="estado" id="estado" class="form-control" required>
                                <option value="">Seleccione el estado</option>
                                <?php while($row=mysqli_fetch_assoc($estados)){ ?>
                                <option value="<?php echo $row['id_estado']; ?>" <?php if($row['estado']==='Aragua') echo 'selected'; ?>><?php echo $row['estado']; ?></option>
                                <?php } ?>
                               </select>
                           </div>

                               <div class="form-group col-md-4">
                                <?php $ciudad=$con->query("SELECT * FROM ciudades INNER JOIN estados ON ciudades.id_estado=estados.id_estado WHERE estado='Aragua'"); ?>
                                 <label for="">Ciudad <span style="color: red;">*</span></label>
                                   <select class="form-control" id="ciudad" name="ciudad" required>
                                  <option value="">Seleccione la ciudad</option>
                                  <?php while($row2=mysqli_fetch_assoc($ciudad)){ ?>
                                  <option value="<?php echo $row2['id_ciudad']; ?>" <?php if($row2['ciudad']==='La Victoria') echo 'selected'; ?>><?php echo $row2['ciudad']; ?></option>
                                  <?php } ?>
                                  </select>
                               </div>

                                 <div class="form-group col-md-4">
                                  <?php $municipio=$con->query("SELECT * FROM municipios INNER JOIN estados ON municipios.id_estado=estados.id_estado WHERE estados.estado='Aragua'"); ?>
                                  <label for="">Municipio <span style="color: red;">*</span></label>
                                   <select class="form-control" id="municipio" name="municipio" required>
                                  <option value="">Seleccione el municipio</option>
                                  <?php while($row3=mysqli_fetch_assoc($municipio)){ ?>
                                  <option value="<?php echo $row3['id_municipio']; ?>" <?php if($row3['municipio']==='José Félix Ribas') echo 'selected'; ?> ><?php echo $row3['municipio']; ?></option>
                                  <?php } ?>
                                  </select>
                               </div>
                             <div class="form-group col-md-4">
                              <?php $parroquia=$con->query("SELECT * FROM parroquias INNER JOIN municipios ON municipios.id_municipio=parroquias.id_municipio WHERE municipios.municipio='José Félix Ribas'"); ?>
                               <label for="">Parroquia <span style="color: red;">*</span></label>
                               <select class="form-control" id="parroquia" name="parroquia" required>
                              <option value="">Seleccione la Parroquia</option>
                              <?php while($row4=mysqli_fetch_assoc($parroquia)){ ?>
                              <option value="<?php echo $row4['id_parroquia']; ?>" <?php if($row4['parroquia']==='José Félix Ribas') echo 'selected'; ?> ><?php echo $row4['parroquia']; ?></option>
                              <?php } ?>
                            </select>
                           </div>
                            <div class="form-group col-md-4">
                             <label for="">Dirección <span style="color: red;">*</span></label>
                             <textarea name="direccion" id="direccion"  rows="50" class="form-control" required  pattern="[a-zA-Z#]*" title="Solo numeros,letras y #" minlength="3" maxlength="50"></textarea>
                           </div>
                          
                                                                               
                             <div class="form-group col-md-4" id="res">
                             <label for="">Responsable <span style="color: red;">*</span></label>
                              <input type="" class="form-control" name="responsable"  id="responsable" placeholder="Referente del paciente" required pattern="[a-zA-Z]*" title="Solo letras" minlength="3" maxlength="20">
                           </div>
                         
                            <div class="text-center botones-formulario col-xs-12">                           
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
<script src="../public/js/pacientes/nuevopaciente.js"></script>