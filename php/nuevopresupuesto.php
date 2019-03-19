<?php 
require_once("header.php");
 ?>
<?php 
require_once("../config/conexion.php");
$hora_actual=date('H:i:s');
$fecha_actual=date('d-m-Y');
 ?>
<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Nuevo Presupuesto</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Presupuestos <i class="fa fa-caret-right"></i> Nuevo Presupuesto </span>
        </div>
        </div>
        <div class="row" style="">
            <div class="col-xs-12 col-xs-offset-">
             <div id="mensaje"></div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <center><h3>Nuevo Presupuesto</h3></center>
                    </div>
                    <div class="panel-body">
                        <form action="" id="form_presupuesto">
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
                            
                   
                                 
                            <div class="form-group col-md-4">
                                <label for="intervencion"> Tipo de Intervención <span style="color: red;">*</span> </label>
                                <?php $intervencion=$con->query("SELECT * FROM intervencion WHERE status_intervencion='Activo'");  ?>
                                <select name="intervencion" id="intervencion" class="form-control">
                                   <option value="">Seleccione la Intervención</option>
                                   <?php while($i=mysqli_fetch_assoc($intervencion)){ ?>
                                   <option value="<?php echo $i['id_intervencion']; ?>"><?php echo $i['nombre_intervencion']; ?></option>
                                   <?php } ?>
                                </select>
                            </div>    
                            
                             <div class="form-group col-md-4">
                                <label for="">Fecha Actual<span style="color: red;">*</span> </label>
                                <input type="text" class="form-control" name="fecha_actual" id="fecha_actual" value="<?php echo $fecha_actual; ?>" readonly>
                                </div>

                                <div class="form-group col-md-4">
                                <label for="">Dias de vencimiento de Vencimiento<span style="color: red;">*</span> </label>
                                <select name="d_vencimiento" class="form-control" id="d_vencimiento">
                                  <option value="">Seleccione el dia de vencimiento</option>
                                   <option value=" 1 dia">1 dia</option>
                                    <option value="2 dias"> 2 dias</option>
                                  <option value="3 dias">3 dias</option>
                                   <option value="4 dias">4 dias</option>
                                    <option value="5 dias">5 dias</option>
                                     <option value="6 dias">6 dias</option>
                                    <option value="7 dias">7 dias</option>
                                     <option value="10 dias">10 dias</option>
                                </select>
                                </div>
                                 
                                
                              <div class="botones-formulario text-center">                           
                                <button type="submit" id="guardar_presupuesto" name="guardar_presupuesto" class="btn btn-lca" style="">
                                    <i class="fa fa-save"></i>
                                </button>
                
                                <a href="presupuesto.php" class="btn btn-lca">
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

        $('#guardar_presupuesto').click(function(e){
            e.preventDefault();
            var cedula,nombre,apellido,intervencion,fecha,d_vencimiento,data;
            cedula=$('#cedula').val();
            nombre=$('#nombre').val();
            apellido=$('#apellido').val();
            intervencion=$('#intervencion').val();
            d_vencimiento=$('#d_vencimiento').val();
            data=$('#form_presupuesto').serialize();
            if(cedula===''){
              swal("Ingrese la cedula del paciente","","error");
              return false;
            }else if(nombre===""){
              swal("El nombre del paciente es requerido","","error");
              return false;
            }else if(apellido===""){
              swal("El apellido del paciente es requerido","","error");
              return false;
            }else if(intervencion===""){
               swal("Seleccione el tipo de intervencion","","error");
              return false;
            }else if(d_vencimiento===""){
               swal("Seleccione los dias de vencimiento del presupuesto","","error");
               return false;
            }else{
            $.ajax({
              url:"presupuestos/addpresupuesto.php",
              type:"POST",
              data:data,
              success:function(data){
                $('#mensaje').html(data);
              }
            });
            }
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
    var d=new Date();
    $('#fecha').datepicker({
      minDate:d,
      maxDate:d
    });
  });
  </script>
  <script src="../public/js/datepicker-es.js"></script>
>