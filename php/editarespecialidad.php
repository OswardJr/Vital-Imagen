<?php 
require_once("header.php");
 ?>
<?php 
require_once("../config/conexion.php");
$id=$_GET['id'];
$sql="SELECT * FROM especialidades WHERE id_especialidad='$id'";
$result=$con->query($sql);
$rows=mysqli_fetch_assoc($result);
 ?>
<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
 <div class="container">
            <h4>Editar especialidad</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Areas medicas <i class="fa fa-caret-right"></i> Editar especialidad</span>
        </div>
    </div>
        <div class="row" style="">
        	<div class="col-xs-12 col-xs-offset-">
            <h5 id="mensajes"></h5>
        		<div class="panel panel-default" >
        			<div class="panel-heading">
                        <center><h3 >Editar Especialidad</h3></center>
        			</div>
        			
        			<div class="panel-body">   
                    <form id="form_especialidad">
                       <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="nombre_especialidad">Nombre de la especialidad <span style="color: red;">*</span></label>
                            <input type="text" name="nombre_especialidad" id="nombre_especialidad" class="form-control" value="<?php echo $rows['nombre_especialidad']; ?>">
                        </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="<?php echo $rows['id_especialidad']; ?>">
                           
                           <div class="botones-formulario text-center">
                            <button type="submit" class="btn btn-lca" id="update_especialidad"><i class="fa fa-save"></i></button>
                            <a href="especialidades1.php" class="btn btn-lca"><i class="fa fa-undo"></i></a>
                            </div> 
                          
                    </form>
                      <div class="form-group col-xs-12 text-center"><h5><strong>Complete los campos requeridos <span style="color: red;">*</span> </strong></h5></div> 
        			</div>

        		</div>
        	</div>
        </div>
  </div>

</div>
 <?php require_once("footer.php"); ?>
 <script type="text/javascript">
     $(document).ready(function(){
        $('#error').hide();
        $('#update_especialidad').click(function(e){
            e.preventDefault();
           var nombre=$('#nombre_especialidad').val();
            var descripcion=$('#descripcion_especialidad').val();

            //Expresiones Regulares
            var expNombre=/[a-zA-Z]/;
            var expDescripcion=/[a-zA-Z]/;



            if(nombre===""){
                swal("Ingrese el nombre de la especialidad","","error");
                return false;
            }else if(!expNombre.test(nombre)){

                swal("El nombre de la especialidad solo admite letras","","error");
                return false;

            }else if(nombre.length>30){

                swal("El maximo de caracteres del nombre de la especialidad es de 30","","error");
                return false;

            }else{
                $.ajax({
                    url:"doctores/updateespecialidad.php",
                    type:"POST",
                    data:$('#form_especialidad').serialize(),
                    success:function(data){
                        $('#mensajes').html(data);
                      
                    }
                });
            }
        });
     });
 </script>