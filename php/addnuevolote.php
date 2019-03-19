<?php 
require_once("header.php");
 ?>

<div class="page-content">
      <div class="container-fluid">
    <div class="bread-content">
        <div class="container">
            <h4>Nuevo lote</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario <i class="fa fa-caret-right"></i> Lotes <i class="fa fa-caret-right"></i> Nuevo lote</span>
        </div>
    </div>

        <div class="row" style="margin-top: 40px;">
          <div class="col-xs-12">
            <div class="panel panel-default">
              <div class="panel-heading">
                <center><h3>Nuevo lote</h3></center>
              </div>
                    <?php require_once("../config/conexion.php"); 
                        $sql="SELECT * FROM categorias WHERE status_categoria='Activo'";
                        $categorias=$con->query($sql);
                        $sql2="SELECT * FROM proveedores WHERE status_proveedor='Activo'";
                        $proveedores=$con->query($sql2);

                        function generarCodigo($longitud=8, $tipo=0){
                            
                            $codigo = "";
                            
                            $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-#";
                          
                            $max=strlen($caracteres)-1;
                           
                            for($i=0;$i < $longitud;$i++)
                            {
                                $codigo.=$caracteres[rand(0,$max)];
                            }
                           
                            return $codigo;
                        }
                      
          

                    ?>
              <div id="mensaje"></div>
              <div class="panel-body">
                <form action="nuevolote.php" method="POST" autocomplete="on" id="form_pro">
               
                        <div class="form-group col-xs-12 col-md-4">
                     
                                <label for="nombre">Codigo:</label>
                                <input type="text" class="form-control" placeholder="codigo_lote" id="codigo_lote" value="<?php echo generarCodigo(); ?>" disabled>
                   
                        </div>

                        <div class="form-group col-xs-12 col-md-4">
                                <label for="usuario">Fecha de ingreso:</label>
                                <input type="text" disabled  id="fecha_ent" class="form-control" value="<?php echo $fecha; ?>">
                            </div>
              

                         <input type="hidden" name="codigo_lote" id="value_codigo">  
                         <input type="hidden" name="fecha_ent" id="value_fecha_ent">   

                      
                              <div class="form-group col-xs-12 col-md-4">
                                  <label for="proveedores_id">Proveedor:</label>
                                <select name="proveedores_id" id="proveedores_id" class="form-control">
                                    <option value="">Seleccione un proveedor</option>
                                    <?php while($row2=$proveedores->fetch_assoc()){ ?>
                                    <option value="<?php echo $row2['id_proveedor']; ?>"><?php echo $row2['nombre_proveedor']; ?></option>
                                    <?php } ?>
                                </select>
                              </div>
            
                         
                                                       
                            <div class="form-group botones-formulario col-xs-12" style="">
                               <center>
                                <button type="submit" id="datoslote" name="" class="btn btn-lca">
                                    <i class="fa fa-arrow-right"></i>
                                </button>
                                <a href="lotes.php" class="btn btn-lca "><i class="fa fa-undo"></i></a>
                                </center>
                            </div>                      
                        </form>
              </div>
            </div>
          </div>
        </div>
</div>
</div>
 <?php require_once("footer.php"); ?>
 <script>
     $(document).ready(function(){
        var nuevocodigo=$('#codigo_lote').val();
        $('#value_codigo').attr('value',nuevocodigo)        
        var codigo=$('#value_codigo').val();

         var nuevafecha=$('#fecha_ent').val();
        $('#value_fecha_ent').attr('value',nuevafecha)        
        var codigo=$('#value_fecha_ent').val();



        $('#datoslote').click(function(){

          var fecha_venc=$('#fecha').val();
          var proveedores=$('#proveedores_id').val();

          if(proveedores==''){
            swal("Seleccione un proveedor","","error");
            return false;
          } 

        });
     });
 </script>