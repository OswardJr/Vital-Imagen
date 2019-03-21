<?php 
require_once("header.php");
$estados=$con->query("SELECT * FROM estados");
if(isset($_GET['ced']) && !empty([$_GET['ced']])){
    $cedulaIngresada = $_GET['ced'];
}
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
           <span class="breadcoumb"><a href="pacientes.php">Pacientes</a> <i class="fa fa-caret-right"></i> Nuevo Paciente</span>
        </div>
    </div>
        <div class="row" style="margin-top:15px;">
          
            <div class="col-xs-12 col-xs-offset-">
              <div id="mensajes"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Registro Paciente</h4>
                    </div>
                    <div class="panel-body">
                        <form  id="form_paciente">
                           <div class="row">
                            
                           <div class="form-group col-md-6 col-sm-12" id="marcado">
                              <label for="">Cedula: <span style="color: red;">*</span></label>
                              <div class="input-group form-flex" style="">
                                <div class="input-group-btn">
                                 <select name="nacionalidad" id="nacionalidad" class="form-control">
                                <option value="V">V</option>
                                <option value="E">E</option>
                                </select>
                                </div>
                                 <input type="text" name="cedula" maxlength="12" id="cedula" class="form-control" placeholder="Ejem: 24924739"  value="<?php if(isset($_GET['ced']) && !empty([$_GET['ced']])){
                                  echo $cedulaIngresada;
                                  }?>">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" title="Verificar cedula"  type="button" id="buscar"><span class="fa fa-search" style=""></span></button>
                              </span>
                              </div>
                           </div>

                            <div class="form-group col-md-6 col-sm-12">
                              <label for="">Nombres: <span style="color: red;">*</span></label>
                               <input type="text" name="nombres" class="form-control" id="nombres" maxlength="20" onkeypress="return validar_saltos(event)" placeholder="Ejemp: Carolina Alejandra">
                           </div>

                            </div>

                            <div class="form-group col-md-6 col-sm-12">
                               <label for="">Apellidos: <span style="color: red;">*</span></label>
                               <input type="text" name="apellidos" id="apellidos" maxlength="20" onkeypress="return validar_saltos(event)" class="form-control" placeholder="Ejemp:Gonzalez Requena">
                           </div>

                        <div class="form-group col-md-6 col-sm-12">
                           <label for="">Sexo: <span style="color: red;">*</span></label>
                           <select name="sexo" id="sexo" class="form-control select2" required>
                             <option value="">Seleccione el sexo:</option>
                             <option value="Masculino">Masculino</option>
                             <option value="Femenino">Femenino</option>
                           </select>
                        </div>


                         
                           <div class="form-group col-md-6 col-sm-12">
                            <label for="">Fecha de nacimiento: <span style="color: red;">*</span></label>
                               <input type="date" name="fecha_nacimiento" id="fecha_nacimiento"  class="form-control" placeholder="Fecha de nacimiento">
                           </div>
                                                          
                             <div class="form-group col-md-6 col-sm-12">
                               <label for="">Teléfono Movil: <span style="color: red;">*</span></label>
                               <input type="text" name="telefono_movil" id="telefono_movil" class="form-control" placeholder="Ejemp: 0000-0000000" maxlength="15">
                           </div>

                             <div class="form-group col-md-6 col-sm-12">
                               <label for="">Teléfono Local: <span style="color: red;"></span></label>
                               <input type="text" name="telefono_local" id="telefono_local" class="form-control" placeholder="Ejemp: 0000-0000000" maxlength="15">
                           </div>

                           

                            <div class="form-group col-md-6 col-sm-12">
                             <label for="">Estado: <span style="color: red;">*</span></label>        
                               <select name="estado" id="estado" class="form-control" required>
                                <option value="">Seleccione el estado</option>
                                <?php while($row=mysqli_fetch_assoc($estados)){ ?>
                                <option value="<?php echo $row['id_estado']; ?>" <?php if($row['estado']==='Aragua') echo 'selected'; ?>><?php echo $row['estado']; ?></option>
                                <?php } ?>
                               </select>
                           </div>

                               <div class="form-group col-md-6 col-sm-12">
                                <?php $ciudad=$con->query("SELECT * FROM ciudades INNER JOIN estados ON ciudades.id_estado=estados.id_estado WHERE estado='Aragua'"); ?>
                                 <label for="">Ciudad: <span style="color: red;">*</span></label>
                                   <select class="form-control" id="ciudad" name="ciudad" required>
                                  <option value="">Seleccione la ciudad</option>
                                  <?php while($row2=mysqli_fetch_assoc($ciudad)){ ?>
                                  <option value="<?php echo $row2['id_ciudad']; ?>" <?php if($row2['ciudad']==='La Victoria') echo 'selected'; ?>><?php echo $row2['ciudad']; ?></option>
                                  <?php } ?>
                                  </select>
                               </div>

                                 <div class="form-group col-md-6 col-sm-12">
                                  <?php $municipio=$con->query("SELECT * FROM municipios INNER JOIN estados ON municipios.id_estado=estados.id_estado WHERE estados.estado='Aragua'"); ?>
                                  <label for="">Municipio: <span style="color: red;">*</span></label>
                                   <select class="form-control" id="municipio" name="municipio" required>
                                  <option value="">Seleccione el municipio</option>
                                  <?php while($row3=mysqli_fetch_assoc($municipio)){ ?>
                                  <option value="<?php echo $row3['id_municipio']; ?>" <?php if($row3['municipio']==='José Félix Ribas') echo 'selected'; ?> ><?php echo $row3['municipio']; ?></option>
                                  <?php } ?>
                                  </select>
                               </div>
                             <div class="form-group col-md-6 col-sm-12">
                              <?php $parroquia=$con->query("SELECT * FROM parroquias INNER JOIN municipios ON municipios.id_municipio=parroquias.id_municipio WHERE municipios.municipio='José Félix Ribas'"); ?>
                               <label for="">Parroquia: <span style="color: red;">*</span></label>
                               <select class="form-control" id="parroquia" name="parroquia" required>
                              <option value="">Seleccione la Parroquia</option>
                              <?php while($row4=mysqli_fetch_assoc($parroquia)){ ?>
                              <option value="<?php echo $row4['id_parroquia']; ?>" <?php if($row4['parroquia']==='José Félix Ribas') echo 'selected'; ?> ><?php echo $row4['parroquia']; ?></option>
                              <?php } ?>
                            </select>
                           </div>
                            <div class="form-group col-md-6 col-sm-12">
                             <label for="">Dirección: <span style="color: red;">*</span></label>
                             <textarea name="direccion" id="direccion" maxlength="100" id="direccion" cols="30" rows="2" class="form-control"></textarea>
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
<script src="<?php echo SERVERURL; ?>public/js/buscar_cedula.js"></script>
<script src="<?php echo SERVERURL; ?>public/js/calculo_edad.js"></script>
<script src="<?php echo SERVERURL; ?>public/js/cargar_ubicacion.js"></script>
<script src="<?php echo SERVERURL; ?>public/js/pacientes/nuevopaciente.js"></script>
<script>
$(document).ready(function(){
  $('#telefono_movil').mask('9999-9999999');
  $('#telefono_local').mask('9999-9999999');
  $('#cedula').numeric();
});
</script>

