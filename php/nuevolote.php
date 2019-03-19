<?php 
require_once("header.php");
 ?>

<div class="page-content">
   <div class="container-fluid">
    <div class="bread-content">
        <div class="container">
            <h4>Ingresar Lote</h4>
            <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Inventario <i class="fa fa-caret-right"></i> Lotes <i class="fa fa-caret-right"></i> Ingresar Lote</span>
        </div>
    </div>
  <?php

    if (isset($_POST['codigo_lote'])) {
      $codigo=$_POST['codigo_lote'];
      $proveedor=$_POST['proveedores_id'];
      $fechaEnt=$_POST['fecha_ent'];
    }else{
      header('location:lotes.php');
    }
   
  ?>

        <div class="row" style="margin-top: 10px;">
        	<div class="col-xs-12 ">
        
        		<div class="panel panel-default">
             <div class="panel-heading">
             <center><h3 >Lote: <?php echo $codigo; ?></h3></center>
             </div>
               <div id="content"></div>
                  <div class="panel-body">
                        <div class="lotes">
                  <center><h3 class="lotevacio"><i class="fa fa-warning"></i> Sin productos registrados en el lote</h3></center>
                  <form action="" method="" id="formulariolote" autocomplete="on">
                      <input type="hidden" name="codigo_lote" value="<?php echo $codigo;?>" class="">
                      <input type="hidden" name="numero_productos" id="numprod">
                      <input type="hidden" name="proveedores_id" value="<?php echo $proveedor;?>" class="">
                      <input type="hidden" name="fecha_ent" value="<?php echo $fechaEnt;?>" class="">
                      <div class="table-responsive">
                        <table class="table table-striped" id="lote">
                          <thead>
                            <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Stock</th>
                            <th>Cantidad/Fecha de vencimiento</th>
                            <th>Opcion</th>
                            </tr>
                          </thead>
                          <tbody>
                              
                          </tbody>

                        </table>
                        </div>
                      <div class="botones-formulario text-center">
                        
                      <a href="lotes.php" class="btn btn-lca"><i class="fa fa-undo"></i> Regresar</a>
                     <button type="submit" id="addlote" class="btn hidden btn-lca" name="addlote"><i class="fa fa-caret-right"></i>Ingresar lote</button>
                      </div>
                    
                  </form>
                  <hr>
                  </div>
                  <!--PRODUCTOS-->
          <div class="productos">
  <center><h3>Lista de productos disponibles</h3></center>
  <br><br>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="table-responsive">
    <table class="table table-striped dataTab">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripcion</th>
          <th>Stock</th>
          <th>Opcion</th>
          <th></th>
        </tr>
      </thead>
      <tbody id="contentproductos">
      <?php 
       $sql="SELECT * FROM productos INNER JOIN categorias ON productos.categorias_id = categorias.id_categoria WHERE status_producto='Activo' AND status_categoria='Activo' ";
      $consulta=$con->query($sql);
      while($productos=mysqli_fetch_array($consulta)){ ?>
          <tr>
            <td><?php echo $productos['nombre_producto']; ?></td>
            <td><?php echo $productos['descripcion_producto']; ?></td>
            <td><?php echo $productos['stock']; ?></td>
            <!--Estos son los inputs que apareceran en lotes-->
            <td class="lote-opcion">
              <input type="number" min="1" max="50" class="addstockpro" name="addstock[<?php echo $productos['id_producto'];?>]">
              <input type="date" class="fecha_venc" name="fecha_venc[<?php echo $productos['id_producto'];?>]">
              <input type="hidden" name="stockpro[<?php echo $productos['id_producto']; ?>]" value="<?php echo $productos['stock']; ?>">
              <input type="hidden" name="idpro[<?php echo $productos['id_producto']; ?>]" value="<?php echo $productos['id_producto']; ?>">
            </td>
            <td>
              <input type="button" class="btn btn-primary additem" title="Agregar producto" value="+">
              <input type="button" class="btn btn-danger menositem" title="Eliminar producto" value="-">
            </td>
          </tr>
      <?php } ?>
         </tbody>
    </table>
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

  $('#lote').hide();
  $('.lote-opcion').hide();
  $('.menositem').hide();

  $(document).on('click','.additem',function(){
    if($('#lote tbody').children('tr').length == '0'){
      $('.lotevacio').hide();
      $('#lote').fadeIn(200);
        $('#addlote').removeClass('hidden');
    }
    $(this).hide();
    $(this).parent().children('.menositem').show();
    var fila=$(this).parent().parent();
    $(fila).children('.lote-opcion').show();
    $(fila).clone().prependTo('#lote>tbody');
    $(fila).remove();
  });

  $(document).on('click','.menositem',function(){
    $(this).fadeOut();
    if($('#lote tbody').children('tr').length == '1'){
      $('.lotevacio').show();
      $('#lote').hide();
      $('#addlote').addClass('hidden');
    }
    $(this).hide();
    $(this).parent().children('.additem').show();
    var fila=$(this).parent().parent();
    $(fila).children('.lote-opcion').hide();
    $(fila).clone().appendTo('#contentproductos');
    $(fila).remove();
  });

  $('#addlote').click(function(e){
    e.preventDefault();
        var numprolotes=$('#lote tbody').children('tr').length;
        $('#numprod').attr('value',numprolotes);

    if($('.addstockpro').val() == ''){
      swal('Campos vacios','Asegurese de que cada producto ingresado posea su cantidad correspondiente','error');
    }else if($('.addstockpro').val() < 0 || $('.addstockpro').val() >= 50){
      swal('Debe ingresar una cantidad de productos mayor a 0 o menor o igual a 50','','error');
    }else if($('.fecha_venc').val() == ''){
      swal('Campos vacios','debe ingresar la fecha de vencimiento','error');
    }else{
        swal({
  title: 'Agregar lote',
  text: "¿Desea agregar este lote?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, agregar',
  cancelButtonText: 'No, cancelar!',
  confirmButtonClass: 'btn btn-primary',
  cancelButtonClass: 'btn btn-warning',
  buttonsStyling: false
}).then(function () {
            $.ajax({
                url:"lotes/addlote.php",
                type:"POST",
                data: $('#formulariolote').serialize(),
                success:function(respuesta){
                    $('#content').html(respuesta);
                    return false;
                }
            });
            return true;    
}, function (dismiss) {
})

    }


});

});
 </script>
 <script>
       $(document).ready(function() {
        $('.dataTab').DataTable({
            "language": {
                "lengthMenu": "Registros por pagina: _MENU_",
                "info": "Página _PAGE_ de _PAGES_",
                "infoEmpty": "No hay Registros disponibles",
                "infoFiltered": "(filtrada de _MAX_ registros)",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "<i class='fa fa-search'></i>",
                "zeroRecords": "No se encontraron registros coincidentes",
                "paginate": {
                    "next": "<i class='fa fa-angle-double-right'></i>",
                    "previous": "<i class='fa fa-angle-double-left'></i>"
                },
            }

        });
    });
 </script>
 