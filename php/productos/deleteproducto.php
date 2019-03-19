<?php 
require_once("../../config/conexion.php");
$id=$_POST['id'];
$sql="UPDATE productos SET status_producto='Inactivo' WHERE id_producto='$id'";
$result=$con->query($sql);

$sql2="SELECT * FROM productos INNER JOIN categorias ON productos.categorias_id = categorias.id_categoria WHERE status_producto='Activo' AND status_categoria='Activo' ";
$result2=$con->query($sql2);
session_start();
$idUsuario=$_SESSION['id_usuario'];

$sql3="INSERT INTO bitacora(usuario_id,accion,descripcion,fecha) VALUES ('$idUsuario','Borrar','Elimino un producto',NOW())";
$result3=$con->query($sql3);

echo '<script>location.reload(true);</script>';
 ?>