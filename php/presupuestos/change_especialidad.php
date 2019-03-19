<?php 
require_once("../../config/conexion.php");
$id=$_POST['id_especialidad'];
$sql="SELECT * FROM doctores WHERE id_especialidad='$id' AND status='activo'";
$result=$con->query($sql);
while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	$videos .="<option value='$row[id_doctor]'>$row[nombre]</option>";
}
echo $videos;