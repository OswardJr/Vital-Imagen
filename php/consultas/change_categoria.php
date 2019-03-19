<?php 
require_once("../../config/conexion.php");
$id=$_POST['id_categoria'];
$sql="SELECT * FROM productos WHERE categorias_id='$id' AND status_producto='Activo'";
$result=$con->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$videos .="<option value='$row[id_producto]'>$row[nombre_producto]</option>";
}
echo $videos;