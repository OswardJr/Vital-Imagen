<?php 
require_once("header.php");
 ?>
<div class="page-content">

    <div class="container-fluid">
        <div class="bread-content">
            <div class="container">
                <h4>Nueva Intervención</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Administración <i class="fa fa-caret-right"></i> Intervenciones <i class="fa fa-caret-right"></i> Nueva Intervención</span>
            </div>
        </div>
            <div id="mensaje"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading"><h3>Nueva Intervención</h3></div>
                        <div class="panel-body">
                            <form action="" id="form_intervencion">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="">Nombre de la Intervención</label>
                                        <input type="text" class="form-control" id="nombre_intervencion" name="nombre_intervencion" placeholder="Ejem: Cesarea">
                                    </div>
                                     <div class="form-group col-md-6">
                                        <label for="">Descripción</label>
                                        <input type="text" class="form-control" name="descripcion_intervencion" id="descripcion_intervencion" placeholder="Ejem: Cesarea 12 semanas de embarazo">
                                    </div>
                                </div>
                                <hr>
                                <div class="row" style="margin-top: 10px;">
                                    <h4 class="text-center col-md-12">Datos de la Intervención</h4>
                                </div>
                                <div class="row">
                                     <div class="form-group col-md-4">
                                        <h4>Quirofano:</h4>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_quirofano" name="cantidad_quirofano">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_quirofano" name="importe_quirofano">
                                    </div>

                                </div>
                                <div class="row">
                                     <div class="form-group col-md-4">
                                      <h4>Oxigeno:</h4>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_oxigeno" name="cantidad_oxigeno">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_oxigeno" name="importe_oxigeno">
                                    </div>

                                </div>
                                <div class="row">
                                     <div class="form-group col-md-4">
                                        <h4>Reten:</h4>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_reten" name="cantidad_reten"> 
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_reten" name="importe_reten">
                                    </div>

                                </div>
<hr>
                                 <div class="row" style="margin-top: 10px;">
                                    <h4 class="text-center col-md-12">Hospitalización</h4>
                                </div>

                                  <div class="row">
                                     <div class="form-group col-md-4">
                                       <h4>Hospitalización Clinica:</h4>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_hospitalizacion" name="cantidad_hospitalizacion">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_hospitalizacion" name="importe_hospitalizacion">
                                    </div>

                                </div> 

                                <div class="row">
                                     <div class="form-group col-md-4">
                                        <h4>Medico Residente:</h4>                                    
                                      </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_medico" name="cantidad_medico">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_medico" name="importe_medico">
                                    </div>

                                </div> 

                                <div class="row">
                                     <div class="form-group col-md-4">
                                      <h4>Enfermera:</h4>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_enfermera" name="cantidad_enfermera">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_enfermera" name="importe_enfermera">
                                    </div>

                                </div>
                          <div class="row">
                                     <div class="form-group col-md-4">
                                      <h4>Alimentación Balanceada:</h4>
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Cantidad</label>
                                        <input type="number" class="form-control" id="cantidad_balanceada" name="cantidad_balanceada">
                                    </div>
                                     <div class="form-group col-md-4">
                                        <label for="">Importe</label>
                                        <input type="text" class="form-control" id="importe_balanceada" name="importe_balanceada">
                                    </div>

                                </div>
                                <hr>

                                <div class="row" style="margin-top: 10px;">
                                    <h4 class="col-md-12 text-center">Honorarios Profesionales</h4>
                                </div>
                                <div class="row">
                              <div class="col-md-12"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                <span class="fa fa-plus"></span> Profesionales
                              </button></div>

                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
                                        <table class="table ">
                                            <thead>
                                                <th>Especialidad</th>
                                                <th>Doctor</th>
                                                <th>Importe</th>
                                                <th>&nbsp</th>
                                            </thead>
                                            <tbody id="content1">
                                                <?php $profesionales=$con->query("SELECT * FROM temp_profesionales INNER JOIN doctores ON temp_profesionales.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad"); 
                                                while($pro=mysqli_fetch_array($profesionales)){
                                                ?>
                                                <tr>
                                                    <td><?php echo $pro['nombre_especialidad']; ?></td>
                                                    <td><?php echo $pro['nombre']; ?></td>
                                                    <td><?php echo $pro['importe']; ?></td>
                                                    <td><input type="hidden" value="<?php echo $pro['id_doctor']; ?>" name="id_prof[<?php echo $pro['id_doctor']; ?>]"><input type="hidden" value="<?php echo $pro['importe']; ?>" name="importe_profesional[<?php echo $pro['id_doctor']; ?>]"></td>
                                                    <td><a class="btn btn-danger" href="javascript:eliminar_profesional('<?php echo $pro['id_doctor']; ?>')"><span class="fa fa-trash"></span></a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                    <hr>
                                 <div class="row" style="margin-top: 10px;">
                                    <h4 class="col-md-12 text-center">Insumos</h4>
                                </div>

                                <div class="row">
                                    <div class="col-md-12"><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#insumos"><span class="fa fa-plus"></span> Insumos</button></div>
                                </div>
                                <div class="row" style="margin-top: 10px;">
                                    <div class="col-md-12">
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
                                 <?php $temp=$con->query("SELECT p.*,t.cantidad FROM temp_productos AS t INNER JOIN productos AS p ON t.id_producto=p.id_producto"); 
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
                                </div>
                                <div class="text-center botones-formulario col-xs-12" style="margin-top: 20px;">                           
                                <button type="submit" id="guardar" name="guardar" class="btn btn-lca" style="" title="Guardar">
                                    <i class="fa fa-save"></i>
                                </button>
                                <a href="presupuesto.php" class="btn btn-lca" title="regresar">
                                    <i class="fa fa-undo"></i>
                                </a>
                            </div>   
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       
        <div class="modal fade" id="insumos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel2">Insumos</h4>
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
  
<div class="container">
    <!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Honorarios Profesionales</h4>
      </div>
      <div class="modal-body">
        <div class="row">
           
            <form action="" id="form_profesional">
                <div class="form-group col-md-3">
                    <label for="">Especialidad</label>
                    <?php $especialidad=$con->query("SELECT * FROM especialidades WHERE status='activo'") ?>
                  <select name="" class="form-control" id="id_especialidad">
                      <option value="">Seleccione La especialidad</option>
                      <?php while ($cat=mysqli_fetch_assoc($especialidad)) { ?>
                      <option value="<?php echo $cat['id_especialidad']; ?>"><?php echo $cat['nombre_especialidad']; ?></option>
                      <?php } ?>
                  </select>
                </div>
                 <div class="form-group col-md-3">
                    <label for="">Nombre</label>
                    <select name="id_profesional" id="id_profesional" class="form-control">
                        <option value="">Seleccione el Nombre</option>
                    </select>
                </div>
                 <div class="form-group col-md-3">
                    <label for="">Importe</label>
                    <input type="text" class="form-control" name="importe_profesional" id="importe_profesional">
                </div>
                 <div class="form-group col-md-3" style="margin-top: 24px;">
                     <button class="btn btn-success" type="submit" title="Agregar Profesional" id="agg_profesional"><span class="fa fa-plus"></span></button>
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
</div>

   <!--Insumos-->


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
                $('#insumos').modal('hide');
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
        $('#id_especialidad').change(function(){
            var id_especialidad=$('#id_especialidad').val();
            $.ajax({
                url:"presupuestos/change_especialidad.php",
                type:"POST",
                data:'id_especialidad='+id_especialidad,
                success:function(data){
                    $('#id_profesional').append(data);
                }
            });
            
        });
    });
</script>
<script>
    $(document).ready(function(){
        $('#agg_profesional').click(function(e){
            e.preventDefault();
            var id_especialidad=$('#id_especialidad').val();
            var id_profesional=$('#id_profesional').val();
            var importe_profesional=$('#importe_profesional').val();
            var data=$('#form_profesional').serialize();
            if(id_especialidad===''){
                swal("Seleccione la especialidad","","error");
                return false;
            }else if(id_profesional===''){
                swal("Seleccione el nombre","","error");
                return false;
            }else if(importe_profesional===''){
                swal("Ingrese el valor de Importe a cancelar","","error");
                return false;
            }else{
                $.ajax({
                    url:"presupuestos/temp_profesionales.php",
                    type:"POST",
                    data:data,
                    success:function(data){
                        $('#form_profesional')[0].reset();
                        $('#content1').html(data);
                        $('#myModal2').modal('hide');
        
                    }
                });
            }
        });
    });
</script>

<script>
   function eliminar_profesional(id) {

                    swal({
                        title: 'Eliminar Honorario del profesional de la consulta',
                        text: "¿Desea eliminar este Honorario de la consulta?",
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
                            url: "presupuestos/deletetemp_profesional.php",
                            type: "POST",
                            data: 'id=' + id,
                            success: function(respuesta) {
                                $('#content1').html(respuesta);
                            }
                        });
                        return true;
                    }, function(dismiss) {})

                }
</script>

<script>
  $(document).ready(function(){
    $('#guardar').click(function(e){
      e.preventDefault();
      var nombre_intervencion,descripcion_intervencion,cantidad_quirofano,importe_quirofano,cantidad_oxigeno,importe_oxigeno,cantidad_reten,importe_reten,cantidad_hospitalizacion,importe_hospitalizacion,cantidad_medico,importe_medico,cantidad_enfermera,importe_enfermera,cantidad_balanceada,importe_balanceada;

      nombre_intervencion=$('#nombre_intervencion').val();
      descripcion_intervencion=$('#descripcion_intervencion').val();
      cantidad_quirofano=$('#cantidad_quirofano').val();
      importe_quirofano=$('#importe_quirofano').val();
      cantidad_oxigeno=$('#cantidad_oxigeno').val();
      importe_oxigeno=$('#cantidad_oxigeno').val();
      cantidad_reten=$('#cantidad_reten').val();
      importe_reten=$('#importe_reten').val();
      cantidad_hospitalizacion=$('#cantidad_hospitalizacion').val();
      importe_hospitalizacion=$('#importe_hospitalizacion').val();
      cantidad_medico=$('#cantidad_medico').val();
      importe_medico=$('#importe_medico').val();
      cantidad_enfermera=$('#cantidad_enfermera').val();
      importe_enfermera=$('#importe_enfermera').val();
      cantidad_balanceada=$('#cantidad_balanceada').val();
      importe_balanceada=$('#importe_balanceada').val();

      if(nombre_intervencion===''){
        swal("Ingrese el Nombre de la Intervención","","error");
        return false;
      }else if(descripcion_intervencion===''){
          swal("Ingrese la descripcion de la intervencion","","error");
          return false;
      }else if(cantidad_quirofano===''){
        swal("Ingrese cantidad de horas en Quirofano","","error");
        return false;
      }else if(importe_quirofano===""){
        swal("Ingrese el importe a cancelar por las horas de Quirofano","","error");
        return false;
      }else if(cantidad_oxigeno===''){
        swal("Ingrese cantidad de horas de Oxigeno a utilizar","","error");
        return false;
      }else if(importe_oxigeno===''){
        swal("Ingrese el importe a cancelar por las horas de Oxigeno","","error");
        return false;
      }else if(cantidad_reten===''){
        swal("Ingrese la cantidad de horas de Guardia","","error");
        return false;
      }else if(importe_reten===""){
        swal("Ingrese el importe a cancelar por las horas de guardia","","error");
        return false;
      }else if(cantidad_hospitalizacion===''){
        swal("Ingrese La cantidad de dias de hospitalización","","error");
        return false;
      }else if(importe_hospitalizacion===''){
        swal("Ingrese el importe a cancelar por dias de hospitalización","","error");
        return false;
      }else if(cantidad_medico===''){
        swal("Ingrese la cantidad de dias del medico residente","","error");
        return false;
      }else if(importe_medico===''){
        swal("Ingrese el importe a cancelar por la cantidad de dias del medico residente","","error");
        return false;
      }else if(cantidad_enfermera===''){
        swal("Ingrese la cantidad de dias de la Enfermera","","error");
        return false;
      }else if(importe_enfermera===''){
        swal("Ingrese el importe a cancelar por la cantidad de dias de la enfermera","","error");
        return false;
      }else if(cantidad_balanceada===''){
        swal("Ingrese la cantidad de dias con comida balanceada","","error");
        return false;
      }else if(importe_balanceada===''){
        swal("Ingrese el importe a cancelar por los dias de comida","","error");
        return false;
      }else{
        $.ajax({
          url:"presupuestos/nueva_intervencion.php",
          type:"POST",
          data:$('#form_intervencion').serialize(),
          success:function(data){
            $('#mensaje').html(data);
          }
        });
      }
    });
  });
</script>