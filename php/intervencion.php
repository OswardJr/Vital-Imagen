<?php 
require_once("header.php");
 ?>
<div class="page-content">

    <div class="container-fluid">
        <div class="bread-content">
            <div class="container">
                <h4>Intervenciones</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Administración <i class="fa fa-caret-right"></i> Intervenciones</span>
            </div>
        </div>
        <div class="row" style="">

            <div class="col-xs-12 ">

                <a href="nuevaintervencion2.php" class="btn btn-lca nuevo" style=""><span class="fa fa-user-plus"></span> Agregar Intervención</a>

                <div class="panel panel-default" style="">
                    <div class="panel-heading">
                        <center>
                            <h3>Intervenciones</h3>
                        </center>
                    </div>
                    <?php 
        			require_once("../config/conexion.php");
        			$intervencion=$con->query("SELECT * FROM intervencion WHERE status_intervencion='Activo' ORDER BY id_intervencion DESC");
        			 ?>
                    <div id="content"></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tabla" class="display">
                                <thead>
                                   
                                    <th>Nombre de la Intervención</th>
                                    <th>Precio</th>
                                    <th>Ver/Eliminar</th>
                                </thead>
                                <tbody id="content">
                                 <?php while ($in=mysqli_fetch_array($intervencion)) {
                                    $id_intervencion=$in['id_intervencion'];
                                    $profesionales=$con->query("SELECT * FROM presupuesto_intervencion INNER JOIN doctores ON presupuesto_intervencion.id_doctor=doctores.id_doctor INNER JOIN especialidades ON doctores.id_especialidad=especialidades.id_especialidad WHERE id_intervencion='$id_intervencion'");
                                    $insumos=$con->query("SELECT * FROM presupuesto_intervencion INNER JOIN productos ON presupuesto_intervencion.id_producto=productos.id_producto WHERE id_intervencion='$id_intervencion'");
                                    ?>
                                 <tr>
                                  
                                     <td><?php echo $in['nombre_intervencion']; ?></td>
                                     <td><?php echo $in['precio_total']; ?></td>
                                     <td><a href="#" class="btn btn-info" data-target="#vercita" onclick="verintervencion('<?php echo $in['nombre_intervencion'] ?>','<?php echo $in['descripcion_intervencion'] ?>','<?php echo $in['cantidad_quirofano'] ?>','<?php echo $in['importe_quirofano'] ?>','<?php echo $in['cantidad_oxigeno'] ?>','<?php echo $in['importe_oxigeno'] ?>','<?php echo $in['cantidad_reten'] ?>','<?php echo $in['importe_reten'] ?>','<?php echo $in['cantidad_hospitalizacion'] ?>','<?php echo $in['importe_hospitalizacion'] ?>','<?php echo $in['cantidad_medico'] ?>','<?php echo $in['importe_medico'] ?>','<?php echo $in['cantidad_enfermera'] ?>','<?php echo $in['importe_enfermera'] ?>','<?php echo $in['cantidad_alimentacion'] ?>','<?php echo $in['importe_alimentacion'] ?>','<?php if($profesionales->num_rows<1){
                                            echo 'No se asignaron Honorarios';
                                     }else{ while($pro=mysqli_fetch_array($profesionales)){
                                                echo $pro['nombre'].', ';
                                     } }?>','<?php if($insumos->num_rows<1){
                                        echo 'No hay Insumos asigndos';
                                     }else{
                                        while($i=mysqli_fetch_array($insumos)){
                                            echo $i['nombre_producto'].', ';
                                        }
                                     } ?>','<?php echo $in['precio_total'] ?>')" data-toggle="modal" ><span class="fa fa-eye"></span></a> <a href="javascript:eliminar_intervencion('<?php echo $in['id_intervencion']; ?>')"  class="btn btn-danger"><span class="fa fa-trash"></span></a> <a href="../reportes/presupuestos/reporteintervencion.php?id=<?php echo $in['id_intervencion']; ?>" target="_blank"><img src="../public/multimedia/pdf.png" title="Exportar PDF"></a>
                                   </td>
                                 </tr>
                                 <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    
      <div class="modal fade modal-view" id="vercita">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                                <h3 class="modal-title"> Ver Intervención</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <table class="table">
                                        <tr>
                                            <td id="ver_nombre"></td>
                                            <td id="ver_descripcion"></td>
                                        </tr>
                                        <tr>
                                            <td id="ver_profesionales">
                                            
                                            </td>
                                            <td id="ver_insumos">
                                                
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="row">
                                    <h3 class="text-center">Datos de la Intervención</h3>
                                    <div class="col-md-12">
                                         <table class="table">
                                           <thead>
                                               <th>Detalle</th>
                                               <th>Cantidad</th>
                                               <th>Importe</th>
                                           </thead>
                                        <tbody>
                                        <tr>
                                            <td id="ver_quirofano"><b>Quirofano x hora</b></td>
                                            <td id="ver_cantidad_quirofano"></td>
                                            <td id="ver_importe_quirofano"></td>
                                        </tr>
                                         <tr>
                                            <td id="ver_oxigeno"><b>Oxigeno</b></td>
                                            <td id="ver_cantidad_oxigeno"></td>
                                            <td id="ver_importe_oxigeno"></td>
                                        </tr>
                                         <tr>
                                            <td id="ver_reten"><b>Reten</b></td>
                                            <td id="ver_cantidad_reten"></td>
                                            <td id="ver_importe_reten"></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                    </div>
                                </div>

                                <div class="row">
                                    <h3 class="text-center">Hospitalización</h3>
                                    <div class="col-md-12">
                                        <table class="table">
                                            <thead>
                                                <th>Detalle</th>
                                                <th>Cantidad</th>
                                                <th>Importe</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td id="ver_hospitalizacion"><b>Hospitalización</b></td>
                                                    <td id="ver_cantidad_hospitalizacion"></td>
                                                    <td id="ver_importe_hospitalizacion"></td>
                                                </tr>
                                                 <tr>
                                                    <td id="ver_medico"><b>Medico Residente</b></td>
                                                    <td id="ver_cantidad_medico"></td>
                                                    <td id="ver_importe_medico"></td>
                                                </tr>
                                                 <tr>
                                                    <td id="ver_enfermera"><b>Enfermera</b></td>
                                                    <td id="ver_cantidad_enfermera"></td>
                                                    <td id="ver_importe_enfermera"></td>
                                                </tr>
                                                 <tr>
                                                    <td id="ver_alimentacion"><b>Alimentación Balanceada</b></td>
                                                    <td id="ver_cantidad_alimentacion"></td>
                                                    <td id="ver_importe_alimentacion"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>    

                                </div>

                                <div class="row">
                                     <div class="col-md-4 alert alert-info">
                                         <h4>Total</h4>
                                         <input type="text" class="form-control" readonly value="" id="total">
                                     </div>
                                </div>

                                
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    Para cerrar esta ventana haga click fuera de ella o presione el boton cerrar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           

</div>
<?php require_once("footer.php"); ?>
<script type="text/javascript">
     var verintervencion = function(nombre, descripcion, cantidad_quirofano,importe_quirofano,cantidad_oxigeno,importe_oxigeno,cantidad_reten,importe_reten,cantidad_hospitalizacion,importe_hospitalizacion,cantidad_medico,importe_medico,cantidad_enfermera,importe_enfermera,cantidad_alimentacion,importe_alimentacion,profesionales,insumos,precio_total) {
                   var longitud = profesionales.length;
                    var longitud2 = insumos.length;
                    $('#ver_nombre').html('<b>Nombre de la Intervención : </b> '+ nombre);
                     $('#ver_descripcion').html('<b>Descripción : </b> '+ descripcion);
                      $('#ver_cantidad_quirofano').html(cantidad_quirofano);
                       $('#ver_importe_quirofano').html(importe_quirofano);
                        $('#ver_cantidad_oxigeno').html(cantidad_oxigeno);
                        $('#ver_importe_oxigeno').html(importe_oxigeno);
                        $('#ver_cantidad_reten').html(cantidad_reten);
                        $('#ver_importe_reten').html(importe_reten);
                         $('#ver_cantidad_hospitalizacion').html(cantidad_hospitalizacion);
                          $('#ver_importe_hospitalizacion').html(importe_hospitalizacion);
                           $('#ver_cantidad_medico').html(cantidad_medico);
                            $('#ver_importe_medico').html(importe_medico);
                             $('#ver_cantidad_enfermera').html(cantidad_enfermera);
                              $('#ver_importe_enfermera').html(importe_enfermera);
                               $('#ver_cantidad_alimentacion').html(cantidad_alimentacion);
                                $('#ver_importe_alimentacion').html(importe_alimentacion);
                                   $('#ver_profesionales').html('<b>Profesionales : </b>'+profesionales.substr(0, longitud - 1) );
                                    $('#ver_insumos').html('<b>Insumos: </b>'+insumos.substr(0, longitud2 - 1) );
                                    $('#total').val(precio_total);




                };

                function eliminar_intervencion(id) {

                    swal({
                        title: 'Eliminar Intervención',
                        text: "¿Desea eliminar esta intervención?",
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
                            url: "presupuestos/delete_intervencion.php",
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
