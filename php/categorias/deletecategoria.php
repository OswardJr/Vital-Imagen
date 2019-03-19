<?php
session_start();
require_once("../../config/conexion.php");
$id=$_POST['id'];
$idUsuario=$_SESSION['id_usuario'];

$sql="UPDATE categorias SET status_categoria='Inactivo' WHERE id_categoria='$id'";
$result=$con->query($sql);

$sql2="SELECT * FROM categorias WHERE status_categoria='Activo'";
$result2=$con->query($sql2);


$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino una categoria',NOW())";
$result3=$con->query($sql3);

echo '<script>location.reload(true);</script>';


 ?>