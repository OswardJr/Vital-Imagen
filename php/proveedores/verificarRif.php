<?php
	require_once('../../config/conexion.php');
	$rif = $_POST['rif'];

	$verificar = $con->query("SELECT * FROM proveedores WHERE rif_proveedor = '$rif' LIMIT 1");
	$datos = $verificar ->num_rows;
	echo json_encode($datos);
?>