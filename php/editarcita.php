<?php 
require_once("header.php");
 ?>
<?php 
require_once("../config/conexion.php");
$id=$_GET['id'];
$sql="SELECT p.ced_paciente,p.nombres,p.apellidos,p.responsable,d.id_doctor,d.nombre,e.nombre_especialidad,c.id_citas,c.fecha_cita,c.hora,c.id_doctor FROM citas AS c INNER JOIN pacientes AS p ON c.ced_paciente=p.ced_paciente INNER JOIN doctores AS d ON d.id_doctor=c.id_doctor INNER JOIN especialidades AS e ON e.id_especialidad=d.id_especialidad WHERE c.id_citas='$id'";
$result=$con->query($sql);
$row = mysqli_fetch_assoc($result);

 ?>
<div class="page-content">
    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Editar Cita</h4>
          <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Citas <i class="fa fa-caret-right"></i> Editar Cita </span>
        </div>
    </div>
        <div class="row" style="">
        	<div class="col-xs-12">
              <div id="mensajes"></div>
        		<div class="panel panel-default">
        			<div class="panel-heading">
        				<center><h3>Editar Datos de la Cita</h3></center>
        			</div>
        			<div class="panel-body">
        				<form id="form_cita">

                            <div class="form-group col-md-4">
                                <label for="cedula ">Cedula <span style="color: red;">*</span></label>
                               
                                <input  type="text" class="form-control" id="cedula" name="cedula" placeholder="ej. 24924739" maxlength="9" value="<?php echo $row['ced_paciente']; ?>" readonLy>
                            
                            </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombre <span style="color: red;">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" disabled value="<?php echo $row['nombres']; ?>">
                            </div>   

                            <div class="form-group col-md-4">
                                <label for="password">Apellido <span style="color: red;">*</span></label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Apellido" disabled value="<?php echo $row['apellidos']; ?>">
                            </div>     

                    
                    <?php 
                    require_once("../config/conexion.php");
                    $sql2="SELECT id_especialidad,nombre_especialidad FROM especialidades";
                    $result2=$con->query($sql2);
                    $fecha=$row['fecha_cita'];

                     ?>
                            <div class="form-group col-md-6">
                                <label for="nombre"> Especialidad <span style="color: red;">*</span></label>
                                <select name="id_especialidad" id="id_especialidad" class="form-control">
                                    <option value="<?php  echo $row['id_especialidad']; ?>"><?php echo $row['nombre_especialidad']; ?></option>
                                    <option value="">------------------</option>
                                    <?php while($row2=mysqli_fetch_assoc($result2)){ ?>
                                    <option value="<?php echo $row2['id_especialidad']; ?>"><?php echo $row2['nombre_especialidad']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>     
                            <div class="form-group col-md-6">
                           
                                <label for="id_doctor"> Doctor <span style="color: red;">*</span></label>
                                <select name="doctor" id="id_doctor" class="form-control">
                                   <option value="<?php echo $row['id_doctor']; ?>"><?php  echo $row['nombre']; ?></option>
                                </select>
                            </div>     
                             <div class="form-group col-md-6">
                             <label>Fecha de la Cita <span style="color: red;">*</span></label>
                                <input type="text" class="form-control" id="fecha_cita" name="fecha_cita" placeholder="ej. 24924739" maxlength="" value="<?php echo str_replace('-', '/', date('d-m-Y',strtotime($fecha))); ?>">
                               
                                </div>
                            <div class="form-group col-md-6">
                                <label for="">Hora <span style="color: red;">*</span></label>
                                <input type="time" class="form-control" name="hora" id="hora" value="<?php echo $row['hora']; ?>">
                            </div>
                               
                           <div class="text-center botones-formulario">                           
                                <button type="submit" id="guardar_cita" name="guardar_cita" class="btn btn-lca" style="">
                                    <i class="fa fa-check-square-o"></i>
                                </button>
                             
                                <input type="hidden" name="id_cita" value="<?php echo $row['id_citas'];?>">
                                <a href="citas.php" class="btn btn-lca">
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
</div>
</div>
<script>
    $(document).ready(function(){

        $('#id_especialidad').on('change',function(){
            var id=$('#id_especialidad').val();
            $.ajax({
                url:"citas/cargardoctores.php",
                type:"POST",
                data:{'id': id},
                success:function(respuesta){
                    $('#id_doctor').html(respuesta);
                }
            });
        });

    });
</script>

<script>
    $(document).ready(function(){
        
    $('#guardar_cita').click(function(e){
        e.preventDefault();
       //Expresiones Regulares
         var expCedula=/[A-Za-z]-[1-9]/;
        var expFecha=/\d{2}\/\d{2}\/\d{4}/;

        var cedula=$('#cedula').val();
        var nombre=$('#nombre').val();
        var apellido=$('#apellido').val();
        var especialidad=$('#id_especialidad').val();
        var doctor=$('#id_doctor').val();
        var fecha_cita=$('#fecha_cita').val();
        var hora=$('#hora').val();
        
        if(cedula===""){
            swal("Ingrese el Nro de cedula","","error");
            return false;
        }else if(!expCedula.test(cedula)){
            swal("Formato no valido v-24924739","","error");
            return false;
        }else if(cedula.length>20){
            swal("El maximo de caracteres en la cedula es 30","","error");
            return false;
        }else if(nombre===""){
            swal("Campo nombre requerido","","error");
            return false;
        }else if(apellido===""){
            swal("Campo apellido requerido","","error");
            return false;
        }else if(especialidad===""){
            swal("Seleccione una especialidad para continuar","","error");
            return false;
        }else if(doctor===""){
            swal("Selecciones el doctor de la especialidad para continuar","","error");
            return false;
        }else if(fecha_cita === ""){
            swal("Ingrese la fecha de la cita para continuar","","error");
            return false;
        }else if(!expFecha.test(fecha_cita)){
            swal("Formato no valido dd/mm/yyyy","","error");
            return false;
        }else if(fecha_cita.length>20){
            swal("El maximo de caracteres para la fecha de la cita son 20","","error");
            return false;
        }else if(hora===""){
            swal("Ingrese la hora","","error");
            return false;
        }else{  
            $.ajax({
            url:"citas/updatecitas.php",
            type:"POST",
            data:$('#form_cita').serialize(),
            success:function(data){
                $('#mensajes').html(data);
            }
        });
            }
    });


    });
</script>
<script>
   $(document).ready(function(){
    var d=new Date();
    $('#fecha_cita').datepicker({
    minDate:d,
    changeMonth: true,
      changeYear: true
    });

  });
</script>
<script src="../public/js/datepicker-es.js"></script>