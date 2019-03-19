<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Nuevo Doctor</h4>
           <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Doctores <i class="fa fa-caret-right"></i>Nuevo Doctor</span>
        </div>
    </div>
        <div class="row" style="">
        	<div class="col-xs-12 ">
          
              <div id="mensajes"></div>
        		<div class="panel panel-default" style="margin-top:20px;">
        			<div class="panel-heading" style="">
        				<center><h3>Registro Doctor</h3></center>
        			</div>
        			<div class="panel-body">
        				<form action="" id="form_doctor">
                              <div class="row">
                            <div class="form-group col-md-4">
                                <label for="nombre">Cedula <span style="color: red;">*</span></label>
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
                                <label for="nombre">Nombre <span style="color: red;">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Leonardo">
                            </div>     
                            <div class="form-group col-md-4">
                                <label for="password">Apellido <span style="color: red;">*</span></label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Padron">
                            </div>     
                              </div>


                             <div class="form-group col-md-4">
                                <label for="password">Sexo <span style="color: red;">*</span></label>
                                <select id="sexo" name="sexo" class="form-control">
                                    <option value="">Seleccione el sexo del doctor</option>
                                     <option value="Masculino">Masculino</option>
                                      <option value="Femenino">Femenino</option>
                                </select>
                            </div> 
                      

                               <div class="form-group col-md-4">
                                 <label for="">Telefono <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="telefono" name="telefono"  placeholder="ejm: 0416-2415105">
                                </div>

                                 <div class="form-group col-md-4">
                                 <label for="">Correo</label>
                                <input type="text" class="form-control" id="correo" name="correo"  placeholder="ejm: example@gmail.com">
                                </div>
                                 <div class="form-group col-md-4">
                                 <label for="">Dirección</label>
                                  <textarea name="direccion" id="direccion" class="form-control"></textarea>
                                </div>
                           
                             <div class="form-group col-md-4">
                                <label for="nombre">Especialidad <span style="color: red;">*</span></label>
                                <?php require_once("../config/conexion.php");
                                $sql="SELECT * FROM especialidades WHERE status='activo'";
                                $result=$con->query($sql);
                                 ?>
                               <select name="especialidad" id="especialidad" class="form-control">
                               <option value="">Seleccione La Especialidad</option>
                               <?php while($row=$result->fetch_assoc()){ ?>
                                   <option value="<?php echo $row['id_especialidad']; ?>"><?php echo $row['nombre_especialidad']; ?></option>
                                   <?php } ?>
                               </select>
                            </div>
                            
                             <div class="form-group col-md-4">
                                 <label for="">Cantidad de Citas/Consultas</label>
                                  <input type="number" name="cantidad" id="cantidad" class="form-control" value="1" min="1" max="10">
                                </div>
    

                           
                           <div class="text-center botones-formulario">                           
                                <button type="submit" id="guardar" name="guardar" class="btn btn-lca" style="">
                                    <i class="fa fa-save" title="Guardar"></i>
                                </button>
                              
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
<script type="text/javascript" src="../public/js/doctores/nuevodoctor.js"></script>
  <script type="text/javascript">
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
            });
        </script>
<script type="text/javascript">
     $(document).ready(function(){
 
$('#info').hide();
     $('#buscar').click(function(e){
      e.preventDefault();

        var cedula = $("#cedula").val(); 
        var nacionalidad=$('#nacionalidad').val();
         var expcedula=/\d[0-9]/;       
        var dataString = 'cedula='+cedula+'&nacionalidad='+nacionalidad;

        if(cedula===""){
          swal("Ingrese la cedula del paciente a verificar","","error");
          return false;
        }else if(cedula.length<3){
          swal("El campo cedula requiere almenos 3 caracteres","","error");
          return false;
        }else if(cedula.length>12){
          swal("El campo cedula admite maximo 12 caracteres","","error");
          return false;
        }else if(!expcedula.test(cedula)){
          swal("La cedula solo admite numeros","","error");
          return false;
        }else{

        $.ajax({
            type: "POST",
            url: "doctores/detectarcedula.php",
            data: dataString,
            success: function(data) {
                $('#mensajes').html(data);
                return false;
            }
        });
      }
    });              

    });    
</script>