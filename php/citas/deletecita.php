<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$sql="DELETE FROM citas WHERE id_citas='$id'";
$result=$con->query($sql);

session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino una cita',NOW())";
$result3=$con->query($sql3);


echo '<script>location.reload(true);</script>';

 ?>