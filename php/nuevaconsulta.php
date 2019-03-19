<?php 
    require_once("../config/conexion.php");
    require_once("header.php");

 ?>

<div class="page-content">
    <div class="bread-content">
        <div class="container">
            <h4>Consulta Medica</h4>
            
        </div>
    </div>
<?php 
$cita=$_GET['id'];
$sql="SELECT p.*,c.id_citas,c.fecha_cita,c.hora,d.id_doctor,d.nombre,e.nombre_especialidad FROM pacientes as p INNER JOIN citas AS c ON p.ced_paciente=c.ced_paciente INNER JOIN doctores as d ON d.id_doctor=c.id_doctor INNER JOIN especialidades as e ON e.id_especialidad=d.id_especialidad WHERE c.id_citas='$cita'";    
$r=$con->query($sql);
$row=$r->fetch_assoc();
?>
    <div class="container-fluid">
    <!-- Menu -->
    <div>
  <div id="mensaje"></div>
  <!-- Tab panes -->
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3>Consulta</h3>
        </div>
        <div class="panel-body">
            <form id="form_consulta">
            <div class="form-group col-md-4">
               <label for="">Nro Historia</label> 
               <input type="text" class="form-control" readonly value="<?php echo $row['nro_historia']; ?>">
            </div>
            <div class="form-group col-md-4">
               <label for="">Nombre</label> 
               <input type="text" class="form-control" readonly value="<?php echo $row['nombres']; ?>">
            </div>
            <div class="form-group col-md-4">
               <label for="">Especialidad</label> 
               <input type="text" class="form-control" readonly value="<?php echo $row['nombre_especialidad']; ?>">
            </div>
            <div class="form-group col-md-4">
               <label for="">Doctor</label> 
               <input type="text" class="form-control" readonly value="<?php echo $row['nombre']; ?>">
            </div>
            <div class="form-group col-md-4">
               <label for="">Consulta por <span style="color: red;">*</span></label> 
               <textarea name="consulta" id="consulta" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-4">
               <label for="">Tratamiento <span style="color: red;">*</span></label> 
               <textarea name="tratamiento" id="tratamiento" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-4">
               <label for="">Diagnostico <span style="color: red;">*</span></label> 
               <textarea name="diagnostico" id="diagnostico" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group col-md-4">
               <label for="">Indicaciones <span style="color: red;">*</span></label> 
               <textarea name="indicaciones" id="indicaciones" cols="30" rows="10" class="form-control"></textarea>
            </div>
             <div class="form-group col-md-4">
               <label for="precio">Precio de la consulta <span style="color: red;">*</span></label> 
              <input type="text" name="precio" id="precio" class="form-control" placeholder="5000,00">              
              </div>
            <input type="hidden" id="cedula" name="cedula" value="<?php echo $row['ced_paciente']; ?>">
            <input type="hidden" name="id_cita" value="<?php echo $cita; ?>">
            <input type="hidden" name="fecha_cita" value="<?php echo $row['fecha_cita']; ?>">
            <input type="hidden" name="hora" value="<?php echo $row['hora']; ?>">
            <input type="hidden" name="doctor" value="<?php echo $row['id_doctor']; ?>">
            <div class="col-md-12">
              <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#myModal">
               Agregar Insumos <span class="fa fa-plus"></span>
            </button>
            </div>
            <div class="col-md-12" style="margin-top: 10px;">
                <table class="table">
                  <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>&nbsp;</th>

                  </tr>
                  </thead>
                  <tbody id="content">
                    <?php $temp=$con->query("SELECT p.*,t.cantidad FROM temp_productos AS t INNER JOIN productos AS p ON t.id_producto=p.id_producto GROUP BY t.id_producto"); 
                    $total1=0;
                    
                      while($prod=mysqli_fetch_array($temp)){
                      $precio=$prod['precio'];
                      $cantidad=$prod['cantidad'];
                      $total=$precio*$cantidad;
                      $total1 += $total;
                      
                    ?>
                    <tr>
                        <td><?php echo $prod['nombre_producto']; ?></td>
                          <td><?php echo $prod['cantidad']; ?></td>
                          <td><?php echo $prod['precio']; ?></td>
                          <td><input type="hidden" value="<?php echo $prod['id_producto']; ?>" name="id_pro[<?php echo $prod['id_producto']; ?>]"><input type="hidden" value="<?php echo $prod['cantidad']; ?>" name="cantidad[<?php echo $prod['id_producto']; ?>]"></td>
                           <td><a href="javascript:eliminar_producto('<?php echo $prod['id_producto'] ?>')" class="btn btn-danger" title="Eliminar" ><span class="fa fa-trash"></span> </a></td>
                          
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
            </div>
           
             <div class="botones-formulario text-center col-md-12">
              <button class="btn btn-lca" type="submit" id="guardar_consulta" title="Guardar"><span class="fa fa-save"></span></button>
              <a href="citascalendario.php" class="btn btn-lca" title="Volver"><i class="fa fa-undo"></i></a></div>
        </div>
        <div class="text-center"><strong>Completa los campos requeridos <span style="color: red;">*</span></strong></div>
        <input type="hidden" name="total" value="<?php echo $total1; ?>">
      </form>
    </div>
    </div>
    
  </div>
</div>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Insumos</h4>
      </div>
      <div class="modal-body">
        <form id="form_producto">
        <div class="row">
          <?php $categoria=$con->query("SELECT * FROM categorias WHERE status_categoria='Activo'"); 
          ?>
        <div class="form-group col-md-4">
          <label for="">Categoria</label>
          <select name="id_categoria" id="id_categoria" class="form-control">
            <option value="">Selecciona Categoria</option>
            <?php while($c=$categoria->fetch_assoc()) {?>
          <option value="<?php echo $c['id_categoria']; ?>"><?php echo $c['nombre_categoria']; ?></option>
          <?php } ?>
          </select>
        </div>
         <div class="form-group col-md-4">
          <label for="">Nombre del insumo</label>
          <select name="nombre_insumo" id="nombre_insumo" class="form-control" disabled>
            <option value="">Selecciona Insumo</option>
          </select>
        </div>
        <div class="form-group col-md-4">
          <label for="">Stock</label>
          <input type="text" class="form-control" placeholder="5"  readonly id="stock" name="stock">
        </div>
      </div>
      <div class="row">
         <div class="form-group col-md-4">
          <label for="">Precio</label>
          <input type="text" class="form-control" disabled placeholder="$2000" id="precio" name="precio">
        </div>
         <div class="form-group col-md-4">
          <label for="">Cantidad</label>
          <input type="number" class="form-control" disabled id="cantidad" name="cantidad">
        </div>
        <div class="form-group col-md-4" style="margin-top: 24px;">
          <button class="btn btn-success" type="submit" title="Agregar Insumo" id="agg"><span class="fa fa-plus"></span></button>
        </div>
    </form>
      </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

 <?php require_once("footer.php"); ?>
<script>
  $(document).ready(function(){
      $('#id_categoria').change(function(){
          var categoria,insumo,cantidad,data;
          id_categoria=$('#id_categoria').val();
          insumo=$('#nombre_insumo').val();
          cantidad=$('#cantidad').val();
          data='id_categoria='+id_categoria;

          if(id_categoria===''){
            swal("Seleccione la categoria","","error");
            return false;
          }else{
            $.ajax({
              url:"consultas/change_categoria.php",
              type:"POST",
              data:data,
              success:function(data){
                $('#nombre_insumo').append(data);
                $('#nombre_insumo').removeAttr('disabled');
              }
            });
          }
      });
  }); 
</script>
<script>
   $(document).ready(function(){
      $('#nombre_insumo').change(function(){
          var nombre_insumo,data;
          nombre_insumo=$('#nombre_insumo').val();
          data='nombre_insumo='+nombre_insumo;
          if(nombre_insumo ===''){
            swal("Seleccione el insumo","","error");
            return false;
          }else{
            $.ajax({
              url:"consultas/change_insumo.php",
              type:"POST",
              data:data,
              dataType:"JSON",
              success:function(data){
                $('#stock').val(data.stock);
                 $('#precio').val(data.precio);
                $('#cantidad').removeAttr('disabled');
              }
            });
          }
      });
  }); 
</script>
<script>
   $(document).ready(function(){
      $('#agg').click(function(e){
        e.preventDefault();
          var id_categoria,nombre_insumo,cantidad,stock,data;
          id_categoria=$('#id_categoria').val();
          nombre_insumo=$('#nombre_insumo').val();
          cantidad=$('#cantidad').val();
          stock=$('#stock').val();
          data=$('#form_producto').serialize();

          if(id_categoria===""){
            swal("Seleccione la categoria","","error");
            return false;
          }else if(nombre_insumo===""){
            swal("Seleccione el nombre del insumo","","error");
            return false;
          }else if(cantidad===""){
            swal("Ingrese la cantidad","","error");
            return false;
          }else{
            $.ajax({
              url:"consultas/temp_insumos.php",
              type:"POST",
              data:data,
              success:function(data){
                $('#content').html(data);
                $('#myModal').modal('hide');
                $('#form_producto')[0].reset();
                $('#nombre_insumo').AddAttr('disabled');
                $('#cantidad').AddAttr('disabled');
                swal("Insumo agregado con exito","","success");
                $('#cancelar').val('<?php echo $total1; ?>');
              } 
            });
          }
      });
  }); 

</script>
<script>
   function eliminar_producto(id) {

                    swal({
                        title: 'Eliminar insumo de la consulta',
                        text: "¿Desea eliminar este insumo de la consulta?",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, eliminar',
                        cancelButtonText: 'No, cancelar!',
                        confirmButtonClass: 'btn btn-primary',
                        cancelButtonClass: 'btn btn-warning',
                        buttonsStyling: false
                    }).then(function() {
                        $.ajax({
                            url: "consultas/deletetemp_producto.php",
                            type: "POST",
                            data: 'id=' + id,
                            success: function(respuesta) {
                                $('#content').html(respuesta);
                            }
                        });
                        return true;
                    }, function(dismiss) {})

                }
</script>

<script>
  $(document).ready(function(){
      $('#guardar_consulta').click(function(e){
        e.preventDefault();
         var consulta,tratamiento,diagnostico,indicaciones,precio;
         consulta=$('#consulta').val();
         tratamiento=$('#tratamiento').val();
         diagnostico=$('#diagnostico').val();
         indicaciones=$('#indicaciones').val();
         precio=$('#precio').val();
         if(consulta===""){
          swal("Ingrese el motivo de la consulta","","error");
          return false;
         }else if(tratamiento===""){
            swal("Ingrese el tratamiento","","error");
            return false;
         }else if(diagnostico===""){
            swal("Ingrese el diagnostico","","error");
            return false;
         }else if(indicaciones===""){
            swal("Ingrese las indicaciones","","error");
            return false;
         }else if(precio===""){
          swal("Ingrese el precio de la consulta","","error");
          return false;
         }else {
          $.ajax({
            url:"consultas/addconsulta.php",
            type:"POST",
            data:$('#form_consulta').serialize(),
            success:function(data){
                $('#mensaje').html(data);
            }
          });
         }
      }); 
  });
</script>

<script>
  $(document).ready(function(){
      $('#precio').blur(function(e){
          e.preventDefault;
          var precio=$('#precio').val();
          var cancelar=$('#cancelar').val();
          var total;
          total=parseFloat(precio)+parseFloat(cancelar);
          $('#cancelar').val(total);
          return false;
      });
  });
</script>