<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$sql="DELETE FROM pacientes  WHERE nro_historia='$id'";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino un Paciente',NOW())";
$result3=$con->query($sql3);

echo '<script>location.reload(true);</script>';
 ?>