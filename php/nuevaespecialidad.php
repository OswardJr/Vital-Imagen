<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Nueva especialidad</h4>
              <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Control <i class="fa fa-caret-right"></i> Areas Medicas <i class="fa fa-caret-right"></i>Nueva Especialidad</span>
        </div>
    </div>
        <div class="row">
        	<div class="col-xs-12">
             <h5 id="mensajes"></h5>
        
        		<div class="panel panel-default" style="margin-top: 10px;">
        			<div class="panel-heading">
        				<center><h3 >Especialidades</h3></center>
        			</div>
        			
        			<div class="panel-body">   
                    <form id="form_especialidad">
                       <div class="row">
                        <div class="form-group col-xs-12">
                            <label for="nombre_especialidad">Nombre de la Especialidad  <span style="color: red;">*</span></label>
                            <input type="text" name="nombre_especialidad" id="nombre_especialidad" placeholder="Ingrese el nombre de la especialidad" class="form-control">
                        </div>
                        </div>
                        <div class="botones-formulario text-center">
                              <button type="submit" id="guardar_especialidad" name="guardar_especialidad" class="btn btn-lca" title="Guardar"><i class="fa fa-save"></i></button>
                            <a href="especialidades1.php" class="btn btn-lca" title="Regresar"><i class="fa fa-undo"></i></a>
                          </div>
                    
                        <center>Complete los campos son requeridos <span style="color: red;">*</span></center>
                    </form>
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
        $('#guardar_especialidad').click(function(e){
            e.preventDefault();
            //Variables
            var nombre=$('#nombre_especialidad').val();

            //Expresiones Regulares
            var expNombre=/[a-zA-Z]/;



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
                    url:"doctores/addespecialidad.php",
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