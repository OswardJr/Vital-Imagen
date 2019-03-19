<?php 
require_once("../../config/conexion.php");
$nro_presupuesto=$_POST['id'];
$sql="UPDATE presupuestos SET status='Inactivo' WHERE nro_presupuesto='$nro_presupuesto'";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino un Presupuesto',NOW())";
$result3=$con->query($sql3);

echo '<script>location.reload(true);</script>';
 ?>