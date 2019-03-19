<?php 
require_once("header.php");
 ?>

<div class="page-content">

    <div class="container-fluid">
           <div class="bread-content">
        <div class="container">
            <h4>Nuevo Proveedor</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario  <i class="fa fa-caret-right"></i> Proveedores <i class="fa fa-caret-right"></i> Nuevo Proveedor</span>
        </div>
    </div>
        <div class="row" style="">
        	<div class="col-xs-12 ">
 
              <h5 id="mensajes"></h5>
        		<div class="panel panel-default">
        			<div class="panel-heading" style="">
        				<center><h3 >Registrar Proveedor</h3></center>
        			</div>
        			<div class="panel-body">
        				<form action="" id="form_proveedor">

                    <div class="form-group  col-md-4">
                               <div class="input-group form-flex">
                                   <label for="">RIF <span style="color:red;">*</span></label>
                                <input type="text" min="1" max="25" title="RIF" name="rif" id="rif" class="form-control" placeholder="Ingrese el RIF">
                                <div class="input-group-btn" style="transform: translateY(13px);">
                                        <button class="btn btn-primary" type="button" onclick="buscarRif();"><i class="fa fa-search"></i></button>
                                </div>
                               </div>
                            </div>   
                            <div class="form-group col-xs-4">
                               <label for="">Nombre <span style="color:red;">*</span></label>
                                <input type="text" min="3" max="40" title="Nombre" name="nombre_proveedor" id="nombre_proveedor" class="form-control" placeholder="Ingrese el nombre">
                            </div>
                            
                             <div class="form-group col-xs-4">
                                <label for="">Contacto<span style="color:red;">*</span></label>
                                <input type="text" min="4" max="30" title="Contacto" name="nombre_contacto" id="nombre_contacto" class="form-control" placeholder="Ingrese el nombre del contacto">
                            </div>   
                            <div class="form-group col-xs-6">
                                <label for="">Telefono <span style="color:red;">*</span></label>
                                <input type="text" min="1" max="11" title="Telefono" name="telefono" id="telefono" class="form-control" placeholder="Ingrese el telefono del contacto">
                            </div>   
                            <div class="form-group col-xs-6">
                               <label for="">Direccion <span style="color:red;">*</span></label>
                                <textarea type="text" minlength="5" maxlength="30" title="direccion" name="direccion" id="direccion" class="form-control" placeholder="Direccion del proveedor"></textarea>
                            </div>      
                            
                             <input type="hidden" name="status_proveedor" value="Activo">

                            <div class="text-center botones-formulario">
                                    <button type="submit" id="guardar_proveedor" name="guardar_proveedor" class="btn btn-lca" style="">
                                   <i class="fa fa-save"></i>
                                </button>
                                <a href="proveedores.php" class="btn btn-lca "><i class="fa fa-undo"></i></a>
                           </div> 
                           
                            <center>Complete los campos requeridos <span style="color:red;">*</span></center>
                                                
                        </form>
        			</div>
        		</div>
        	</div>
      
</div>
</div>
 <?php require_once("footer.php"); ?>
 <script>
var buscarRif = function(){
    var rif = $('#rif').val();
    var Mixto=/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/;
    if(rif == ''){
         swal('El rif no puede estar vacio','Por favor ingrese el rif correspondiente e iintente de nuevo','error');
         return false;
    }else{
        $.ajax({
            url: 'proveedores/verificarRif.php',
            type: 'POST',
            dataType: 'JSON',
            data: {'rif': rif},
        })
        .done(function(datos) {
            console.log("success");
            if(datos > 0){
                swal('El rif que intenta ingresar ya esta asignado a un proveedor','Por favor ingrese un rif valido','error');
                return false;
            }else{
                swal('El rif ingresado esta disponible','','success');
                return false;
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });   
    }
}

var validarCampos = function(){
    
    var selCampos = document.getElementsByClassName('form-control')
        numeroDeElementos = selCampos.length;
         var camposVacios = 0;
    
    for(var i=0; i<numeroDeElementos; i++){

            if(selCampos[i].className == 'form-control'){
                if(selCampos[i].value == '' || selCampos[i].value.length < 1){
                    swal('Campos vacios','Por favor complete el campo '+selCampos[i].title,'error');
                    camposVacios++;
                    console.log(i);
                    return false;
                }if(selCampos[i].tagName == 'INPUT'){
                    if (selCampos[i].type == 'text') {
                        if(selCampos[i].value.length < selCampos[i].min){
                            swal('Error','El campo '+selCampos[i].title+' debe tener como minimo '+selCampos[i].min+' caracteres','error');
                            camposVacios++;
                            console.log(i);
                            return false;
                        }else if(selCampos[i].value.length > selCampos[i].max){
                            swal('Error','El campo '+selCampos[i].title+' debe tener como maximo '+selCampos[i].max+' caracteres','error');
                            camposVacios++;
                            console.log(i);
                            return false;
                        }
                    }else if(selCampos[i].type == 'number'){
                        if(selCampos[i].value < parseInt(selCampos[i].min)){
                            swal('Error','El campo '+selCampos[i].title+' debe tener un valor minimo de '+selCampos[i].min,'error');
                            camposVacios++;
                            console.log(i);
                            return false;
                        }else if(selCampos[i].value > parseInt(selCampos[i].max)){
                            swal('Error','El campo '+selCampos[i].title+' debe tener un valor maximo de '+selCampos[i].max,'error');
                            camposVacios++;
                            console.log(i);
                            console.log(selCampos[i].value);
                            console.log(selCampos[i].max);
                            return false;
                        }
                    }
                }else{
                    if(selCampos[i].tagName == 'TEXTAREA'){
                        var  valor = selCampos[i].value;
                        if(selCampos[i].value.length <= selCampos[i].minLength){
                            swal('Error','El campo '+selCampos[i].title+' debe tener como minimo '+selCampos[i].minLength+' caracteres','error');
                            camposVacios++;
                            console.log(selCampos[i].value.length);
                            console.log(selCampos[i].minLength);
                            return false;
                        }else if(selCampos[i].value.length >= selCampos[i].maxLength){
                            swal('Error','El campo '+selCampos[i].title+' debe tener como maximo '+selCampos[i].maxLength+' caracteres','error');
                            camposVacios++;
                            console.log(selCampos[i].value.length);
                            console.log(selCampos[i].maxLength);
                            return false;
                        }
                    }
                }
        }
    }
    
    if(camposVacios > 0){
        return false;
    }else{
        return true;
    }
    
};      
     
$(document).ready(function(){
$('#guardar_proveedor').click(function(e){
e.preventDefault();
var Mixto=/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/;
var Numerico=/^[0-9]+$/;
var Letras=/^[a-zA-Z ]+$/;
////------------------------------------------HAY QUE AGREGAR   

if(validarCampos()){
           var nombre = $('#nombre_proveedor').val();
           var rif = $('rif').val();
           var contacto = $('#nombre_contacto').val();
           var telefono = $('#telefono').val();
           var direccion = $('#direccion').val();
           if(!Mixto.test(nombre)){
                swal('','El campo Nombre solo admite letras y numeros por favor verifique','error');
           }else if(!Mixto.test(rif)){
                swal('','El campo RIF solo admite letras y numeros por favor verifique','error');
           }else if(!Mixto.test(contacto)){
                swal('','El campo Contacto solo admite letras y numeros por favor verifique','error');
           }else if(!Numerico.test(telefono)){
                swal('','El campo telefono solo admite numeros por favor verifique','error');
           }else if(!Mixto.test(direccion)){
                swal('','El campo descripcion solo admite letras y numeros por favor verifique','error');
           }else{
                 $.ajax({
                url:"proveedores/addproveedor.php",
                type:"POST",
                data:$('#form_proveedor').serialize(),
                success:function(data){
                    $('#mensajes').html(data);
                  
                }
            });
           } 
}

        });
     });
 </script>

 