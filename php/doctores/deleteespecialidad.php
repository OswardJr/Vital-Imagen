<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$sql="UPDATE especialidades SET status='inactivo' WHERE id_especialidad='$id'";
$result=$con->query($sql);
session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino una especialidad',NOW())";
$result3=$con->query($sql3);

echo '<script>location.reload(true);</script>';