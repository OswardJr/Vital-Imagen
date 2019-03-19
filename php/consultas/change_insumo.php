<?php 
require_once("../../config/conexion.php");
$id=$_POST['nombre_insumo'];
$sql="SELECT * FROM productos WHERE id_producto='$id' AND status_producto='Activo'";
$result=$con->query($sql);
$data=$result->fetch_assoc();
echo json_encode($data);