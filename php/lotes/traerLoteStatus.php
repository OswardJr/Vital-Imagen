<?php

        require_once("../../config/conexion.php");

        $status = $_GET['status'];
        $lotes="SELECT * FROM inventario INNER JOIN proveedores ON inventario.proovedores_id = proveedores.id_proveedor INNER JOIN lotes ON inventario.lotes_id = lotes.id_lote INNER JOIN productos ON inventario.productos_id = productos.id_producto WHERE status_inventario = '$status' ";
        $result3=$con->query($lotes);

        while($lote=mysqli_fetch_assoc($result3)){
                    $idlote=$lote['id_lote'];
                    $datoslote=$con->query("SELECT * FROM inventario INNER JOIN lotes ON inventario.lotes_id ='$idlote'");
                     $infolote=mysqli_fetch_array($datoslote);                      
                     echo' <tr>
                                        <td>
                                            '.$lote['codigo_lote'].'
                                        </td>
                                        <td>
                                            '.$lote['productos_lote'].'
                                        </td>
                                        <td>
                                            '.$infolote['status_inventario'].'
                                        </td>
                                        <td>
                                            '.$lote['nombre_proveedor'].'
                                        </td>
                                        <td>
 <a class="btn btn-primary" href="#" data-target="#verlote" data-toggle="modal" onclick="verlote(\''.$lote['codigo_lote'].'\',\''.$lote['nombre_proveedor'].'\',\''.$lote['productos_lote'].'\',\''.$infolote['status_inventario'].'\');"><i class="fa fa-eye"></i></a>
                                        </td>
                                    </tr>' ; } 

?>