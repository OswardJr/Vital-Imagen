<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Nuevo Servicio</h4>
           <span class="breadcoumb">Servicios <i class="fa fa-caret-right"></i>Nuevo Servicio</span>
        </div>
    </div>
        <div class="row" style="">
        	<div class="col-xs-12 ">
          
              <div id="mensajes"></div>
        		<div class="panel panel-default" style="margin-top:20px;">
        			<div class="panel-heading" style="">
        				<center><h3>Registro Servicio</h3></center>
        			</div>
        			<div class="panel-body">
        				<form action="" id="form_doctor">
                        <div class="row">
                            
                            <div class="form-group col-md-6 col-sm-12">
                                <label for="nombre">Nombre: <span style="color: red;">*</span></label>
                                <input type="text" name="nombre" id="nombre" class="form-control" maxlength="20" onkeypress="return validar_saltos(event)" placeholder="Ingrese Servicio">
                            </div>     
                                 
                             <div class="form-group col-md-6 col-sm-12">
                                <label for="nombre">Decripción:</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="10" maxlength="100" class="form-control"></textarea>
                            </div>
                                
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
<script type="text/javascript" src="<?php echo SERVERURL; ?>public/js/servicios/nuevoservicio.js"></script>
