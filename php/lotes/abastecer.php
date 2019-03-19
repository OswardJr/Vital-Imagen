<?php
require_once("../../config/conexion.php");
$codigo = $_POST['codigoLote'];
$producto = $_POST['idProducto'];

 $verificarlote=$con->query("SELECT * FROM inventario INNER JOIN lotes ON inventario.lotes_id = lotes.id_lote WHERE inventario.productos_id = '$producto' AND lotes_id = '$codigo'");
 $loteSeleccionado = mysqli_fetch_array($verificarlote);

 if ($verificarlote) {
 	if ($verificarlote->num_rows > 0) {
 		$recargar = $loteSeleccionado['cantidad'];
 		$productoSel = $con->query("SELECT * FROM productos WHERE id_producto = '$producto' AND status_producto = 'Activo' ");
 		$productoSeleccionado = mysqli_fetch_array($productoSel);
 		$stock = $productoSeleccionado['stock'];
 		$nuevostock = $stock + $recargar;
 		$actualizarStock = $con->query("UPDATE productos set stock = '$nuevostock' WHERE id_producto = '$producto'");
 		if ($actualizarStock) {
 			$actualizarLote = $con->query("UPDATE inventario set status_inventario = 'Activo' WHERE productos_id = '$producto' AND lotes_id = '$codigo' ");
 			echo $nuevostock;
 		}
  	}
 }

?>