<?php
require_once("header.php");
 ?>

<div class="page-content">


    <div class="container-fluid">
           <div class="bread-content">
            <div class="container">
                <h4>Caja</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Caja</span>
            </div>
        </div>
        <div class="row">
        	<div class="col-xs-12">
        		<a href="pagos.php" class="btn btn-lca nuevo"><span class="fa fa-search"></span> Ver Pagos</a>
            </div>
        		
        	</div>

      
    <div id="mensajes"></div>
       <div class="panel panel-default" style="margin-top: -20px;">
           <div class="panel-heading">
               <strong><h4>Caja</h4></strong>
           </div>
           <div class="panel-body">
            <form id="form_pago">
                <div class="alert alert-info">
                    <label>Nombre del Paciente</label>
                    <?php require_once("../config/conexion.php"); 
                    $select=$con->query("SELECT * FROM consultas INNER JOIN pacientes ON consultas.ced_paciente=pacientes.ced_paciente WHERE consultas.status_pago='pendiente' GROUP BY pacientes.ced_paciente");
                    ?>
                    <select class="form-control" id="cliente" name="cliente">
                        <option>Seleccione el cliente a cancelar</option>
                        <?php while($row=mysqli_fetch_assoc($select)){ ?>
                        <option value="<?php echo $row['ced_paciente']; ?>"><?php echo $row['nombres']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div id="content">
                    
                </div>
               
                <div class="text-center botones-formulario col-xs-12" style="margin-top: 20px; display: none;" id="boton">
                    <button type="submit" id="guardar_pago" class="btn btn-primary">Realizar Pago</button>
                </div>   
           </div>
       </form>
       </div>

        </div>
        <?php require_once("footer.php"); ?>
</div>
    
</div>
<script>
    $(document).ready(function(){
        $('#cliente').change(function(){
            var cliente=$('#cliente').val();
            var data='cliente='+cliente;
            if(cliente===''){
                swal("Seleccione el cliente","","error");
                return false;
            }else{
                $.ajax({
                    url:"caja/change_caja.php",
                    type:"POST",
                    data:data,
                    success:function(data){
                        $('#content').html(data);
                        $('#boton').css("display","block");
                    }
                });
            }
        });
    }); 
</script>
<script>
    $(document).ready(function(){
        $('#guardar_pago').click(function(e){
            e.preventDefault();
            var data=$('#form_pago').serialize();
            $.ajax({
                url:"caja/addfactura.php",
                type:"POST",
                data:data,
                success:function(data){
                    $('#mensajes').html(data);
                }
            }); 
        }); 
    });
</script>

