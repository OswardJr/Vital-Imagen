<?php 
require_once("header.php");
 ?>
<?php 
require_once("../config/conexion.php");
$sql="SELECT * FROM pacientes";
$hora_actual=date('H:i:s');
$fecha_actual=date('d/m/Y');
$fecha
 ?>
<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Nueva Cita</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Citas <i class="fa fa-caret-right"></i> Nueva Cita </span>
        </div>
        </div>
        <div class="row" style="">
            <div class="col-xs-12 col-xs-offset-">
             <div class="mensajes"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><h3>Nueva Cita</h3></center>
                    </div>
                    <div class="panel-body">
                        <form action="" id="form_cita">
                            <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="cedula ">Cedula <span style="color: red;">*</span> </label>
                                <div class="input-group form-flex">
                                <div class="input-group-btn">
                                 <select name="nacionalidad" id="nacionalidad" class="form-control">
                                <option value="V">V</option>
                                <option value="E">E</option>
                                </select>
                                </div>
                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cedula Ejemp: v-24924739" value="">
                                <span class="input-group-btn ">
                                <button class="btn btn-primary" type="button" onclick="buscar_cedula();"><span class="fa fa-search"></span></button>
                                </span>
                            </div>
                    </div>
                            <div class="form-group col-md-4">
                                <label for="nombre">Nombres <span style="color: red;">*</span> </label>
                                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ejemp:Leoncio Enrique" disabled>
                            </div>     
                                 <div class="form-group col-md-4">
                                <label for="password">Apellidos <span style="color: red;">*</span> </label>
                                <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Requena Gonzalez" disabled>
                            </div>     
                             </div>    
                            
                    <?php 
                    require_once("../config/conexion.php");
                    $sql="SELECT id_especialidad,nombre_especialidad FROM especialidades WHERE status='activo'";
                    $result=$con->query($sql);
                     ?>
                            <div class="form-group col-md-6">
                                <label for="nombre">Especialidad <span style="color: red;">*</span> </label>
                                <select name="id_especialidad" id="id_especialidad" class="form-control">
                                    <option value="">Elegir Especialidad</option>
                                    <?php while($row=mysqli_fetch_assoc($result)){ ?>
                                    <option value="<?php echo $row['id_especialidad']; ?>"><?php echo $row['nombre_especialidad']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>     
                            <div class="form-group col-md-6">
                                <label for="id_doctor">Doctor <span style="color: red;">*</span> </label>
                                <select name="id_doctor" id="id_doctor" class="form-control">
                                   <option value="">Seleccione Doctor</option>
                                </select>
                            </div>    
                             <div class="form-group col-md-6">
                                <label for="">Hora <span style="color: red;">*</span> </label>
                                <input type="time" class="form-control" name="hora" id="hora" value="<?php echo $hora_actual; ?>">
                                </div>   
                             <div class="form-group col-md-6">
                                <label for="">Fecha <span style="color: red;">*</span> </label>
                                <input type="text" class="form-control" name="fecha_cita" id="fecha_cita" value="<?php echo $fecha_actual; ?>">
                                </div>
                                 
                                
                              <div class="botones-formulario text-center">                           
                                <button type="submit" id="guardar_cita" name="guardar_cita" class="btn btn-lca" style="">
                                    <i class="fa fa-save"></i>
                                </button>
                                <input type="hidden" name="ced_paciente" value="<?php echo $row['ced_paciente']; ?>">
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
    function buscar_cedula(){
        var cedula=$('#cedula').val();
        var nacionalidad=$('#nacionalidad').val();
        var expCedula2=/\d[1-9]/;
        if(cedula===""){
            swal("Ingrese su numero de cedula","","error");
            return false;
        }else if(!expCedula2.test(cedula)){
            swal("La cedula solo admite numeros","","error");
            return false;
        }else if(cedula.length>20){
            swal("El maximo de caracteres para la cedula es 20","","error");
            return false;
        }else{
        $.ajax({
            url:"citas/buscarcedula.php",
            type:"POST",
            data:'cedula='+cedula+'&nacionalidad='+nacionalidad,
            dataType:"JSON",
            success:function(data){
                if(data){
                $('#nombre').val(data.nombres);
                $('#apellido').val(data.apellidos);
                $('#responsable').val(data.responsable);
            }else{
                   swal({
  title: 'La cedula del Paciente no se encuentra registrada',
  text: "¿Desea Registrar un nuevo paciente?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si',
  cancelButtonText: 'No',
  confirmButtonClass: 'btn btn-primary',
  cancelButtonClass: 'btn btn-warning',
  buttonsStyling: false
}).then(function () {
           window.location="nuevopaciente.php";
            return true;    
}, function (dismiss) {
})

$('#cedula').val("");
            }
            }
        });
    }
}

</script>
<script>
    $(document).ready(function(){
        $('#mensajes').hide();
    $('#guardar_cita').click(function(e){
        e.preventDefault();
       //Expresiones Regulares
                 var expCedula=/\d[1-9]/;
        var expFecha=/\d{2}\/\d{2}\/\d{4}/;

        var cedula=$('#cedula').val();
        var nombre=$('#nombre').val();
        var apellido=$('#apellido').val();
        var responsable=$('#responsable').val();
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
        }else if(hora===""){
            swal("Ingrese la hora","","error");
            return false;
        }else{
            $.ajax({
            url:"citas/addcita1.php",
            type:"POST",
            data:$('#form_cita').serialize(),
            success:function(data){
                $('.mensajes').html(data);
             
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
      minDate:d
    });
  });
  </script>
  <script src="../public/js/datepicker-es.js"></script>
