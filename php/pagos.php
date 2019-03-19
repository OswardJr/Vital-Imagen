<?php
require_once("header.php");
require_once("../config/conexion.php");
$pagos=$con->query("SELECT * FROM pagos INNER JOIN pacientes ON pagos.ced_paciente=pacientes.ced_paciente INNER JOIN usuarios ON pagos.id_usuario=usuarios.id_usuario");
 ?>

<div class="page-content">


    <div class="container-fluid">
           <div class="bread-content">
            <div class="container">
                <h4>Pagos</h4>
                <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i> Caja <i class="fa fa-caret-right"></i> Pagos</span>
            </div>
        </div>
        <div class="row" style="">
        	<div class="col-xs-12 col-xs-offset-">
             
            <div class="" style="">
               
        		<a href="caja.php" class="btn btn-lca nuevo  col-xs-offset"><span class="fa fa-cart-plus"></span> Ir a la Caja</a><br>
                 <!--<form class="form-inline">
                        <div class="form-group">
                            <span>
                            <label for="desde" style="font-size: 18px;">Desde:</label>
                            <input type="date" id="desde" name="desde" class="form-control input-sm">
                              <label for="hasta" style="font-size: 18px;">Hasta:</label>
                            <input type="date" id="hasta" name="hasta" class="form-control input-sm">
                            <button class="btn btn-sm btn-default" type="button" title="Buscar pagos" onclick="buscar_pagos();"><span class="fa fa-search"></span></button>
                          </span>
                        </div>
                    </form>
                    <br>
                -->
                </div>
        		<div class="panel panel-default" id="oculto" style="">
        			<div class="panel-heading">
        				<center><h3 style="">Listado de Pagos</h3></center>
        			</div>
                     <div id="content"></div>
        			<div class="panel-body" id="">
                     <div class="table-responsive">
        				<table id="tabla" class=" table display">
        					<thead>
        						<th>Usuario</th>
                                <th>Paciente</th>
        						<th>Fecha</th>
                                <th>Hora</th>
                                <th>Importe</th>
                                <th>Ver/Editar/Eliminar</th>
        					</thead>
        					<tbody id="tbodytabla">
                                <?php
                                 while($p=mysqli_fetch_array($pagos)){
                                ?>
                                <tr>
                                    <td><?php echo $p['usuario']; ?></td>
                                    <td><?php echo $p['nombres']; ?></td>
                                    <td><?php echo $p['fecha']; ?></td>
                                    <td><?php echo $p['hora']; ?></td>
                                    <td><?php echo $p['total_cancelar']; ?></td>
                                    <td><a href="#" onclick="verpago('<?php echo $p['nro_pago']?>','<?php echo $p['usuario']?>','<?php echo $p['nombres']?>','<?php echo $p['fecha']?>','<?php echo $p['hora'] ?>','<?php echo $p['total_cancelar'] ?>')" data-target="#verpago" data-toggle="modal" class="btn btn-info" style=""><span class="fa fa-eye" style=""></span></a> <a href="javascript:eliminar_pago('<?php echo $p['nro_pago']; ?>')" class="btn btn-danger"><span class="fa fa-trash"></span></a></td>
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
    <div class="modal fade modal-view" id="verpago">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                    <h3 class="modal-title"> Ver pago</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 text-center">
                            <img src="../public/multimedia/presupuesto.png" alt="">
                        </div>
                        <ul class="col-xs-6 list-group">
                            <li class="list-group-item" id="ver_nro"></li>
                           <li class="list-group-item" id="ver_usuario"></li>
                            <li class="list-group-item" id="ver_nombres"></li>
                            <li class="list-group-item" id="ver_fecha"></li>
                            <li class="list-group-item" id="ver_hora"></li>
                            <li class="list-group-item" id="ver_importe"></li>
                        </ul>
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

 <script>
    var verpago = function(nro_pago,usuario,nombres,fecha,hora,importe) {
        $('#ver_nro').html('<b>Nro de pago : </b>0000' + nro_pago);
        $('#ver_usuario').html('<b>Usuario : </b>' + usuario);
        $('#ver_nombres').html('<b>Nombre del paciente : </b>' + nombres);
        $('#ver_fecha').html('<b>Fecha del pago : </b>' + fecha);
        $('#ver_hora').html('<b>Hora del pago : </b>' + hora);
        $('#ver_importe').html('<b>Importe : </b>' + importe);
    };           


     function eliminar_pago(id) {

                    swal({
                        title: 'Eliminar pago',
                        text: "¿Desea eliminar este pago?",
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
                            url: "caja/deletepago.php",
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
                function buscar_pagos() {
                    var desde = $('#desde').val();
                    var hasta = $('#hasta').val();
                    if (desde === "") {
                        swal("Ingrese las fechas del pago a buscar", "", "error");
                        return false;
                    }else{
                    $.ajax({
                        url: "caja/buscar_pagos.php",
                        typr: "GET",
                        data: 'desde=' + desde +'&hasta='+ hasta,
                        success: function(registro) {
                            if (registro) {
                                $('#tbodytabla').html(registro);
                            } else {
                                swal("La fechas ingresadas no poseen pagos disponibles", "", "error");
                                $('#desde').val("");
                                $('#hasta').val("");                            }
                        }

                    });
                    return false;
                 }
                }

            </script>
