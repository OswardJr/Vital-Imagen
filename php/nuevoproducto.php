<?php 
require_once("header.php");
 ?>

<div class="page-content">
    <div class="bread-content">
        <div class="container">
            <h4>Nuevo Producto</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario  <i class="fa fa-caret-right"></i> Productos <i class="fa fa-caret-right"></i> Nuevo Producto</span>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <h5 id="mensajes"></h5>
        		<div class="panel panel-default">
        			<div class="panel-heading">
        				<center><h3>Registrar producto</h3></center>
        			</div>
                    <?php require_once("../config/conexion.php"); 
                        $sql="SELECT * FROM categorias WHERE status_categoria='Activo'";
                        $categorias=$con->query($sql);
                        $sql2="SELECT * FROM proveedores WHERE status_proveedor='Activo'";
                        $proveedores=$con->query($sql2);
                    ?>
              <div id="mensaje"></div>
        			<div class="panel-body">
        				<form action="addproducto.php" method="POST" autocomplete="on" id="form_pro">
                    
                            <div class="form-group col-xs-12 col-md-4">
                               <label for="nombre_producto">Nombre del producto <span style="color:red;">*</span></label>
                                <input type="text" title="Nombre" min="5" max="30" name="nombre_producto" class="form-control" placeholder="Nombre del producto" id="nombre_producto">
                            </div>
  
                        <div class="form-group col-xs-12 col-md-4">
                              <label for="categorias_id">Categoria <span style="color:red;">*</span></label>
                              <select name="categorias_id" title="Categoria" id="categorias_id" class="form-control">
                                  <option value="">Seleccione una categoria</option>
                                  <?php while($row=$categorias->fetch_assoc()){ ?>
                                  <option value="<?php echo $row['id_categoria']; ?>"><?php echo $row['nombre_categoria']; ?></option>
                                  <?php } ?>
                              </select>
                            </div>
        
                            <div class="form-group col-xs-12 col-md-4">
                             <label for="min_stock">Stock minimo <span style="color:red;">*</span></label>
                                <input type="number" title="Stock minimo" min="1" max="300" name="min_stock" class="form-control" placeholder="Determine stock minimo" id="min_stock">
                            </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                  <label for="precio">Precio de entrada<span style="color:red;">*</span></label>
                                <input type="text" title="Precio de entrada" min="1" max="20" name="precioEntrada" class="form-control" placeholder="Ingrese el precio de entrada" id="precioEntrada">
                            </div>
                        </div>
           
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                  <label for="precio">Precio de venta<span style="color:red;">*</span></label>
                                <input type="text" title="Precio de venta" min="1" max="20" name="precio" class="form-control" placeholder="Ingrese el precio de venta" id="precio">
                            </div>
                        </div>
                        <div class="form-group col-xs-12 col-md-6">
                                 <label for="nombre_producto">Descripcion <span style="color:red;">*</span></label>
                                <textarea name="descripcion_producto" minlength="5" maxlength="40" title="Descripcion" class="form-control" id="descripcion_producto" cols="30" rows="10" placeholder="Descripcion del producto...."></textarea>
                            </div>    
                            <input type="hidden" value="0" name="stock">
                            <input type="hidden" value="Activo" name="status_producto">
                    
                               
                                <div class="botones-formulario text-center">
                                    <button type="submit" id="guardar_producto" name="" class="btn btn-lca"> 
                                    <i class="fa fa-save"></i>
                                </button>
                                    <a href="inventario.php" class="btn btn-lca ">  <i class="fa fa-undo"></i></a>
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
$('#guardar_producto').click(function(e){
e.preventDefault();
var Mixto=/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ\s]+$/;
var Numerico=/^[0-9]+$/;
var flotante=/^[+]?\d+([,.]\d+)?$/;
var Letras=/^[a-zA-Z]+$/;
////------------------------------------------HAY QUE AGREGAR   

if(validarCampos()){
           var nombre = $('#nombre_producto').val();
           var precio = $('#precio').val();
           var precioEntrada = $('#precioEntrada').val();
           var minstock = $('#min_stock').val();
           var descripcion = $('descripcion_producto').val();
           if(!Mixto.test(nombre)){
                swal('','El campo nombre solo admite letras y numeros por favor verifique','error');
           }else if(!Numerico.test(minstock)){
                swal('','El campo stock solo admite numeros por favor verifique','error');
           }else if(!flotante.test(precioEntrada)) {
                swal('','El campo precio de entrada solo admite numeros por favor verifique el monto ingresado','error');
           }else if(!flotante.test(precio)) {
                swal('','El campo precio de venta solo admite numeros por favor verifique el monto ingresado','error');
           }else if(!Mixto.test(descripcion)){
                swal('','El campo descripcion solo admite numeros y letras','error');
           }else{
                $.ajax({
                    url:"productos/addproducto.php",
                    type:"POST",
                    data:$('#form_pro').serialize(),
                    success:function(data){
                      $('#mensaje').html(data);           
                    }
               });
           } 
}

        });
     });
 </script>