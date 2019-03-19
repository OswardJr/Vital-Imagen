<?php
    require_once('header.php');
    $mensaje = 0;
?>
    <!--El contenido maldito leo tiene que ir aqui en una etiqueta pagewrapper-->
    <div class="page-content">
        <!--Aqui se maqueta-->
        <div class="container-fluid">
            <div class="bread-content">

                <div class="container">
                    <h4>Inventario</h4>
                    <span class="breadcoumb"><i class="fa fa-home"></i> Inicio <i class="fa fa-caret-right"></i>  Inventario</span>
                </div>

            </div>
           <div class="row">

                    <div class="col-sm-12">
                        <?php 
                            require_once("../config/conexion.php");
                            $categorias=$con->query("SELECT * FROM categorias WHERE status_categoria='Activo'");
        			         $sql="SELECT * FROM productos INNER JOIN categorias ON productos.categorias_id = categorias.id_categoria WHERE status_categoria='Activo' AND status_producto='Activo' ";
                             $result=$con->query($sql);
                        ?>

                        <?php if($categorias->num_rows<1){ ?>
                        <div class="container-fluid" style="margin-bottom:235px;">
                            <br>
                            <center>
                                <h3 style=""><i class="fa fa-exclamation-triangle"></i> Atencion: ¡Debe registrar una categoria para ingresar un producto!</h3>
                                <a href="categorias.php" class="btn btn-lca"><i class="fa fa-sign-in"></i> Ir a categorias</a>
                            </center>
                            <br>
                            <br>
                        </div>
                        <?php }else{ ?>

                        <div id="content"></div>
                        <?php if($result->num_rows<1){ ?>
                        <div class="container-fluid text-center" style="margin-bottom:270px;">
                            <h3><i class="fa fa-exclamation-triangle"></i> No hay productos en el inventario</h3>
                            <a href="nuevoproducto.php" style="" class="btn btn-lca"><i class="fa fa-plus"></i> Registrar producto</a>

                        </div>
                        <?php }else{ ?>
                        <div class="container-fluid filtroproducto">
                            <a href="nuevoproducto.php" style="margin-left:-15px;" class="btn nuevo btn-lca"><i class="fa fa-plus"></i> Registrar producto</a> <a href="../reportes/productos/reporteproductos.php" style="margin-right:15px;" target="_blank"><img style="width: 40px;" src="../public/multimedia/pdf.png" class="col-xs-offset-8" title="Exportar PDF"></a>
                        
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 style="text-align:center;">Productos</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table table-responsive">
                                    <table id="tabla" class="display">
                                        <thead>
                                
                                                <th>Nombre del articulo</th>
                                                <th>descripcion</th>
                                                <th>categoria</th>
                                                <th>stock minimo</th>
                                                <th>en existencia</th>
                                                <th>Operaciones</th>
                                
                                        </thead>
                                        <tbody>
                               <?php while($productos=$result->fetch_array()){ 
                                $esteProducto = $productos['id_producto'];
                                $loteProducto = $con->query("SELECT * FROM inventario INNER JOIN productos ON inventario.productos_id = productos.id_producto INNER JOIN lotes ON inventario.lotes_id = lotes.id_lote WHERE id_producto='$esteProducto' ");
                                $loteDelProducto = mysqli_fetch_array($loteProducto);
                                $loteActivo =  $loteDelProducto['status_inventario'];
                                if($loteActivo == 'Activo'){
                                    $loteName = $loteDelProducto['codigo_lote'];
                                    $fechaVenc = $loteDelProducto['fechaVenc'];
                                }else{
                                    $loteName = 'No se encuentra ningun lote activo para este producto, active uno de la lista de lotes disponibles o registre un lote para su activacion posterior en LOTES';
                                    $fechaVenc = 'La fecha de vencimiento correspondera al lote que sea ingresado';
                                }
                               $stockproducto=$productos['stock'];
                               $min_stock=$productos['min_stock'];
                               $id_producto=$productos['id_producto'];
                               ?>
                    
                                            <tr id="<?php echo 'producto'.$productos['id_producto']; ?>">
                                                <td>
                                                    <?php echo $productos['nombre_producto'];?>
                                                </td>

                                                <td>
                                                    <?php echo $productos['descripcion_producto'];?>
                                                </td>
                                                <td>
                                                    <?php echo $productos['nombre_categoria'];?>
                                                </td>
                                                <td>
                                                    <?php echo $productos['min_stock'];?>
                                                </td>
                                                <td class="stockProducto">
                                                    <?php echo $productos['stock']; if($productos['stock'] < $productos['min_stock']){
                                                echo '<i title="Este producto esta por debajo de su stock minimo" style="color:red;" class="fa fa-exclamation-triangle"></i>';
                                            }?></td>
                                                <td><a href="#" data-target="#verproducto" data-toggle="modal" onclick="verproducto('<?php echo $productos['nombre_producto'];?>','<?php echo $productos['descripcion_producto'];?>','<?php echo $productos['nombre_categoria'];?>','<?php echo $productos['stock'];?>','<?php echo $productos['min_stock'];?>','<?php echo $productos['precio'];?>','<?php echo $productos['precio_entrada'];?>','<?php echo $loteName; ?>','<?php echo $fechaVenc; ?>');" class="btn btn-info" title="Ver producto"><i class="fa fa-eye ver"></i></a>
                                                    <a href="editarproducto.php?id=<?php echo $productos['id_producto']; ?>" class="btn btn-warning" title="Editar"><i class="edit_producto fa fa-pencil-square-o"></i></a>
                                                    <a href="javascript:eliminar_producto('<?php echo $productos['id_producto']; ?>');" class="btn btn-danger" title="Eliminar"><i class="delete_producto fa fa-trash"></i></a>
                                                    <a href="#" data-target="#verlotes" data-toggle="modal" onclick="LoteP('<?php echo $productos['id_producto']; ?>','<?php echo $productos['nombre_producto']; ?>','<?php echo $productos['stock']; ?>');" title="Ver lotes" class="btn btn-success"><i class="fa fa-cubes"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>


                                <?php } ?>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>


                <!--MODAL VISTA-->
                <div class="modal fade modal-view" id="verproducto">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                                <h3 class="modal-title"> Ver producto</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-6 text-center">
                                        <img src="../public/multimedia/box.png" alt="">
                                    </div>
                                    <ul class="col-xs-6 list-group">
                                        <li class="list-group-item" id="ver_nombreproducto"></li>
                                        <li class="list-group-item" id="ver_descripcionproducto"></li>
                                        <li class="list-group-item" id="ver_categoriaproducto"></li>
                                        <li class="list-group-item" id="ver_existencia"></li>
                                        <li class="list-group-item" id="ver_proveedores"></li>
                                        <li class="list-group-item" id="ver_precioEntrada"></li>
                                        <li class="list-group-item" id="ver_precio"></li>
                                        <li class="list-group-item" id="veractivo"></li>
                                        <?php 
                                             if($loteActivo == 'Activo'){
                                        ?>
                                        <li class="list-group-item" id="vervencimiento">
                                            <?php } ?>
                                        </li>
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
                <!--MODAL LOTES-->
                <div class="modal fade modal-view" id="verlotes">
                    <div class="modal-dialog" style="max-width:800px;width:80%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button class="close" data-dismiss="modal" aria-hidden="true" title="Cerrar ventana">&times;</button>
                                <h3 class="modal-title"> Ver producto</h3>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xs-3 text-center">
                                        <img src="../public/multimedia/boxs.png" alt="">
                                    </div>
                                    <div class="col-xs-9">
                                      
                                        <table id="lotesModal" class="table display bordered">
                                            <thead>
                                                    <th>Codigo Lote</th>
                                                    <th>Fecha de entrada</th>
                                                    <th>Fecha de vencimiento</th>
                                                    <th>Cantidad</th>
                                                    <th>Recargar lote</th>
                                            </thead>
                                            <tbody id="LotesExtraidos">
                                            </tbody>
                                        </table>
                                     
                                    </div>
                                    <div class"text-center" id="mensajeErrorLotes"><h3 class="text-center"><i class="fa fa-exclamation-triangle"></i> No se han encontrado lotes disponibles para este producto...</h3></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    !Atencion¡, solo se mostraran un maximo de 5 lotes disponibles para el producto seleccionado,para cerrar esta ventana haga click fuera de ella o presione el boton cerrar.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('footer.php'); ?>
        </div>
        <!--Tiene que ser cerrado con 2 div-->
    </div>
    </div>
    <script>
        
        var verproducto = function(nombre, descripcion, categoria, stock, proveedores, precio,precioEntrada, Loteact, fecha) {
            $('#ver_nombreproducto').html('<b>Nombre : </b>' + nombre);
            $('#ver_descripcionproducto').html('<b>Descripcion : </b>' + descripcion);
            $('#ver_categoriaproducto').html('<b>Categoria : </b>' + categoria);
            $('#ver_existencia').html('<b>En existencia : </b>' + stock);
            $('#ver_proveedores').html('<b>Stock minimo : </b>' + proveedores);
            $('#ver_precioEntrada').html('<b>Precio de entrada : </b>' + precioEntrada + ' Bsf');
            $('#ver_precio').html('<b>Precio de venta : </b>' + precio + ' Bsf');
            $('#veractivo').html('<b>Lote Activo : </b>' + Loteact);
            $('#vervencimiento').html('<b>Fecha de vencimiento del lote : </b>' + fecha);
        };

        var LoteP = function(id,nombre,stockpro) {
            
            $('#verlotes .modal-title').html('Lotes disponibles para el producto: '+nombre+' - Stock actual: '+stockpro);

            $.get('lotes/seleccionarLote.php', {
                'id': id
            }, function(datos) {
                if(datos == false){
                    $('#lotesModal').hide();
                    $('#mensajeErrorLotes').show();
                }else{
                    $('#mensajeErrorLotes').hide();
                    $('#lotesModal').show();
                    $('#LotesExtraidos').html(datos);
                    $('#LotesExtraidos tr:nth-child(1)').find('.recargarLote-btn').removeAttr('disabled');
                }
            });
        };

           var recargarLote = function(codigoLote,idProducto) {
            swal({
                title: 'Abastecer inventario',
                text: "¿Desea cargar este lote para este producto?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, abastecer',
                cancelButtonText: 'No, cancelar!',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-warning',
                buttonsStyling: false
            }).then(function() {
            var producto= '#producto'+idProducto;
            var productoLote = $(producto);
            $.post('lotes/abastecer.php', {
                'codigoLote': codigoLote,
                'idProducto': idProducto
            }, function(datos) {
                $(productoLote).find('.stockProducto').html(datos);
                $('#verlotes').modal('hide');
                swal({
                        title: "Lote cargado con exito",
                        text: "",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });         
                setTimeout(function(){ 
                    location.reload(true);
                 }, 1000);
                });
                return true;
            }, function(dismiss) {})
        };

        function eliminar_producto(id) {

            swal({
                title: 'Eliminar producto',
                text: "¿Desea eliminar este producto?",
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
                    url: "productos/deleteproducto.php",
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
