<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$sql="DELETE FROM pagos WHERE nro_pago='$id'";
$result=$con->query($sql);
$sql2=$con->query("DELETE FROM detalle_factura WHERE id_pago='$id'");
session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino un pago',NOW())";
$result3=$con->query($sql3);


echo '<script>window.</script>';

 ?>


