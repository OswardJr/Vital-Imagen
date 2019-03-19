<?php
require_once("header.php");
?>
<div class="page-content">
<div class="container-fluid">
    <div class="bread-content">
        <div class="container">
            <h4>¡Bienvenido!</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio</span>
        </div>
    </div>

        <div class="row" style="">
            <div class="col-xs-12">
            
                    <h5 id="mensajes"></h5>
                    <div class="panel panel-default">
                        <div class="panel-heading" style="">
                            <center><h3 >Registrar Categoria</h3></center>
                        </div>
                        <div class="panel-body">
                            <form action="" id="form_categoria">
                                    <div class="form-group col-xs-6">
                                       <label for="nombre_categoria">Nombre <span style="color:red;">*</span></label>
                                        <input type="text" name="nombre_categoria" title="Nombre" min="5" max="30" title="Nombre" id="nombre_categoria" class="form-control" placeholder="Nombre">
                                    </div>
                                    
                                    <input type="hidden" name="status_categoria" value="Activo">

                                    <div class="form-group col-xs-6">
                                        <label for="">Descripcion <span style="color:red;">*</span></label>
    
                                        <textarea class="form-control" name="descripcion_categoria" title="Descripcion" minlength="5" maxlength="100" title="Descripcion" id="descripcion_categoria" placeholder="Descripcion" cols="30" rows="10"></textarea>
                                    </div>

                                    <div class="botones-formulario text-center">
                                    <button type="submit" id="guardar_categoria" name="guardar_categoria" class="btn btn-lca" style="">
                                    <i class="fa fa-save"></i>
                                    </button>
                                    <a href="categorias.php" class="btn btn-lca "><i class="fa fa-undo"></i></a>
                                    </div>
                                    
                                    <div class="text-center col-xs-12"><h5><strong>Todos los campos ( <span style="color:red;">*</span> ) son requeridos</strong></h5></div>
                            </form>
                        </div>
                    </div>
           
            </div>
        </div>
    </div>
</div>
<?php require_once("footer.php"); ?>
<script>
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
$('#guardar_categoria').click(function(e){
e.preventDefault();
var Mixto=/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/;
var Numerico=/^[0-9]+$/;
var Letras=/^[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+$/;
////------------------------------------------HAY QUE AGREGAR   

if(validarCampos()){
           var nombre = $('#nombre_categoria').val();
           var descripcion = $('descripcion_categoria').val();
           if(!Mixto.test(nombre)){
                swal('','El campo nombre solo admite letras y numeros por favor verifique','error');
           }else if(!Mixto.test(descripcion)){
                swal('','El campo descripcion solo admite letras y numeros por favor verifique','error');
           }else{
                $.ajax({
                    url:"categorias/addcategoria.php",
                    type:"POST",
                    data:$('#form_categoria').serialize(),
                    success:function(data){
                    $('#mensajes').html(data);
                    }
                    });
           } 
}

        });
     });
 </script>
