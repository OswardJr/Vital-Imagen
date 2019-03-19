<?php 
require_once("../../config/conexion.php");
$cedula=$_POST['cedula'];
$sql="DELETE FROM pacientes  WHERE ced_paciente='$cedula'";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino un Paciente',NOW())";
$result3=$con->query($sql3);

echo '<script>location.reload(true);</script>';
 ?>